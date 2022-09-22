<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Throwable;

class SyncUserTotalXp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SyncUserTotalXp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync user total_xp';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(
        DatabaseManager $databaseManager
    ) {
        $this->info('Starting SyncUserTotalXp.');

        $sql = <<<'EOT'
UPDATE `%s` cs
 JOIN (
    SELECT
        sum(p.points)  as total_xp, p.user_id as user_id
    FROM points_user_points p
                    GROUP BY p.user_id

) n ON
    cs.id = n.user_id
SET cs.`total_xp` = IF(n.total_xp IS NULL, 0, n.total_xp)
EOT;

        $statement = sprintf(
            $sql,
            'usora_users'
        );

        $databaseManager->connection(config('usora.database_connection_name'))
            ->statement($statement);

        $this->info('SyncUserTotalXp end.');
    }
}
