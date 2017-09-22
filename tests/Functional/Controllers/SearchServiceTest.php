<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/20/2017
 * Time: 12:26 PM
 */

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PlaylistsService;
use Railroad\Railcontent\Services\SearchService;
use Railroad\Railcontent\Services\UserContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

/**
 * Class SearchServiceTest
 * @package Railroad\Railcontent\Tests\Functional\Controllers
 */
class SearchServiceTest extends RailcontentTestCase
{
    /**
     * @var
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(SearchService::class);
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

    public function test_get_many_by_id_with_datum()
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

        $linkedDatumdKey = $this->faker->word;
        $linkedDatumValue = $this->faker->word;

        $linkedDatumId = $this->query()->table(ConfigService::$tableData)->insertGetId(
            [
                'key' => $linkedDatumdKey,
                'value' => $linkedDatumValue,
                'position' => 1,
            ]
        );

        $linkedContentDatumLinkId = $this->query()->table(ConfigService::$tableContentData)->insertGetId(
            [
                'content_id' => $contentId,
                'datum_id' => $linkedDatumId,
            ]
        );

        $response = $this->classBeingTested->getById($contentId);

        $this->assertEquals(
            [
                "id" => $contentId,
                "slug" => $content["slug"],
                "status" => $content["status"],
                "type" => $content["type"],
                "position" => $content["position"],
                "parent_id" => $content["parent_id"],
                "published_on" => $content["published_on"],
                "created_on" => $content["created_on"],
                "archived_on" => $content["archived_on"],
                "datum" => [
                    $linkedDatumdKey => $linkedDatumValue
                ],
            ],
            $response
        );
    }

    public function test_get_many_by_id_with_multiple_datum()
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

        $linkedDatumdKey = $this->faker->word;
        $linkedDatumValue = $this->faker->word;

        $linkedDatumId = $this->query()->table(ConfigService::$tableData)->insertGetId(
            [
                'key' => $linkedDatumdKey,
                'value' => $linkedDatumValue,
                'position' => 1,
            ]
        );

        $linkedContentDatumLinkId = $this->query()->table(ConfigService::$tableContentData)->insertGetId(
            [
                'content_id' => $contentId,
                'datum_id' => $linkedDatumId,
            ]
        );

        $linkedDatumdKey2 = $this->faker->word;
        $linkedDatumValue2 = $this->faker->word;

        $linkedDatumId2 = $this->query()->table(ConfigService::$tableData)->insertGetId(
            [
                'key' => $linkedDatumdKey2,
                'value' => $linkedDatumValue2,
                'position' => 1,
            ]
        );

        $linkedContentDatumLinkId2 = $this->query()->table(ConfigService::$tableContentData)->insertGetId(
            [
                'content_id' => $contentId,
                'datum_id' => $linkedDatumId2,
            ]
        );

        $response = $this->classBeingTested->getById($contentId);

        $this->assertEquals(
            [
                "id" => $contentId,
                "slug" => $content["slug"],
                "status" => $content["status"],
                "type" => $content["type"],
                "position" => $content["position"],
                "parent_id" => $content["parent_id"],
                "published_on" => $content["published_on"],
                "created_on" => $content["created_on"],
                "archived_on" => $content["archived_on"],
                "datum" => [
                    $linkedDatumdKey => $linkedDatumValue,
                    $linkedDatumdKey2 => $linkedDatumValue2
                ],
            ],
            $response
        );
    }

    public function test_get_many_by_id_with_field_and_datum()
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
                'content_id' => $contentId,
                'field_id' => $linkedFieldId,
            ]
        );

        $linkedDatumKey = $this->faker->word;
        $linkedDatumValue = $this->faker->word;

        $linkedDatumId = $this->query()->table(ConfigService::$tableData)->insertGetId(
            [
                'key' => $linkedDatumKey,
                'value' => $linkedDatumValue,
                'position' => 1,
            ]
        );

        $linkedContentDatumLinkId = $this->query()->table(ConfigService::$tableContentData)->insertGetId(
            [
                'content_id' => $contentId,
                'datum_id' => $linkedDatumId,
            ]
        );

        $linkedDatumKey2 = $this->faker->word;
        $linkedDatumValue2 = $this->faker->word;

        $linkedDatumId2 = $this->query()->table(ConfigService::$tableData)->insertGetId(
            [
                'key' => $linkedDatumKey2,
                'value' => $linkedDatumValue2,
                'position' => 1,
            ]
        );

        $linkedContentDatumLinkId2 = $this->query()->table(ConfigService::$tableContentData)->insertGetId(
            [
                'content_id' => $contentId,
                'datum_id' => $linkedDatumId2,
            ]
        );

        $response = $this->classBeingTested->getById($contentId);

        $this->assertEquals(
            [
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
                    $linkedFieldKey => $linkedFieldValue,
                ],
                "datum" => [
                    $linkedDatumKey => $linkedDatumValue,
                    $linkedDatumKey2 => $linkedDatumValue2
                ],
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

        $response = $this->classBeingTested->getBySlug($this->faker->word.rand(), null);

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

        for($i = 0; $i < 3; $i++) {
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

        for($i = 0; $i < 3; $i++) {
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
                'type' => $this->faker->word.rand(),
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
                'slug' => $this->faker->word.rand(),
                'status' => $this->faker->word,
                'type' => $this->faker->word.rand(),
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
        $requiredFields = [];

        $expectedContent = [];

        // insert matching content
        for($i = 0; $i < 3; $i++) {
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
        for($i = 0; $i < 3; $i++) {
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

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $this->assertEquals($expectedContent, json_decode($response->content(), true));
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
        $requiredFields = [];

        $expectedContent = [];

        // insert matching content
        for($i = 0; $i < 3; $i++) {
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
        for($i = 0; $i < 3; $i++) {
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

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $this->assertEquals($expectedContent, json_decode($response->content(), true));
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
        $requiredFields = [];

        $expectedContent = [];

        // insert matching content
        for($i = 0; $i < 3; $i++) {
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

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $this->assertEquals($expectedContent, json_decode($response->content(), true));

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys(json_decode($response->content(), true)));
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
        $requiredFields = [];

        $expectedContent = [];

        // insert matching content
        for($i = 0; $i < 3; $i++) {
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

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $this->assertEquals($expectedContent, json_decode($response->content(), true));

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys(json_decode($response->content(), true)));
    }

    public function test_get_paginated_with_searched_fields()
    {
        $page = 1;
        $amount = 10;
        $orderByDirection = 'desc';
        $orderByColumn = 'published_on';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = false;
        $requiredFields = [
            'topic' => 'jazz'
        ];

        $expectedContent = [];

        $field = [
            'key' => 'topic',
            'value' => 'jazz',
            'type' => 'multiple',
            'position' => 1
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);


        // insert matching content
        for($i = 0; $i < 30; $i++) {
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

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        //link field to 5 contents
        for($i = 5; $i < 10; $i++) {
            $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
                [
                    'content_id' => $contents[$i]['id'],
                    'field_id' => $fieldId,
                ]
            );
            $expectedContent[$i] = array_merge($contents[$i], ['fields' => ['topic' => [1 => 'jazz']]]);
        }

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $results = json_decode($response->content(), true);
        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));

        //check that in the response we have 5 results
        $this->assertEquals(5, count($results));
    }

    /**
     * Get a courses 10th to 20th lessons where the instructor is caleb and the topic is bass drumming
     */
    public function test_get_paginated_search_parent_fields()
    {
        $page = 2;
        $amount = 10;
        $orderByDirection = 'desc';
        $orderByColumn = 'published_on';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = ['course lessons'];
        $parentId = null;
        $includeFuturePublishedOn = false;
        $requiredFields = [
            'instructor' => 'caleb',
            'topic' => 'bass drumming'
        ];

        $expectedContent = [];

        //create 2 courses with instructor 'caleb' and different topics
        $course1 = [
            'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'course',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];

        $courseId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($course1);

        $course2 = [
            'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'course',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];

        $courseId2 = $this->query()->table(ConfigService::$tableContent)->insertGetId($course2);

        //create and link instructor caleb to the course
        $instructor = [
            'slug' => 'caleb',
            'status' => $this->faker->word,
            'type' => 'instructor',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];
        $instructorId = $this->query()->table(ConfigService::$tableContent)->insertGetId($instructor);

        $fieldForInstructor = [
            'key' => 'instructor',
            'value' => $instructorId,
            'type' => 'content_id',
            'position' => null
        ];

        $fieldForInstructorId = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldForInstructor);

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $courseId1,
                'field_id' => $fieldForInstructorId,
            ]
        );

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $courseId2,
                'field_id' => $fieldForInstructorId,
            ]
        );

        //create and link topic bass drumming to the course
        $fieldForTopic = [
            'key' => 'topic',
            'value' => 'bass drumming',
            'type' => 'multiple',
            'position' => 1
        ];

        $fieldForInstructorId = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldForTopic);

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $courseId1,
                'field_id' => $fieldForInstructorId,
            ]
        );

        //link 25 lessons to the course
        for($i = 0; $i < 25; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => 'course lessons',
                'position' => $this->faker->numberBetween(),
                'parent_id' => $courseId1,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        //Get 10th to 20th lessons for the course with instructor 'caleb' and topic 'bass drumming'
        $expectedContent = array_slice($contents, 10, 10, true);

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $results = json_decode($response->content(), true);
        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));

        //check that in the response we have 10 results
        $this->assertEquals(10, count($results));
    }

    /*
     * Get 40th to 60th library lesson where the topic is snare
     */
    public function test_get_paginated_library_lesson_with_topic()
    {
        $page = 3;
        $amount = 20;
        $orderByDirection = 'desc';
        $orderByColumn = 'published_on';
        $statues = ['published'];
        $types = ['library lessons'];
        $parentId = null;
        $includeFuturePublishedOn = false;
        $requiredFields = [
            'topic' => 'snare'
        ];

        $expectedContent = [];

        for($i = 0; $i < 80; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => 'published',
                'type' => 'library lessons',
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        //link topic snare to 65 library lessons
        $fieldForTopic = [
            'key' => 'topic',
            'value' => 'snare',
            'type' => 'string',
            'position' => 1
        ];

        $fieldForTopicId = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldForTopic);


        for($i = 1; $i < 66; $i++) {

            $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
                [
                    'content_id' => $contents[$i]['id'],
                    'field_id' => $fieldForTopicId,
                ]
            );

            $expectedContent[$i] = array_merge($contents[$i], ['fields' => [
                'topic' => 'snare'
            ]
            ]);
        }

        //Get 40th to 60th library lesson where the topic is snare
        $expectedContent = array_slice($expectedContent, 40, 20, true);

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $results = json_decode($response->content(), true);
        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));

        //check that in the response we have 20 results
        $this->assertEquals(20, count($results));
    }

    /**
     * Get the most recent play along draft lesson
     */
    public function test_get_most_recent_content_with_type()
    {
        $page = 1;
        $amount = 1;
        $orderByDirection = 'desc';
        $orderByColumn = 'id';
        $statues = ['draft'];
        $types = ['play along'];
        $parentId = null;
        $includeFuturePublishedOn = true;
        $requiredFields = [];

        $expectedContent = [];
        $content1 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);

        $content2 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId2 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content2);

        //last inserted content it's expected to be returned by the getPaginated method
        $expectedContent[$contentId2] = array_merge(['id' => $contentId2], $content2);

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $results = json_decode($response->content(), true);
        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));
    }

    public function test_get_only_published_content()
    {
        $page = 1;
        $amount = 10;
        $orderByDirection = 'desc';
        $orderByColumn = 'id';
        $statues = ['draft'];
        $types = ['play along'];
        $parentId = null;
        $includeFuturePublishedOn = false;
        $requiredFields = [];

        $expectedContent = [];
        $content1 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::tomorrow()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);

        $content2 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::yesterday()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId2 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content2);

        //last inserted content it's expected to be returned by the getPaginated method
        $expectedContent[$contentId2] = array_merge(['id' => $contentId2], $content2);

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $results = json_decode($response->content(), true);
        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));
    }

    public function test_get_only_my_completed_content()
    {
        $page = 1;
        $amount = 10;
        $orderByDirection = 'asc';
        $orderByColumn = 'id';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = true;
        $requiredFields = [];
        $userId = $this->createAndLogInNewUser();

        $expectedContent = [];

        // insert contents
        for($i = 0; $i < 10; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        // save content as completed
        for($i = 1; $i < 3; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $userId,
                'state' => UserContentService::STATE_COMPLETED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

            $expectedContent[$i] = $contents[$i];
        }

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn,
            'only_completed' => 1
        ]);

        $results = json_decode($response->content(), true);

        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));
    }

    public function test_get_only_my_started_content()
    {
        $page = 1;
        $amount = 10;
        $orderByDirection = 'asc';
        $orderByColumn = 'id';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = true;
        $requiredFields = [];
        $userId = $this->createAndLogInNewUser();

        $expectedContent = [];

        // insert contents
        for($i = 0; $i < 10; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        // save content as completed
        for($i = 1; $i < 3; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $userId,
                'state' => UserContentService::STATE_STARTED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

            $expectedContent[$i] = $contents[$i];
        }

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn,
            'only_started' => 1
        ]);

        $results = json_decode($response->content(), true);

        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));
    }

    public function test_get_content_from_my_playlist()
    {
        $page = 1;
        $amount = 10;
        $orderByDirection = 'asc';
        $orderByColumn = 'id';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = true;
        $requiredFields = [];
        $userId = $this->createAndLogInNewUser();

        $expectedContent = [];

        $playlist = [
            'name' =>$this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        // insert contents
        for($i = 0; $i < 10; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        // save content in playlist
        for($i = 1; $i < 3; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $userId,
                'state' => UserContentService::STATE_STARTED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

            $userContentPlaylist = [
                'content_user_id' => $userContentId,
                'playlist_id' => $playlistId
            ];

            $userContentPlaylistId = $this->query()->table(ConfigService::$tableUserContentPlaylists)->insertGetId($userContentPlaylist);
            $expectedContent[$i] = $contents[$i];
        }

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn,
            'playlists' => [$playlist['name']]
        ]);

        $results = json_decode($response->content(), true);

        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));
    }

    public function test_get_content_from_multiple_playlists()
    {
        $page = 1;
        $amount = 10;
        $orderByDirection = 'asc';
        $orderByColumn = 'id';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = true;
        $requiredFields = [];
        $userId = $this->createAndLogInNewUser();

        $expectedContent = [];

        $playlist1 = [
            'name' =>$this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);

        $playlist2 = [
            'name' =>$this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);

        // insert contents
        for($i = 0; $i < 10; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        // save content in playlist 1
        for($i = 1; $i < 3; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $userId,
                'state' => UserContentService::STATE_STARTED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

            $userContentPlaylist = [
                'content_user_id' => $userContentId,
                'playlist_id' => $playlistId1
            ];

            $userContentPlaylistId = $this->query()->table(ConfigService::$tableUserContentPlaylists)->insertGetId($userContentPlaylist);
            $expectedContent[$i] = $contents[$i];
        }

        // save content in playlist 1
        for($i = 4; $i < 6; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $userId,
                'state' => UserContentService::STATE_STARTED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

            $userContentPlaylist = [
                'content_user_id' => $userContentId,
                'playlist_id' => $playlistId2
            ];

            $userContentPlaylistId = $this->query()->table(ConfigService::$tableUserContentPlaylists)->insertGetId($userContentPlaylist);
            $expectedContent[$i] = $contents[$i];
        }

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn,
            'playlists' => [$playlist1['name'], $playlist2['name']]
        ]);

        $results = json_decode($response->content(), true);

        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));
    }

    public function test_can_not_view_content_if_dont_have_permission()
    {
        $page = 1;
        $amount = 1;
        $orderByDirection = 'desc';
        $orderByColumn = 'id';
        $statues = ['draft'];
        $types = ['play along'];
        $parentId = null;
        $includeFuturePublishedOn = true;
        $requiredFields = [];

        $content1 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);

        $permission = [
            'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $contentPermission = [
            'content_id' => $contentId1,
            'content_type' => null,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn
        ]);

        $results = json_decode($response->content(), true);
        $this->assertEquals([], $results);

        //check that in the response we have 10 results
        $this->assertEquals(0, count($results));
    }

    public function test_can_view_specific_content_if_have_permission()
    {
        $permissionName = $this->faker->word;

        $page = 1;
        $amount = 1;
        $orderByDirection = 'desc';
        $orderByColumn = 'id';
        $statues = ['draft'];
        $types = ['play along'];
        $parentId = null;
        $includeFuturePublishedOn = true;
        $requiredFields = [];

        $expectedContent = [];
        $content1 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);

        $permission = [
            'name' => $permissionName,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $contentPermission = [
            'content_id' => $contentId1,
            'content_type' => null,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        $expectedContent[$contentId1] = array_merge(['id' => $contentId1], $content1);

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn,
            'permissions' => [$permissionName]
        ]);

        $results = json_decode($response->content(), true);

        $this->assertEquals($expectedContent, $results);

        // for some reason phpunit doesn't test the order of the array values
        $this->assertEquals(array_keys($expectedContent), array_keys($results));
    }

    public function test_can_view_all_contents_with_specific_type_if_have_permission()
    {
        $permissionName = $this->faker->word;

        $permission = [
            'name' => $permissionName,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $contentType = $this->faker->word;

        $contentPermission = [
            'content_id' => null,
            'content_type' => $contentType,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        $page = 1;
        $amount = 100;
        $orderByDirection = 'asc';
        $orderByColumn = 'id';
        $statues = ['draft'];
        $types = [$contentType];
        $parentId = null;
        $includeFuturePublishedOn = true;
        $requiredFields = [];

        for($i = 0; $i < 50; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => 'draft',
                'type' => $contentType,
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i+10))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        $response = $this->call('GET','/',[
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn,
            'permissions' => [$permissionName]
        ]);

        $results = json_decode($response->content(), true);

        $this->assertEquals($contents, $results);
    }

    public function test_can_not_view_content_without_permission()
    {
        $content1 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);

        $permissionName = $this->faker->word;
        $permission = [
            'name' => $permissionName,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $contentPermission = [
            'content_id' => $contentId1,
            'content_type' => null,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        $response = $this->classBeingTested->getById($contentId1);

        $this->assertNull($response);

    }

    public function test_can_view_content_if_have_permission_to_access_specific_id()
    {
        $content1 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);

        $permissionName = $this->faker->word;
        $permission = [
            'name' => $permissionName,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $contentPermission = [
            'content_id' => $contentId1,
            'content_type' => null,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        //add user permission on request
        request()->merge(['permissions'=> [$permissionName]]);

        $response = $this->classBeingTested->getById($contentId1);

        $this->assertEquals(array_merge(['id' => $contentId1], $content1),$response);
    }

    public function test_can_view_content_with_type_if_have_permission_to_access_type()
    {
        $contentType = $this->faker->word;

        $content1 = [
            'slug' => $this->faker->word,
            'status' => 'draft',
            'type' => $contentType,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);

        $permissionName = $this->faker->word;
        $permission = [
            'name' => $permissionName,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $contentPermission = [
            'content_id' => null,
            'content_type' => $contentType,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        //add user permission on request
        request()->merge(['permissions'=> [$permissionName]]);

        $response = $this->classBeingTested->getById($contentId1);

        $this->assertEquals(array_merge(['id' => $contentId1], $content1),$response);

    }
}
