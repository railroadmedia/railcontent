<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;
use Vimeo\Exceptions\VimeoRequestException;
use Vimeo\Vimeo;

class CreateVimeoVideoContentRecords extends Command
{
    protected $signature = 'CreateVimeoVideoContentRecords {howFarBack?} {perPage?} {skipPages?} {debug?}';

    protected $description = 'Content from external resources.';

    private $contentService;
    private $contentFieldService;
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
        ContentFieldService $contentFieldService
    ) {
        parent::__construct();
        $this->contentService = $contentService;
        $this->contentFieldService = $contentFieldService;
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
            $contentFieldVideoIdCreatedCount = 0;
            $contentFieldDurationCreatedCount = 0;
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

                    if ($duration === 0 || !is_numeric($duration)) {
                        $this->info('Duration for video ' . $id . ' is zero or invalid. Skipped.');
                        $this->amountProcessed++;
                        continue;
                    }

                    if ($this->argument('debug')) {
                        $this->info('vimeo id: ' . $id);
                    }

                    if (!is_numeric($id)) {
                        $this->info(
                            'URI "' . $uri . '" failed to convert to a numeric video id. (used: "$id = ' .
                            'str_replace(\'/videos/\', \'\', $uri);"'
                        );
                    }

                    $content = $this->contentService->getBySlugAndType('vimeo-video-' . $id, 'vimeo-video');

                    if (!empty($content)) {
                        $content = $content[key($content)];
                    }else{
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
                        }else{
                            $contentWriteDataSummary = [
                                'slug' => 'vimeo-video-' . $id,
                                'type' => 'vimeo-video',
                                'status' => ContentService::STATUS_PUBLISHED,
                                'publishedOn' => Carbon::now()->toDateTimeString(),
                                'brand' => ConfigService::$brand
                            ];
                            $this->info('Content create failed. Data: ' . json_encode($contentWriteDataSummary));
                        }
                    }

                    if(empty($content['fields'])){
                        $this->fieldWriteVideoId($content['id'], $id, $contentFieldVideoIdCreatedCount);
                        $this->fieldWriteDuration($content['id'], $duration, $contentFieldDurationCreatedCount);
                    }else{

                        $videoIdSet = false;
                        $durationSet = false;

                        foreach($content['fields'] as $field){
                            if($field['key'] === 'vimeo_video_id'){
                                $videoIdSet = true;
                            }
                            if($field['key'] === 'length_in_seconds'){
                                $durationSet = true;
                            }
                        }

                        if(!$videoIdSet){
                            $this->fieldWriteVideoId($content['id'], $id, $contentFieldVideoIdCreatedCount);
                        }

                        if(!$durationSet){
                            $this->fieldWriteDuration($content['id'], $duration, $contentFieldDurationCreatedCount);
                        }
                    }

                    $this->amountProcessed++;
                }
            }

            $msg = '';

            if($contentCreatedCount){
                $msg = $msg .
                    $contentCreatedCount . ' content write' .
                    ($contentCreatedCount > 1 ? 's. ' : '. ');
            }
            if($contentFieldVideoIdCreatedCount){
                $msg = $msg .
                    $contentFieldVideoIdCreatedCount . ' content field video id write' .
                    ($contentFieldVideoIdCreatedCount > 1 ? 's. ' : '. ');
            }
            if($contentFieldDurationCreatedCount){
                $msg = $msg .
                    $contentFieldDurationCreatedCount . ' content field duration write' .
                    ($contentFieldDurationCreatedCount > 1 ? 's. ' : '. ');
            }

            if(
                $contentCreatedCount === 0 &&
                $contentFieldVideoIdCreatedCount === 0 &&
                $contentFieldDurationCreatedCount === 0
            ){
                $msg = 'No database writes required.';
            }

            $this->info($msg);

            $this->pageToGet = floor($this->amountProcessed / $this->perPage) + 1;


            // constrain total number to get based on number available

            if (is_null($this->total)) { // if not set, is 1st iteration - thus set now that we have them
                $this->total = $response['body']['total'];
                if ($this->howFarBack > $this->total) {
                    $this->info('Only ' . $this->total . ' available (not ' . $this->howFarBack . ').');
                    $this->howFarBack = $this->total;
                }
            }

        } while ($this->amountProcessed < $this->howFarBack);

        $this->info('CreateVimeoVideoContentRecords complete.');
    }

    private function fieldWriteVideoId($contentId, $id, &$contentFieldVideoIdCreatedCount){
        $idWrite = $this->contentFieldService->create(
            $contentId,
            'vimeo_video_id',
            $id,
            1,
            'string'
        );
        if ($idWrite) {
            $contentFieldVideoIdCreatedCount++;
        }else{
            $idWriteDataSummary = [
                'contentId' => $contentId,
                'key' => 'vimeo_video_id',
                'value' => $id,
                'position' => 1,
                'type' => 'string'
            ];
            $this->info('ContentFields write failed. Data: ' . json_encode($idWriteDataSummary));
        }
    }

    private function fieldWriteDuration($contentId, $duration, &$contentFieldDurationCreatedCount){
        $durationWrite = $this->contentFieldService->create(
            $contentId,
            'length_in_seconds',
            $duration,
            1,
            'integer'
        );
        if ($durationWrite) {
            $contentFieldDurationCreatedCount++;
        }else{
            $durationWriteDataSummary = [
                'contentId' => $contentId,
                'key' => 'length_in_seconds',
                'value' => $duration,
                'position' => 1,
                'type' => 'integer'
            ];
            $this->info('ContentFields write failed. Data: ' . json_encode($durationWriteDataSummary));
        }
    }
}
