<?php

namespace App\Console\Commands;

use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Points\Services\UserPointsService;

class MigrateGuitareoUserXP extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'MigrateGuitareoUserXP';

    protected $signature = 'MigrateGuitareoUserXP {startingId=0} {endingId=9999999}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Guitareo user XP into points_user_points table.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        DatabaseManager $databaseManager,
        UserPointsService $userPointsService,
        UserProviderInterface $userProvider
    ) {
        $this->info("MigrateGuitareoUserXP command starts now \n");

        $guitareoDbConn = $databaseManager->connection(config('railforums.brand_database_connection_names.guitareo'));
        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $query =
            $guitareoDbConn->table('experiences')
                ->selectRaw('user_id,  SUM(points) as total_xp');

        if (!empty($this->argument('startingId'))) {
            $query->where('id', '>', $this->argument('startingId'));
        }

        if (!empty($this->argument('endingId'))) {
            $query->where('id', '<', $this->argument('endingId'));
        }

        $query->orderBy('user_id', 'asc')
            ->groupBy(['user_id']);

        $query->chunk(20, function (Collection $rows) use ($userPointsService, $userProvider) {
            $xp = [];
            foreach ($rows as $row) {
                $userPointsService->setPoints(
                    $row->user_id,
                    [
                        'progress_state' => 'completed',
                    ],
                    'content_completed',
                    $row->total_xp,
                    'Awarded per complete content.',
                    'guitareo'
                );

                $userProvider->saveExperiencePoints(
                    $row->user_id,
                    $userPointsService->countUserPointsPerBrand(
                        $row->user_id
                    )
                );
            }
        });

        $this->info("PopulateUserTotalXpPerBrand command has finished #n");
    }

}
