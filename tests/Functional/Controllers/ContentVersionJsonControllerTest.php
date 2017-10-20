<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentVersionJsonControllerTest extends RailcontentTestCase
{
    public function test_version_old_content_on_update()
    {
        Event::fake();

        $content = [
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $content = $this->contentFactory->create();

        $new_slug = $this->faker->word;
        $contentId = $content['id'];
        $response = $this->call('PUT', 'railcontent/content/'.$contentId, [
            'slug' => $new_slug,
            'status' =>$content['status'],
            'position' => $content['position'],
            'type' => $content['type']
        ]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }

    public function test_version_old_content_before_delete_content()
    {
        Event::fake();

        $content = $this->contentFactory->create();
        $contentId = $content['id'];

        $response = $this->call('DELETE', 'railcontent/content/'.$contentId);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }

    public function restore_content_with_datum()
    {
        $content = $this->contentFactory->create();
        $contentId = $content['id'];

        $datum = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(500)
        ];

        $req1 = $this->call('POST', 'railcontent/content/datum', [
            'content_id' => $contentId,
            'key' => $datum['key'],
            'value' => $datum['value'],
            'position' => 1
        ]);


        // $content = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();

        $content['datum'] = [$datum['key'] => $datum['value']];

        $req2 = $this->call('DELETE', 'railcontent/content/datum/1', [
            'content_id' => $contentId
        ]);

        //restore content to version 2, where the datum it's linked to the content
        $response = $this->call('GET', 'railcontent/content/restore/2');

        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'datum'
            ]
        );

        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $content['slug'],
                'position' => $content['position'],
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => $content['created_on'],
                'archived_on' => $content['archived_on'],
                'datum' => $content['datum']
            ]
        );
    }

    public function test_restore_content_with_fields()
    {
        $content = $this->contentFactory->create();
        $contentId = $content['id'];

        $this->call('POST', 'railcontent/content/field', [
            'content_id' => $contentId,
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'type' => 'string',
            'position' => 1
        ]);

        // content that is linked via a field
        $linkedContent = $this->contentFactory->create();
        $linkedContentId = $linkedContent['id'];

        $fieldKey = $this->faker->word;

        $a = $this->call('POST', 'railcontent/content/field', [
            'content_id' => $contentId,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);

        //get content that will be restored
        // $content = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();
        $content['fields'] = [$fieldKey => $linkedContent];

        $del = $this->call('DELETE', 'railcontent/content/field/1', [
            'content_id' => $contentId
        ]);

        //restore content to version 3, where the field with type content_id it's linked to the content
        $response = $this->call('GET', 'railcontent/content/restore/3');

        //check response structure
        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                // 'fields'
            ]
        );

        //check response values
        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $content['slug'],
                'position' => $content['position'],
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => $content['created_on'],
                'archived_on' => $content['archived_on'],
                // 'fields' => $content['fields'],
                'brand' => ConfigService::$brand
            ]
        );
    }

    public function test_restore_and_recreate_missing_field()
    {
        $content = [
            //'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        // content that is linked via a field
        $linkedContent = [
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $linkedContentId = $this->createContent($linkedContent);

        $linkedContentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedContentId, ConfigService::$tableContent, $linkedContentSlug);

        $linkedContent['id'] = $linkedContentId;

        $fieldKey = $this->faker->word;

        $this->call('POST', 'railcontent/content/field', [
            'content_id' => $contentId,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);

        $content = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();
        $content['fields'] = [$fieldKey => $linkedContent];

        $this->call('DELETE', 'railcontent/content/field/1', [
            'content_id' => $contentId
        ]);

        $this->call('DELETE', 'railcontent/content/field/'.$linkedContentId, [
            'content_id' => $contentId
        ]);

        $this->call('DELETE', 'railcontent/content/'.$linkedContentId);

        //restore content to version 3, where the field with type content_id it's linked to the content
        $response = $this->call('GET', 'railcontent/content/restore/2');

        //a new linked content should be created => the content id is incremented
        $content['fields'][$fieldKey]['id']++;

        //check response structure
        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'fields'
            ]
        );

        //check response values
        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $contentSlug,
                'position' => $content['position'],
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => $content['created_on'],
                'archived_on' => $content['archived_on'],
                'fields' => $content['fields']
            ]
        );
    }

    public function test_restore_multiple_fields()
    {
        $content = [
            // 'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

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

        $content = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();
        $content['fields'] = [$multipleKeyFieldKey => [0 => $multipleKeyFieldValues[0], 2 => $multipleKeyFieldValues[2], 1 => $multipleKeyFieldValues[1]]];
        $response = $this->call('DELETE', 'railcontent/content/field/'.$multipleField1, [
            'content_id' => $contentId
        ]);

        //restore content to version 1, where all the fields are linked to the content
        $response = $this->call('GET', 'railcontent/content/restore/1');

        //check response structure
        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'fields'
            ]
        );

        //check response values
        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $contentSlug,
                'position' => $content['position'],
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => $content['created_on'],
                'archived_on' => $content['archived_on'],
                'fields' => $content['fields']
            ]
        );
    }

    public function test_restore_with_fields_and_datum()
    {
        $content = [
            //'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        //link a field with 'string' type
        $this->call('POST', 'railcontent/content/field', [
            'content_id' => $contentId,
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'type' => 'string',
            'position' => 1
        ]);

        // content linked
        $linkedContent = [
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $linkedContentId = $this->createContent($linkedContent);

        $linkedContentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedContentId, ConfigService::$tableContent, $linkedContentSlug);

        $fieldKey = $this->faker->word;

        $this->call('POST', 'railcontent/content/field', [
            'content_id' => $contentId,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);

        //link first datum to content
        $this->call('POST', 'content/datum', [
            'content_id' => $contentId,
            'key' => $this->faker->word,
            'value' => $this->faker->text(500),
            'position' => 1
        ]);

        $datum = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(500)
        ];

        //link second datum to content
        $this->call('POST', 'content/datum', [
            'content_id' => $contentId,
            'key' => $datum['key'],
            'value' => $datum['value'],
            'position' => 2
        ]);

        $versionContent = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();
        $versionContent['fields'] = [$fieldKey => $linkedContent];
        $versionContent['datum'] = [$datum['key'] => $datum['value']];
        $versionContent['slug'] = $contentSlug;

        //delete first linked field
        $this->call('DELETE', 'content/field/1', [
            'content_id' => $contentId
        ]);

        //delete second linked field
        $this->call('DELETE', 'content/field/2', [
            'content_id' => $contentId
        ]);

        //delete first linked datum
        $this->call('DELETE', 'content/datum/1', [
            'content_id' => $contentId
        ]);

        //delete second linked datum
        $this->call('DELETE', 'content/datum/2', [
            'content_id' => $contentId
        ]);

        //restore content to version 5, where all the fields and datum are linked to the content
        $response = $this->call('GET', 'content/restore/5');

        //check response structure
        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'fields',
                'datum'
            ]
        );

        //check response values
        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $versionContent['slug'],
                'position' => $versionContent['position'],
                'status' => $versionContent['status'],
                'type' => $versionContent['type'],
                'parent_id' => $versionContent['parent_id'],
                'created_on' => $versionContent['created_on'],
                'archived_on' => $versionContent['archived_on'],
                'fields' => $versionContent['fields'],
                'datum' => $versionContent['datum']
            ]
        );
    }

    public function test_restore_content_version_not_exist()
    {
        //restore content to a missing version
        $response = $this->call('GET', 'content/restore/1');

        $this->assertEquals('"Restore content failed, version not found with id: 1"', $response->content());

        $this->assertEquals(404, $response->status());
    }

}
