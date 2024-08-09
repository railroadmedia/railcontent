<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Spatie\Permission\Models\Role;
use Exception;

class PopulateUserBrandLevel extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'PopulateUserBrandLevel';

    protected $signature = 'PopulateUserBrandLevel {startingUserId=0} {endingUserId=9999999}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate user brand level in usora_users table.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager): void
    {
        $this->info("PopulateUserBrandLevel command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $methods = [
            241247 => 'drumeo',
            276693 => 'pianote',
            333652 => 'guitareo',
            308514 => 'singeo',
        ];

        $query = $dbConn->table('railcontent_user_content_progress')
            ->select('user_id', 'content_id', 'higher_key_progress')
            ->whereIn('content_id', array_keys($methods))
            ->orderBy('user_id', 'asc');
        if (!empty($this->argument('startingUserId'))) {
            $query->where('user_id', '>', $this->argument('startingUserId'));
        }

        if (!empty($this->argument('endingUserId'))) {
            $query->where('user_id', '<', $this->argument('endingUserId'));
        }

        $query->chunk(200, function (Collection $rows) use ($dbConn, $methods) {
            $progress = [];
            foreach ($rows as $row) {
                $progress[$row->user_id][$methods[$row->content_id]] = $row->higher_key_progress;
            }
            foreach ($progress as $key => $progres) {
                $dbConn->table('usora_users')
                    ->where('id', $key)
                    ->update([
                                 'brand_method_levels' => $progres,
                             ]);
            }
        });

        $this->info("PopulateUserBrandLevel command has finished #n");
    }

}
