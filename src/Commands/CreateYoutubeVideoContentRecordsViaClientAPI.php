<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ConfigService;


class CreateYoutubeVideoContentRecordsViaClientAPI extends Command
{
    const MAX_PAGES_ALLOWED = 5;

    protected $signature = 'content:CreateYoutubeVideoContentRecordsViaClientAPI {maxPages?} {skipPages?}';
    protected $description = 'Pull YT videos from channel and sync to content database.';

    protected $scope = 'https://www.googleapis.com/auth/youtube';


    public function info($string, $verbosity = null)
    {
        Log::info($string); //also write info statements to log
        $this->line($string, 'info', $verbosity);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ContentFieldService $contentFieldService, ContentService $contentService)
    {
        $this->info("Processing $this->name");
        $timeStart = microtime(true);

        foreach (ConfigService::$availableBrands as $brand) {
            $this->info("Processing $brand videos");
            $client = new Google_Client();
            $youtube = new Google_Service_YouTube($client);

            $client->setClientId(config("railcontent.video_sync.$brand.youtube_client_api.client_id"));
            $client->setClientSecret(config("railcontent.video_sync.$brand.youtube_client_api.client_secret"));

            $client->setScopes(['https://www.googleapis.com/auth/youtube']);
            $client->setAccessType("offline");
            $client->setApprovalPrompt('force');

            $tokenData = $client->refreshToken(
                config("railcontent.video_sync.$brand.youtube_client_api.refresh_token")
            );

            $client->setAccessToken($tokenData['access_token']);

            $shouldEnd = 0;
            $items = [];

            if (is_numeric($this->argument('maxPages'))) {
                $maxPages = (int)$this->argument('maxPages');
            }

            if (empty($maxPages) || $maxPages > $this::MAX_PAGES_ALLOWED) {
                $maxPages = $this::MAX_PAGES_ALLOWED;
            }

            $skipPages = 0;
            if (is_numeric($this->argument('skipPages'))) {
                $skipPages = (int)$this->argument('skipPages');

                // todo: maybe rename max pages since it's no longer the max *number* of pages, but rather which page to stop at
                $maxPages = $maxPages + $skipPages;
            }

            // get the channels list for youtube user
            // note: a refresh token generally represents a single YT channel so we should never get more
            // than 1 channel back here
            $channelsResponse = $youtube->channels->listChannels(
                'contentDetails',
                array(
                    'mine' => true,
                    'maxResults' => 50,
                )
            );

            // for each channel get the videos from the channel playlists
            foreach ($channelsResponse['items'] as $channel) {
                $this->info('Processing a set of videos');
                $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];
                $nextPageToken = '';
                $shouldEnd = 0;
                $page = $skipPages; // default if supplied is 0

                // only 50 video can be received in a call to Youtube API, so we make calls until complete
                do {
                    $this->info('Retrieving 50 items');

                    $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems(
                        'id,snippet,contentDetails',
                        array(
                            'playlistId' => $uploadsListId,
                            'maxResults' => 50,
                            'pageToken' => $nextPageToken,
                        )
                    );

                    foreach ($playlistItemsResponse['items'] as $playlistItem) {
                        $videoId = $playlistItem['snippet']['resourceId']['videoId'];

                        // get video details
                        $videoParams = array(
                            'id' => $videoId,
                            'fields' => "items(contentDetails(duration))",
                        );
                        $videoDetails = $youtube->videos->listVideos("contentDetails", $videoParams);

                        $duration = $videoDetails->getItems()[0]->getContentDetails()->getDuration();
                        $duration = $this->covtime($duration);

//                    $this->info('Retrieved video ' . $videoId . ' with duration value of ' . $duration);

                        $video = [
                            'videoId' => $videoId,
                            'duration' => $duration,
                        ];
                        array_push($items, $video);
                    }
                    $nextPageToken = $playlistItemsResponse->getNextPageToken();

                    $page++;

                    if (is_null($nextPageToken) || $page >= $maxPages) {
                        $shouldEnd = 1;
                    }
                } while ($shouldEnd == 0);
            }

            $contentCreatedCount = 0;
            $contentFieldsInsertData = [];
            $contentCreationFailed = [];

            $processed = 0;

            foreach ($items as $video) {
                if ($processed % 25 == 0) {
                    $this->info('Processing 25 items (so far processed ' . $processed . ' of ' . count($items));
                }

                // create if needed
                $existingRecords = $contentService->getBySlugAndType(
                    'youtube-video-' . $video['videoId'],
                    'youtube-video'
                );

                if ($existingRecords->count() == 0 && $video['duration'] !== 0 && is_numeric($video['duration'])) {
                    $this->info('video ' . $video['videoId'] . ' not found in our database');

                    // store a new content
                    $content = $contentService->create(
                        'youtube-video-' . $video['videoId'],
                        'youtube-video',
                        ContentService::STATUS_PUBLISHED,
                        null,
                        $brand,
                        null,
                        Carbon::now()->toDateTimeString(),
                        null,
                        0,
                        false
                    );

                    if (empty($content)) {
                        $contentCreationFailed[] = $video['videoId'];
                    } else {
                        $contentCreatedCount++;
                        $contentFieldsInsertData[] = $contentFieldService->create(
                            $content['id'],
                            'youtube_video_id',
                            $video['videoId'],
                            1,
                            'string'
                        );
                        $contentFieldsInsertData[] = $contentFieldService->create(
                            $content['id'],
                            'length_in_seconds',
                            $video['duration'],
                            1,
                            'integer'
                        );
                    }
                } else {
                    if ($video['duration'] === 0) {
                        $this->info(
                            'Duration ' . 'for video ' . $video['videoId'] . ' is zero and thus video not added.'
                        );
                    } elseif (!is_numeric($video['duration'])) {
                        $this->info(
                            'Duration ' . 'for video ' . $video['videoId'] .
                            ' is not numeric and thus video not added.' . $video['duration']
                        );
                    }
                }
                $processed++;
            }

            $this->info(
                'Processed ' . count($items) . ' videos. ' .
                (count($contentFieldsInsertData) + $contentCreatedCount) . ' DB rows created.'
            );

            if (!empty($contentCreationFailed)) {
                $this->info(
                    'There was|were ' . count($contentCreationFailed) . ' content creation failure(s):'
                );
                $this->info(print_r($contentCreationFailed, true));
            }
        }

        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $this->info("Finished $this->name ($sec s)");
    }

    /** Convert video's duration from ISO 8601 to seconds
     * @param string $youtube_time - ISO 8601
     * @return float|int
     */
    function covtime($youtube_time)
    {
        $interval = new \DateInterval($youtube_time);

        return ($interval->d * 24 * 60 * 60) +
            ($interval->h * 60 * 60) +
            ($interval->i * 60) +
            $interval->s;
    }
}
