<?php

namespace App\Console\Commands;

use App\Services\UserMetricsService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railtracker\Services\ConfigService;
use Spatie\Permission\Models\Role;
use Exception;

class PopulateUserMinutesPracticedPerBrand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'PopulateUserMinutesPracticedPerBrand';

    protected $signature = 'PopulateUserMinutesPracticedPerBrand {startingUserId=0} {endingUserId=9999999}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate user minutes practiced per brand column in usora_users table.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager, UserMetricsService $userMetricsService)
    {
        $this->info("PopulateUserMinutesPracticedPerBrand command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));
        $query = $dbConn->table('usora_users')
            ->select('id');
        if (!empty($this->argument('startingUserId'))) {
            $query->where('id', '>', $this->argument('startingUserId'));
        }

        if (!empty($this->argument('endingUserId'))) {
            $query->where('id', '<', $this->argument('endingUserId'));
        }

        $query->orderBy('id', 'asc');

        $query->chunk(200, function (Collection $rows) use ($dbConn, $userMetricsService) {
            foreach ($rows as $row) {
                $minutes = [];
                foreach (config('railcontent.available_brands', []) as $brand) {
                    $railtrackerConnectionName = config('railtracker.brand_database_connection_names')[$brand];
                    ConfigService::$databaseConnectionName = $railtrackerConnectionName;
                    config()->set('railtracker.database_connection', $railtrackerConnectionName);
                    config()->set('railtracker.database_connection_name', $railtrackerConnectionName);
                    config()->set('railtracker.brand', $brand);

                    $min =
                        $userMetricsService->getTotalMinutesPracticed(
                            $row->id
                        );
                    $minutes[$row->id][$brand] = $min;
                    $this->info($row->id.'   '.$min);
                }

                foreach ($minutes as $key => $x) {
                    if ($x > 0) {
                        $dbConn->table('usora_users')
                            ->where('id', $key)
                            ->update([
                                         'brand_minutes_practiced' => $x,
                                     ]);
                    }
                }
            }
        });

       $this->info("PopulateUserMinutesPracticedPerBrand command has finished #n");
    }

}
