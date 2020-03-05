<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
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

        $sql = <<<'EOT'
INSERT INTO %s (`content_id`, `key`, `value`, `type`, `position`) (
    SELECT
        `id` AS 'content_id',
        'show_in_new_feed' AS 'key',
        %s AS 'value',
        'boolean' AS 'type',
        '1' AS 'position'
    FROM %s
    WHERE `type` %s ('%s')
)
EOT;

        $statement = sprintf(
            $sql,
            ConfigService::$tableContentFields, // insert into table
            1, // show_in_new_feed key's value
            ConfigService::$tableContent, // select from table
            'IN', // content type IN list - condition format
            implode("', '", $showNewFieldDefaultTrueTypes) // content types
        );

        $this->databaseManager->statement($statement);

        $statement = sprintf(
            $sql,
            ConfigService::$tableContentFields, // insert into table
            0, // show_in_new_feed key's value
            ConfigService::$tableContent, // select from table
            'NOT IN', // content type NOT IN list - condition format
            implode("', '", $showNewFieldDefaultTrueTypes) // content type list
        );

        $this->databaseManager->statement($statement);

        $finish = microtime(true) - $start;

        $format = "Finished adding default 'show_in_new_feed' fields in total %s seconds\n";

        $this->info(sprintf($format, $finish));
    }
}
