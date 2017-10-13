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
    protected $classBeingTested, $languageId;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);

        $userId = $this->createAndLogInNewUser();
        $this->languageId = $this->setUserLanguage($userId);
    }

    public function test_create_content()
    {
        $slug = $this->faker->word;
        $status = $this->faker->word;
        $type = $this->faker->word;

        $contentId = $this->classBeingTested->create($slug, $status, $type, 1, null, Carbon::now()->subDays(1000 - 10)->toDateTimeString());

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId,
                'status' => $status,
                'type' => $type,
                'position' => 1,
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(1000 - 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'id' => 1,
                'value' => $slug,
                'entity_type' => ConfigService::$tableContent,
                'entity_id' => $contentId,
                'language_id' => $this->languageId
            ]
        );
    }

    public function test_push_position_stack()
    {
        $slug = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());
        $slug3 = implode('-', $this->faker->words());
        $status = $this->faker->word;
        $status2 = $this->faker->word;
        $status3 = $this->faker->word;
        $type = $this->faker->word;
        $type2 = $this->faker->word;
        $type3 = $this->faker->word;

        $contentId = $this->classBeingTested->create($slug, $status, $type, 1, null, Carbon::now()->subDays(990)->toDateTimeString());
        $content2Id = $this->classBeingTested->create($slug2, $status2, $type2, 1, null, Carbon::now()->subDays(10)->toDateTimeString());
        $content3Id = $this->classBeingTested->create($slug3, $status3, $type3, 1, null, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId,
                'position' => 3,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $content2Id,
                'position' => 2,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $content3Id,
                'position' => 1,
            ]
        );
    }

    public function test_push_position_stack_abnormal()
    {
        $slug = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());
        $status = $this->faker->word;
        $status2 = $this->faker->word;
        $type = $this->faker->word;
        $type2 = $this->faker->word;

        $contentId = $this->classBeingTested->create($slug, $status, $type, 1, null, null);
        $content2Id = $this->classBeingTested->create($slug2, $status2, $type2, -581, null, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId,
                'status' => $status,
                'type' => $type,
                'position' => 2,
                'parent_id' => null,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $content2Id,
                'status' => $status2,
                'type' => $type2,
                'position' => 1,
                'parent_id' => null,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );
    }

    public function test_create_full_content_tree()
    {
        /*
         * --- $slug1 null - 1
         * ------ $slug2 1 - 1
         * --------- $slug3 2 - 1
         * --------- $slug4 2 - 2
         * --------- $slug5 2 - 3
         * --------- $slug6 2 - 4
         * ------------ $slug7 6 - 1
         * ------ $slug8 1 - 2
         * --- $slug9 null - 2
         */

        $slug1 = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());
        $slug3 = implode('-', $this->faker->words());
        $slug4 = implode('-', $this->faker->words());
        $slug5 = implode('-', $this->faker->words());
        $slug6 = implode('-', $this->faker->words());
        $slug7 = implode('-', $this->faker->words());
        $slug8 = implode('-', $this->faker->words());
        $slug9 = implode('-', $this->faker->words());
        $status = $this->faker->word;
        $type = $this->faker->text(64);

        $contentId1 = $this->classBeingTested->create($slug1, $status, $type, 1, null, null);
        $contentId2 = $this->classBeingTested->create($slug2, $status, $type, 1, $contentId1, null);
        $contentId3 = $this->classBeingTested->create($slug3, $status, $type, 1, $contentId2, null);
        $contentId4 = $this->classBeingTested->create($slug4, $status, $type, 2, $contentId2, null);
        $contentId5 = $this->classBeingTested->create($slug5, $status, $type, 3, $contentId2, null);
        $contentId6 = $this->classBeingTested->create($slug6, $status, $type, 4, $contentId2, null);
        $contentId7 = $this->classBeingTested->create($slug7, $status, $type, 1, $contentId6, null);
        $contentId8 = $this->classBeingTested->create($slug8, $status, $type, 2, $contentId1, null);
        $contentId9 = $this->classBeingTested->create($slug9, $status, $type, 2, null, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId1,
                'status' => $status,
                'type' => $type,
                'position' => 1,
                'parent_id' => null,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId2,
                'status' => $status,
                'type' => $type,
                'position' => 1,
                'parent_id' => $contentId1,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId3,
                //'slug' => $slug3,
                'status' => $status,
                'type' => $type,
                'position' => 1,
                'parent_id' => $contentId2,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId4,
               // 'slug' => $slug4,
                'status' => $status,
                'type' => $type,
                'position' => 2,
                'parent_id' => $contentId2,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId5,
               // 'slug' => $slug5,
                'status' => $status,
                'type' => $type,
                'position' => 3,
                'parent_id' => $contentId2,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId6,
              //  'slug' => $slug6,
                'status' => $status,
                'type' => $type,
                'position' => 4,
                'parent_id' => $contentId2,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId7,
               // 'slug' => $slug7,
                'status' => $status,
                'type' => $type,
                'position' => 1,
                'parent_id' => $contentId6,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId8,
              //  'slug' => $slug8,
                'status' => $status,
                'type' => $type,
                'position' => 2,
                'parent_id' => $contentId1,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId9,
               // 'slug' => $slug9,
                'status' => $status,
                'type' => $type,
                'position' => 2,
                'parent_id' => null,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );
    }

    public function test_update_content_slug()
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

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $new_slug = $this->faker->word;

        $this->classBeingTested->update($contentId, $new_slug, $content['status'], $content['type'], $content['position'], $content['parent_id'], null, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId,
                'status' => $content['status'],
                'type' => $content['type'],
                'position' => 1,
                'parent_id' => null,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'value' => $new_slug,
                'entity_type' => ConfigService::$tableContent,
                'entity_id' => $contentId,
                'language_id' => $this->languageId
            ]
        );
    }

    public function test_update_content_position()
    {
        $content1 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];


        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);

        $content2 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 1,
            'parent_id' => $contentId1,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId11 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content2);

        $content3 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => $contentId1,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $content3Slug = $this->faker->word;
        $contentId12 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content3);

        $contentId12 = $this->classBeingTested->update($contentId12, $content3Slug, $content3['status'], $content3['type'], 1, $content3['parent_id'], null, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId12,
                'position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId11,
                'position' => 2
            ]
        );
    }

    public function test_update_content_and_reposition()
    {
        $content1 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);
        $content1Slug = $this->faker->word;

        $content2 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId2 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content2);

        $content3 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 3,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId3 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content3);

        $contentId1 = $this->classBeingTested->update($contentId1, $content1Slug, $content1['status'], $content1['type'], 2, $content1['parent_id'], null, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId2,
                'position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId1,
                'position' => 2
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId3,
                'position' => 3
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'id' => 1,
                'value' => $content1Slug,
                'entity_type' => ConfigService::$tableContent,
                'entity_id' => $contentId1,
                'language_id' => $this->languageId
            ]
        );
    }

    public function test_update_content_and_children_reposition()
    {
        $content1 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);
        $content1Slug = $this->faker->word;

        $content2 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId2 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content2);

        $content3 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 3,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId3 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content3);

        $contentId1 = $this->classBeingTested->update($contentId1,$content1Slug, $content1['status'], $content1['type'], 3, $content1['parent_id'], null, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId2,
                'position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId3,
                'position' => 2
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId1,
                'position' => 3
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'id' => 1,
                'value' => $content1Slug,
                'entity_type' => ConfigService::$tableContent,
                'entity_id' => $contentId1,
                'language_id' => $this->languageId
            ]
        );
    }

    public function test_delete_content()
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
        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $contentSlug = $this->faker->word;

        $translation = [
            'entity_type' => ConfigService::$tableContent,
            'entity_id' => $contentId,
            'value' => $contentSlug,
            'language_id' => $this->languageId
        ];

        $translationId = $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translation);

        $content['id'] = $contentId;

        $this->classBeingTested->delete($content, 1);

        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id' => $contentId,
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableTranslations,
            [
                'id' => $translationId,
                'value' => $contentSlug,
                'entity_type' => ConfigService::$tableContent,
                'entity_id' => $contentId,
                'language_id' => $this->languageId
            ]
        );
    }

    public function test_delete_content_move_children()
    {
        $content1 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 1,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content1);
        $content1['id'] = $contentId1;

        $content11 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 1,
            'parent_id' => $contentId1,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId11 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content11);

        $content12 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => $contentId1,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId12 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content12);

        $content2 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $contentId2 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content2);

        $this->classBeingTested->delete($content1, 1);

        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id' => $contentId1,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId11,
                'parent_id' => null,
                'position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId12,
                'parent_id' => null,
                'position' => 2
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $contentId2,
                'parent_id' => null,
                'position' => 3
            ]
        );
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

    public function test_get_content_datum_non_exist()
    {
        $contentDatum = $this->classBeingTested->getLinkedDatum(1, 1);
        $this->assertEquals(null, $contentDatum);
    }

    public function test_get_content_datum()
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
        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $datum = [
            'key' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $datumValue = $this->faker->text();
        $datumId = $this->query()->table(ConfigService::$tableData)->insertGetId($datum);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $datumId, ConfigService::$tableData, $datumValue);

        $datumLinkId = $this->query()->table(ConfigService::$tableContentData)->insertGetId([
            'content_id' => $contentId,
            'datum_id' => $datumId
        ]);

        $contentDatum = $this->classBeingTested->getLinkedDatum($datumId, $contentId);

        $expectedResults = [
            'id' => $datumLinkId,
            'content_id' => $contentId,
            'datum_id' => $datumId,
            'key' => $datum['key'],
            'value' => $datumValue,
            'position' => $datum['position']
        ];

        $this->assertEquals($expectedResults, $contentDatum);
    }

    public function test_unlink_content_specific_datum()
    {
        $contentDatum = [
            'content_id' => $this->faker->numberBetween(),
            'datum_id' => $this->faker->numberBetween()
        ];
        $contentDatumId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentDatum);

        $this->classBeingTested->unlinkDatum($contentDatum['content_id'], $contentDatum['datum_id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
            [
                'id' => $contentDatumId,
                'content_id' => $contentDatum['content_id'],
                'datum_id' => $contentDatum['datum_id']
            ]
        );
    }

    public function test_unlink_content_all_datum()
    {
        $contentDatum = [
            'content_id' => $this->faker->numberBetween(),
            'datum_id' => $this->faker->numberBetween()
        ];
        $contentDatumId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentDatum);

        $contentDatum2 = [
            'content_id' => $contentDatum['content_id'],
            'datum_id' => $this->faker->numberBetween()
        ];
        $contentDatumId2 = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentDatum2);

        $this->classBeingTested->unlinkDatum($contentDatum['content_id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
            [
                'content_id' => $contentDatum['content_id']
            ]
        );
    }

    public function test_link_field()
    {
        $contentId = $this->faker->numberBetween();
        $fieldId = $this->faker->numberBetween();

        $fieldLinkId = $this->classBeingTested->linkField($contentId, $fieldId);

        $this->assertEquals(1, $fieldLinkId);

        $this->assertDatabaseHas(
            ConfigService::$tableContentFields,
            [
                'id' => $fieldLinkId,
                'content_id' => $contentId,
                'field_id' => $fieldId
            ]
        );
    }

    public function test_get_content_field_non_exist()
    {
        $contentField = $this->classBeingTested->getLinkedField(1, 1);
        $this->assertEquals(null, $contentField);
    }

    public function test_get_content_field()
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
        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];
        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $fieldId, ConfigService::$tableFields, $field['value']);

        $fieldLinkId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId([
            'content_id' => $contentId,
            'field_id' => $fieldId
        ]);

        $contentField = $this->classBeingTested->getLinkedField($fieldId, $contentId);

        $expectedResults = [
            'id' => $fieldLinkId,
            'content_id' => $contentId,
            'field_id' => $fieldId,
            'key' => $field['key'],
            'value' => $field['value'],
            'type' => $field['type'],
            'position' => $field['position'],
        ];

        $this->assertEquals($expectedResults, $contentField);
    }

    public function test_unlink_content_specific_field()
    {
        $contentField = [
            'content_id' => $this->faker->numberBetween(),
            'field_id' => $this->faker->numberBetween()
        ];
        $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        $contentField2 = [
            'content_id' => $contentField['content_id'],
            'field_id' => $this->faker->numberBetween()
        ];
        $contentFieldId2 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField2);

        $this->classBeingTested->unlinkField($contentField['content_id'], $contentField['field_id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentFields,
            [
                'id' => $contentFieldId,
                'content_id' => $contentField['content_id'],
                'field_id' => $contentField['field_id']
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentFields,
            [
                'id' => $contentFieldId2,
                'content_id' => $contentField['content_id'],
                'field_id' => $contentField2['field_id']
            ]
        );
    }

    public function test_unlink_content_all_fields()
    {
        $contentField1 = [
            'content_id' => $this->faker->numberBetween(),
            'field_id' => $this->faker->numberBetween()
        ];
        $contentFieldId1 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField1);

        $contentField2 = [
            'content_id' => $contentField1['content_id'],
            'field_id' => $this->faker->numberBetween()
        ];
        $contentFieldId2 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField2);

        $this->classBeingTested->unlinkField($contentField1['content_id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentFields,
            [
                'content_id' => $contentField1['content_id']
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