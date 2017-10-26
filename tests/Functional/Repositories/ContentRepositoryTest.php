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
        $status = $this->faker->word;
        $language = 'en-US';

        $contentId =
            $this->classBeingTested->create(
                $slug,
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
                'status' => $status,
                'published_on' => null,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );
    }

    public function test_get_many_by_parent_slug()
    {

        $parentSlug = $this->faker->word;

        $parentContentId =
            $this->classBeingTested->create(
                $parentSlug,
                $this->faker->word,
                ConfigService::$brand,
                'en-US',
                null
            );

        // to see if having another link will mess it up
        $randomParentContentId =
            $this->classBeingTested->create(
                $this->faker->word,
                $this->faker->word,
                ConfigService::$brand,
                'en-US',
                null
            );

        for ($i = 0; $i < 6; $i++) {
            $contentId = $this->classBeingTested->create(
                $this->faker->word,
                $this->faker->word,
                ConfigService::$brand,
                'en-US',
                null
            );

            $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
                $parentContentId,
                $contentId
            );

            $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
                $randomParentContentId,
                $contentId
            );
        }

        $content = $this->classBeingTested->getManyByParentSlug($parentSlug);

        $this->assertEquals(6, count($content));
    }

    public function test_update()
    {
        $oldContent = [
            'slug' => $this->faker->word,
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

    public function test_unlink_content_all_data()
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
        $contentDatumId2 =
            $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentDatum2);

        $this->classBeingTested->unlinkData($contentDatum['content_id']);

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

    public function test_unlink_content_specific_field()
    {
        $contentField = [
            'content_id' => $this->faker->numberBetween(),
            'field_id' => $this->faker->numberBetween()
        ];
        $contentFieldId =
            $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        $contentField2 = [
            'content_id' => $contentField['content_id'],
            'field_id' => $this->faker->numberBetween()
        ];
        $contentFieldId2 =
            $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField2);

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
        $contentFieldId1 =
            $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField1);

        $contentField2 = [
            'content_id' => $contentField1['content_id'],
            'field_id' => $this->faker->numberBetween()
        ];
        $contentFieldId2 =
            $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField2);

        $this->classBeingTested->unlinkFields($contentField1['content_id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentFields,
            [
                'content_id' => $contentField1['content_id']
            ]
        );
    }

    public function test_get_content_with_fields_and_datum_by_id()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => ContentService::STATUS_PUBLISHED,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'created_on' => Carbon::now()->toDateTimeString(),
        ];
        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $fieldLinkId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $fieldId
            ]
        );

        $linkedContent = [
            'slug' => $this->faker->word,
            'status' => ContentService::STATUS_PUBLISHED,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $linkedContentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($linkedContent);

        $linkedContentField = [
            'key' => $this->faker->word,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => null,
        ];

        $linkedContentFieldId =
            $this->query()->table(ConfigService::$tableFields)->insertGetId($linkedContentField);

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $linkedContentFieldId,
            ]
        );

        $expectedResults = array_merge(
            $content,
            [
                'id' => $contentId,
                'published_on' => null,
                'fields' => [
                    array_merge($field, ['id' => $fieldId]),
                    array_merge($linkedContentField, ['id' => $linkedContentFieldId])
                ]
            ]
        );
        $results = $this->classBeingTested->getById($contentId);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_by_id_not_exist()
    {
        $results = $this->classBeingTested->getById($this->faker->numberBetween());

        $this->assertNull($results);
    }

    public function test_get_content_with_fields_and_datum_by_slug()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => ContentService::STATUS_PUBLISHED,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'created_on' => Carbon::now()->toDateTimeString(),
        ];
        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $fieldLinkId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $fieldId
            ]
        );

        $linkedContent = [
            'slug' => $this->faker->word,
            'status' => ContentService::STATUS_PUBLISHED,
            'brand' => ConfigService::$brand,
            'language' => 'en-US',
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];
        $linkedContentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($linkedContent);

        $linkedContentField = [
            'key' => $this->faker->word,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => null,
        ];

        $linkedContentFieldId =
            $this->query()->table(ConfigService::$tableFields)->insertGetId($linkedContentField);

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $linkedContentFieldId,
            ]
        );

        $expectedResults = array_merge(
            $content,
            [
                'id' => $contentId,
                'fields' => [
                    array_merge($field, ['id' => $fieldId]),
                    array_merge($linkedContentField, ['id' => $linkedContentFieldId])
                ]
            ]
        );
        $results = $this->classBeingTested->getBySlugHierarchy($content['slug']);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_by_slug_not_exist()
    {
        $results = $this->classBeingTested->getBySlugHierarchy($this->faker->word);

        $this->assertNull($results);
    }
}