<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryBaseFilteringTest extends RailcontentTestCase
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
     * @var ContentHierarchyFactory
     */
    protected $contentHierarchyFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
    }

    public function test_empty()
    {
        $rows = $this->classBeingTested->startFilter(1, 1, 'published_on', 'desc', [])->get();

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

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [])->get();

        $this->assertEquals([4, 5, 6], array_column($rows, 'id'));
    }

    public function test_include_parent_slugs()
    {
        /*
         * Expected content ids:
         * [ 1, 2, 3, 4, 5 ]
         *
         */

        $slugsToInclude = [
            $this->faker->word . rand(),
            $this->faker->word . rand(),
            $this->faker->word . rand()
        ];

        $includedParentContentIds = [];

        foreach ($slugsToInclude as $slugToInclude) {
            $includedParentContentIds[] = $this->contentFactory->create([0 => $slugToInclude])['id'];
        }

        $slugsToExclude = [
            $this->faker->word . rand(),
            $this->faker->word . rand(),
            $this->faker->word . rand()
        ];

        $excludedParentContentIds = [];

        foreach ($slugsToExclude as $slugToExclude) {
            $excludedParentContentIds[] = $this->contentFactory->create([0 => $slugToExclude])['id'];
        }

        $expectedContents = [];

        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                ]
            );

            foreach ($includedParentContentIds as $includedParentContentId) {
                $this->contentHierarchyFactory->create(
                    [$includedParentContentId, $content['id']]
                );
            }

            $expectedContents[] = $content;
        }

        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                ]
            );

            foreach ($excludedParentContentIds as $excludedParentContentId) {
                $this->contentHierarchyFactory->create(
                    [$excludedParentContentId, $content['id']]
                );
            }

        }

        $rows = $this->classBeingTested->startFilter(1, 10, 'id', 'asc', $slugsToInclude)->get();

        $this->assertEquals(array_column($expectedContents, 'id'), array_column($rows, 'id'));
    }

    public function test_include_types_count()
    {
        /*
         * Expected content ids:
         * [ 1, 2, 3, 4, 5 ]
         *
         */

        $slugsToInclude = [
            $this->faker->word . rand(),
            $this->faker->word . rand(),
            $this->faker->word . rand()
        ];

        $includedParentContentIds = [];

        foreach ($slugsToInclude as $slugToInclude) {
            $includedParentContentIds[] = $this->contentFactory->create([0 => $slugToInclude])['id'];
        }

        $slugsToExclude = [
            $this->faker->word . rand(),
            $this->faker->word . rand(),
            $this->faker->word . rand()
        ];

        $excludedParentContentIds = [];

        foreach ($slugsToExclude as $slugToExclude) {
            $excludedParentContentIds[] = $this->contentFactory->create([0 => $slugToExclude])['id'];
        }

        $expectedContents = [];

        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                ]
            );

            foreach ($includedParentContentIds as $includedParentContentId) {
                $this->contentHierarchyFactory->create(
                    [$includedParentContentId, $content['id']]
                );
            }

            $expectedContents[] = $content;
        }

        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                ]
            );

            foreach ($excludedParentContentIds as $excludedParentContentId) {
                $this->contentHierarchyFactory->create(
                    [$excludedParentContentId, $content['id']]
                );
            }

        }

        $count = $this->classBeingTested->startFilter(1, 10, 'id', 'asc', $slugsToInclude)->count();

        $this->assertEquals(5, $count);
    }
}