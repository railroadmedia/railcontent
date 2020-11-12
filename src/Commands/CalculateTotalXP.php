<?php

namespace Railroad\Railcontent\Commands;

use App\Decorators\Content\Types\DrumeoMethodLearningPathDecorator;
use App\Decorators\LessonAssignmentDecorator;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Events\HierarchyUpdated;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
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
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * Create a new command instance.
     *
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager, ContentService $contentService)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;
        $this->contentService = $contentService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Calculate total XP values.');
        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        ContentRepository::$bypassPermissions = true;
        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_DRAFT,
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];
        ConfigService::$availableBrands = ['drumeo'];
        $types = [
            "assignment",
            "course-part",
            "course",
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
        ];

        foreach ($types as $type) {
            $this->info('Start ' . $type );
            $dbConnection->table(config('railcontent.table_prefix') . 'content')
                ->select('id')
                ->where('type', $type)
                ->where('brand','drumeo')
                ->whereIn('status',[
                    ContentService::STATUS_DRAFT,
                    ContentService::STATUS_PUBLISHED,
                    ContentService::STATUS_SCHEDULED,
                ])
                ->orderBy('id', 'asc')
                ->chunk(
                    150,
                    function (Collection $rows)  use($type, $pdo, $dbConnection) {
                        $totalXPForContents = $this->contentService->calculateTotalXpForContents(
                            $rows->pluck('id')
                                ->toArray()
                        );


                        $contentIdsToUpdate = array_keys($totalXPForContents);
                        if (!empty($contentIdsToUpdate)) {
                            $query1 = ' CASE';
                            foreach ($totalXPForContents as $id => $totalXPForContent) {
                                $query1 .= "  WHEN id = " . $id . " THEN " . $pdo->quote($totalXPForContent);
                            }

                            $cq = " SET total_xp = (" . $query1 . " END )";
                            $statement = "UPDATE " . config('railcontent.table_prefix') . 'content' . $cq;
                            $statement .= " WHERE " .
                                config('railcontent.table_prefix') .
                                'content' .
                                ".id IN (" .
                                implode(",", $contentIdsToUpdate) .
                                ")";

                            $dbConnection->statement($statement);
                        }

                    });

            $this->info('End ' . $type);
        }

        $this->info('Finished total XP values.');

        return true;
    }
}
