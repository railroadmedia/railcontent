<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentVersionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentVersionRepositoryTest extends RailcontentTestCase
{
    /**
     * @var ContentVersionRepository
     */
    protected $classBeingTested;

    public function test_store_content_version()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'language' => 'en-US',
            'parent_id' => rand(),
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => Carbon::now()->toDateTimeString(),
        ];

        $version = [
            'content_id' => rand(),
            'author_id' => rand(),
            'state' => $this->faker->word,
            'data' => serialize($content),
            'saved_on' => Carbon::now()->toDateTimeString(),
        ];

        $id = $this->classBeingTested->create($version);

        $this->assertDatabaseHas(
            ConfigService::$tableContentVersions,
            array_merge(
                ['id' => $id],
                $version
            )
        );
    }

    public function test_store_content_with_datum_fields_permissions()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'language' => 'en-US',
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'datum' => [[$this->faker->word => $this->faker->word]],
            'fields' => [[$this->faker->word => $this->faker->word]],
            'permissions' => [[$this->faker->word => $this->faker->word]],
        ];

        $version = [
            'content_id' => rand(),
            'author_id' => rand(),
            'state' => $this->faker->word,
            'data' => serialize($content),
            'saved_on' => Carbon::now()->toDateTimeString(),
        ];

        $id = $this->classBeingTested->create($version);

        $this->assertDatabaseHas(
            ConfigService::$tableContentVersions,
            array_merge(
                ['id' => $id],
                $version
            )
        );
    }

    public function test_get_old_content_version()
    {
        $oldContent = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'language' => 'en-US',
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'datum' => [[$this->faker->word => $this->faker->word]],
            'fields' => [[$this->faker->word => $this->faker->word]],
            'permissions' => [[$this->faker->word => $this->faker->word]],
        ];

        $oldVersion = [
            'content_id' => rand(),
            'author_id' => rand(),
            'state' => $this->faker->word,
            'data' => serialize($oldContent),
            'saved_on' => Carbon::now()->toDateTimeString(),
        ];

        $oldId = $this->classBeingTested->create($oldVersion);

        $newContent = array_merge($oldContent, ['slug' => $this->faker->word]);

        $newVersion = [
            'content_id' => rand(),
            'author_id' => rand(),
            'state' => $this->faker->word,
            'data' => serialize($newContent),
            'saved_on' => Carbon::now()->toDateTimeString(),
        ];

        $newId = $this->classBeingTested->create($newVersion);

        $oldContentVersion = $this->classBeingTested->getById($oldId);

        $this->assertEquals(array_merge(['id' => $oldId], $oldVersion), $oldContentVersion);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentVersionRepository::class);
    }
}
