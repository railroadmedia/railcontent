<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Spatie\Permission\Models\Role;
use Exception;

class PopulateUserTotalXpPerBrand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'PopulateUserTotalXpPerBrand';

    protected $signature = 'PopulateUserTotalXpPerBrand {startingUserId=0} {endingUserId=9999999}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate user total xp per brand column in usora_users table.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $this->info("PopulateUserTotalXpPerBrand command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $query = $dbConn->table('points_user_points')
            ->selectRaw('user_id, brand, SUM(points) as total_xp')
            ->whereIn('brand', config('railcontent.available_brands', []));
        if (!empty($this->argument('startingUserId'))) {
            $query->where('user_id', '>', $this->argument('startingUserId'));
        }

        if (!empty($this->argument('endingUserId'))) {
            $query->where('user_id', '<', $this->argument('endingUserId'));
        }

        $query->orderBy('user_id', 'asc')
        ->groupBy(['user_id','brand']);

        $query->chunk(200, function (Collection $rows) use ($dbConn) {
            $xp = [];
            foreach ($rows as $row) {
                $xp[$row->user_id][$row->brand] = $row->total_xp;
            }
            foreach ($xp as $key => $x) {
                $dbConn->table('usora_users')
                    ->where('id', $key)
                    ->update([
                                 'brand_total_xp' => $x,
                             ]);
            }
        });

        $this->info("PopulateUserTotalXpPerBrand command has finished #n");
    }

}
