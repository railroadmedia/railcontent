<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentDatumRepositoryTest extends RailcontentTestCase
{
    /**
     * @var ContentDatumRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentDatumRepository::class);
    }

    public function test_get_by_id()
    {
        $contentId = rand();
        $key = $this->faker->word;
        $value = $this->faker->text();
        $position = rand();

        $result = $this->classBeingTested->getById(
            $this->classBeingTested->createOrUpdateAndReposition(null,
                [
                    'content_id' => $contentId,
                    'key' => $key,
                    'value' => $value,
                    'position' => $position
                ]
            )
        );

        $this->assertEquals(
            [
                'id' => 1,
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => 1
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
                'position' => rand()
            ];

            $data['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $data);
            $data['position'] = 1;
            $expectedData[] = $data;
        }

        // random data that shouldn't be returned
        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => rand(),
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => rand()
            ];

            $this->classBeingTested->createOrUpdateAndReposition(null, $data);
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
                'position' => rand()
            ];

            $data['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $data);
            $data['position'] = 1;
            $expectedData[] = $data;
        }

        // random data that shouldn't be returned
        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => rand(),
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => rand()
            ];

            $this->classBeingTested->createOrUpdateAndReposition(null, $data);
        }

        $response = $this->classBeingTested->getByContentIds([1, 2, 3]);

        $this->assertEquals(
            $expectedData,
            $response
        );
    }

    public function test_create()
    {
        $contentId = rand();
        $key = $this->faker->word;
        $value = $this->faker->text();
        $position = rand();

        $result = $this->classBeingTested->createOrUpdateAndReposition(null,
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position
            ]
        );

        $this->assertEquals(1, $result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentData,
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => 1
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
        ];

        $newData = [
            'content_id' => rand(),
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'position' => rand(),
        ];

        $id = $this->query()->table(ConfigService::$tableContentData)->insertGetId($oldData);

        $result = $this->classBeingTested->createOrUpdateAndReposition($id, $newData);

        $this->assertEquals(1, $result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentData,
            [
                'content_id' => $newData['content_id'],
                'key' => $newData['key'],
                'value' => $newData['value'],
                'position' => 1
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
        ];

        $id = $this->query()->table(ConfigService::$tableContentData)->insertGetId($data);

        $deleted = $this->classBeingTested->delete($id);

        $this->assertTrue($deleted);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
            [
                'id' => $id,
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
                'position' => rand()
            ];

            $data['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $data);

            $expectedData[] = $data;
        }

        $this->classBeingTested->deleteByContentId($contentId);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
            [
                'content_id' => $contentId,
            ]
        );
    }

    public function test_reposition_other_datum_after_creation()
    {
        $contentId = rand();
        $key = $this->faker->word;
        $expectedData = [];

        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $this->faker->word,
                'position' => rand()
            ];
            $data['position'] = $i + 1;
            $data['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $data);

            $expectedData[] = $data;
        }

        foreach ($expectedData as $expectedDatum) {
            $this->assertDatabaseHas(
                ConfigService::$tableContentData,
                $expectedDatum
            );
        }
    }

    public function test_reposition_other_datum_after_update()
    {
        $contentId = rand();
        $key = $this->faker->word;
        $value = $this->faker->word;
        $expectedData = [];

        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => rand()
            ];
            $data['position'] = $i + 1;
            $data['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $data);

            $expectedData[] = $data;
        }

        $newData = [
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'position' => 0
        ];
        $this->classBeingTested->createOrUpdateAndReposition(2, $newData);
        $expectedData[1]['position'] = 1;
        $expectedData[0]['position'] = 2;

        foreach ($expectedData as $expectedDatum) {
            $this->assertDatabaseHas(
                ConfigService::$tableContentData,
                $expectedDatum
            );
        }
    }
    public function test_reposition_other_datum_after_update_with_position_null()
    {
        $contentId = rand();
        $key = $this->faker->word;
        $value = $this->faker->word;
        $expectedData = [];

        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => rand()
            ];
            $data['position'] = $i + 1;
            $data['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $data);

            $expectedData[] = $data;
        }

        $newData = [
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'position' => 3
        ];
        $this->classBeingTested->createOrUpdateAndReposition(2, $newData);
        $expectedData[1]['position'] = 3;
        $expectedData[2]['position'] = 2;

        foreach ($expectedData as $expectedDatum) {
            $this->assertDatabaseHas(
                ConfigService::$tableContentData,
                $expectedDatum
            );
        }
    }

    public function test_reposition_other_datum_after_update_with_position_huge()
    {
        $contentId = rand();
        $key = $this->faker->word;
        $value = $this->faker->word;
        $expectedData = [];

        for ($i = 0; $i < 3; $i++) {
            $data = [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => rand()
            ];
            $data['position'] = $i + 1;
            $data['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $data);

            $expectedData[] = $data;
        }

        $newData = [
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'position' => $this->faker->numberBetween(500, 550)
        ];
        $this->classBeingTested->createOrUpdateAndReposition(2, $newData);
        $expectedData[1]['position'] = 3;
        $expectedData[2]['position'] = 2;

        foreach ($expectedData as $expectedDatum) {
            $this->assertDatabaseHas(
                ConfigService::$tableContentData,
                $expectedDatum
            );
        }
    }

    public function test_delete_data_and_reposition()
    {
        $contentId = rand();
        $expectedData = [];
        $key = $this->faker->word;
        for ($i = 0; $i < 5; $i++) {
            $data = [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $this->faker->word,
                'position' => rand()
            ];

            $data['id'] = $this->classBeingTested->createOrUpdateAndReposition(null, $data);
            $data['position'] = $i + 1;

            $expectedData[] = $data;
        }

        $this->classBeingTested->deleteAndReposition($expectedData[2]);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
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
                ConfigService::$tableContentData,
                $expectedDatum
            );
        }
    }
}
