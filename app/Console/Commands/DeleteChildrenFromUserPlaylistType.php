<?php

namespace  App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteChildrenFromUserPlaylistType extends Command
{
    protected $signature = 'DeleteChildrenFromUserPlaylistType';

    protected $description = 'Delete broken children from user-playlist type; update parent_content_data from the deleted children';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('###### Starting DeleteChildrenFromUserPlaylistType...  ######');

        $dbConnection = DB::connection(config('railcontent.database_connection_name'));

        $brokenContentIds = $dbConnection->table('railcontent_content')
            ->select('id')
            ->where('type', 'quick-tips')
            ->where('parent_content_data', '!=', null )
            ->get()->toArray()
        ;

        foreach ($brokenContentIds as $contentId) {
            $dbConnection->table('railcontent_content_hierarchy')
                ->where('child_id', $contentId->id)
                ->delete()
            ;

            $dbConnection->table('railcontent_content')
                ->where('id', $contentId->id)
                ->update(['parent_content_data' => null])
            ;

        }

        $this->info('###### Command DeleteChildrenFromUserPlaylistType has finished ###### ');
    }
}
