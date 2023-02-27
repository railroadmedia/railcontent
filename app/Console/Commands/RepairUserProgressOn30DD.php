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
SET up.state = '%s' , up.progress_percent = 2
WHERE up.content_id = '%s' and up.state = '%s'
EOT;
        $statement = sprintf(
            $sql,
            'started',
            383627,
            'completed'
        );
        $databaseManager->statement($statement);

        $sql = <<<'EOT'
UPDATE railcontent_user_content_progress up
SET up.state = '%s' , up.progress_percent = 3
WHERE up.content_id = '%s' and up.state = '%s'
EOT;
        $statement = sprintf(
            $sql,
            'started',
            383628,
            'completed'
        );
        $databaseManager->statement($statement);

        $sql = <<<'EOT'
UPDATE railcontent_user_content_progress up
SET up.state = '%s' , up.progress_percent = 1
WHERE up.content_id = '%s' and up.state = '%s'
EOT;
        $statement = sprintf(
            $sql,
            'started',
            383628,
            'completed'
        );
        $databaseManager->statement($statement);

        $sql = "DELETE from musora_laravel.railcontent_user_content_progress where content_id in (
383635, 383636, 383637, 383638,383639, 383640,383641,383642, 383643, 383645,383646, 383647,383648,383649,383650,383651,383652,
383653,383655,383657,383658,383659,383660,383662,383663,383664,383666)";
        $databaseManager->statement($sql);

        $finish = microtime(true) - $start;

        $format = "Finished processing in total %s seconds\n";

        $this->info(sprintf($format, $finish));

        $this->info("RepairUserProgressOn30DD command has finished #n");
    }

}
