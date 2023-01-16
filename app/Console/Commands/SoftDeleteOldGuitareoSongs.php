<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ContentService;

class SoftDeleteOldGuitareoSongs extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'SoftDeleteOldGuitareoSongs';

    protected $signature = 'SoftDeleteOldGuitareoSongs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Soft Delete Old Guitareo Songs.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        DatabaseManager $databaseManager,
        ContentService $contentService
    ) {
        $this->info("SoftDeleteOldGuitareoSongs command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $query =
            $dbConn->table('railcontent_content')
                ->select('id', 'type')
                ->where('brand', 'guitareo')
                ->where('type', 'song')
                ->where('id','<',377661)
                ->orderBy('id', 'asc');

        $query->chunk(200, function (Collection $rows) use ($dbConn, $contentService) {
            $dbConn->table('railcontent_content')
                ->whereIn('id', $rows->pluck('id'))
                ->update([
                             'status' => 'deleted',
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

        $this->info("SoftDeleteOldGuitareoSongs command has finished");
    }

}
