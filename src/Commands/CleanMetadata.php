<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ConfigService;

class CleanMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CleanMetadata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean content metadata';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $this->info('Started cleaning content metadata');

        $allDifficultyVariants = ['A', 'a', 'Al', 'al', 'All', 'all'];
        $allDifficultyValue = 'All Skill Levels';

        $databaseManager->connection(config('railcontent.database_connection_name'))
            ->table(ConfigService::$tableContentFields)
            ->join(
                ConfigService::$tableContent,
                ConfigService::$tableContent . '.id',
                '=',
                ConfigService::$tableContentFields . '.content_id'
            )
            ->where(ConfigService::$tableContentFields . '.key', 'difficulty')
            ->whereIn(ConfigService::$tableContentFields . '.value', $allDifficultyVariants)
            ->where(ConfigService::$tableContent . '.brand', config('railcontent.brand'))
            ->update(
                [
                    ConfigService::$tableContentFields . '.value' => $allDifficultyValue,
                ]
            );

        $this->info('Finished cleaning content metadata');
    }
}
