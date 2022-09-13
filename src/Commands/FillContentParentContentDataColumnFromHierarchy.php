<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ContentService;

class FillContentParentContentDataColumnFromHierarchy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FillContentParentContentDataColumnFromHierarchy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'FillContentParentContentDataColumnFromHierarchy';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager, ContentService $contentService)
    {
        $this->info('Starting FillContentParentContentDataColumnFromHierarchy...');

        $dbConnection = $databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();

        $totalProcessed = 0;

        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->orderBy(config('railcontent.table_prefix') . 'content.id', 'asc')
            ->chunk(500, function (Collection $rows) use ($contentService, $dbConnection, &$totalProcessed) {

                $contentService->fillParentContentDataColumnForContentIds($rows->pluck('id')->toArray());
                $totalProcessed += $rows->count();

                $this->info('Done ' . $totalProcessed);
            });


        $this->info('Finished FillContentParentContentDataColumnFromHierarchy...');

        return true;
    }
}
