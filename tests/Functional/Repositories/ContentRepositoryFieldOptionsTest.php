<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryFieldOptionsTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
    }

    public function test_get_field_options_single()
    {
        $type = $this->faker->word;

        $fieldName = $this->faker->word;
        $fieldValue = $this->faker->word;
        $fieldType = $this->faker->word;

        // content that has all the required fields
        for ($i = 0; $i < 10; $i++) {
            $expectedContent = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );

            $field = $this->fieldFactory->create(
                $expectedContent['id'],
                $fieldName,
                $fieldValue,
                1,
                $fieldType
            );

            ConfigService::$fieldOptionList[] = $fieldName;
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type], [], [])
            ->getFilterFields();

        $this->assertEquals([$fieldName => [$fieldValue]], $rows);
    }

    public function test_get_field_options_multiple()
    {
        $type = $this->faker->word;

        $expectedFields = [];

        // content that has all the required fields
        for ($i = 0; $i < 10; $i++) {
            $fieldName = $this->faker->word . rand();
            $fieldValue = $this->faker->word . rand();
            $fieldType = $this->faker->word . rand();

            $expectedContent = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );

            $field = $this->fieldFactory->create(
                $expectedContent['id'],
                $fieldName,
                $fieldValue,
                1,
                $fieldType
            );

            ConfigService::$fieldOptionList[] = $fieldName;

            $expectedFields[$fieldName][] = $fieldValue;
        }

        // random fields that shouldn't be in the filter
        for ($i = 0; $i < 10; $i++) {
            $fieldName = $this->faker->word . rand();
            $fieldValue = $this->faker->word . rand();
            $fieldType = $this->faker->word . rand();

            $field = $this->fieldFactory->create(
                rand(1000, 100000),
                $fieldName,
                $fieldValue,
                1,
                $fieldType
            );

            ConfigService::$fieldOptionList[] = $fieldName;
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type], [], [])
            ->getFilterFields();

        $this->assertEquals($expectedFields, $rows);
    }
}