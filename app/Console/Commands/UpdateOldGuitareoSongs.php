<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ContentService;

class UpdateOldGuitareoSongs extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'UpdateOldGuitareoSongs';

    protected $signature = 'UpdateOldGuitareoSongs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update "soft-deleted" Guitareo Songs. Set status as draft';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        DatabaseManager $databaseManager,
        ContentService $contentService
    ) {
        $this->info("UpdateOldGuitareoSongs command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $query =
            $dbConn->table('railcontent_content')
                ->select('railcontent_content.id', 'railcontent_content.type')
                ->join('railcontent_content_instructors','railcontent_content.id','=','railcontent_content_instructors.content_id')
                ->where('brand', 'guitareo')
                ->where('type', 'song')
                ->where('railcontent_content.id','<',377661)
                ->where('railcontent_content_instructors.instructor_id','=',191339)
              //  ->where('status','=','deleted')
                ->orderBy('railcontent_content.id', 'asc');

        $query->chunk(200, function (Collection $rows) use ($dbConn, $contentService) {
            $dbConn->table('railcontent_content')
                ->whereIn('id', $rows->pluck('id'))
                ->update([
                    'status' => 'draft'
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

        $this->info("UpdateOldGuitareoSongs command has finished");
    }

}
