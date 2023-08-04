<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Vimeo\Exceptions\VimeoRequestException;
use Vimeo\Vimeo;

class RepairVimeoDurations extends Command
{
    protected $signature = 'RepairVimeoDurations';
    protected $description = 'Repair wrong length_in_seconds values for vimeo-video contents-items.';

    public function handle(ContentService $contentService)
    {
        $dbConnection = DB::connection(config('railcontent.database_connection_name'));

        $clientId = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_id'];
        $clientSecret = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['client_secret'];
        $accessToken = ConfigService::$videoSync['vimeo'][ConfigService::$brand]['access_token'];
        $lib = new Vimeo($clientId, $clientSecret);
        $lib->setToken($accessToken);

        $contentIds = [
            280601,
            280601,
            280602,
            280604,
            280606,
            280610,
            280612,
            280615,
            280618,
            280622,
            280625,
            280626,
            280628,
            280631,
            280634,
            280636,
            280641,
            280644,
            280647,
            280648,
            280652,
            280656,
            280663,
            280665,
            280669,
            280673,
            280677,
            280680,
            280681,
            280684,
            280687,
            280690,
            280693,
            280696,
            280699,
            280702,
            280705,
            280706,
            280708,
            280710,
            280712,
            280714,
            280716,
            280718,
            280721,
            280723,
            280727,
            280729,
            280734,
            280735,
            280737,
            280739,
            280741,
            280743,
            280746,
            280748,
            280750,
            280754,
            280755,
            280758,
            280762,
            280765,
            280768,
            280774,
            280778,
            280779,
            280782,
            280787,
            280789,
            280792,
            280795,
            280804,
            280806,
            280810,
            280811,
            280813,
            280815,
            280817,
            280819,
            280821,
            280825,
            280826,
            280828,
        ];
        ContentRepository::$bypassPermissions = true;
        $content = $contentService->getByIds($contentIds);

        foreach ($content as $singleContent) {
            try {
                $duration = $lib->request(
                    '/videos/' . $singleContent->fetch('fields.video.fields.vimeo_video_id')
                )['body']['duration'];
                $dbConnection->table('railcontent_content')
                    ->where('id', $singleContent->fetch('video'))
                    ->update([
                        'length_in_seconds' => $duration,
                    ]);

                $dbConnection->table(ConfigService::$tableContentFields)
                    ->where([
                        'content_id' => $singleContent->fetch('video'),
                        'key' => 'length_in_seconds',
                    ])
                    ->update(['value' => $duration,]);
                $contentService->fillCompiledViewContentDataColumnForContentIds(
                    [$singleContent->fetch('video'), $singleContent['id']]
                );
            } catch (VimeoRequestException $e) {
                $this->info(
                    'Request GET \'/videos/' . '\' failed with error: ' . print_r($e)
                );
            }
        }

        $this->info('repairMissingDurations operation complete.');

        return true;
    }
}
