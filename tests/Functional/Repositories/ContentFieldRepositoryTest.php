<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentFieldRepositoryTest extends RailcontentTestCase
{
    /**
     * @var ContentFieldRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentFieldRepository::class);
    }

    public function test_get()
    {
        $contentId = rand();
        $key = $this->faker->word;
        $value = $this->faker->text();
        $position = rand();
        $type = $this->faker->text();

        $result = $this->classBeingTested->getById(
            $this->classBeingTested->create(
                [
                    'content_id' => $contentId,
                    'key' => $key,
                    'value' => $value,
                    'position' => $position,
                    'type' => $type
                ]
            )
        );

        $this->assertEquals(
            [
                'id' => 1,
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position,
                'type' => $type
            ],
            $result
        );
    }

    public function test_get_by_content_id_empty()
    {
        $response = $this->classBeingTested->getByContentId(rand());

        $this->assertEquals(
            [],
            $response
        );
    }

    public function test_get_by_content_id()
    {
        $contentId = rand();
        $expectedData = [];

        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => $contentId,
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $i,
                'type' => $this->faker->word,
            ];

            $data['id'] = $this->classBeingTested->create($data);

            $expectedData[] = $data;
        }

        // random data that shouldn't be returned
        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => rand(),
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $i,
                'type' => $this->faker->word,
            ];

            $this->classBeingTested->create($data);
        }

        $response = $this->classBeingTested->getByContentId($contentId);

        $this->assertEquals(
            $expectedData,
            $response
        );
    }

    public function test_get_by_content_ids()
    {
        $expectedData = [];

        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => $i + 1,
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $i,
                'type' => $this->faker->word,
            ];

            $data['id'] = $this->classBeingTested->create($data);

            $expectedData[] = $data;
        }

        // random data that shouldn't be returned
        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => rand(),
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $i,
                'type' => $this->faker->word,
            ];

            $this->classBeingTested->create($data);
        }

        $response = $this->classBeingTested->getByContentIds([1, 2, 3]);

        $this->assertEquals(
            $expectedData,
            $response
        );
    }

    public function test_create()
    {
        $key = $this->faker->word;
        $value = $this->faker->text();
        $position = rand();
        $type = $this->faker->word;

        $result = $this->classBeingTested->create(
            [
                'content_id' => 1,
                'key' => $key,
                'value' => $value,
                'position' => $position,
                'type' => $type
            ]
        );

        $this->assertEquals(1, $result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentFields,
            [
                'content_id' => 1,
                'key' => $key,
                'value' => $value,
                'position' => $position,
                'type' => $type
            ]
        );
    }

    public function test_update()
    {
        $oldData = [
            'content_id' => rand(),
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'position' => rand(),
            'type' => $this->faker->word,
        ];

        $newData = [
            'content_id' => rand(),
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'position' => rand(),
            'type' => $this->faker->word,
        ];

        $dataId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($oldData);

        $result =
            $this->classBeingTested->update(
                $dataId,
                $newData
            );

        $this->assertEquals(1, $result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentFields,
            [
                'content_id' => $newData['content_id'],
                'key' => $newData['key'],
                'value' => $newData['value'],
                'position' => $newData['position'],
                'type' => $newData['type'],
            ]
        );

    }

    public function test_delete()
    {
        $data = [
            'content_id' => rand(),
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'position' => rand(),
            'type' => $this->faker->word,
        ];

        $dataId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($data);

        $this->classBeingTested->delete($dataId);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentFields,
            [
                'id' => $dataId,
            ]
        );
    }

    public function test_delete_content_data()
    {
        $contentId = rand();
        $expectedData = [];

        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => $contentId,
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => rand(),
                'type' => $this->faker->word,
            ];

            $data['id'] = $this->classBeingTested->create($data);

            $expectedData[] = $data;
        }

        $this->classBeingTested->deleteByContentId($contentId);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentFields,
            [
                'content_id' => $contentId,
            ]
        );
    }

    public function test_delete_field_and_reposition()
    {
        $contentId = rand();
        $expectedData = [];
        $key = $this->faker->word;
        for ($i = 0; $i < 5; $i++) {
            $field = [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $this->faker->word,
                'type' => $this->faker->word,
                'position' => rand()
            ];

            $field['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $field);
            $field['position'] = $i + 1;

            $expectedData[] = $field;
        }

        $this->classBeingTested->deleteAndReposition($expectedData[2]);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentFields,
            [
                'id' => 3,
            ]
        );

        //decrement position in expected results
        $expectedData[4]['position'] = $expectedData[3]['position'];
        $expectedData[3]['position'] = $expectedData[2]['position'];

        unset($expectedData[2]);

        foreach ($expectedData as $expectedDatum) {
            $this->assertDatabaseHas(
                ConfigService::$tableContentFields,
                $expectedDatum
            );
        }
    }
}
