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
            404879,
            404741,
            404737,
            404736,
            404635,
            404633,
            404629,
            404627,
            404622,
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
