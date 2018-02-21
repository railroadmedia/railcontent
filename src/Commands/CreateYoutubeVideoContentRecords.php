<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;
use Google_Client;


class CreateYoutubeVideoContentRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CreateYoutubeVideoContentRecords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Youtube videos';

    /**
     * @var ContentService
     */
    protected $contentService;

    protected $scope = 'https://www.googleapis.com/auth/youtube';

    /**
     * @var ContentFieldService
     */
    protected $contentFieldService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ContentFieldService $contentFieldService, ContentService $contentService)
    {
        parent::__construct();

        $this->contentFieldService = $contentFieldService;

        $this->contentService = $contentService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Google_Client();
        $client->setDeveloperKey(ConfigService::$videoSync['youtube']['key']);
        $client->setScopes($this->scope);

        $youtube = new \Google_Service_YouTube($client);

        $shouldEnd = 0;
        $maxPages = 5;
        $items = [];

        //get the channels list for youtube user
        $channelsResponse = $youtube->channels->listChannels(
            'contentDetails',
            array(
                'forUsername' => ConfigService::$videoSync['youtube'][ConfigService::$brand]['user'],
                'maxResults' => 50
            )
        );

        //for each channel get the videos from the channel playlists
        foreach ($channelsResponse['items'] as $channel) {
            $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];
            $nextPageToken = '';
            $shouldEnd = 0;
            $page = 1;
            //only 50 video can be received in a call to Youtube API, so we make calls until complete
            do {
                $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems(
                    'id,snippet,contentDetails',
                    array(
                        'playlistId' => $uploadsListId,
                        'maxResults' => 50,
                        'pageToken' => $nextPageToken
                    )
                );

                foreach ($playlistItemsResponse['items'] as $playlistItem) {
                    //get video details
                    $videoParams = array(
                        'id' => $playlistItem['snippet']['resourceId']['videoId'],
                        'fields' => "items(contentDetails(duration))"
                    );
                    $videoDetails = $youtube->videos->listVideos("contentDetails", $videoParams);

                    $videoDetail = $videoDetails->getItems();
                    $video = [
                        'videoId' => $playlistItem['snippet']['resourceId']['videoId'],
                        'duration' => $this->covtime($videoDetail[0]->getContentDetails()->getDuration())
                    ];
                    array_push($items, $video);
                }
                $nextPageToken = $playlistItemsResponse->getNextPageToken();

                if (is_null($nextPageToken) || $page == $maxPages) {
                    $shouldEnd = 1;
                    $page++;
                }
            } while ($shouldEnd == 0);
        }

        $contentCreatedCount = 0;
        $contentFieldsInsertData = [];
        $contentCreationFailed = [];

        foreach ($items as $video) {
            // create if needed
            $noRecordOfVideoInCMS = empty(
            $this->contentService->getBySlugAndType(
                'youtube-video-' . $video['videoId'],
                'youtube-video'
            )
            );

            if ($noRecordOfVideoInCMS && $video['duration'] !== 0 && is_numeric($video['duration'])) {
                // store a new content
                $content = $this->contentService->create(
                    'youtube-video-' . $video['videoId'],
                    'youtube-video',
                    ContentService::STATUS_PUBLISHED,
                    null,
                    null,
                    null,
                    Carbon::now()->toDateTimeString()
                );
                if (empty($content)) {
                    $contentCreationFailed[] = $video['videoId'];
                } else {
                    $contentCreatedCount++;
                    $contentFieldsInsertData[] = $this->contentFieldService->create(
                        $content['id'],
                        'youtube_video_id',
                        $video['videoId'],
                        1,
                        'string'
                    );
                    $contentFieldsInsertData[] = $this->contentFieldService->create(
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
                        'Duration ' .
                        'for video ' . $video['videoId'] . ' is zero and thus video not added.'
                    );
                } elseif (!is_numeric($video['duration'])) {
                    $this->info(
                        'Duration ' .
                        'for video ' . $video['videoId'] . ' is not numeric and thus video not added.' . $video['duration']
                    );
                }
            }
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

        $this->info('CreateYoutubeVideoContentRecords complete.');
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
