<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\FieldFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryFieldFilteringTest extends RailcontentTestCase
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
     * @var FieldFactory
     */
    protected $fieldFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(FieldFactory::class);
    }

    public function test_empty()
    {
        $rows = $this->classBeingTested->getFiltered(1, 1, 'published_on', 'desc', [], [], []);

        $this->assertEmpty($rows);
    }

    public function test_pagination_and_order_by()
    {
        /*
         * Expected content ids before pagination:
         * [ 1, 2, 3... 10 ]
         *
         * Expected content ids after pagination:
         * [ 4, 5, 6 ]
         *
         */

        for ($i = 0; $i < 10; $i++) {
            $this->contentFactory->create([1 => ContentService::STATUS_PUBLISHED]);
        }

        $rows = $this->classBeingTested->getFiltered(2, 3, 'id', 'asc', [], [], []);

        $this->assertEquals([4, 5, 6], array_column($rows, 'id'));
    }

    public function test_include_types()
    {
        /*
         * Expected content ids:
         * [ 1, 2, 3, 4, 5 ]
         *
         */

        $typesToInclude = [
            $this->faker->word . rand(),
            $this->faker->word . rand(),
            $this->faker->word . rand()
        ];

        $typesToExclude = [
            $this->faker->word . rand(),
            $this->faker->word . rand(),
            $this->faker->word . rand()
        ];

        $expectedContents = [];

        for ($i = 0; $i < 5; $i++) {
            $expectedContents[] = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $this->faker->randomElement($typesToInclude),
                ]
            );
        }

        for ($i = 0; $i < 5; $i++) {
            $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $this->faker->randomElement($typesToExclude),
                ]
            );
        }

        $rows = $this->classBeingTested->getFiltered(1, 10, 'id', 'asc', $typesToInclude, [], []);

        $this->assertEquals(array_column($expectedContents, 'id'), array_column($rows, 'id'));
    }

    public function test_require_fields_with_pagination()
    {
        /*
         * Expected content ids before pagination:
         * [ 5, 6, 7... 14 ]
         *
         * Expected content ids after  pagination:
         * [ 8, 9, 10 ]
         *
         * Adding in some random fields to make that having extra unfiltered fields doesn't
         * throw off the query.
         *
         */

        $type = $this->faker->word;

        $requiredFieldName = $this->faker->word;
        $requiredFieldValue = $this->faker->word;
        $requiredFieldType = $this->faker->word;

        $otherRequiredFieldName = $this->faker->word;
        $otherRequiredFieldValue = $this->faker->word;
        $otherRequiredFieldType = $this->faker->word;

        // content that has none of the required fields
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        // content that only has 1 of the required fields
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $field = $this->fieldFactory->create(
                [
                    0 => $content['id'],
                    1 => $requiredFieldName,
                    2 => $requiredFieldValue,
                    3 => $requiredFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        // content that has all the required fields
        for ($i = 0; $i < 10; $i++) {
            $expectedContent = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $requiredField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $requiredFieldName,
                    2 => $requiredFieldValue,
                    3 => $requiredFieldType,
                    4 => 1
                ]
            );

            $otherRequiredField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $otherRequiredFieldName,
                    2 => $otherRequiredFieldValue,
                    3 => $otherRequiredFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id']
                ]
            );
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type])
            ->requireField(
                $requiredFieldName,
                $requiredFieldValue,
                $requiredFieldType
            )
            ->requireField(
                $otherRequiredFieldName,
                $otherRequiredFieldValue,
                $otherRequiredFieldType
            )
            ->get();

        $this->assertEquals([8, 9, 10], array_column($rows, 'id'));
    }

    public function test_include_single_field_with_pagination()
    {
        /*
         * If only 1 include field is passed in its basically treated the same as a required field.
         *
         * Expected content ids before pagination:
         * [ 3, 4, 5... 12 ]
         *
         * Expected content ids after  pagination:
         * [ 6, 7, 8 ]
         *
         * Adding in some random fields to make that having extra unfiltered fields doesn't
         * throw off the query.
         *
         */

        $type = $this->faker->word;

        $includedFieldName = $this->faker->word;
        $includedFieldValue = $this->faker->word;
        $includedFieldType = $this->faker->word;

        // content that has none of the included fields
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        // content that only has 1 of the included fields
        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $field = $this->fieldFactory->create(
                [
                    0 => $content['id'],
                    1 => $includedFieldName,
                    2 => $includedFieldValue,
                    3 => $includedFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type])
            ->includeField(
                $includedFieldName,
                $includedFieldValue,
                $includedFieldType
            )
            ->get();

        $this->assertEquals([6, 7, 8], array_column($rows, 'id'));
    }

    public function test_include_fields_with_pagination()
    {
        /*
         *
         *
         * Expected content ids before pagination:
         * [ 5, 6, 7... 15 ]
         *
         * Expected content ids after  pagination:
         * [ 8, 9, 10 ]
         *
         * Adding in some random fields to make that having extra unfiltered fields doesn't
         * throw off the query.
         *
         */

        $type = $this->faker->word;

        $includedFieldName = $this->faker->word;
        $includedFieldValue = $this->faker->word;
        $includedFieldType = $this->faker->word;

        $otherIncludedFieldName = $this->faker->word;
        $otherIncludedFieldValue = $this->faker->word;
        $otherIncludedFieldType = $this->faker->word;

        // content that has none of the included fields
        for ($i = 0; $i < 4; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        // content that only has 1 of the included fields
        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $field = $this->fieldFactory->create(
                [
                    0 => $content['id'],
                    1 => $includedFieldName,
                    2 => $includedFieldValue,
                    3 => $includedFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        // content that has all the included fields
        for ($i = 0; $i < 5; $i++) {
            $expectedContent = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $includedField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $includedFieldName,
                    2 => $includedFieldValue,
                    3 => $includedFieldType,
                    4 => 1
                ]
            );

            $otherIncludedField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $otherIncludedFieldName,
                    2 => $otherIncludedFieldValue,
                    3 => $otherIncludedFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id']
                ]
            );
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type])
            ->includeField(
                $includedFieldName,
                $includedFieldValue,
                $includedFieldType
            )
            ->includeField(
                $otherIncludedFieldName,
                $otherIncludedFieldValue,
                $otherIncludedFieldType
            )
            ->get();

        $this->assertEquals([8, 9, 10], array_column($rows, 'id'));
    }

    public function test_include_and_require_fields_with_pagination()
    {
        /*
         * Expected content ids before pagination:
         * [ 7, 8, 9... 17 ]
         *
         * Expected content ids after  pagination:
         * [ 10, 11, 12 ]
         *
         * Adding in some random fields to make that having extra unfiltered fields doesn't
         * throw off the query.
         *
         */

        $type = $this->faker->word;

        $includedFieldName = $this->faker->word;
        $includedFieldValue = $this->faker->word;
        $includedFieldType = $this->faker->word;

        $otherIncludedFieldName = $this->faker->word;
        $otherIncludedFieldValue = $this->faker->word;
        $otherIncludedFieldType = $this->faker->word;

        $requiredFieldName = $this->faker->word;
        $requiredFieldValue = $this->faker->word;
        $requiredFieldType = $this->faker->word;

        $otherRequiredFieldName = $this->faker->word;
        $otherRequiredFieldValue = $this->faker->word;
        $otherRequiredFieldType = $this->faker->word;

        // content that has none of the required or included fields
        // (should not be in results)

        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        // content that only has 1 of the required fields and 1 of the included fields
        // (should not be in results)

        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $field = $this->fieldFactory->create(
                [
                    0 => $content['id'],
                    1 => $requiredFieldName,
                    2 => $requiredFieldValue,
                    3 => $requiredFieldType,
                    4 => 1
                ]
            );

            $field = $this->fieldFactory->create(
                [
                    0 => $content['id'],
                    1 => $includedFieldName,
                    2 => $includedFieldValue,
                    3 => $includedFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        // content that has all the required fields but none of the included fields
        // (should not be in results)

        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $requiredField = $this->fieldFactory->create(
                [
                    0 => $content['id'],
                    1 => $requiredFieldName,
                    2 => $requiredFieldValue,
                    3 => $requiredFieldType,
                    4 => 1
                ]
            );

            $otherRequiredField = $this->fieldFactory->create(
                [
                    0 => $content['id'],
                    1 => $otherRequiredFieldName,
                    2 => $otherRequiredFieldValue,
                    3 => $otherRequiredFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $content['id']
                ]
            );
        }

        // content that has all the required fields and 1 of the included fields
        // (should be in results)

        for ($i = 0; $i < 5; $i++) {
            $expectedContent = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $requiredField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $requiredFieldName,
                    2 => $requiredFieldValue,
                    3 => $requiredFieldType,
                    4 => 1
                ]
            );

            $otherRequiredField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $otherRequiredFieldName,
                    2 => $otherRequiredFieldValue,
                    3 => $otherRequiredFieldType,
                    4 => 1
                ]
            );

            $includedField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $includedFieldName,
                    2 => $includedFieldValue,
                    3 => $includedFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id']
                ]
            );
        }

        // content that has all the required fields and all of the included fields
        // (should be in results)

        for ($i = 0; $i < 5; $i++) {
            $expectedContent = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $requiredField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $requiredFieldName,
                    2 => $requiredFieldValue,
                    3 => $requiredFieldType,
                    4 => 1
                ]
            );

            $otherRequiredField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $otherRequiredFieldName,
                    2 => $otherRequiredFieldValue,
                    3 => $otherRequiredFieldType,
                    4 => 1
                ]
            );

            $includedField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $includedFieldName,
                    2 => $includedFieldValue,
                    3 => $includedFieldType,
                    4 => 1
                ]
            );

            $otherIncludedField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $otherIncludedFieldName,
                    2 => $otherIncludedFieldValue,
                    3 => $otherIncludedFieldType,
                    4 => 1
                ]
            );

            $randomField = $this->fieldFactory->create(
                [
                    0 => $expectedContent['id']
                ]
            );
        }

        $rows = $this->contentRepository->startFilter(2, 3, 'id', 'asc', [$type])
            ->includeField(
                $includedFieldName,
                $includedFieldValue,
                $includedFieldType
            )
            ->includeField(
                $otherIncludedFieldName,
                $otherIncludedFieldValue,
                $otherIncludedFieldType
            )
            ->requireField(
                $requiredFieldName,
                $requiredFieldValue,
                $requiredFieldType
            )
            ->requireField(
                $otherRequiredFieldName,
                $otherRequiredFieldValue,
                $otherRequiredFieldType
            )
            ->get();

        $this->assertEquals([10, 11, 12], array_column($rows, 'id'));
    }

}