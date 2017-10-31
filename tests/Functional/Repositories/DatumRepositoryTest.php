<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class DatumRepositoryTest extends RailcontentTestCase
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

    public function test_insert_data()
    {
        $key = $this->faker->word;
        $value = $this->faker->text();
        $position = $this->faker->numberBetween();

        $result = $this->classBeingTested->updateOrCreateDatum(1, $key, $value, $position);

        $this->assertEquals(1, $result);

        $this->assertDatabaseHas(
            ConfigService::$tableData,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value,
                'position' => $position
            ]
        );
    }

    public function test_update_data()
    {
        $data = [
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $result =
            $this->classBeingTested->updateOrCreateDatum(
                $dataId,
                $data['key'],
                $data['value'],
                $data['position']
            );

        $this->assertEquals(1, $result);
        $this->assertDatabaseHas(
            ConfigService::$tableData,
            [
                'id' => 1,
                'key' => $data['key'],
                'value' => $data['value'],
                'position' => $data['position']
            ]
        );

    }

    public function test_delete_data()
    {
        $data = [
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $this->classBeingTested->deleteDatum($dataId);

        $this->assertDatabaseMissing(
            ConfigService::$tableData,
            [
                'id' => $dataId,
                'key' => $data['key'],
                'value' => $data['value'],
                'position' => $data['position']
            ]
        );
    }
}
