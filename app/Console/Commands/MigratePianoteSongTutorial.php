<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;

class MigratePianoteSongTutorial extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'MigratePianoteSongTutorial';

    protected $signature = 'MigratePianoteSongTutorial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Pianote songs to song tutorials.';

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
        $this->info("MigratePianoteSongTutorial command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $query =
            $dbConn->table('railcontent_content')
                ->select('id', 'type')
                ->where('brand', 'pianote')
                ->where('type', 'song')
                ->orderBy('id', 'asc');

        $query->chunk(200, function (Collection $rows) use ($dbConn, $contentService, $contentHierarchyService) {
            $dbConn->table('railcontent_content')
                ->whereIn('id', $rows->pluck('id'))
                ->update([
                             'type' => 'song-tutorial',
                         ]);
            $contentService->fillCompiledViewContentDataColumnForContentIds(
                $rows->pluck('id')
                    ->toArray()
            );
            $contentService->fillParentContentDataColumnForContentIds(
                $rows->pluck('id')
                    ->toArray()
            );

            $childrenIds =
                $contentHierarchyService->getByParentIds(
                    $rows->pluck('id')
                        ->toArray()
                );
            $childrens =
                $dbConn->table('railcontent_content')
                    ->select('id', 'type')
                    ->where('brand', 'pianote')
                    ->whereIn('id', \Arr::pluck($childrenIds, 'child_id'))
                    ->where('type', '!=', 'assignment')
                    ->orderBy('id', 'asc')
                    ->get();

            $dbConn->table('railcontent_content')
                ->whereIn('id', $childrens->pluck('id'))
                ->update([
                             'type' => 'song-tutorial-children',
                         ]);
            $contentService->fillCompiledViewContentDataColumnForContentIds(
                $childrens->pluck('id')
                    ->toArray()
            );
            $contentService->fillParentContentDataColumnForContentIds(
                $childrens->pluck('id')
                    ->toArray()
            );
        });

        $this->info("MigratePianoteSongTutorial command has finished");
    }

}
