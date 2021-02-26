<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ConfigService;

class CleanContentTopicsAndStyles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CleanTopicsAndStyles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean content topics and content style';

    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Started cleaning content metadata');

        $replaceOldValueInto = [
            'Question & Answer' => 'Q&A',
            'Peformance' => 'Performance',
            'Performances' => 'Performance',
            'Bues' => 'Blues',
            'Odd-times' => 'Odd times',
            'rock/pop' => 'pop/rock',
        ];

        foreach ($replaceOldValueInto as $key => $value) {
            $rows =
                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(ConfigService::$tableContentFields)
                    ->join(
                        ConfigService::$tableContent,
                        ConfigService::$tableContent . '.id',
                        '=',
                        ConfigService::$tableContentFields . '.content_id'
                    )
                    ->whereIn(ConfigService::$tableContentFields . '.key', ['topic', 'style'])
                    ->where(ConfigService::$tableContentFields . '.value', $key)
                    ->update(
                        [
                            ConfigService::$tableContentFields . '.value' => $value,
                        ]
                    );
        }

        $this->info('Finished cleaning');
    }
}
