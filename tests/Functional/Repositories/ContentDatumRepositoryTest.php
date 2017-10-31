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

    public function test_get()
    {
        $contentId = rand();
        $key = $this->faker->word;
        $value = $this->faker->text();
        $position = rand();

        $result = $this->classBeingTested->get(
            $this->classBeingTested->create(
                $contentId,
                $key,
                $value,
                $position
            )
        );

        $this->assertEquals(
            [
                'id' => 1,
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position
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

            $data['id'] = $this->classBeingTested->create(
                $data['content_id'],
                $data['key'],
                $data['value'],
                $data['position']
            );

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

            $this->classBeingTested->create(
                $data['content_id'],
                $data['key'],
                $data['value'],
                $data['position']
            );
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

            $data['id'] = $this->classBeingTested->create(
                $data['content_id'],
                $data['key'],
                $data['value'],
                $data['position']
            );

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

            $this->classBeingTested->create(
                $data['content_id'],
                $data['key'],
                $data['value'],
                $data['position']
            );
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

        $result = $this->classBeingTested->create(1, $key, $value, $position);

        $this->assertEquals(1, $result);
        $this->assertDatabaseHas(
            ConfigService::$tableContentData,
            [
                'id' => 1,
                'content_id' => 1,
                'key' => $key,
                'value' => $value,
                'position' => $position
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

        $dataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($oldData);

        $result =
            $this->classBeingTested->update(
                $dataId,
                $newData
            );

        $this->assertEquals(1, $result);
        $this->assertDatabaseHas(
            ConfigService::$tableContentData,
            [
                'id' => 1,
                'content_id' => $newData['content_id'],
                'key' => $newData['key'],
                'value' => $newData['value'],
                'position' => $newData['position']
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

        $dataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($data);

        $this->classBeingTested->delete($dataId);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
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
                'position' => rand()
            ];

            $data['id'] = $this->classBeingTested->create(
                $data['content_id'],
                $data['key'],
                $data['value'],
                $data['position']
            );

            $expectedData[] = $data;
        }

        $this->classBeingTested->deleteContentData($contentId);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
            [
                'content_id' => $contentId,
            ]
        );
    }
}
