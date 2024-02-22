<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;

class CleanParentContentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:CleanParentContentData {ids}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Parent Content Data';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(RailcontentV2DataSyncingService $rcService)
    {
        $this->info('Started cleaning parent content data');
        $stringIDs = $this->argument('ids');
        $ids = explode(',', $stringIDs);
        $this->info("start updating ids: $ids");
        $rcService->syncContentIds($ids);
        $this->info("finished updating ids: $ids");
    }
}
