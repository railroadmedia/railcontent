<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\LanguageRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class LanguageRepositoryTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(LanguageRepository::class);
        $this->userId = $this->createAndLogInNewUser();
        $this->setUserLanguage($this->userId);
    }

    public function test_get_user_language()
    {
        $results = $this->classBeingTested->getUserLanguage();

        $this->assertEquals(1, $results);
    }

    public function test_set_user_language_failed()
    {
        $locale = 'fr';
        $results = $this->classBeingTested->setUserLanguage($locale);

        $this->assertFalse($results);
    }

    public function test_set_user_language()
    {
        $language = [
            'name' => 'Francais',
            'locale' => 'fr'
        ];

        $languageId = $this->query()->table(ConfigService::$tableLanguage)->insertGetId($language);

        $results = $this->classBeingTested->setUserLanguage($language['locale']);

        $this->assertTrue($results);

        $this->assertDatabaseHas(
            ConfigService::$tableUserLanguagePreference,
            [
                'id' => 1,
                'user_id' => $this->userId,
                'brand' => ConfigService::$brand,
                'language_id' => $languageId
            ]
        );
    }

    public function test_save_new_translation()
    {
        $translate = [
            'entity_type' => ConfigService::$tableContent,
            'entity_id' => 1,
            'value' => $this->faker->word
        ];

        $this->classBeingTested->saveTranslation($translate);

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'entity_type' => $translate['entity_type'],
                'entity_id' => $translate['entity_id'],
                'value' => $translate['value'],
                'language_id' => $this->classBeingTested->getUserLanguage()
            ]
        );
    }

    public function test_save_modified_translation()
    {
        $translate = [
            'entity_type' => ConfigService::$tableContent,
            'entity_id' => 1,
            'value' => $this->faker->word,
            'language_id' => $this->classBeingTested->getUserLanguage()
        ];

        $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translate);

        $translate['value'] = $this->faker->word;
        $this->classBeingTested->saveTranslation($translate);

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'entity_type' => $translate['entity_type'],
                'entity_id' => $translate['entity_id'],
                'value' => $translate['value'],
                'language_id' => $this->classBeingTested->getUserLanguage()
            ]
        );
    }

    public function test_delete_translation()
    {
        $translate = [
            'entity_type' => ConfigService::$tableContent,
            'entity_id' => 1,
            'value' => $this->faker->word,
            'language_id' => $this->classBeingTested->getUserLanguage()
        ];

        $this->query()->table(ConfigService::$tableTranslations)->insertGetId($translate);

        $results = $this->classBeingTested->deleteTranslations($translate);

        $this->assertEquals(1, $results);

        $this->assertDatabaseMissing(
            ConfigService::$tableTranslations,
            [
                'entity_type' => $translate['entity_type'],
                'entity_id' => $translate['entity_id'],
                'value' => $translate['value'],
                'language_id' => $this->classBeingTested->getUserLanguage()
            ]
        );
    }

    public function test_switch_language_not_supported()
    {
        $locale = 'fr';
        $response = $this->call('POST', '/switchLang', [
            'locale' => $locale

        ]);

        $this->assertEquals(404, $response->status());

        $this->assertEquals('"Language with locale '.$locale.' not supported."', $response->content());
    }

    public function test_switch_language()
    {
        $language = [
            'name' => 'Francais',
            'locale' => 'fr'
        ];

        $languageId = $this->query()->table(ConfigService::$tableLanguage)->insertGetId($language);

        $response = $this->call('POST', '/switchLang', [
            'locale' => $language['locale']

        ]);

        $this->assertEquals(201, $response->status());

        $this->assertEquals('"Set language with success."', $response->content());

        $this->assertDatabaseHas(
            ConfigService::$tableUserLanguagePreference, [
                'user_id' => $this->userId,
                'language_id' => $languageId,
                'brand' => ConfigService::$brand
            ]
        );
    }
}
