<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;

class MigrateSingeoSingAlongs extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'MigrateSingeoSingAlongs';

    protected $signature = 'MigrateSingeoSingAlongs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Singeo old karaoke songs to sing-alongs.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        DatabaseManager $databaseManager,
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService
    ) {
        $this->info("MigrateSingeoSingAlongs command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $query =
            $dbConn->table('railcontent_content')
                ->select('id', 'type')
                ->where('brand', 'singeo')
                ->where('type', 'song')
                ->where('id','<=',365586)
                ->orderBy('id', 'asc');

        $query->chunk(200, function (Collection $rows) use ($dbConn, $contentService, $contentHierarchyService) {
            $dbConn->table('railcontent_content')
                ->whereIn('id', $rows->pluck('id'))
                ->update([
                             'type' => 'sing-along',
                         ]);
            $contentService->fillCompiledViewContentDataColumnForContentIds(
                $rows->pluck('id')
                    ->toArray()
            );
            $contentService->fillParentContentDataColumnForContentIds(
                $rows->pluck('id')
                    ->toArray()
            );
        });

        $this->info("MigrateSingeoSingAlongs command has finished");
    }

}
