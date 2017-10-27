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
        $rows = $this->classBeingTested->startFilter(1, 1, 'published_on', 'desc', [], [])
            ->retrieveFilter();

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

        $type = $this->faker->word;

        for ($i = 0; $i < 10; $i++) {
            $this->contentFactory->create([1 => $type, 2 => ContentService::STATUS_PUBLISHED]);
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type], [])
            ->retrieveFilter();

        $this->assertEquals([4, 5, 6], array_column($rows, 'id'));
    }

    public function test_include_parent_slugs()
    {
        /*
         * Expected content ids:
         * [ 7, 8, 9, 10, 11 ]
         *
         */

        $type = $this->faker->word;

        $slugHierarchyToInclude = [
            'top-slug-' . rand(),
            'second-slug-' . rand(),
            'third-slug-' . rand()
        ];

        $includedParentContentIds = [];

        foreach ($slugHierarchyToInclude as $slugToInclude) {
            $includedParentContentIds[] =
                $this->contentFactory->create([0 => $slugToInclude, 1 => $type])['id'];
        }

        foreach ($includedParentContentIds as $index => $includedParentContentId) {
            if ($index > 0) {
                $this->contentHierarchyFactory->create(
                    [$includedParentContentIds[$index - 1], $includedParentContentId]
                );
            }
        }

        $slugHierarchyToExclude = [
            $slugHierarchyToInclude[0],
            $slugHierarchyToInclude[1],
            'random-slug-' . rand()
        ];

        $excludedParentContentIds = [];

        foreach ($slugHierarchyToExclude as $slugToExclude) {
            $excludedParentContentIds[] =
                $this->contentFactory->create([0 => $slugToExclude, 1 => $type])['id'];
        }

        foreach ($excludedParentContentIds as $index => $excludedParentContentId) {
            if ($index > 0) {
                $this->contentHierarchyFactory->create(
                    [$excludedParentContentIds[$index - 1], $excludedParentContentId]
                );
            }
        }

        $expectedContents = [];

        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => $type,
                    2 => ContentService::STATUS_PUBLISHED,
                ]
            );

            $this->contentHierarchyFactory->create(
                [$includedParentContentIds[2], $content['id']]
            );

            $expectedContents[] = $content;
        }

        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => $type,
                    2 => ContentService::STATUS_PUBLISHED,
                ]
            );

            $this->contentHierarchyFactory->create(
                [$excludedParentContentIds[2], $content['id']]
            );
        }

        $rows = $this->classBeingTested->startFilter(
            1,
            10,
            'id',
            'asc',
            [$type],
            $slugHierarchyToInclude
        )
            ->retrieveFilter();

        $this->assertEquals(array_column($expectedContents, 'id'), array_column($rows, 'id'));
    }

    public function test_include_types_count()
    {
        /*
  * Expected content ids:
  * [ 7, 8, 9, 10, 11 ]
  *
  */

        $type = $this->faker->word;

        $slugHierarchyToInclude = [
            'top-slug-' . rand(),
            'second-slug-' . rand(),
            'third-slug-' . rand()
        ];

        $includedParentContentIds = [];

        foreach ($slugHierarchyToInclude as $slugToInclude) {
            $includedParentContentIds[] =
                $this->contentFactory->create([0 => $slugToInclude, 1 => $type])['id'];
        }

        foreach ($includedParentContentIds as $index => $includedParentContentId) {
            if ($index > 0) {
                $this->contentHierarchyFactory->create(
                    [$includedParentContentIds[$index - 1], $includedParentContentId]
                );
            }
        }

        $slugHierarchyToExclude = [
            $slugHierarchyToInclude[0],
            $slugHierarchyToInclude[1],
            'random-slug-' . rand()
        ];

        $excludedParentContentIds = [];

        foreach ($slugHierarchyToExclude as $slugToExclude) {
            $excludedParentContentIds[] =
                $this->contentFactory->create([0 => $slugToExclude, 1 => $type])['id'];
        }

        foreach ($excludedParentContentIds as $index => $excludedParentContentId) {
            if ($index > 0) {
                $this->contentHierarchyFactory->create(
                    [$excludedParentContentIds[$index - 1], $excludedParentContentId]
                );
            }
        }

        $expectedContents = [];

        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => $type,
                    2 => ContentService::STATUS_PUBLISHED,
                ]
            );

            $this->contentHierarchyFactory->create(
                [$includedParentContentIds[2], $content['id']]
            );

            $expectedContents[] = $content;
        }

        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => $type,
                    2 => ContentService::STATUS_PUBLISHED,
                ]
            );

            $this->contentHierarchyFactory->create(
                [$excludedParentContentIds[2], $content['id']]
            );
        }

        $count = $this->classBeingTested->startFilter(
            1,
            10,
            'id',
            'asc',
            [$type],
            $slugHierarchyToInclude
        )
            ->countFilter();

        $this->assertEquals(5, $count);
    }
}