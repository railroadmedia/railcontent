<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\FieldRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class FieldRepositoryTest extends RailcontentTestCase
{
    /**
     * @var FieldRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(FieldRepository::class);
    }

    public function test_insert_field()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();

        $field = $this->classBeingTested->updateOrCreateField(1, $key, $value, $type, $position);

        $this->assertEquals(1, $field);

        $this->assertDatabaseHas(
            ConfigService::$tableFields,
            [
                'id' => $field,
                'key' => $key,
                'value' => $value,
                'type' => $type,
                'position' => $position
            ]
        );
    }

    public function test_update_field()
    {
        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $new_value = $this->faker->text(255);

        $result =
            $this->classBeingTested->updateOrCreateField(
                $fieldId,
                $field['key'],
                $new_value,
                $field['type'],
                $field['position']
            );

        $this->assertEquals($fieldId, $result);

        $this->assertDatabaseMissing(
            ConfigService::$tableFields,
            [
                'id' => $fieldId,
                'key' => $field['key'],
                'value' => $field['value'],
                'type' => $field['type'],
                'position' => $field['position']
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableFields,
            [
                'id' => $fieldId,
                'key' => $field['key'],
                'value' => $new_value,
                'type' => $field['type'],
                'position' => $field['position']
            ]
        );
    }

    public function test_delete_field()
    {
        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $this->classBeingTested->deleteField($fieldId);

        $this->assertDatabaseMissing(
            ConfigService::$tableFields,
            [
                'id' => $fieldId,
                'key' => $field['key'],
                'value' => $field['value'],
                'type' => $field['type'],
                'position' => $field['position']
            ]
        );
    }
}
