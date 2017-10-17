<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\FieldRepository;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class FieldRepositoryTest extends RailcontentTestCase
{
    protected $classBeingTested, $languageId;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(FieldRepository::class);
        $userId = $this->createAndLogInNewUser();
        $this->languageId = $this->setUserLanguage($userId);
    }

    public function test_insert_field()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();

        $field = $this->classBeingTested->updateOrCreateField(1, $key, $value,  $type, $position);

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

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'entity_type' => ConfigService::$tableFields,
                'entity_id' => $field,
                'value' => $value,
                'language_id' => $this->languageId
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

        $translationId = $this->translateItem($this->languageId, $fieldId, ConfigService::$tableFields, $field['value']);

        $new_value = $this->faker->text(255);

        $result = $this->classBeingTested->updateOrCreateField($fieldId, $field['key'], $new_value, $field['type'], $field['position']);

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
                'key' =>  $field['key'],
                'value' => $new_value,
                'type' => $field['type'],
                'position' => $field['position']
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableTranslations,
            [
                'id' => $translationId,
                'entity_type' => ConfigService::$tableFields,
                'entity_id' => $fieldId,
                'value' => $field['value'],
                'language_id' => $this->languageId
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'id' => ($translationId + 1),
                'entity_type' => ConfigService::$tableFields,
                'entity_id' => $fieldId,
                'value' => $new_value,
                'language_id' => $this->languageId
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

        $translationId = $this->translateItem($this->languageId, $fieldId, ConfigService::$tableFields, $field['value']);

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

        $this->assertDatabaseMissing(
            ConfigService::$tableTranslations,
            [
                'id' => $translationId,
                'entity_type' => ConfigService::$tableFields,
                'entity_id' => $fieldId,
                'value' => $field['value'],
                'language_id' => $this->languageId
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
