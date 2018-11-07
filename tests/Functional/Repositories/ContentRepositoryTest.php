<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Resora\Entities\Entity;

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

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $contentFieldFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $contentDatumFactory;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);

        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentFieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->contentDatumFactory = $this->app->make(ContentDatumFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);

        ContentRepository::$pullFutureContent = true;
        ContentRepository::$availableContentStatues = false;
        ContentRepository::$includedLanguages = false;
    }

    public function test_get_by_id()
    {
        $contentData = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => Carbon::now()->toDateTimeString(),
            'sort' => 0,
            'user_id' => null
        ];

        $content = $this->classBeingTested->create($contentData);

        $results = $this->classBeingTested->read($content['id']);

        $this->assertEquals(
            array_merge($contentData, [
                'id' => $content['id'],
                'fields' => [],
                'data' => [],
                'permissions' => []
            ]),
            $results->getArrayCopy()
        );
    }

    public function test_get_by_id_with_fields_datum()
    {
        $content = $this->classBeingTested->create(['slug' => $this->faker->word,
            'type'=>$this->faker->randomElement(ConfigService::$commentableContentTypes),
            'status'=>ContentService::STATUS_PUBLISHED,
            'brand' => ConfigService::$brand,
            'language' => 'en',
            'created_on' => Carbon::now()->toDateTimeString()]);

        $contentId = $content['id'];

        $expectedFields = [];
        $expectedData = [];
        $expectedPermissions = [];

       for ($i = 0; $i < 3; $i++) {
            $expectedFields[] = $this->contentFieldFactory->create($contentId)->getArrayCopy();
            $expectedData[] = $this->contentDatumFactory->create($contentId);
        }

        $results = $this->classBeingTested->getById($contentId);

        $this->assertEquals(
            array_merge(
                $content->getArrayCopy(),
                [
                    'id' => $contentId,
                    'fields' => $expectedFields,
                    'data' => $expectedData,
//                    'permissions' => [],
//                    'parent_id' => null,
//                    'child_id' => null
                ]
            ),
            $results->getArrayCopy()
        );
    }

    public function test_get_by_id_restricted_by_content_status()
    {
        $content = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => Carbon::now()->toDateTimeString(),
        ];

        $contentId = $this->classBeingTested->create($content);

        $results = $this->classBeingTested->getById($contentId['id']);

        $this->assertNotEmpty($results);

        ContentRepository::$availableContentStatues = [rand()];

        $results = $this->classBeingTested->getById($contentId['id']);

        $this->assertEmpty($results);
    }

    public function test_get_by_id_accepted_by_content_status()
    {
        $content = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => Carbon::now()->toDateTimeString(),
        ];

        $contentId = $this->classBeingTested->create($content);

        ContentRepository::$availableContentStatues = [$content['status']];

        $results = $this->classBeingTested->getById($contentId['id']);

        $this->assertNotEmpty($results);
    }

    public function test_get_by_id_restricted_by_published_date()
    {
        $content = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => Carbon::now()->addDay()->toDateTimeString(),
            'created_on' => Carbon::now()->addDay()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->classBeingTested->create($content);

        $results = $this->classBeingTested->getById($contentId['id']);

        $this->assertNotEmpty($results);

        ContentRepository::$pullFutureContent = false;

        $results = $this->classBeingTested->getById($contentId['id']);

        $this->assertEmpty($results);
    }

    public function test_get_by_id_accepted_by_published_date()
    {
        $content = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => Carbon::now()->subDay()->toDateTimeString(),
            'created_on' => Carbon::now()->subDay()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->classBeingTested->create($content);

        ContentRepository::$pullFutureContent = false;

        $results = $this->classBeingTested->getById($contentId['id']);

        $this->assertNotEmpty($results);
    }

    public function test_get_by_id_restricted_by_brand()
    {
        $content = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => $this->faker->word,
            'language' => 'en-US',
            'published_on' => Carbon::now()->addDay()->toDateTimeString(),
            'created_on' => Carbon::now()->addDay()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->classBeingTested->create($content);

        $results = $this->classBeingTested->getById($contentId['id']);

        $this->assertEmpty($results);
    }

    public function test_get_by_id_accepted_by_brand()
    {
        $content = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => Carbon::now()->addDay()->toDateTimeString(),
            'created_on' => Carbon::now()->addDay()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentRow = $this->classBeingTested->create($content);

        $results = $this->classBeingTested->getById($contentRow['id']);

        $this->assertNotEmpty($results);
    }

    public function test_create_content()
    {
        $data = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'language' => 'en-US',
            'brand' => ConfigService::$brand,
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => Carbon::now()->toDateTimeString()
        ];

        $content = $this->classBeingTested->create($data);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            array_merge(
                [
                    'id' => $content['id'],
                ],
                $data
            )
        );
    }

    public function test_update()
    {
        $oldContent = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'language' => 'en-US',
            'brand' => ConfigService::$brand,
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => Carbon::now()->toDateTimeString()
        ];

        $contentId = $this->classBeingTested->create($oldContent);

        $newContent = [
            'slug' => $this->faker->word,
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'language' => 'en-US',
            'brand' => ConfigService::$brand,
            'published_on' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => Carbon::now()->toDateTimeString()
        ];

        $this->classBeingTested->update($contentId['id'], $newContent);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            array_merge(
                $newContent,
                [
                    'id' => $contentId['id'],
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
                'language' => 'en-US',
                'brand' => ConfigService::$brand,
                'published_on' => Carbon::now()->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => Carbon::now()->toDateTimeString()
            ];

            $contentId = $this->classBeingTested->create($contents[$i + 1]);
        }

        $this->classBeingTested->destroy(2);

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
}