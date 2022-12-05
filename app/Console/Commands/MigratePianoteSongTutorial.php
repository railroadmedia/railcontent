<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Spatie\Permission\Models\Role;
use Exception;
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
    protected $description = 'Migrate Pianote songs to song tutorial.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager, ContentService $contentService)
    {
        $this->info("MigratePianoteSongTutorial command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $query =
            $dbConn->table('railcontent_content')
                ->select('id')
                ->where('brand', 'pianote')
                ->where('type', 'song')
                ->orderBy('id', 'asc');

        $query->chunk(200, function (Collection $rows) use ($dbConn, $contentService) {
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
        });

        $query =
            $dbConn->table('railcontent_content')
                ->select('id')
                ->where('brand', 'pianote')
                ->where('type', 'song-part')
                ->orderBy('id', 'asc');

        $query->chunk(200, function (Collection $rows) use ($dbConn, $contentService) {
            $dbConn->table('railcontent_content')
                ->whereIn('id', $rows->pluck('id'))
                ->update([
                             'type' => 'song-tutorial-children',
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

        $this->info("MigratePianoteSongTutorial command has finished");
    }

}
