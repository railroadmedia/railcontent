<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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

        $this->info('Syncing content ID: '.$contentId);

        if ($contentId === 'all') {
            $this->info('Syncing all content IDs.');

            $totalToSync = $databaseManager->connection(config('railcontent.database_connection_name'))
                ->table(config('railcontent.table_prefix').'content')
                ->whereNotIn('type', ['vimeo-video', 'youtube-video', 'assignment'])
                ->count();

            $totalSynced = 0;

            $this->info('Total to sync: ' . $totalToSync);
            Log::info('Total to sync: ' . $totalToSync);

            $databaseManager->connection(config('railcontent.database_connection_name'))
                ->table(config('railcontent.table_prefix').'content')
                ->whereNotIn('type', ['vimeo-video', 'youtube-video', 'assignment'])
                ->orderBy('id', 'desc')
                ->chunkById(500, function (Collection $rows) use (&$totalSynced, $railcontentV2DataSyncingService) {
                    $railcontentV2DataSyncingService->syncContentIds($rows->pluck('id')->toArray());

                    $totalSynced += $rows->count();

                    $this->info(
                        'Done syncing '.$totalSynced.', last processed content ID: '.$rows->last()->id
                    );
                    Log::info('Done syncing '.$totalSynced.', last processed content ID: '.$rows->last()->id);
                });
        } else {
            $this->info('Syncing content ID: '.$contentId);
            $railcontentV2DataSyncingService->syncContentId($contentId);
        }

        $this->info('Done');
        Log::info('Done');

        return true;
    }
}
