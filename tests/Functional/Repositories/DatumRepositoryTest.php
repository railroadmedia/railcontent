<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\DatumRepository;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class DatumRepositoryTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(DatumRepository::class);
    }

    public function test_insert_data()
    {
        $key = implode('-', $this->faker->words());
        $value = $this->faker->text();
        $data = $this->classBeingTested->updateOrCreateDatum(1,$key,$value);

        $this->assertEquals(1, $data);

        $this->assertDatabaseHas(
            ConfigService::$tableData,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()

            ]
        );
    }

    public function test_update_data()
    {
        $key = implode('-', $this->faker->words());
        $value = $this->faker->text();
        $data = $this->classBeingTested->updateOrCreateDatum(1,$key,$value);

        $this->assertEquals(1, $data);

        $this->assertDatabaseHas(
            ConfigService::$tableData,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value

            ]
        );

        $new_value = $this->faker->text();
        $data = $this->classBeingTested->updateOrCreateDatum(1,$key,$new_value);

        $this->assertEquals(1, $data);

        $this->assertDatabaseMissing(
            ConfigService::$tableData,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableData,
            [
                'id' => 1,
                'key' => $key,
                'value' => $new_value,
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        );
    }

    public function test_delete_data()
    {
        $id = 1;
        $key = implode('-', $this->faker->words());
        $value =  $this->faker->text();

        $this->classBeingTested->updateOrCreateDatum($id, $key, $value);

        $this->assertDatabaseHas(
            ConfigService::$tableData,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value
            ]
        );

        $this->classBeingTested->deleteDatum($id);

        $this->assertDatabaseMissing(
            ConfigService::$tableData,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value
            ]
        );
    }

}
