<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Spatie\Permission\Models\Role;
use Exception;

class RepairUserProgressOnNPPSH extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'RepairUserProgressOnNPPSH';

    protected $signature = 'RepairUserProgressOnNPPSH';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Repair user progress on NPPSH.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $this->info("RepairUserProgressOnNPPSH command starts now \n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $start = microtime(true);

        $sql = <<<'EOT'
UPDATE railcontent_user_content_progress up
SET up.state = '%s' , up.progress_percent = 16
WHERE up.content_id = '%s' and up.state = '%s'
EOT;
        $statement = sprintf(
            $sql,
            'started',
            383675,
            'completed'
        );
        $databaseManager->statement($statement);

        $sql = <<<'EOT'
UPDATE railcontent_user_content_progress up
SET up.state = '%s' , up.progress_percent = 16
WHERE up.content_id = '%s' and up.state = '%s'
EOT;
        $statement = sprintf(
            $sql,
            'started',
            383674,
            'completed'
        );
        $databaseManager->statement($statement);

        $finish = microtime(true) - $start;

        $format = "Finished processing in total %s seconds\n";

        $this->info(sprintf($format, $finish));

        $this->info("RepairUserProgressOnNPPSH command has finished #n");
    }

}
