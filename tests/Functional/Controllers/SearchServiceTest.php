<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PlaylistsService;
use Railroad\Railcontent\Services\SearchService;
use Railroad\Railcontent\Services\UserContentProgressService;
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
    protected $classBeingTested, $userId, $languageId, $secondaryLanguageId;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(SearchService::class);

        $this->userId = $this->createAndLogInNewUser();
        $this->languageId = $this->setUserLanguage($this->userId);
        $this->secondaryLanguageId = 2;
    }

    public function test_get_by_id()
    {
        $content = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $response = $this->classBeingTested->getById($contentId);

        $this->assertEquals(
            array_merge(['id' => $contentId, 'slug' => $contentSlug], $content),
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
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];
        $slugLinkedContent = $this->faker->word;
        $linkedContentId = $this->createContent($linkedContent);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedContentId, ConfigService::$tableContent, $slugLinkedContent);

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
        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedFieldId, ConfigService::$tableFields, $linkedFieldValue);

        $linkedContentFieldLinkId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $linkedContentId,
                'field_id' => $linkedFieldId,
            ]
        );

        // main content
        $content = [
            //'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $slugContent = $this->faker->word;
        $contentId = $this->createContent($content);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $slugContent);

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
        $this->translateItem($this->classBeingTested->getUserLanguage(), $multipleField1, ConfigService::$tableFields, $multipleKeyFieldValues[0]);

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

        $this->translateItem($this->classBeingTested->getUserLanguage(), $multipleField2, ConfigService::$tableFields, $multipleKeyFieldValues[2]);

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
        $this->translateItem($this->classBeingTested->getUserLanguage(), $multipleField3, ConfigService::$tableFields, $multipleKeyFieldValues[1]);

        $multipleFieldLink3 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField3,
            ]
        );

        $multipleFieldIds = [$multipleField1, $multipleField3, $multipleField2];

        $response = $this->classBeingTested->getManyById([$contentId]);

        $this->assertEquals(
            [
                2 => [
                    "id" => $contentId,
                    "slug" => $slugContent,
                    "status" => $content["status"],
                    "type" => $content["type"],
                    "position" => $content["position"],
                    "parent_id" => $content["parent_id"],
                    "published_on" => $content["published_on"],
                    "created_on" => $content["created_on"],
                    "archived_on" => $content["archived_on"],
                    "brand" => $content['brand'],
                    "fields" => [
                        $fieldKey => [
                            "id" => $linkedContentId,
                            "slug" => $slugLinkedContent,
                            "status" => $linkedContent["status"],
                            "type" => $linkedContent["type"],
                            "position" => $linkedContent["position"],
                            "parent_id" => $linkedContent["parent_id"],
                            "published_on" => $linkedContent["published_on"],
                            "created_on" => $linkedContent["created_on"],
                            "archived_on" => $linkedContent["archived_on"],
                            'brand' => $linkedContent['brand'],
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
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $linkedDatumdKey = $this->faker->word;
        $linkedDatumValue = $this->faker->word;

        $linkedDatumId = $this->query()->table(ConfigService::$tableData)->insertGetId(
            [
                'key' => $linkedDatumdKey,
                'position' => 1,
            ]
        );

        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedDatumId, ConfigService::$tableData, $linkedDatumValue);

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
                "slug" => $contentSlug,
                "status" => $content["status"],
                "type" => $content["type"],
                "position" => $content["position"],
                "parent_id" => $content["parent_id"],
                "published_on" => $content["published_on"],
                "created_on" => $content["created_on"],
                "archived_on" => $content["archived_on"],
                'brand' => ConfigService::$brand,
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
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $linkedDatumdKey = $this->faker->word;
        $linkedDatumValue = $this->faker->word;

        $linkedDatumId = $this->query()->table(ConfigService::$tableData)->insertGetId(
            [
                'key' => $linkedDatumdKey,
                'position' => 1,
            ]
        );
        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedDatumId, ConfigService::$tableData, $linkedDatumValue);

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
                'position' => 1,
            ]
        );

        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedDatumId2, ConfigService::$tableData, $linkedDatumValue2);
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
                "slug" => $contentSlug,
                "status" => $content["status"],
                "type" => $content["type"],
                "position" => $content["position"],
                "parent_id" => $content["parent_id"],
                "published_on" => $content["published_on"],
                "created_on" => $content["created_on"],
                "archived_on" => $content["archived_on"],
                'brand' => ConfigService::$brand,
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
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $translationContent = [
            'language_id' => $this->classBeingTested->getUserLanguage(),
            'entity_type' => ConfigService::$tableContent,
            'entity_id' => $contentId,
            'value' => $this->faker->word
        ];
        $translationContentId = $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translationContent);

        $linkedFieldKey = $this->faker->word;
        $linkedFieldValue = $this->faker->word;

        $linkedFieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $linkedFieldKey,
                'type' => 'string',
                'position' => null,
            ]
        );

        $translationField = [
            'language_id' => $this->classBeingTested->getUserLanguage(),
            'entity_type' => ConfigService::$tableFields,
            'entity_id' => $linkedFieldId,
            'value' => $linkedFieldValue
        ];
        $translationFieldId = $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translationField);

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
                'position' => 1,
            ]
        );

        $translationDatum = [
            'language_id' => $this->classBeingTested->getUserLanguage(),
            'entity_type' => ConfigService::$tableData,
            'entity_id' => $linkedDatumId,
            'value' => $linkedDatumValue
        ];
        $translationDatumId = $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translationDatum);

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
                'position' => 1,
            ]
        );
        $translationDatum2 = [
            'language_id' => $this->classBeingTested->getUserLanguage(),
            'entity_type' => ConfigService::$tableData,
            'entity_id' => $linkedDatumId2,
            'value' => $linkedDatumValue2
        ];
        $translationDatumId2 = $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translationDatum2);

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
                "slug" => $translationContent["value"],
                "status" => $content["status"],
                "type" => $content["type"],
                "position" => $content["position"],
                "parent_id" => $content["parent_id"],
                "published_on" => $content["published_on"],
                "created_on" => $content["created_on"],
                "archived_on" => $content["archived_on"],
                "brand" => ConfigService::$brand,
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
        $contentId = $this->createContent();
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $response = $this->classBeingTested->getBySlug($this->faker->word.rand(), null);

        $this->assertEquals([], $response);
    }

    public function test_get_by_slug_any_parent_single()
    {
        $content = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $response = $this->classBeingTested->getBySlug($contentSlug, null);

        $this->assertEquals([$contentId => array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content)], $response);
    }

    public function test_get_by_slug_any_parent_multiple()
    {
        $expectedContent = [];

        $slug = $this->faker->word;

        for($i = 0; $i < 3; $i++) {
            $content = [
                'status' => $this->faker->word,
                'type' => $this->faker->word,
                'position' => $this->faker->numberBetween(),
                'parent_id' => $i == 0 ? null : $i,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $slug);
            $expectedContent[$contentId] = array_merge(['id' => $contentId, 'slug' => $slug, 'brand' => ConfigService::$brand], $content);
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
                'status' => $this->faker->word,
                'type' => $this->faker->word,
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $slug);
            $expectedContent[$contentId] = array_merge(['id' => $contentId, 'slug' => $slug, 'brand' => ConfigService::$brand], $content);
        }

        // add other content with the same slug but different parent id to make sure it gets excluded
        $contentID = $this->createContent(
            [
                'status' => $this->faker->word,
                'type' => $this->faker->word.rand(),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId + 1,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ]
        );
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentID, ConfigService::$tableContent, $slug);

        // add some other random content that should be excluded
        $randContentId = $this->createContent(
            [
                'status' => $this->faker->word,
                'type' => $this->faker->word.rand(),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId + 1,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ]
        );

        $this->translateItem($this->classBeingTested->getUserLanguage(), $randContentId, ConfigService::$tableContent, $this->faker->word);
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
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(1, 99))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

            $expectedContent[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        // insert non-matching content
        for($i = 0; $i < 3; $i++) {
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(100, 1000))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
        }

        $response = $this->call('GET', '/', [
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
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(100, 1000))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

            $expectedContent[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        // insert non-matching content
        for($i = 0; $i < 3; $i++) {
            $content = [
                // 'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(1, 99))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
        }

        $response = $this->call('GET', '/', [
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
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

            $expectedContent[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        $response = $this->call('GET', '/', [
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
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(1000 - (($i + 1) * 10))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $expectedContent[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        $response = $this->call('GET', '/', [
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
            'type' => 'multiple',
            'position' => 1
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $this->translateItem($this->classBeingTested->getUserLanguage(), $fieldId, ConfigService::$tableFields, 'jazz');

        // insert matching content
        for($i = 0; $i < 10; $i++) {
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $slug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $slug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $slug, 'brand' => ConfigService::$brand], $content);
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

        $response = $this->call('GET', '/', [
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

    public function test_get_course_lessons_for_instructor()
    {
        $page = 1;
        $amount = 10;
        $orderByDirection = 'asc';
        $orderByColumn = 'id';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = ['course lessons'];
        $parentId = null;
        $includeFuturePublishedOn = false;

        $requiredFields = [
            'instructor' => 'roxana',
        ];

        $course1 = [
            'status' => $this->faker->randomElement($statues),
            'type' => 'course',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];

        $courseId1 = $this->createContent($course1);
        $contentSlug1 = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $courseId1, ConfigService::$tableContent, $contentSlug1);

        $instructor = [
            'status' => $this->faker->randomElement($statues),
            'type' => 'instructor',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];
        $instructorId1 = $this->createContent($instructor);
        $instructorSlug = 'roxana';
        $this->translateItem($this->classBeingTested->getUserLanguage(), $instructorId1, ConfigService::$tableContent, $instructorSlug);

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructorId1,
            'type' => 'content_id'
        ];
        $fieldId1 = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldInstructor);

        $contentField = [
            'content_id' => $courseId1,
            'field_id' => $fieldId1
        ];

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        for($i = 0; $i < 25; $i++) {
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => 'course lessons',
                'position' => $this->faker->numberBetween(),
                'parent_id' => $courseId1,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        //Get 10th to 20th lessons for the course with instructor 'caleb' and topic 'bass drumming'
        $expectedContent = array_slice($contents, 0, 10, true);

        for($i = 0; $i < 5; $i++) {
            $content2 = [
                'status' => $this->faker->randomElement($statues),
                'type' => 'course lessons',
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId2 = $this->createContent($content2);
            $contentSlug2 = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId2, ConfigService::$tableContent, $contentSlug2);
        }

        $response = $this->call('GET', '/', [
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
            'instructor' => 'roxana',
        ];

        $expectedContent = [];

        //create 2 courses with instructor 'caleb' and different topics
        $course1 = [
            'status' => $this->faker->randomElement($statues),
            'type' => 'course',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];

        $courseId1 = $this->createContent($course1);
        $contentSlug1 = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $courseId1, ConfigService::$tableContent, $contentSlug1);

        $course2 = [
            'status' => $this->faker->randomElement($statues),
            'type' => 'course',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];

        $courseId2 = $this->createContent($course2);
        $contentSlug2 = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $courseId2, ConfigService::$tableContent, $contentSlug2);

        //create and link instructor caleb to the course
        $instructor = [
            'status' => 'published',
            'type' => 'instructor',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];
        $instructorId = $this->createContent($instructor);

        $instructorSlug = 'roxana';
        $this->translateItem($this->classBeingTested->getUserLanguage(), $instructorId, ConfigService::$tableContent, $instructorSlug);

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
                'field_id' => 1,
            ]
        );

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $courseId2,
                'field_id' => 1,
            ]
        );

        //create and link topic bass drumming to the course
        $fieldForTopic = [
            'key' => 'topic',
            'value' => 'bass drumming',
            'type' => 'multiple',
            'position' => 1
        ];

        $fieldForTopicId = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldForTopic);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $fieldForTopicId, ConfigService::$tableFields, 'bass drumming');

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $courseId1,
                'field_id' => $fieldForTopicId,
            ]
        );

        //link 25 lessons to the course
        for($i = 0; $i < 25; $i++) {
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => 'course lessons',
                'position' => $this->faker->numberBetween(),
                'parent_id' => $courseId1,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        //Get 10th to 20th lessons for the course with instructor 'caleb' and topic 'bass drumming'
        $expectedContent = array_slice($contents, 10, 10, true);

        $response = $this->call('GET', '/', [
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
        //dd($results);
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
                'status' => 'published',
                'type' => 'library lessons',
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        //link topic snare to 65 library lessons
        $fieldSlug = 'snare';
        $fieldForTopic = [
            'key' => 'topic',
            'value' => $fieldSlug,
            'type' => 'string',
            'position' => 1
        ];

        $fieldForTopicId = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldForTopic);

        $this->translateItem($this->classBeingTested->getUserLanguage(), $fieldForTopicId, ConfigService::$tableFields, $fieldSlug);

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

        $response = $this->call('GET', '/', [
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
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->createContent($content1);
        $contentSlug1 = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId1, ConfigService::$tableContent, $contentSlug1);

        $content2 = [
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId2 = $this->createContent($content2);
        $contentSlug2 = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId2, ConfigService::$tableContent, $contentSlug2);

        //last inserted content it's expected to be returned by the getPaginated method
        $expectedContent[$contentId2] = array_merge(['id' => $contentId2, 'slug' => $contentSlug2, 'brand' => ConfigService::$brand], $content2);

        $response = $this->call('GET', '/', [
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
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::tomorrow()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->createContent($content1);
        $contentSlug1 = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId1, ConfigService::$tableContent, $contentSlug1);

        $content2 = [
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::yesterday()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $content2Slug = $this->faker->word;
        $contentId2 = $this->createContent($content2);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId2, ConfigService::$tableContent, $content2Slug);
        //last inserted content it's expected to be returned by the getPaginated method
        $expectedContent[$contentId2] = array_merge(['id' => $contentId2, 'slug' => $content2Slug, 'brand' => ConfigService::$brand], $content2);

        $response = $this->call('GET', '/', [
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
        $expectedContent = [];

        // insert contents
        for($i = 0; $i < 10; $i++) {
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        // save content as completed
        for($i = 1; $i < 3; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $this->userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

            $expectedContent[$i] = $contents[$i];
        }

        $response = $this->call('GET', '/', [
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

        $expectedContent = [];

        // insert contents
        for($i = 0; $i < 10; $i++) {
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        // save content as completed
        for($i = 1; $i < 3; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $this->userId,
                'state' => UserContentProgressService::STATE_STARTED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

            $expectedContent[$i] = $contents[$i];
        }

        $response = $this->call('GET', '/', [
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

        $expectedContent = [];

        $playlist = [
            'type' => PlaylistsService::PRIVACY_PUBLIC,
            'brand' => ConfigService::$brand,
            'user_id' => $this->userId
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);
        $playlistName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId, ConfigService::$tablePlaylists, $playlistName);

        // insert contents
        for($i = 0; $i < 10; $i++) {
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug,'brand' => ConfigService::$brand], $content);
        }

        // save content in playlist
        for($i = 1; $i < 3; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $this->userId,
                'state' => UserContentProgressService::STATE_STARTED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

            $userContentPlaylist = [
                'content_user_id' => $userContentId,
                'playlist_id' => $playlistId
            ];

            $userContentPlaylistId = $this->query()->table(ConfigService::$tablePlaylistContents)->insertGetId($userContentPlaylist);
            $expectedContent[$i] = $contents[$i];
        }

        $response = $this->call('GET', '/', [
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn,
            'playlists' => [$playlistName]
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

        $expectedContent = [];

        $playlist1 = [
            'type' => PlaylistsService::PRIVACY_PUBLIC,
            'brand' => ConfigService::$brand,
            'user_id' => $this->userId
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);
        $playlistName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId1, ConfigService::$tablePlaylists, $playlistName);

        $playlist2 = [
            'type' => PlaylistsService::PRIVACY_PRIVATE,
            'brand' => ConfigService::$brand,
            'user_id' => $this->userId
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);
        $playlistName2 = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId2, ConfigService::$tablePlaylists, $playlistName2);

        // insert contents
        for($i = 0; $i < 10; $i++) {
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug,'brand' => ConfigService::$brand], $content);
        }

        // save content in playlist 1
        for($i = 1; $i < 3; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $this->userId,
                'state' => UserContentProgressService::STATE_STARTED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

            $userContentPlaylist = [
                'content_user_id' => $userContentId,
                'playlist_id' => $playlistId1
            ];

            $userContentPlaylistId = $this->query()->table(ConfigService::$tablePlaylistContents)->insertGetId($userContentPlaylist);
            $expectedContent[$i] = $contents[$i];
        }

        // save content in playlist 1
        for($i = 4; $i < 6; $i++) {
            $userContent = [
                'content_id' => $contents[$i]['id'],
                'user_id' => $this->userId,
                'state' => UserContentProgressService::STATE_STARTED,
                'progress' => 100
            ];

            $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

            $userContentPlaylist = [
                'content_user_id' => $userContentId,
                'playlist_id' => $playlistId2
            ];

            $userContentPlaylistId = $this->query()->table(ConfigService::$tablePlaylistContents)->insertGetId($userContentPlaylist);
            $expectedContent[$i] = $contents[$i];
        }

        $response = $this->call('GET', '/', [
            'page' => $page,
            'amount' => $amount,
            'fields' => $requiredFields,
            'parent_id' => $parentId,
            'statues' => $statues,
            'types' => $types,
            'order_by' => $orderByColumn,
            'order' => $orderByDirection,
            'include_future' => $includeFuturePublishedOn,
            'playlists' => [$playlistName, $playlistName2]
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
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->createContent($content1);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId1, ConfigService::$tableContent, $contentSlug);

        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);
        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);
        $contentPermission = [
            'content_id' => $contentId1,
            'content_type' => null,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        $response = $this->call('GET', '/', [
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
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->createContent($content1);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId1, ConfigService::$tableContent, $contentSlug);

        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $contentPermission = [
            'content_id' => $contentId1,
            'content_type' => null,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        $expectedContent[$contentId1] = array_merge(['id' => $contentId1, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content1);

        $response = $this->call('GET', '/', [
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
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);
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
                'status' => 'draft',
                'type' => $contentType,
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 10))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        $response = $this->call('GET', '/', [
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
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->createContent($content1);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId1, ConfigService::$tableContent, $contentSlug);

        $permissionName = $this->faker->word;
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

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
            'status' => 'draft',
            'type' => 'play along',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->createContent($content1);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId1, ConfigService::$tableContent, $contentSlug);

        $permissionName = $this->faker->word;
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $contentPermission = [
            'content_id' => $contentId1,
            'content_type' => null,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        //add user permission on request
        request()->merge(['permissions' => [$permissionName]]);

        $response = $this->classBeingTested->getById($contentId1);

        $this->assertEquals(array_merge(['id' => $contentId1, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content1), $response);
    }

    public function test_can_view_content_with_type_if_have_permission_to_access_type()
    {
        $contentType = $this->faker->word;

        $content1 = [
            'status' => 'draft',
            'type' => $contentType,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId1 = $this->createContent($content1);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId1, ConfigService::$tableContent, $contentSlug);

        $permissionName = $this->faker->word;
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $contentPermission = [
            'content_id' => null,
            'content_type' => $contentType,
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        //add user permission on request
        request()->merge(['permissions' => [$permissionName]]);

        $response = $this->classBeingTested->getById($contentId1);

        $this->assertEquals(array_merge(
            [
                'id' => $contentId1,
                'slug' => $contentSlug,
                'brand' => ConfigService::$brand
            ],
            $content1),
            $response);

    }

    public function test_get_translated_content()
    {
        $page = 1;
        $amount = 10;
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
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => $parentId,
                'published_on' => Carbon::now()->subDays(rand(1, 99))->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $contentSlug = $this->faker->word;
            $contentSlugSecondaryLanguage = $this->faker->word;
            $this->translateItem($this->languageId, $contentId, ConfigService::$tableContent, $contentSlug);
            $this->translateItem($this->secondaryLanguageId, $contentId, ConfigService::$tableContent, $contentSlugSecondaryLanguage);

            $expectedContent[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug, 'brand' => ConfigService::$brand], $content);
        }

        $response = $this->call('GET', '/', [
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

    public function test_get_content_with_fields_and_datum_in_my_language()
    {
        $content = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $contentSlugSecondaryLanguage = $this->faker->word;
        $this->translateItem($this->languageId, $contentId, ConfigService::$tableContent, $contentSlug);
        $this->translateItem($this->secondaryLanguageId, $contentId, ConfigService::$tableContent, $contentSlugSecondaryLanguage);

        $linkedFieldKey = $this->faker->word;
        $linkedFieldValue = $this->faker->word;

        $linkedFieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $linkedFieldKey,
                'type' => 'string',
                'position' => null,
            ]
        );

        $fieldValueSecondaryLanguage = $this->faker->word;
        $this->translateItem($this->languageId, $linkedFieldId, ConfigService::$tableFields, $linkedFieldValue);
        $this->translateItem($this->secondaryLanguageId, $linkedFieldId, ConfigService::$tableFields, $fieldValueSecondaryLanguage);

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
                'position' => 1,
            ]
        );

        $datumValue = $linkedDatumValue;
        $datumValueSecondaryLanguage = $this->faker->word;
        $this->translateItem($this->languageId, $linkedDatumId, ConfigService::$tableData, $datumValue);
        $this->translateItem($this->secondaryLanguageId, $linkedDatumId, ConfigService::$tableData, $datumValueSecondaryLanguage);

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
                'position' => 1,
            ]
        );

        $datumValueSecondaryLanguage2 = $this->faker->word;
        $this->translateItem($this->languageId, $linkedDatumId2, ConfigService::$tableData, $linkedDatumValue2);
        $this->translateItem($this->secondaryLanguageId, $linkedDatumId2, ConfigService::$tableData, $datumValueSecondaryLanguage2);

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
                "slug" => $contentSlug,
                "status" => $content["status"],
                "type" => $content["type"],
                "position" => $content["position"],
                "parent_id" => $content["parent_id"],
                "published_on" => $content["published_on"],
                "created_on" => $content["created_on"],
                "archived_on" => $content["archived_on"],
                "brand" => ConfigService::$brand,
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

    public function test_get_contents_for_brand()
    {
        $otherBrand = $this->faker->word;

        $page = 1;
        $amount = 10;
        $orderByDirection = 'desc';
        $orderByColumn = 'published_on';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $types = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $includeFuturePublishedOn = false;
        $requiredFields = [];

        //create 10 contents for a brand value that it's not the value from the config file
        for ($i=0; $i<10; $i++){
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
                'brand' => $otherBrand
            ];
            $contentId = $this->createContent($content);

            $contentSlug = $this->faker->word;
            $this->translateItem($this->languageId, $contentId, ConfigService::$tableContent, $contentSlug);
        }

        //create 5 contents for the config brand value
        for ($i=0; $i<5; $i++){
            $content = [
                'status' => $this->faker->randomElement($statues),
                'type' => $this->faker->randomElement($types),
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
                'brand' => ConfigService::$brand
            ];
            $contentId = $this->createContent($content);

            $contentSlug = $this->faker->word;
            $this->translateItem($this->languageId, $contentId, ConfigService::$tableContent, $contentSlug);

            $expectedContent[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug], $content);
        }

        $response = $this->call('GET', '/', [
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
}
