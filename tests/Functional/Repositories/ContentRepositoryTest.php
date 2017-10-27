<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentHierarchyRepository
     */
    protected $contentHierarchyRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);

        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
    }

    public function test_create_content()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = $this->faker->word;
        $language = 'en-US';

        $contentId =
            $this->classBeingTested->create(
                $slug,
                $type,
                $status,
                ConfigService::$brand,
                $language,
                null
            );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId,
                'slug' => $slug,
                'type' => $type,
                'status' => $status,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );
    }

    public function test_update()
    {
        $oldContent = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($oldContent);

        $newContent = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => ConfigService::$brand,
            'language' => 'en-CA',
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => Carbon::now()->toDateTimeString(),
        ];

        $this->classBeingTested->update($contentId, $newContent);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            array_merge(
                $newContent,
                [
                    'id' => $contentId,
                ]
            )
        );
    }

    public function test_delete()
    {
        $contents = [];

        for ($i = 0; $i < 4; $i++) {
            $contents[$i + 1] = [
                'slug' => $this->faker->word,
                'type' => $this->faker->word,
                'status' => $this->faker->word,
                'brand' => ConfigService::$brand,
                'language' => 'en-US',
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $this->query()
                ->table(ConfigService::$tableContent)
                ->insertGetId(
                    $contents[$i + 1]
                );
        }

        $this->classBeingTested->delete(2);

        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            ['id' => 2]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            ['id' => 1]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            ['id' => 3]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            ['id' => 4]
        );
    }

    public function test_get_by_slug_not_exist()
    {
        $results = $this->classBeingTested->getBySlugHierarchy($this->faker->word);

        $this->assertNull($results);
    }
}