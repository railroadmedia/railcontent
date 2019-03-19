<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

use Railroad\Railcontent\Services\ContentService;
use Google_Client;


class CreateYoutubeVideoContentRecords extends Command
{
    const MAX_PAGES_ALLOWED = 10;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CreateYoutubeVideoContentRecords {maxPages?} {skipPages?}';

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ContentService $contentService)
    {
        parent::__construct();

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
        $client->setDeveloperKey(config('railcontent.video_sync')['youtube']['key']);
        $client->setScopes($this->scope);

        $youtube = new \Google_Service_YouTube($client);

        $shouldEnd = 0;
        $items = [];

        if(is_numeric($this->argument('maxPages'))){
            $maxPages = (int) $this->argument('maxPages');
        }

        if (empty($maxPages) || $maxPages > $this::MAX_PAGES_ALLOWED) {
            $maxPages = $this::MAX_PAGES_ALLOWED;
        }

        $skipPages = 0;
        if(is_numeric($this->argument('skipPages'))){
            $skipPages = (int) $this->argument('skipPages');

            // todo: maybe rename max pages since it's no longer the max *number* of pages, but rather which page to stop at
            $maxPages = $maxPages + $skipPages;
        }

        //get the channels list for youtube user
        $channelsResponse = $youtube->channels->listChannels(
            'contentDetails',
            array(
                'forUsername' => config('railcontent.video_sync')['youtube'][config('railcontent.brand')]['user'],
                'maxResults' => 50
            )
        );

        //for each channel get the videos from the channel playlists
        foreach ($channelsResponse['items'] as $channel) {
            $this->info('Processing a set of videos');
            $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];
            $nextPageToken = '';
            $shouldEnd = 0;
            $page = $skipPages; // default if supplied is 0
            //only 50 video can be received in a call to Youtube API, so we make calls until complete
            do {
                $this->info('Retrieving 50 items');

                $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems(
                    'id,snippet,contentDetails',
                    array(
                        'playlistId' => $uploadsListId,
                        'maxResults' => 50,
                        'pageToken' => $nextPageToken
                    )
                );

                foreach ($playlistItemsResponse['items'] as $playlistItem) {

                    $videoId = $playlistItem['snippet']['resourceId']['videoId'];

                    //get video details
                    $videoParams = array(
                        'id' => $videoId,
                        'fields' => "items(contentDetails(duration))"
                    );
                    $videoDetails = $youtube->videos->listVideos("contentDetails", $videoParams);

                    $duration = $videoDetails->getItems()[0]->getContentDetails()->getDuration();
                    $duration = $this->covtime($duration);

//                    $this->info('Retrieved video ' . $videoId . ' with duration value of ' . $duration);

                    $video = [
                        'videoId' => $videoId,
                        'duration' => $duration
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

            if ($processed % 25 == 0){
                $this->info('Processing 25 items (so far processed ' . $processed . ' of ' . count($items));
            }

            // create if needed
            $noRecordOfVideoInCMS = empty(
                $this->contentService->getBySlugAndType('youtube-video-' . $video['videoId'],'youtube-video')
            );

            if ($noRecordOfVideoInCMS && $video['duration'] !== 0 && is_numeric($video['duration'])) {

                $this->info('video ' . $video['videoId'] . ' not found in our database');

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
//                    $contentFieldsInsertData[] = $this->contentFieldService->create(
//                        $content['id'],
//                        'youtube_video_id',
//                        $video['videoId'],
//                        1,
//                        'string'
//                    );
//                    $contentFieldsInsertData[] = $this->contentFieldService->create(
//                        $content['id'],
//                        'length_in_seconds',
//                        $video['duration'],
//                        1,
//                        'integer'
//                    );
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
