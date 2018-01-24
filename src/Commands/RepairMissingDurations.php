<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoRequestException;

class RepairMissingDurations extends Command
{
    protected $signature = 'RepairMissingDurations';
    protected $description = 'Repair missing content-field length_in_seconds values for vimeo-video contents-items.';

    private $contentService;
    private $databaseManager;

    public function __construct(ContentService $contentService, DatabaseManager $databaseManager)
    {
        parent::__construct();
        $this->contentService = $contentService;
        $this->databaseManager = $databaseManager;
    }

    public function handle(){
        $vimeoIdsOfContentMissingDuration = [];
        $durationsRetrieved = [];
        $contentIds = [];
        $contentFieldRowsUpdated = 0;
        $contentFieldsWriteSuccess = [];

        $client_id = ConfigService::$videoSync['vimeo']['drumeo']['client_id'];
        $client_secret = ConfigService::$videoSync['vimeo']['drumeo']['client_secret'];
        $access_token = ConfigService::$videoSync['vimeo']['drumeo']['access_token'];
        $lib = new Vimeo($client_id, $client_secret);
        $lib->setToken($access_token);

        $idsOfContentMissingDuration = $this->contentService->getByContentFieldValuesForTypes(
            ['vimeo-video'], 'length_in_seconds',  [0]
        );
        $this->info(
            'There are ' . count($idsOfContentMissingDuration) . ' vimeo-video content records in our database ' .
            'that have a length_in_seconds value of "0".'
        );
        foreach($idsOfContentMissingDuration as $row){
            $contentIds[] = $row['id'];
        }
        $content = $this->contentService->getByIds($contentIds);
        foreach($content as $singleContent){
            $vimeoId = (int) ContentHelper::getFieldValue($singleContent, 'vimeo_video_id');
            if(!empty($vimeoId)){
                $vimeoIdsOfContentMissingDuration[$singleContent['id']] = $vimeoId;
            }
        }
        foreach($vimeoIdsOfContentMissingDuration as $contentId => $vimeoId){
            if(!is_null($vimeoId)){
                try{
                    $durationsRetrieved[$contentId] = $lib->request('/videos/' . $vimeoId)['body']['duration'];
                } catch (VimeoRequestException $e){
                    $this->info(
                        'Request GET \'/videos/' . $vimeoId . '\' failed with error: ' .
                        print_r($e)
                    );
                }

            }
        }
        $this->info('Duration values retrieved for ' . count($durationsRetrieved) . ' contents');
        foreach($durationsRetrieved as $contentId => $duration){
            if (empty($duration)) {
                $this->info('No duration value for: ' . print_r([$contentId => $duration]));
            }else{
                $contentFieldsWriteSuccess[] = $this->databaseManager->connection(
                    ConfigService::$databaseConnectionName
                )
                    ->table(ConfigService::$tableContentFields)->where([
                        'content_id' => $contentId,
                        'key' => 'length_in_seconds',
                        'value' => 0,
                    ])->update(['value' => $duration,]);
                if($contentFieldsWriteSuccess){
                    $contentFieldRowsUpdated++;
                    $this->info('Duration repair succeeded for content id:' . $contentId);
                }else{
                    $this->info('Duration repair failed for content id:' . $contentId);
                }
            }
        }
        $this->info('repairMissingDurations operation complete. Updated ' . $contentFieldRowsUpdated . ' rows.');
        return true;
    }
}