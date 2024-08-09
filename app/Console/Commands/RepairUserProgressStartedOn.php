<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Spatie\Permission\Models\Role;
use Exception;

class RepairUserProgressStartedOn extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'RepairUserProgressStartedOn';

    protected $signature = 'RepairUserProgressStartedOn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Repair user progress started on.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager): void
    {
        $this->info("RepairUserProgressStartedOn command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $start = microtime(true);

        $sql = <<<'EOT'
UPDATE railcontent_user_content_progress up
SET up.started_on = up.updated_on
WHERE up.started_on is null
EOT;

        $databaseManager->statement($sql);

        $finish = microtime(true) - $start;

        $format = "Finished processing in total %s seconds\n";

        $this->info(sprintf($format, $finish));

        $this->info("RepairUserProgressStartedOn command has finished #n");
    }

}
