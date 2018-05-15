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
    protected $signature = 'CreateVimeoVideoContentRecords {howFarBack?} {perPage?} {skipPages?} {debug?}';

    protected $description = 'Content from external resources.';

    private $contentService;
    private $databaseManager;
    private $lib;

    private $perPage;
    private $howFarBack;
    private $total;
    private $amountProcessed;
    private $totalNumberOfPagesToProcess;
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
        $this->total = null;
        $this->howFarBack = null;
        $this->totalNumberOfPagesToProcess = null;
        $this->amountProcessed = 0;

        $client_id = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_id'];
        $client_secret = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_secret'];
        $access_token = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['access_token'];
        $this->lib = new Vimeo($client_id, $client_secret);
        $this->lib->setToken($access_token);

        $howFarBack = $this->argument('howFarBack');
        $perPage = $this->argument('perPage');

        if ($howFarBack === '0' || $perPage === '0') {
            $this->info("No. You cannot pass \"0\" to \"perPage\" or \"howFarBack\". Exiting now. Try again.");
            exit;
        }

        $this->howFarBack = (int)$howFarBack === 0 ? self::MAX_PER_PAGE_API_LIMIT : (int)$howFarBack;

        $this->perPage = (int)$perPage === 0 ? self::MAX_PER_PAGE_API_LIMIT : (int)$perPage;
        $this->perPage = $this->perPage > self::MAX_PER_PAGE_API_LIMIT ? self::MAX_PER_PAGE_API_LIMIT : $this->perPage;
        $this->perPage = ($this->howFarBack <= $this->perPage) ? $this->howFarBack : $this->perPage; // no more than needed

        $skipPages = (int)$this->argument('skipPages');

        if ($skipPages) {
            $this->pageToGet = $skipPages + 1;
            $this->amountProcessed = $skipPages * $this->perPage;

            if ((($this->howFarBack / $this->perPage) - $skipPages) <= 0) {
                $this->info("\"pagesToSkip\" is too high a value. Exiting Now. Try Again");
                exit;
            }
        }

        do {
            $contentCreatedCount = 0;
            $contentFieldsInsertData = [];
            $response = null;

            // get a bunch of videos

            do {
                try {
                    $this->pageToGet = $this->pageToGet ?? 1; // if not set, is 1st iteration
                    $this->info('Page ' . $this->pageToGet . '/' . ceil($this->howFarBack / $this->perPage) . '.');
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
                    /*
                     * Can't alter last request amount w/o convoluted calculations involving adjusting perPage. Instead
                     * truncate the results of last request so DB processes only required amount.
                     */
                    if (($this->howFarBack - $this->amountProcessed) < $this->perPage) {
                        $response['body']['data'] = array_slice(
                            $response['body']['data'],
                            0,
                            $this->howFarBack - $this->amountProcessed
                        );
                    }
                    $success = true;
                } catch (VimeoRequestException $e) {
                    $success = false;
                    $this->info('Oops, timed-out. Trying page again.');
                }
                if ($success) {
                    $this->info(
                        'Success. Now processing ' . count($response['body']['data']) . ' videos in this batch.'
                    );
                }
            } while (!$success);

            $videos = $response['body']['data'];


            // figure what to do with videos in current bunch. Create content if need be. Defer field & data writes.

            if (!empty($videos)) {

                foreach ($videos as $video) {

                    $uri = $video['uri'];
                    $id = str_replace('/videos/', '', $uri);
                    $duration = $video['duration'];

                    if ($this->argument('debug')) {
                        $this->info(print_r('vimeo id: ' . $id, true));
                    }

                    if (!is_numeric($id)) {
                        $this->info(
                            'URI "' . $uri . '" failed to convert to a numeric video id. (used: "$id = ' .
                            'str_replace(\'/videos/\', \'\', $uri);"'
                        );
                    }

                    $content = $this->contentService->getBySlugAndType('vimeo-video-' . $id, 'vimeo-video');

                    if (empty($content)) {

                        if ($duration === 0 || !is_numeric($duration)) {
                            $this->info('Duration for video ' . $id . ' is zero or invalid. Video not added.');
                            break(2);
                        }

                        $content = $this->contentService->create(
                            'vimeo-video-' . $id,
                            'vimeo-video',
                            ContentService::STATUS_PUBLISHED,
                            null,
                            null,
                            null,
                            Carbon::now()->toDateTimeString()
                        );

                        if ($content) {
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
            }

            $this->info($contentCreatedCount . ' videos added.' . PHP_EOL);

            $this->pageToGet = floor($this->amountProcessed / $this->perPage) + 1;


            // constrain total number to get based on number available

            if (is_null($this->total)) { // if not set, is 1st iteration - thus set now that we have them
                $this->total = $response['body']['total'];
                if ($this->howFarBack > $this->total) {
                    $this->info('Only ' . $this->total . ' available (not ' . $this->howFarBack . ').');
                    $this->howFarBack = $this->total;
                }
            }


            // Create content fields and data as needed. Return helpful information

            if (
            !$this->databaseManager->connection(ConfigService::$databaseConnectionName)
                ->table(ConfigService::$tableContentFields)
                ->insert($contentFieldsInsertData)
            ) {
                $this->info(
                    'ContentFields write failed. Data: ' .
                    json_encode(print_r($contentFieldsInsertData, true)) . PHP_EOL
                );
            }

        } while ($this->amountProcessed < $this->howFarBack);

        $this->info('CreateVimeoVideoContentRecords complete.');
    }
}
