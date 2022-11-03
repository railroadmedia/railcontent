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
    protected $signature = 'CleanContentTopicsAndStyles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean content topics and content style';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $this->info('Started cleaning content metadata');

        $replaceOldValueInto = [
//            'Question & Answer' => 'Q&A',
//            'Peformance' => 'Performance',
//            'Performances' => 'Performance',
//            'Bues' => 'Blues',
            'Odd-Time' => 'Odd Time',
//            'rock/pop' => 'Pop/Rock',
//            'Gear Talk' => 'Gear',
//            'Solo' => 'Solos',
//            'Style' => 'Styles',
//            'Funk. Electronic' => 'Funk',
//            'Funk. Odd Time' => 'Funk',
//            'Odd-Time' => 'Odd time',
              'Pop Rock' => 'Pop/Rock',
//            'Pop/Rock/Metal' => 'Pop/Rock',
//            'Pop/Style' => 'Pop/Rock',
//            'R&B Electronic' => 'R&B',
              'R&B' => 'R&B/Soul',

        ];

        foreach ($replaceOldValueInto as $key => $value) {
            $rows =
                $databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(ConfigService::$tableContentFields)
                    ->join(
                        ConfigService::$tableContent,
                        ConfigService::$tableContent . '.id',
                        '=',
                        ConfigService::$tableContentFields . '.content_id'
                    )
                    ->whereIn(ConfigService::$tableContentFields . '.key', ['style'])
                    ->where(ConfigService::$tableContentFields . '.value', $key)
                    ->where(ConfigService::$tableContent . '.brand', 'drumeo')
                    ->update(
                        [
                            ConfigService::$tableContentFields . '.value' => $value,
                        ]
                    );

            $databaseManager->connection(config('railcontent.database_connection_name'))
                ->table(config('railcontent.table_prefix') . 'content_styles')
                ->join(
                    ConfigService::$tableContent,
                    ConfigService::$tableContent . '.id',
                    '=',
                    config('railcontent.table_prefix') . 'content_styles' . '.content_id'
                )
                ->where(config('railcontent.table_prefix') . 'content_styles' . '.style', $key)
                ->where(ConfigService::$tableContent . '.brand', 'drumeo')
                ->update(
                    [
                        config('railcontent.table_prefix') . 'content_styles' . '.style' => $value,
                    ]
                );
        }

//        $databaseManager->connection(config('railcontent.database_connection_name'))
//            ->table(ConfigService::$tableContentFields)
//            ->where('key', 'topic')
//            ->where('value', '-')
//            ->delete();

//        $databaseManager->connection(config('railcontent.database_connection_name'))
//            ->table(ConfigService::$tableContentFields)
//            ->where('key', 'style')
//            ->where('value', '-')
//            ->delete();

        $this->info('Finished cleaning');
    }
}
