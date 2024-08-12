<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;

class UpdatePermissionsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;


    /**
     * @param array $contentIdsToDelist
     */
    public function __construct(private array $contentIds, private int $permissionId)
    {
    }


    public function handle(ContentService $contentService, RailcontentV2DataSyncingService $dataSyncingService): void
    {
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$pullFutureContent = true;
        $count = count($this->contentIds);
        $idMin = $this->contentIds[0];
        $idMax = $this->contentIds[$count - 1];
        Log::info(
            'Starting UpdatePermissionsJob ID: ' . $this->job->getJobId() .
            ' -- adding permission '.  $this->permissionId . ' sync for ' . count($this->contentIds) .
            ' min -- ' . $idMin . ' max -- ' . $idMax
        );

        $valuesToInsert = [];
        foreach($this->contentIds as $contentId) {
            $valuesToInsert[] = [
              'content_id' => $contentId,
              'permission_id' => $this->permissionId,
              'brand' => 'musora' // this can be sorted out later. For now this value isn't use anywhere
            ];
        }
        DB::connection(config('railcontent.database_connection_name'))->query()
            ->from('railcontent_content_permissions')
            ->insert($valuesToInsert);

        Log::info(
            'Finished UpdatePermissionsJob ID: ' . $this->job->getJobId() .
            ' -- for count ' . $count
        );
    }


}
