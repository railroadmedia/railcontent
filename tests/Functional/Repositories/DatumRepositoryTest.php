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

        $userId = $this->createAndLogInNewUser();
        $this->setUserLanguage($userId);
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
                'position' => $position
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'id' => 1,
                'entity_id' => 1,
                'value' => $value,
                'language_id' => $this->classBeingTested->getUserLanguage(),
                'entity_type' => ConfigService::$tableData
            ]
        );
    }

    public function test_update_data()
    {
        $data = [
            'key' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $translation = [
            'language_id' => $this->classBeingTested->getUserLanguage(),
            'entity_type' => ConfigService::$tableData,
            'entity_id' => $dataId,
            'value' => $this->faker->word
        ];
        $translationId = $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translation);

        $new_value = $this->faker->text();

        $result = $this->classBeingTested->updateOrCreateDatum($dataId, $data['key'], $new_value, $data['position']);

        $this->assertEquals(1, $result);

        //assert that old value not exist in the database
        $this->assertDatabaseMissing(
            ConfigService::$tableTranslations,
            [
                'id' => $translationId,
                'entity_type' => ConfigService::$tableData,
                'entity_id' => $dataId,
                'value' => $translation['value'],
                'language_id' => $translation['language_id']
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'id' => ($translationId + 1),
                'entity_type' => ConfigService::$tableData,
                'entity_id' => $dataId,
                'value' => $new_value,
                'language_id' => $translation['language_id']
            ]
        );
    }

    public function test_delete_data()
    {
        $data = [
            'key' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $translation = [
            'language_id' => $this->classBeingTested->getUserLanguage(),
            'entity_type' => ConfigService::$tableData,
            'entity_id' => $dataId,
            'value' => $this->faker->word
        ];
        $translationId = $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translation);

        $this->classBeingTested->deleteDatum($dataId);

        $this->assertDatabaseMissing(
            ConfigService::$tableData,
            [
                'id' => $dataId,
                'key' => $data['key'],
                'position' => $data['position']
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableTranslations,
            [
                'id' => $translationId,
                'entity_type' => ConfigService::$tableData,
                'entity_id' => $dataId,
                'value' => $translation['value'],
                'language_id' => $translation['language_id']
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
