<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;

class SyncContentRowFromRelatedTables extends Command
{
    /**
     * Example content IDS: Course: 349360, Instructor: 317639, Course Lesson: 340136
     */
    protected $signature = 'SyncContentRowFromRelatedTables {contentId}';

    protected $description = 'Syncs content row content and relevant data tables from the content fields table.';

    private RailcontentV2DataSyncingService $railcontentV2DataSyncingService;

    public function __construct(RailcontentV2DataSyncingService $railcontentV2DataSyncingService)
    {
        parent::__construct();

        $this->railcontentV2DataSyncingService = $railcontentV2DataSyncingService;
    }

    public function handle()
    {
        $contentId = $this->argument('contentId');

        $this->info('Syncing content ID: ' . $contentId);

        $this->railcontentV2DataSyncingService->syncContentId($contentId);

        $this->info('Done');

        return true;
    }
}
