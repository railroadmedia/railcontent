<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Spatie\Permission\Models\Role;
use Exception;

class RepairUserProgressOn30DD extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'RepairUserProgressOn30DD';

    protected $signature = 'RepairUserProgressOn30DD';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Repair user progress on 30 Day Drummer.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $this->info("RepairUserProgressOn30DD command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $start = microtime(true);

        $sql = <<<'EOT'
UPDATE railcontent_user_content_progress up
SET up.state = 'started' and up.progress_percent = 2
WHERE up.content_id = 383627 and up.state = 'completed'
EOT;

        $databaseManager->statement($sql);

        $sql = <<<'EOT'
UPDATE railcontent_user_content_progress up
SET up.state = 'started' and up.progress_percent = 3
WHERE up.content_id = 383628 and up.state = 'completed'
EOT;

        $databaseManager->statement($sql);

        $sql = <<<'EOT'
UPDATE railcontent_user_content_progress up
SET up.state = 'started' and up.progress_percent = 1
WHERE up.content_id = 383629 and up.state = 'completed'
EOT;

        $databaseManager->statement($sql);

        $finish = microtime(true) - $start;

        $format = "Finished processing in total %s seconds\n";

        $this->info(sprintf($format, $finish));

        $this->info("RepairUserProgressOn30DD command has finished #n");
    }

}
