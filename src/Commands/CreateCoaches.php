<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;
use Faker\Generator;

class CreateCoaches extends Command
{
    protected $signature = 'CreateCoaches';
    protected $description = 'Create coach content for each instructor';

    private $contentService;
    private $contentFieldService;
    private $contentDatumService;
    private $databaseManager;
    private $faker;

    public function __construct(
        Generator $faker,
        ContentService $contentService,
        ContentFieldService $contentFieldService,
        ContentDatumService $contentDatumService,
        DatabaseManager $databaseManager
    ) {
        parent::__construct();
        $this->contentService = $contentService;
        $this->contentFieldService = $contentFieldService;
        $this->contentDatumService = $contentDatumService;
        $this->databaseManager = $databaseManager;
        $this->faker = $faker;
    }

    public function handle()
    {
        $existingCoaches = $this->databaseManager->connection(
            ConfigService::$databaseConnectionName
        )
            ->table(ConfigService::$tableContent)
            ->where([
                'type' => 'coach',
                'status' => ContentService::STATUS_PUBLISHED,
                'brand' => config('railcontent.brand'),
            ])
            ->get()
            ->keyBy('slug');

        foreach ($existingCoaches as $existingCoach) {
            //set coach as active
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $existingCoach->id,
                'key' => 'is_active',
                'type' => 'boolean',
                'position' => 1,
            ], [
                'value' => 1,
            ]);

            //add genre field
            $genre = $this->faker->randomElement(['Odd Time', 'Country', 'Folk', 'Beats', 'Musical', 'Pop']);
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $existingCoach->id,
                'key' => 'genre',
                'type' => 'string',
                'position' => 1,
            ], [
                'value' => $genre,
            ]);

            $genre2 = $this->faker->randomElement(['Fusion', 'Funk', 'Folk', 'Soul', 'Rock', 'Latin']);
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $existingCoach->id,
                'key' => 'genre',
                'type' => 'string',
                'position' => 2,
            ], [
                'value' => $genre2,
            ]);

            //add focus field
            $focus = $this->faker->randomElement(['Creativity', 'Groove', 'Electronic Drums', 'Technique']);
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $existingCoach->id,
                'key' => 'focus',
                'type' => 'string',
                'position' => 1,
            ], [
                'value' => $focus,
            ]);

            $focus2 = $this->faker->randomElement(['Rudiments', 'Performance', 'Composition']);
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $existingCoach->id,
                'key' => 'focus',
                'type' => 'string',
                'position' => 2,
            ], [
                'value' => $focus2,
            ]);

            //add data
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'focus_text',
                'position' => 1,
            ], [
                'value' => $this->faker->sentences(rand(1, 5), true),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'short_bio',
                'position' => 1,
            ], [
                'value' => $this->faker->sentences(rand(1, 2), true),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'card_thumbnail_url',
                'position' => 1,
            ], [
                'value' => $this->randomThumbUrl(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'banner_background_image_url',
                'position' => 1,
            ], [
                'value' => $this->randomThumbUrl(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'bio_image',
                'position' => 1,
            ], [
                'value' => $this->randomThumbUrl(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'trailer_video_id',
                'position' => 1,
            ], [
                'value' => $this->randomVimeoVideoId(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'bio_image',
                'position' => 1,
            ], [
                'value' => $this->randomThumbUrl(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'long_bio',
                'position' => 1,
            ], [
                'value' => $this->faker->sentences(rand(1, 5), true),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $existingCoach->id,
                'key' => 'forum_thread_url',
                'position' => 1,
            ], [
                'value' => $this->faker->text(),
            ]);

            $featuredCoachId = $existingCoach->id;
        }

        $featuredCoaches = 0;
        if (isset($featuredCoachId)) {
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $featuredCoachId,
                'key' => 'is_featured',
                'type' => 'boolean',
                'position' => 1,
            ], [
                'value' => 1,
            ]);
            $featuredCoaches++;
        }

        $instructors = $this->databaseManager->connection(
            ConfigService::$databaseConnectionName
        )
            ->table(ConfigService::$tableContent)
            ->where([
                'type' => 'instructor',
                'status' => ContentService::STATUS_PUBLISHED,
                'brand' => config('railcontent.brand'),
            ])
            ->get();

        foreach ($instructors as $instructor) {
            $coach = $this->updateOrInsertAndGetFirst(ConfigService::$tableContent, [
                'slug' => $instructor->slug,
                'type' => 'coach',
                'sort' => 0,
                'status' => $instructor->status,
                'brand' => $instructor->brand,
            ], [
                'published_on' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]);

            $genre = $this->faker->randomElement(['Odd Time', 'Country', 'Folk', 'Beats', 'Musical', 'Pop']);
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $coach->id,
                'key' => 'genre',
                'type' => 'string',
                'position' => 1,
            ], [
                'value' => $genre,
            ]);

            $genre2 = $this->faker->randomElement(['Fusion', 'Funk', 'Folk', 'Soul', 'Rock', 'Latin']);
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $coach->id,
                'key' => 'genre',
                'type' => 'string',
                'position' => 2,
            ], [
                'value' => $genre2,
            ]);

            //add focus field
            $focus = $this->faker->randomElement(['Creativity', 'Groove', 'Electronic Drums', 'Technique']);
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $coach->id,
                'key' => 'focus',
                'type' => 'string',
                'position' => 1,
            ], [
                'value' => $focus,
            ]);

            $focus2 = $this->faker->randomElement(['Rudiments', 'Performance', 'Composition']);
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $coach->id,
                'key' => 'focus',
                'type' => 'string',
                'position' => 2,
            ], [
                'value' => $focus2,
            ]);

            $instructorField = $this->databaseManager->connection(
                ConfigService::$databaseConnectionName
            )
                ->table(ConfigService::$tableContentFields)
                ->where([
                    'content_id' => $instructor->id,
                    'key' => 'name',
                ])
                ->first();

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $coach->id,
                'key' => 'name',
                'type' => 'string',
                'position' => 1,
            ], [
                'value' => $instructorField->value,
            ]);

            //add data
            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'focus_text',
                'position' => 1,
            ], [
                'value' => $this->faker->sentences(rand(1, 5), true),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'short_bio',
                'position' => 1,
            ], [
                'value' => $this->faker->sentences(rand(1, 2), true),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'card_thumbnail_url',
                'position' => 1,
            ], [
                'value' => $this->randomThumbUrl(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'banner_background_image_url',
                'position' => 1,
            ], [
                'value' => $this->randomThumbUrl(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'bio_image',
                'position' => 1,
            ], [
                'value' => $this->faker->imageUrl(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'trailer_video_id',
                'position' => 1,
            ], [
                'value' => $this->randomVimeoVideoId(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'bio_image',
                'position' => 1,
            ], [
                'value' => $this->faker->imageUrl(),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'long_bio',
                'position' => 1,
            ], [
                'value' => $this->faker->sentences(rand(1, 5), true),
            ]);

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentData, [
                'content_id' => $coach->id,
                'key' => 'forum_thread_url',
                'position' => 1,
            ], [
                'value' => $this->faker->text(),
            ]);

            if ($featuredCoaches < 3) {
                $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                    'content_id' => $coach->id,
                    'key' => 'is_featured',
                    'type' => 'boolean',
                    'position' => 1,
                ], [
                    'value' => 1,
                ]);
                $featuredCoaches++;
            }

            $this->updateOrInsertAndGetFirst(ConfigService::$tableContentFields, [
                'content_id' => $coach->id,
                'key' => 'is_active',
                'type' => 'boolean',
                'position' => 1,
            ], [
                'value' => $this->faker->randomElement([true, false]),
            ]);

        }

        return true;
    }

    private function railcontentDB()
    {
        return $this->databaseManager->connection(
            ConfigService::$databaseConnectionName
        )
            ->query();
    }

    private function updateOrInsertAndGetFirst($table, array $attributes, array $values = [])
    {
        $this->railcontentDB()
            ->from($table)
            ->updateOrInsert($attributes, $values);

        return $this->railcontentDB()
            ->from($table)
            ->where(array_merge($attributes, $values))
            ->get()
            ->first();
    }

    /**
     * @return mixed
     */
    private function randomVimeoVideoId()
    {
        return $this->faker->randomElement([
            236547,
            236543,
            236538,
            236536,
            236501,
            236458,
            236448,
            236447,
            236446,
            236445,
            236430,
            236426,
            236421,
            236413,
            236408,
            236326,
            236325,
            236320,
            236319,
            236318,
            236317,
            236307,
            236299,
            236291,
            236275,
            236262,
            236261,
            236260,
            236259,
            236258,
            236257,
            236255,
            236252,
            236250,
            236248,
            236246,
            236244,
            236241,
            236239,
            236237,
            236235,
            236232,
            236230,
            236228,
            236226,
            236224,
            236222,
            236219,
            236217,
            236215,
            236213,
            236211,
            236203,
            236179,
            236173,
            236171,
            236158,
            236157,
            236103,
            236099,
            236098,
            236087,
            236082,
            236041,
            236040,
            236039,
            236028,
            236027,
            236026,
            236025,
            235992,
            235979,
            235898,
            235894,
            235890,
            235889,
            235888,
            235887,
            235886,
            235885,
            235884,
            235882,
            235880,
            235878,
            235856,
            235842,
            235834,
            235833,
            235724,
            235713,
            235712,
            235642,
            235631,
            235627,
            235626,
            235615,
            235599,
            235598,
            235597,
        ]);
    }

    /**
     * @return mixed
     */
    private function randomThumbUrl()
    {
        return $this->faker->randomElement([
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/domino-santantonio.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/john-wooton.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/dorothea-taylor.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/kaz-rodriguez.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/todd-sucherman.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/jared-falk.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/matt-mcguire.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/sarah-thawer.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/aric-importa.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/larnell-lewis.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/michael-schack.png',
            ]);
    }

}