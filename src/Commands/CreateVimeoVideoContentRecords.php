<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

use Railroad\Railcontent\Services\ContentService;
use Vimeo\Exceptions\VimeoRequestException;
use Vimeo\Vimeo;

class CreateVimeoVideoContentRecords extends Command
{
    protected $signature = 'CreateVimeoVideoContentRecords {totalNumberToProcess?}';
    protected $description = 'Content from external resources.';

    private $contentService;
    private $databaseManager;
    private $lib;

    private $perPage;
    private $totalNumberToProcess;
    private $total;
    private $amountProcessed;
    private $pagesProcessed;
    private $totalNumberOfPagesToProcess;
    private $numberOnLastPage;

    public function __construct(
        ContentService $contentService,
        DatabaseManager $databaseManager
    ) {
        parent::__construct();
        $this->contentService = $contentService;
        $this->databaseManager = $databaseManager;
    }

    public function handle()
    {
        $this->numberOnLastPage = null;
        $this->total = null;
        $this->totalNumberToProcess = null;
        $this->totalNumberOfPagesToProcess = null;
        $this->amountProcessed = 0;
        $this->perPage = 50;

        $this->info('Starting. The requests can take 5-30 seconds.');

        $client_id = config('railcontent.video_sync')['vimeo'][config('railcontent.brand')]['client_id'];
        $client_secret = config('railcontent.video_sync')['vimeo'][config('railcontent.brand')]['client_secret'];
        $access_token = config('railcontent.video_sync')['vimeo'][config('railcontent.brand')]['access_token'];
        $this->lib = new Vimeo($client_id, $client_secret);
        $this->lib->setToken($access_token);

        // how many videos to get
        $amountRequested = $this->argument('totalNumberToProcess');
        if (empty($amountRequested)) {
            $amountRequested = $this->ask('how many of the latest do you want to get?', 'all');
        }

        if ($amountRequested === 'all') {
            $this->totalNumberToProcess = null;
            $this->info('This\'ll take a while.');
            // If they request all, we don't yet set $this->totalNumberOfPagesToProcess. We have...
            // to wait until the first request returns how many there are available to process.
        } else {
            if (!is_numeric($amountRequested)) {
                $this->info(
                    'ERROR: Non-numeric value (other than allowed string \'all\' passed to ' .
                    '$this->totalNumberToProcess.'
                );
                die();
            }
            $this->totalNumberToProcess = $amountRequested;
            $this->totalNumberOfPagesToProcess = ceil($this->totalNumberToProcess / $this->perPage);

            // If we can get it all done in one page request, there's no point requesting more than needed.
            if ($this->totalNumberToProcess <= $this->perPage) {
                $this->totalNumberOfPagesToProcess = 1;
                $this->perPage = $this->totalNumberToProcess;
            }
        }

        do { // Make calls until complete
            $contentCreatedCount = 0;
            $contentFieldsInsertData = [];

            // Get and parse videos
            $response = $this->getVideos();
            $videos = $response['body']['data'];

            if (!empty($videos)) {
                foreach ($videos as $video) {
                    $uri = $video['uri'];
                    $id = str_replace('/videos/', '', $uri);
                    $duration = $video['duration'];

                    // validate
                    if (!is_numeric($id)) {
                        $this->info(
                            'URI "' . $uri . '" failed to convert to a numeric video id. (used: "$id = ' .
                            'str_replace(\'/videos/\', \'\', $uri);"'
                        );
                    }
                    // create if needed
                    $noRecordOfVideoInCMS = count(
                            $this->contentService->getBySlugAndType(
                                'vimeo-video-' . $id,
                                'vimeo-video'
                            )
                        ) == 0;

                    if ($noRecordOfVideoInCMS && $duration !== 0 && is_numeric($duration)) {
                        // store and add to array for mass insert
                        $content = $this->contentService->create(
                            'vimeo-video-' . $id,
                            'vimeo-video',
                            ContentService::STATUS_PUBLISHED,
                            null,
                            null,
                            null,
                            Carbon::now()->toDateTimeString()
                        );
                        if (empty($content)) {
                            $contentCreationFailed[] = $id;
                        } else {
                            $contentCreatedCount++;
                            $contentFieldsInsertData[] = [
                                'content_id' => $content['id'],
                                'key' => 'vimeo_video_id',
                                'value' => $id,
                                'type' => 'string',
                                'position' => 1,
                            ];
                            $contentFieldsInsertData[] = [
                                'content_id' => $content['id'],
                                'key' => 'length_in_seconds',
                                'value' => $duration,
                                'type' => 'integer',
                                'position' => 1,
                            ];
                        }
                    } else {
                        if ($duration === 0) {
                            $this->info(
                                'Duration ' .
                                // '("print_r($duration, true)" returned: `' . print_r($duration, true) . '`) ' .
                                'for video ' .
                                $id .
                                ' is zero and thus video not added.'
                            );
                        } elseif (!is_numeric($duration)) {
                            $this->info(
                                'Duration ' .
                                // '("print_r($duration, true)" returned: `' . print_r($duration, true) . '`) ' .
                                'for video ' .
                                $id .
                                ' is not numeric and thus video not added.'
                            );
                        }
                    }
                    $this->amountProcessed++;
                }
            }

            // set values now that we have them
            if (is_null($this->total)) { // if not yet set, then this if the first iteration
                $this->total = $response['body']['total'];
                if ($this->totalNumberToProcess > $this->total) {
                    $this->info(
                        'You\'ve requested that we process ' .
                        $this->totalNumberToProcess .
                        ' videos but there are only ' .
                        $this->total .
                        ' available to process for this user. Thus, ' .
                        'we\'ll do the sensible thing here.'
                    );
                    $this->totalNumberToProcess = $this->total;
                }
                if (is_null($this->numberOnLastPage)) {
                    $this->numberOnLastPage = $this->totalNumberToProcess % $this->perPage;
                }
                $this->totalNumberOfPagesToProcess = ceil($this->totalNumberToProcess / $this->perPage);
            }

            // content-field data insert and assess DB-writing success
            $contentFieldsWriteSuccess = $this->databaseManager->connection(
                config('railcontent.database_connection_name')
            )
                ->table(config('railcontent.table_prefix') . 'content_fields')->insert($contentFieldsInsertData);
            if ($contentFieldsWriteSuccess && empty($contentCreationFailed)) {
                $this->info(
                    'Processed ' . count($videos) . ' videos. ' .
                    (count($contentFieldsInsertData) + $contentCreatedCount) . ' DB rows created.'
                );
            } else {
                if (!empty($contentCreationFailed)) {
                    $this->info(
                        'There was|were ' . count($contentCreationFailed) . ' content creation failure(s):'
                    );
                    $this->info(print_r($contentCreationFailed, true));
                }
                if (!$contentFieldsWriteSuccess) {
                    $this->info("contentFields write failed");
                }
            }
        } while ($this->amountProcessed < $this->totalNumberToProcess);

        $this->info('CreateVimeoVideoContentRecords complete.');
    }

    private function getVideos()
    {
        $response = null;
        do {
            try {
                $totalNumberRemainingToProcess = $this->totalNumberToProcess - $this->amountProcessed;
                $lastPage = $totalNumberRemainingToProcess < $this->perPage;
                $this->info(
                    'Requesting page ' .
                    $this->pageToGet() .
                    ' of ' .
                    $this->totalNumberOfPagesToProcess .
                    '.'
                );
                $response = $this->lib->request( // developer.vimeo.com/api/endpoints/videos#GET/users/{user_id}/videos
                    '/me/videos',
                    [
                        'per_page' => $this->perPage,
                        'page' => $this->pageToGet(),
                        'sort' => 'date',
                        'direction' => 'desc',
                    ],
                    'GET'
                );
                if ($lastPage) {
                    $response['body']['data'] = array_slice(
                        $response['body']['data'],
                        0,
                        $totalNumberRemainingToProcess
                    ); // Note that we're getting the videos by date in descending order.
                }
                $success = true;
            } catch (VimeoRequestException $e) {
                $success = false;
                $this->info('Oops, timed-out. Trying page ' . $this->totalNumberToProcess . ' again.');
            }
            if ($success) {
                $this->info(
                    'Success. Now processing ' . count($response['body']['data']) . ' videos in this batch.'
                );
            }
        } while (!$success);

        return $response;
    }

    private function pageToGet()
    {
        if (empty($this->total)) {
            //If the total number available to get is not yet set here, it is
            // because we have not yet made a request, thus start at the start.
            return 1;
        }
        $this->pagesProcessed = floor($this->amountProcessed / $this->perPage);

        return $this->pagesProcessed + 1;
    }
}
