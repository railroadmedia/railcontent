<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Storage;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Vimeo\Exceptions\VimeoRequestException;
use Vimeo\Vimeo;

class CreateVimeoVideoContentRecords extends Command
{
    protected $signature = 'CreateVimeoVideoContentRecords ' .
        '{totalNumberToProcess?} ' .    // required - will prompt if not entered
        '{writeToDb?} ' .               // optional - defaults to true
        '{outputToLogFile?} ' .         // optional - defaults to false
        '{numberPerPage?}';             // optional - defaults to self::MAX_PER_PAGE_API_LIMIT

    protected $description = 'Content from external resources.';

    private $contentService;
    private $databaseManager;
    private $lib;

    private $perPage;
    private $totalNumberToProcess;
    private $total;
    private $amountProcessed;
    private $totalNumberOfPagesToProcess;
    private $numberOnLastPage;
    private $logFileName;
    private $pageToGet;

    const MAX_PER_PAGE_API_LIMIT = 50;

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
        // =============================================================================================================
        // A file for writing helpful info =============================================================================
        // =============================================================================================================

        $time = (string) time();
        $time = substr($time,4);
        $time1 = substr($time,0, 3);
        $time2 = substr($time, 3);
        $time = $time1 . '_' . $time2;
        $faker = \Faker\Factory::create();
        $dir = 'CreateVimeoVideoContentRecords_output/';
        $this->logFileName = $dir . $time . '_' . $faker->firstNameFemale . '.json';

        $vimeoIdsOfVideosNotInCMS = [];

        // =============================================================================================================
        // ====================================================================== END OF A file for writing helpful info
        // =============================================================================================================

        $this->numberOnLastPage = null;
        $this->total = null;
        $this->totalNumberToProcess = null;
        $this->totalNumberOfPagesToProcess = null;
        $this->amountProcessed = 0;
        $this->perPage = self::MAX_PER_PAGE_API_LIMIT;

        $this->info('Starting. The requests can take 5-30 seconds.');

        $client_id = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_id'];
        $client_secret = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_secret'];
        $access_token = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['access_token'];
        $this->lib = new Vimeo($client_id, $client_secret);
        $this->lib->setToken($access_token);

        // -------------------------------------------------------------------------------------------------------------

        $amountRequested = $this->argument('totalNumberToProcess');
        if (empty($amountRequested)) {
            $amountRequested = $this->ask('how many of the latest do you want to get?', 'all');
        }

        // -------------------------------------------------------------------------------------------------------------

        $allRequested = $amountRequested === 'all';

        if ($allRequested) {
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

        // -------------------------------------------------------------------------------------------------------------

        if (
            empty($this->argument('writeToDb')) ||
            $this->argument('writeToDb') == 1 ||
            $this->argument('writeToDb') === 'true' ||
            strtolower($this->argument('writeToDb')) === 'writetodb'
        ) {
            $writeToDb = true;
        }elseif($this->argument('writeToDb') === 'false'){
            $writeToDb = false;
        }else{
            $this->info('"writeToDb" param was unexpected value and thus set to "false"');
            $writeToDb = false;
        }

        // -------------------------------------------------------------------------------------------------------------

        if(
            $this->argument('outputToLogFile') == 1 ||
            $this->argument('outputToLogFile') === 'true' ||
            strtolower($this->argument('outputToLogFile')) === 'outputtologfile'
        ){
            $outputToLogFile = true;
        }else{
            $outputToLogFile = false;
        }

        // -------------------------------------------------------------------------------------------------------------

        $numberPerPageArg = $this->argument('numberPerPage');

        $numPerPageNotEmpty = !empty($numberPerPageArg);
        $numIsNotTooMuch = $numberPerPageArg <= self::MAX_PER_PAGE_API_LIMIT;

        if($numPerPageNotEmpty && $numIsNotTooMuch){
            $this->perPage = $numberPerPageArg;
        }

        // -------------------------------------------------------------------------------------------------------------

        do { // Make calls until complete
            $contentCreatedCount = 0;
            $contentFieldsInsertData = [];
            $contentCreationFailed = [];

            // Get and parse videos
            $response = $this->getVideos();

            // =========================================================================================================
            // helpful header for each page ============================================================================
            // =========================================================================================================

            $headerForOutputText = '----------------------- page ' . $this->pageToGet . ' of ' .
                $this->totalNumberOfPagesToProcess . ' -----------------------';

            $mfDatePile[] = $headerForOutputText;


            // =========================================================================================================
            // ===================================================================== END OF helpful header for each page
            // =========================================================================================================

            $videos = $response['body']['data'];

//            $this->justDumpThisShitAndThenStop($videos);

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
                    $recordInCms = $this->contentService->getBySlugAndType(
                        'vimeo-video-' . $id,
                        'vimeo-video'
                    );

                    $noRecordOfVideoInCMS = empty($recordInCms);

                    $createNeeded = $noRecordOfVideoInCMS && $duration !== 0 && is_numeric($duration);

                    $content = null;

                    if ($createNeeded) {
                        // store and add to array for mass insert

                        if($writeToDb){
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
                                    'position' => 1
                                ];
                                $contentFieldsInsertData[] = [
                                    'content_id' => $content['id'],
                                    'key' => 'length_in_seconds',
                                    'value' => $duration,
                                    'type' => 'integer',
                                    'position' => 1
                                ];
                            }
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

                    // echo 'amountProcessed ' . $this->amountProcessed . PHP_EOL;


                    // =================================================================================================
                    // helpful output message for each video ===========================================================
                    // =================================================================================================

                    $info = [];

                    if($noRecordOfVideoInCMS){
                        $info[] = 'NOT IN CMS';
                        $vimeoIdsOfVideosNotInCMS[] = $id;
                    }else{
                        reset($recordInCms);
                        $contentId = key($recordInCms);

                        if(isset($recordInCms[$contentId]['brand'])){
                            $brand = $recordInCms[$contentId]['brand'];
                            if($brand !== ConfigService::$brand){
                                $info[] = 'brand in DB (' . $brand . ') does *not* match application (' . ConfigService::$brand . ')';
                            }
                        }

                        $info[] = 'exists already with content id ' . $contentId;
                    }

                    if(!empty($content)){
                        $info['created'] = $content;
                    }

                    if ($createNeeded) {
                        $info['will create'] = [
                            'contentFieldsInsertData' => [
                                [
                                    'content_id' => $content['id'],
                                    'key' => 'vimeo_video_id',
                                    'value' => $id,
                                    'type' => 'string',
                                    'position' => 1
                                ], [
                                    'content_id' => $content['id'],
                                    'key' => 'length_in_seconds',
                                    'value' => $duration,
                                    'type' => 'integer',
                                    'position' => 1
                                ]
                            ]
                        ];
                        if($createNeeded && empty($content)){
                            $info['$contentCreationFailed'] = true;
                        }
                    }

                    $uriForMsg = str_replace('/', ' / ', $uri);
                    $info[] = [
                        'uri' => startsWith($uriForMsg, ' / ') ? ltrim($uriForMsg, ' / ') : $uriForMsg,
                        'id' => $id,
                        'duration' => $duration,
                    ];

                    $mfDatePile[] = [$id => $info];

                    // echo 'id: ' . $id . PHP_EOL;

                    // =================================================================================================
                    // ==================================================== END OF helpful output message for each video
                    // =================================================================================================
                }
            }

            // set values now that we have them
            if (is_null($this->total)) { // if not yet set, then this if the first iteration
                $this->total = $response['body']['total'];

                // echo '$this->total: ' . $this->total . PHP_EOL;

                if ($this->totalNumberToProcess > $this->total) {
                    $this->info(
                        'You\'ve requested that we process ' . $this->totalNumberToProcess .
                        ' videos but there are only ' . $this->total .
                        ' available to process for this user. Thus, we\'ll do the sensible thing here.'
                    );
                    $this->totalNumberToProcess = $this->total;
                }

                if(is_null($this->totalNumberToProcess)){
                    if(!$allRequested){
                        $this->info('Something is fucky - I have a "$allRequested" var here that\'s not set ' .
                            'but then I have "is_null($this->totalNumberToProcess)" evaluating to true, so I don\'t know '.
                            'what to do. I\'ll just get fucking everything and just let you know that there\'s something ' .
                            'fucky in here');
                    }
                    $this->totalNumberToProcess = $this->total;
                    $this->info(PHP_EOL .
                        'Hey we found out how many there are! There\'s ' . $this->totalNumberToProcess .
                        ' videos and we\'re gonna do \'em all! Maybe get some coffee or something, it might be a while.' .
                        PHP_EOL
                    );
                }

                if (is_null($this->numberOnLastPage)) {
                    $this->numberOnLastPage = $this->totalNumberToProcess % $this->perPage;
                }
                $this->totalNumberOfPagesToProcess = ceil($this->totalNumberToProcess / $this->perPage);
            }

            if($writeToDb){
                // content-field data insert and assess DB-writing success
                $contentFieldsWriteSuccess = $this->databaseManager
                    ->connection(ConfigService::$databaseConnectionName)
                    ->table(ConfigService::$tableContentFields)
                    ->insert($contentFieldsInsertData);
                if ($contentFieldsWriteSuccess && empty($contentCreationFailed)) {

                    $this->pageToGet = floor($this->amountProcessed / $this->perPage) + 1;

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
            }else{
                $this->pageToGet = floor($this->amountProcessed / $this->perPage) + 1;
            }

        } while ($this->amountProcessed < $this->totalNumberToProcess);


        // =============================================================================================================
        // Write to the helpful file ===================================================================================
        // =============================================================================================================

        if($outputToLogFile){
            Storage::put($this->logFileName, json_encode(
                [
                    'vimeo Ids Of Videos Not In CMS (search "NOT IN CMS")' => $vimeoIdsOfVideosNotInCMS,
                    'motherfucking data pile' => $mfDatePile
                ]
            ));

            $commandToRun = 'chmod 777 -R /app/pianote/storage/app/' . $dir;
            $chmodOutput = exec($commandToRun);
            if(!empty($chmodOutput)){
                echo '$chmodOutput is: "' . $chmodOutput . '".';
            }
        }

        // =============================================================================================================
        // ============================================================================ END OF Write to the helpful file
        // =============================================================================================================


        $this->info('CreateVimeoVideoContentRecords complete.');
    }

    private function getVideos()
    {
        $response = null;
        do {
            try {
                $totalNumberRemainingToProcess = $this->totalNumberToProcess - $this->amountProcessed;
                $lastPage = $totalNumberRemainingToProcess < $this->perPage;

                if(is_null($this->totalNumberToProcess)){
                    $this->info(
                        'Requesting page ' . $this->pageToGet .
                        ' of ? (we have to make the first request to find out how many there are).'
                    );
                }else{
                    $this->info(
                        'Requesting page ' . $this->pageToGet . ' of ' . $this->totalNumberOfPagesToProcess . '.'
                    );
                }

                if (empty($this->total)) {
                    //If the total number available to get is not yet set here, it is
                    // because we have not yet made a request, thus start at the beginning.
                    $this->pageToGet = 1;
                }

                $response = $this->lib->request( // developer.vimeo.com/api/endpoints/videos#GET/users/{user_id}/videos
                    '/me/videos',
                    [
                        'per_page' => $this->perPage,
                        'page' => $this->pageToGet,
                        'sort' => 'date',
                        'direction' => 'desc'
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

    private function justDumpThisShitAndThenStop($shit){
        $dir = 'CreateVimeoVideoContentRecords_output/';
        Storage::put($this->logFileName, json_encode($shit));
        $commandToRun = 'chmod 777 -R /app/pianote/storage/app/' . $dir;
        $chmodOutput = exec($commandToRun);
        if(!empty($chmodOutput)){
            echo '$chmodOutput is: "' . $chmodOutput . '".';
        }
        die();
    }
}
