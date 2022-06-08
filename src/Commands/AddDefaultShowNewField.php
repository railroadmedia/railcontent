<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ConfigService;

class AddDefaultShowNewField extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AddDefaultShowNewField';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds the show_in_new_feed content field with default value based on content type';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $start = microtime(true);

        $this->info("Started adding default 'show_in_new_feed' fields");

        $showNewFieldDefaultTrueTypes = [
            'quick-tips',
            'in-rhythm',
            'student-collaborations',
            'live',
            'diy-drum-experiments',
            'rhythmic-adventures-of-captain-carson',
            'exploring-beats',
            'podcasts',
            'solos',
            'boot-camps',
            'study-the-greats',
            'rhythms-from-another-planet',
            'challenges',
            'tama-drums',
            'sonor-drums',
            'paiste-cymbals',
            'gear-guides',
            'behind-the-scenes',
            'performances',
            'on-the-road',
            'namm-2019',
            'camp-drumeo-ah',
            '25-days-of-christmas',
            'course',
            'play-along',
            'song'
        ];

        $chunkSize = 1000;
        $insertData = [];

        $databaseManager->connection(config('railcontent.database_connection_name'))
            ->table(ConfigService::$tableContent)
            ->whereIn('type', $showNewFieldDefaultTrueTypes)
            ->orderBy('id', 'desc')
            ->chunk(
                $chunkSize,
                function (Collection $rows) use ($databaseManager) {

                    foreach ($rows as $item) {

                        $insertData[] = [
                            'content_id' => $item->id,
                            'key' => 'show_in_new_feed',
                            'value' => 1,
                            'type' => 'boolean',
                            'position' => 1,
                        ];
                    }

                    $databaseManager->connection(config('railcontent.database_connection_name'))
                        ->table(ConfigService::$tableContentFields)
                        ->insert($insertData);

                    $insertData = [];
                }
            );

        $finish = microtime(true) - $start;

        $format = "Finished adding default 'show_in_new_feed' fields in total %s seconds\n";

        $this->info(sprintf($format, $finish));
    }
}
