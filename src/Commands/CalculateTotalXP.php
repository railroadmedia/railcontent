<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ContentService;

class CalculateTotalXP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CalculateTotalXP';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CalculateTotalXP';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager, ContentService $contentService)
    {
        $this->info('Calculate total XP values.');
        $dbConnection = $databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $memoryStart = memory_get_usage();
        $startTime = microtime(true);

        $types = [
            "assignment",
            "course-part",
            "course",
            "song-part",
            "song",
            "unit-part",
            "unit",
            "learning-path-lesson",
            "learning-path-course",
            "learning-path-level",
            "learning-path",
            "play-along",
            "question-and-answer",
            "25-days-of-christmas",
            "behind-the-scenes",
            "boot-camps",
            "camp-drumeo-ah",
            "challenges",
            "diy-drum-experiments",
            "exploring-beats",
            "gear-guides",
            "ha-oemurd-pmac",
            "live",
            "namm-2019",
            "on-the-road",
            "paiste-cymbals",
            "performances",
            "podcasts",
            "quick-tips",
            "rhythmic-adventures-of-captain-carson",
            "rhythms-from-another-planet",
            "rudiment",
            "semester-pack-lesson",
            "semester-pack",
            "solos",
            "sonor-drums",
            "student-collaborations",
            "student-focus",
            "study-the-greats",
            "tama-drums",
            "pack-bundle-lesson",
            "pack-bundle",
            "pack",
            "recording",
            "student-review",
            "song-tutorial",
            "song-tutorial-children"
        ];

        if (Schema::connection(config('railcontent.database_connection_name'))->hasColumn(
            config('railcontent.table_prefix').'content',
            'children_total_xp'
        )) {
            Schema::connection(config('railcontent.database_connection_name'))
                ->table(
                    config('railcontent.table_prefix').'content',
                    function (Blueprint $table) {
                        $table->dropColumn('children_total_xp');
                    }
                );
        }

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'content',
                function (Blueprint $table) {
                    $table->integer('children_total_xp')
                        ->nullable(true);
                }
            );

        foreach ($types as $lessonType) {

            $start = microtime(true);

            $this->calculateChildrenTotalXP($databaseManager, $lessonType);

            $sql = <<<'EOT'
UPDATE `%s` cs
INNER JOIN (
    SELECT
        c.id AS content_id,
        f1.value as xp,
        f2.value as difficulty
    FROM railcontent_content c
    LEFT JOIN railcontent_content_fields f1 on f1.content_id  = c.id and f1.key = 'xp'
    LEFT JOIN railcontent_content_fields f2 on f2.content_id  = c.id and f2.key = 'difficulty'
    WHERE c.type = '%s'
) n ON  cs.id = n.content_id 
SET cs.`total_xp` = IF(n.xp IS NULL, (
 case
         when cs.type = '%s' then '%s'
         when cs.type = '%s' then '%s'
         when cs.type = '%s' then '%s'
         when cs.type = '%s' then '%s'
         when cs.type = '%s' then '%s'
         when cs.type = '%s' then '%s'
         when cs.type = '%s' then '%s'
         when n.difficulty in ('1', '2', '3', 'beginner') then 100
         when n.difficulty in ('4', '5', '6', 'intermediate', 'all') then 150
         when n.difficulty in ('7', '8', '9', '10', 'advanced') then 200
         else 150
                      
        end
+ (IF(cs.`children_total_xp` IS NULL, 0, cs.`children_total_xp`))), 
(n.`xp` + (IF(cs.`children_total_xp` IS NULL, 0, cs.`children_total_xp`)))
)
where cs.type = '%s'
EOT;

            $statement = sprintf(
                $sql,
                config('railcontent.table_prefix') . 'content',
                $lessonType,
                'assignment',
                config('xp_ranks.assignment_content_completed'),
                'course',
                config('xp_ranks.course_content_completed'),
                'unit',
                config('xp_ranks.unit_content_completed'),
                'song',
                config('xp_ranks.song_content_completed'),
                'pack-bundle',
                config('xp_ranks.pack_bundle_content_completed'),
                'pack',
                config('xp_ranks.pack_content_completed'),
                'learning-path',
                config('xp_ranks.learning_path_content_completed'),
                $lessonType
            );

            $databaseManager->connection(config('railcontent.database_connection_name'))
                ->statement($statement);

            $finish = microtime(true) - $start;

            $format = "Finished processing " . $lessonType . " in total %s seconds\n ";

            $this->info(sprintf($format, $finish));
        }

        $this->info('Total time::  '.(microtime(true) - $startTime));
        $this->info('Memory usage :: ' . $this->formatmem(memory_get_usage() - $memoryStart));

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'content',
                function (Blueprint $table) {
                    $table->dropColumn('children_total_xp');
                }
            );

        return true;

    }

    function formatmem($m)
    {
        if ($m) {
            $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
            $m = @round($m / pow(1024, ($i = floor(log($m, 1024)))), 2) . ' ' . $unit[$i];
        }
        return str_pad($m, 15, ' ', STR_PAD_LEFT);
    }

    /**
     * @param string $type
     * @return array
     */
    private function calculateChildrenTotalXP(DatabaseManager $databaseManager, string $type)
    {

        $sql = <<<'EOT'
UPDATE `%s` cs
 JOIN (
    SELECT
        sum(c.total_xp)  as child_xp, hc.parent_id as parent_id
    FROM railcontent_content_hierarchy hc 
    Join railcontent_content c on hc.child_id = c.id
      where c.status in  ('%s')
                    GROUP BY hc.parent_id

) n ON
    cs.id = n.parent_id 
SET cs.`children_total_xp` = IF(n.child_xp IS NULL, 0, n.child_xp)

where cs.type = '%s'
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content',
            implode(
                "', '",
                [
                    ContentService::STATUS_DRAFT,
                    ContentService::STATUS_PUBLISHED,
                    ContentService::STATUS_SCHEDULED,
                ]
            ),
            $type
        );

        $databaseManager->connection(config('railcontent.database_connection_name'))
            ->statement($statement);

        return $statement;
    }
}
