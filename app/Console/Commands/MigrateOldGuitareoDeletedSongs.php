<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ContentService;

class MigrateOldGuitareoDeletedSongs extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'MigrateOldGuitareoDeletedSongs';

    protected $signature = 'MigrateOldGuitareoDeletedSongs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Old Guitareo Deleted Songs To Courses.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        DatabaseManager $databaseManager,
        ContentService $contentService
    ) {
        $this->info("MigrateOldGuitareoDeletedSongs command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $query =
            $dbConn->table('railcontent_content')
                ->select('id', 'type')
                ->where('brand', 'guitareo')
                ->where('status', 'deleted')
                ->whereIn(
                    'id',
                    [
                        191465,
                        191466,
                        191468,
                        191481,
                        191484,
                        216116,
                        222393,
                        222965,
                        223294,
                        235825,
                        240078,
                        240082,
                        240125,
                        240126,
                        191362,
                    ]
                )
                ->orderBy('id', 'asc');

        $query->chunk(5, function (Collection $rows) use ($dbConn, $contentService) {
            $dbConn->table('railcontent_content')
                ->whereIn('id', $rows->pluck('id'))
                ->update([
                             'status' => 'draft',
                             'type' => 'course',
                         ]);
            $childrens = $dbConn->table('railcontent_content_hierarchy')->select('child_id')
                ->whereIn('parent_id', $rows->pluck('id'))
                ->get();


            $dbConn->table('railcontent_content')
                ->whereIn('id', $childrens->pluck('child_id'))
                ->update([
                             'status' => 'published',
                             'type' => 'course-part',
                         ]);
            $allIds = array_merge($rows->pluck('id')
                                     ->toArray(), $childrens->pluck('child_id')->toArray());
            $contentService->fillCompiledViewContentDataColumnForContentIds(
                $allIds
            );
            $contentService->fillParentContentDataColumnForContentIds(
                $allIds
            );
        });

        $this->info("MigrateOldGuitareoDeletedSongs command has finished");
    }

}
