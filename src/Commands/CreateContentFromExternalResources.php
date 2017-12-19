<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoRequestException;

class CreateContentFromExternalResources extends Command
{
    protected $signature = 'CreateContentFromExternalResources {totalNumberToProcess?}';
    protected $description = 'Content from external resources.';

    /**
     * @var ContentService
     */
    private $contentService;
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var Vimeo
     */
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
    )
    {
        parent::__construct();
        $this->contentService = $contentService;
        $this->databaseManager = $databaseManager;
    }

    public function handle()
    {
        $this->info('Starting. The requests can take 5-30 seconds.');

        $this->numberOnLastPage = null;
        $this->total = null;
        $this->totalNumberToProcess = null;
        $this->totalNumberOfPagesToProcess = null;
        $this->amountProcessed = 0;
        $this->perPage = 50;


        // how many videos to get

        $amountRequested = $this->argument('totalNumberToProcess');

        if(empty($amountRequested)) {
            $amountRequested = $this->ask('how many of the latest do you want to get?', 'all');
        }

        if($amountRequested === 'all'){
            $this->totalNumberToProcess = null;
            $this->info('This\'ll take a while.');
            /*
             * If they request all, we don't yet set $this->totalNumberOfPagesToProcess. We have to wait until the
             * first request returns how many there are available to process.
             */
        }else{
            if(!is_numeric($amountRequested)){
                $this->info('ERROR: Non-numeric value passed to $this->totalNumberToProcess. ' .
                    'This should no be possible. Something is broken. Exiting now.' );
                die();
            }

            $this->totalNumberToProcess = $amountRequested;

            $this->totalNumberOfPagesToProcess = ceil( $this->totalNumberToProcess / $this->perPage);

            // can get it all done in one page request
            if($this->totalNumberToProcess <= $this->perPage){
                $this->totalNumberOfPagesToProcess = 1;
                $this->perPage = $this->totalNumberToProcess; // no point requesting more than needed.
            }
        }


        // Vimeo library

        $client_id = ConfigService::$videoSync['vimeo']['drumeo']['client_id'];
        $client_secret = ConfigService::$videoSync['vimeo']['drumeo']['client_secret'];
        $access_token = ConfigService::$videoSync['vimeo']['drumeo']['access_token'];

        $this->lib = new Vimeo($client_id, $client_secret);
        $this->lib->setToken($access_token);


        // Make calls until complete

        do {
            $contentCreatedCount = 0;
            $contentFieldsInsertData = [];


            // Get and parse videos

            $response = $this->getVideos();

            $videos = $response['body']['data'];

            if(!empty($videos)){

                foreach ($videos as $video) {

                    $uri = $video['uri'];
                    $id = str_replace('/videos/', '', $uri);
                    $duration = $video['duration'];


                    // validate

                    if (!is_numeric($id)) {
                        $this->info('URI "' . $uri . '" failed to convert to a numeric video id. (used: "$id = ' .
                            'str_replace(\'/videos/\', \'\', $uri);"');
                    }

                    if (!is_numeric($duration)) {
                        $this->info('Video failed to provide numeric duration value. (video with URI "' . $uri . '")');
                    }


                    // create if needed

                    $noRecordOfVideoInCMS = empty($this->contentService->getBySlugAndType(
                        'vimeo-video-' . $id, 'vimeo-video'
                    ));

                    if($noRecordOfVideoInCMS){


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
                        }else{
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

                    $this->amountProcessed++;
                }
            }else{
                error_log(
                    'ERROR: "src/Commands/CreateContentFromExternalResources.php" requested videos ' .
                    'but received an empty response. This makes no sense and should not have happened. It *may* be ' .
                    'indicative of something being wrong somewhere.'
                );
            }


            // if first request, now have information previously missing

            if(is_null($this->total)){ // if not yet set, then this if the first iteration
                $this->total = $response['body']['total'];
                if($this->totalNumberToProcess > $this->total){
                    $this->info(
                        'You\'ve requested that we process ' . $this->totalNumberToProcess .
                        ' videos but there are only ' . $this->total . ' available to process for this user. Thus, ' .
                        'we\'ll do the sensible thing here.'
                    );
                    $this->totalNumberToProcess = $this->total;
                }
                if(is_null($this->numberOnLastPage)){
                    $this->numberOnLastPage = $this->totalNumberToProcess % $this->perPage;
                }
                $this->totalNumberOfPagesToProcess = ceil( $this->totalNumberToProcess / $this->perPage);
            }


            // content-field data insert and assess DB-writing success

            $contentFieldsWriteSuccess = $this->databaseManager->connection(ConfigService::$databaseConnectionName)
                ->table(ConfigService::$tableContentFields)
                ->insert($contentFieldsInsertData);

            if($contentFieldsWriteSuccess && empty($contentCreationFailed)){
                $this->info(
                    'Processed ' . count($videos) . ' videos. ' .
                    (count($contentFieldsInsertData) + $contentCreatedCount) . ' DB rows created.'
                );
            }else{
                if(!empty($contentCreationFailed)){
                    $this->info(
                        'There was|were ' . count($contentCreationFailed) . ' content creation failure(s):'
                    );
                    $this->info(print_r($contentCreationFailed,true));
                }
                if(!$contentFieldsWriteSuccess){
                    $this->info("contentFields write failed");
                }
            }


            // loop again?

            $getMore = $this->amountProcessed < $this->totalNumberToProcess;

        } while ( $getMore );

        $this->info('');
        $this->info('------------------------------------------------------------');
        $this->info('Complete.');
    }

    private function getVideos()
    {
        /*
         * In cases where this is the last page requested (to fulfill the requested number of videos), we could here
         * only return the number of videos needed to meet that request. That is to say, we could alter the request for
         * the last page (hint: euclidean algorithm) to only get as many as is required).
         *
         * But we're not doing that. That would make this command more complex to a degree not befitting it's current
         * purpose. Instead we just won't process the extra videos.
         *
         * For example:
         *      * Each page has 10 videos.
         *      * User requests 33 videos.
         *      * That's 4 page requests
         *          * The first 3 supplying 10 videos each for a total of 30 videos
         *          * The last page request to get those remaining 3.
         *      * However, that last page request returns 10 videos, which brings the amount available to process
         *            to at least 33, thus fulfilling the request to get 33 videos—though imperfectly perhaps.
         *
         * Jonathan, December 2017
         */

        $response = null;

        do{

            try{

                /*
                 * above we only should call this method if there's still some to process.
                 * if `($this->totalNumberToProcess - $this->amountProcessed) === 0)` is true above
                 * we should not have gotten here and thus something is wrong.
                 *
                 * Jonathan, Dec 2017
                 */

                if(($this->totalNumberToProcess - $this->amountProcessed) === 0){
                    $this->info('this shouldn\'t be possible!');
                    die();
                };

                /*
                 * If the number remaining to process is less than what can be done on one page, then this is the last
                 * page (the last request we have to make).
                 *
                 * If it's more, it's not the last request, and in the code above (where this method is called from)
                 * "$getMore" (assigned as per this: $this->amountProcessed < $this->totalNumberToProcess;`) will be
                 * true.
                 *
                 * If the number remaining to process is equal to the number per page (say its just a coincidence that
                 * there are exactly that many remaining) then we don't need to care that this will be the last page,
                 * just run as per usual and `$getMore = $this->amountProcessed < $this->totalNumberToProcess;` above
                 * will be false, thus ending
                 * the running of this command without having to worry about any messy "remainder-handling"
                 *
                 * Jonathan, December 2017
                 */

                $totalNumberRemainingToProcess = $this->totalNumberToProcess - $this->amountProcessed;
                $lastPage = $totalNumberRemainingToProcess < $this->perPage;

                $success = true;

                $this->info('');
                $this->info(
                    'Requesting page ' . $this->pageToGet() . ' of ' . $this->totalNumberOfPagesToProcess . '...'
                );

                $response = $this->lib->request( // developer.vimeo.com/api/endpoints/videos#GET/users/{user_id}/videos
                    '/me/videos',
                    [
                        'per_page' => $this->perPage,
                        'page' => $this->pageToGet(),
                        'sort' => 'date',
                        'direction' => 'desc'
                    ],
                    'GET'
                );

                if($lastPage){
                    // Note that we're getting the videos by date in descending order.
                    $response['body']['data'] = array_slice(
                        $response['body']['data'], 0, $totalNumberRemainingToProcess
                    );
                }

            } catch (VimeoRequestException $e){
                $success = false;
                $this->info('Oops, timed-out. Trying page ' . $this->totalNumberToProcess . ' again.');
            }

            $this->info('Success. Now processing ' . count($response['body']['data']) . ' videos in this batch...');
        } while (!$success);

        return $response;
    }

    private function pageToGet()
    {
        if(empty($this->total)){
            /*
             * If the total number available to get is not yet set here, it is
             * because we have not yet made a request, thus start at the start.
             */
            return 1;
        }

        $this->pagesProcessed = floor($this->amountProcessed / $this->perPage);

        return $this->pagesProcessed + 1;
    }
}