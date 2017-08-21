<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
    }

    public function test_get_by_id()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $response = $this->classBeingTested->getById($contentId);

        $this->assertEquals(
            array_merge(['id' => $contentId], $content),
            $response
        );
    }

    public function test_get_by_id_none_exist()
    {
        $response = $this->classBeingTested->getById(rand());

        $this->assertEquals(
            null,
            $response
        );
    }

    public function test_get_many_by_id_with_fields()
    {
        // content that is linked via a field
        $linkedContent = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $linkedContentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($linkedContent);

        $linkedFieldKey = $this->faker->word;
        $linkedFieldValue = $this->faker->word;

        $linkedFieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $linkedFieldKey,
                'value' => $linkedFieldValue,
                'type' => 'string',
                'position' => null,
            ]
        );

        $linkedContentFieldLinkId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $linkedContentId,
                'field_id' => $linkedFieldId,
            ]
        );

        // main content
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $fieldKey = $this->faker->word;

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $fieldKey,
                'value' => $linkedContentId,
                'type' => 'content_id',
                'position' => null,
            ]
        );

        $contentFieldLinkId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $fieldId,
            ]
        );

        // Add a multiple key field
        $multipleKeyFieldKey = $this->faker->word;
        $multipleKeyFieldValues = [$this->faker->word, $this->faker->word, $this->faker->word];

        $multipleField1 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[0],
                'type' => 'multiple',
                'position' => 0,
            ]
        );

        $multipleFieldLink1 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField1,
            ]
        );

        $multipleField2 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[2],
                'type' => 'multiple',
                'position' => 2,
            ]
        );

        $multipleFieldLink2 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField2,
            ]
        );

        $multipleField3 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[1],
                'type' => 'multiple',
                'position' => 1,
            ]
        );

        $multipleFieldLink3 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField3,
            ]
        );

        $response = $this->classBeingTested->getManyById([$contentId]);

        $this->assertEquals(
            [
                2 => [
                    "id" => $contentId,
                    "slug" => $content["slug"],
                    "status" => $content["status"],
                    "type" => $content["type"],
                    "position" => $content["position"],
                    "parent_id" => $content["parent_id"],
                    "published_on" => $content["published_on"],
                    "created_on" => $content["created_on"],
                    "archived_on" => $content["archived_on"],
                    "fields" => [
                        $fieldKey => [
                            "id" => $linkedContentId,
                            "slug" => $linkedContent["slug"],
                            "status" => $linkedContent["status"],
                            "type" => $linkedContent["type"],
                            "position" => $linkedContent["position"],
                            "parent_id" => $linkedContent["parent_id"],
                            "published_on" => $linkedContent["published_on"],
                            "created_on" => $linkedContent["created_on"],
                            "archived_on" => $linkedContent["archived_on"],
                            "fields" => [
                                $linkedFieldKey => $linkedFieldValue,
                            ]
                        ],
                        $multipleKeyFieldKey => $multipleKeyFieldValues
                    ],
                ]
            ],
            $response
        );
    }

    public function test_get_by_slug_non_exist()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $response = $this->classBeingTested->getBySlug($this->faker->word . rand(), null);

        $this->assertEquals([], $response);
    }

    public function test_get_by_slug_any_parent_single()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $response = $this->classBeingTested->getBySlug($content['slug'], null);

        $this->assertEquals([$contentId => array_merge(['id' => $contentId], $content)], $response);
    }

    public function test_get_by_slug_any_parent_multiple()
    {
        $expectedContent = [];

        $slug = $this->faker->word;

        for ($i = 0; $i < 3; $i++) {
            $content = [
                'slug' => $slug,
                'status' => $this->faker->word,
                'type' => $this->faker->word,
                'position' => $this->faker->numberBetween(),
                'parent_id' => $i == 0 ? null : $i,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $expectedContent[$contentId] = array_merge(['id' => $contentId], $content);
        }

        $response = $this->classBeingTested->getBySlug($slug, null);

        $this->assertEquals($expectedContent, $response);
    }

    public function test_get_by_slug_specified_parent_multiple()
    {
        $expectedContent = [];

        $slug = $this->faker->word;
        $parentId = $this->faker->randomNumber();

        for ($i = 0; $i < 3; $i++) {
            $content = [
                'slug' => $slug,
                'status' => $this->faker->word,
                'type' => $this->faker->word,
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $expectedContent[$contentId] = array_merge(['id' => $contentId], $content);
        }

        // add other content with the same slug but different parent id to make sure it gets excluded
        $this->query()->table(ConfigService::$tableContent)->insertGetId(
            [
                'slug' => $slug,
                'status' => $this->faker->word,
                'type' => $this->faker->word . rand(),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId + 1,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ]
        );

        // add some other random content that should be excluded
        $this->query()->table(ConfigService::$tableContent)->insertGetId(
            [
                'slug' => $this->faker->word . rand(),
                'status' => $this->faker->word,
                'type' => $this->faker->word . rand(),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId + 1,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ]
        );

        $response = $this->classBeingTested->getBySlug($slug, $parentId);

        $this->assertEquals($expectedContent, $response);
    }

    public function test_get_paginated_page_amount()
    {
        $page = 1;
        $amount = 3;
        $orderByDirection = 'desc';
        $orderByColumn = 'published_on';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = false;

        $expectedContent = [];

        // insert matching content
        for ($i = 0; $i < 3; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(1, 99))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $expectedContent[$contentId] = array_merge(['id' => $contentId], $content);
        }

        // insert non-matching content
        for ($i = 0; $i < 3; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(100, 1000))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
        }

        $response = $this->classBeingTested->getPaginated(
            $page,
            $amount,
            $orderByDirection,
            $orderByColumn,
            $statues,
            $types,
            $parentId,
            $includeFuturePublishedOn
        );

        $this->assertEquals($expectedContent, $response);
    }

    public function test_get_paginated_page_2_amount()
    {
        $page = 2;
        $amount = 3;
        $orderByDirection = 'desc';
        $orderByColumn = 'published_on';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = false;

        $expectedContent = [];

        // insert matching content
        for ($i = 0; $i < 3; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(100, 1000))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $expectedContent[$contentId] = array_merge(['id' => $contentId], $content);
        }

        // insert non-matching content
        for ($i = 0; $i < 3; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(1, 99))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
        }

        $response = $this->classBeingTested->getPaginated(
            $page,
            $amount,
            $orderByDirection,
            $orderByColumn,
            $statues,
            $types,
            $parentId,
            $includeFuturePublishedOn
        );

        $this->assertEquals($expectedContent, $response);
    }

    public function test_get_paginated_order_by_desc()
    {
        $page = 1;
        $amount = 3;
        $orderByDirection = 'desc';
        $orderByColumn = 'published_on';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = false;

        $expectedContent = [];

        // insert matching content
        for ($i = 0; $i < 3; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $expectedContent[$contentId] = array_merge(['id' => $contentId], $content);
        }

        $response = $this->classBeingTested->getPaginated(
            $page,
            $amount,
            $orderByDirection,
            $orderByColumn,
            $statues,
            $types,
            $parentId,
            $includeFuturePublishedOn
        );

        $this->assertEquals($expectedContent, $response);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($response));
    }

    public function test_get_paginated_order_by_asc()
    {
        $page = 1;
        $amount = 3;
        $orderByDirection = 'asc';
        $orderByColumn = 'published_on';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = false;

        $expectedContent = [];

        // insert matching content
        for ($i = 0; $i < 3; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(1000 - (($i + 1) * 10))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $expectedContent[$contentId] = array_merge(['id' => $contentId], $content);
        }

        $response = $this->classBeingTested->getPaginated(
            $page,
            $amount,
            $orderByDirection,
            $orderByColumn,
            $statues,
            $types,
            $parentId,
            $includeFuturePublishedOn
        );

        $this->assertEquals($expectedContent, $response);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($response));
    }

    public function test_link_datum()
    {
        $contentId = $this->faker->numberBetween();
        $datumId = $this->faker->numberBetween();

        $datumLinkId = $this->classBeingTested->linkDatum($contentId, $datumId);

        $this->assertEquals(1, $datumLinkId);

        $this->assertDatabaseHas(
            ConfigService::$tableContentData,
            [
                'id' => $datumLinkId,
                'content_id' => $contentId,
                'datum_id' => $datumId
            ]
        );

    }

    public function test_create_single()
    {
        $slug = $this->faker->word;
        $status = $this->faker->word;
        $type = $this->faker->word;

        $categoryId = $this->classBeingTested->create($slug, $status, $type, 1, null, Carbon::now()->subDays(1000 -  10)->toDateTimeString());

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $categoryId,
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => 1,
                'parent_id' => null,
                'published_on' =>  Carbon::now()->subDays(1000 -  10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public function query()
    {
        return $this->databaseManager->connection();
    }
}