<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;

class ResyncContentIds extends Command
{
    protected $signature = 'ResyncContentIds {ids*}';
    protected $description = 'Resync content by id. This will rebuild compiled and calculated properties';

    public function handle(
        RailcontentV2DataSyncingService $rcService,
    ) {
        $ids = $this->argument('ids');
        $stringIDs = implode(', ', $ids);
        $this->info("start updating ids: $stringIDs");
        $rcService->syncContentIds($ids);
        $this->info("finished updating ids: $stringIDs");
    }
}
