<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;
use Throwable;

class SyncContentRowFromRelatedTables extends Command
{
    /**
     * Example content IDS: Course: 349360, Instructor: 317639, Course Lesson: 340136
     */
    protected $signature = 'SyncContentRowFromRelatedTables {contentId}';

    protected $description = 'Syncs content row content and relevant data tables from the content fields table.';

    /**
     * @throws Throwable
     */
    public function handle(
        RailcontentV2DataSyncingService $railcontentV2DataSyncingService,
        DatabaseManager $databaseManager
    ) {
        $databaseManager->connection(config('railcontent.database_connection_name'))->disableQueryLog();

        $contentId = $this->argument('contentId');

        $this->info('Syncing content ID: ' . $contentId);

        if ($contentId === 'all') {
            $this->info('Syncing all content IDs.');
            $contentIdRows = $databaseManager->connection(config('railcontent.database_connection_name'))
                ->table(config('railcontent.table_prefix') . 'content')
                ->whereNotIn('type', ['vimeo-video', 'youtube-video', 'assignment'])
                ->orderBy('id', 'desc')
                ->get(['id']);

            $this->info('Syncing total content IDs: ' . count($contentIdRows));

            foreach ($contentIdRows as $contentIdRowIndex => $contentIdRow) {
                $railcontentV2DataSyncingService->syncContentId($contentIdRow->id);

                if ($contentIdRowIndex % 100 === 0) {
                    $this->info('Done syncing ' . $contentIdRowIndex . ' out of ' . count($contentIdRows));
                }
            }
        } else {
            $this->info('Syncing content ID: ' . $contentId);
            $railcontentV2DataSyncingService->syncContentId($contentId);
        }

        $this->info('Done');

        return true;
    }
}
