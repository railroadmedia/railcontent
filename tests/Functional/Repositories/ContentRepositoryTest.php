<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\ContentFieldFactory;
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

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentFieldFactory
     */
    protected $fieldFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $contentDatumFactory;

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
        $this->fieldFactory = $this->app->make(ContentFieldFactory::class);
        $this->contentDatumFactory = $this->app->make(ContentDatumFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);
    }

    public function test_get_by_id()
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

        $results = $this->classBeingTested->getById($contentId);

        $this->assertEquals(
            array_merge($content, ['id' => $contentId, 'fields' => [], 'datum' => [], 'permissions' => []]),
            $results
        );
    }

    public function test_get_by_id_with_fields_datum_permissions()
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

        $expectedFields = [];
        $expectedData = [];
        $expectedPermissions = [];

        for ($i = 0; $i < 3; $i++) {
            $expectedFields[] = $this->fieldFactory->create($contentId);
            $expectedData[] = $this->contentDatumFactory->create([$contentId]);
            $expectedPermissions[] = $this->contentPermissionFactory->create();

            $this->contentPermissionFactory->assign(
                [end($expectedPermissions)['id'], $contentId]
            );
        }

        $results = $this->classBeingTested->getById($contentId);

        $this->assertEquals(
            array_merge(
                $content,
                [
                    'id' => $contentId,
                    'fields' => $expectedFields,
                    'datum' => $expectedData,
                    'permissions' => $expectedPermissions
                ]
            ),
            $results
        );
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

    public function test_get_linked_content_by_fields()
    {
        $type = $this->faker->word;
        $linkedType = $this->faker->word;

        $content = $this->contentFactory->create(
            [
                1 => $type,
                2 => ContentService::STATUS_PUBLISHED,
            ]
        );

        $linkedContent = $this->contentFactory->create(
            [
                1 => $linkedType,
                2 => ContentService::STATUS_PUBLISHED,
            ]
        );

        $randomLinkedContentField = $this->fieldFactory->create(
            [
                $linkedContent['id'],
            ]
        );

        // linked field
        $linkedField = $this->fieldFactory->create(
            [
                $content['id'],
                'instructor_id',
                $linkedContent['id'],
                'content_id',
                1
            ]
        );

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals(
            [
                'id' => '2',
                'type' => 'content',
                'key' => 'instructor_id',
                'value' => array_merge(
                    $linkedContent,
                    [
                        'fields' =>
                            [
                                [
                                    'id' => '1',
                                    'key' => $randomLinkedContentField['key'],
                                    'value' => $randomLinkedContentField['value'],
                                    'type' => $randomLinkedContentField['type'],
                                    'position' => $randomLinkedContentField['position'],
                                ]
                            ]
                    ]
                ),
                'position' => '1'
            ],
            $response['fields'][1]
        );
    }
}