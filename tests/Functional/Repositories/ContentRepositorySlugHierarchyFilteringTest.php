<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositorySlugHierarchyFilteringTest extends RailcontentTestCase
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
        $rows = $this->classBeingTested->startFilter(1, 1, 'published_on', 'desc', [], [], [])
            ->retrieveFilter();

        $this->assertEmpty($rows);
    }

    public function test_restrict_by_slug_hierarchy()
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
                $this->contentFactory->create($slugToInclude, $type, ContentService::STATUS_PUBLISHED)['id'];
        }

        foreach ($includedParentContentIds as $index => $includedParentContentId) {
            if ($index > 0) {
                $this->contentHierarchyFactory->create(
                    $includedParentContentIds[$index - 1],
                    $includedParentContentId
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
                $this->contentFactory->create($slugToExclude, $type, ContentService::STATUS_PUBLISHED)['id'];
        }

        foreach ($excludedParentContentIds as $index => $excludedParentContentId) {
            if ($index > 0) {
                $this->contentHierarchyFactory->create(
                    $excludedParentContentIds[$index - 1],
                    $excludedParentContentId
                );
            }
        }

        $expectedContents = [];

        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );

            $this->contentHierarchyFactory->create(
                $includedParentContentIds[2],
                $content['id']
            );

            $this->contentHierarchyFactory->create(
                $excludedParentContentIds[2],
                $content['id']
            );

            $expectedContents[] = $content->getArrayCopy();
        }

        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );

            $this->contentHierarchyFactory->create(
                $excludedParentContentIds[2],
                $content['id']
            );
        }

        $tStart = microtime(true);

        $rows = $this->classBeingTested->startFilter(
            1,
            20,
            'id',
            'asc',
            [$type],
            $slugHierarchyToInclude,
            []
        )
            ->retrieveFilter();

        $tEnd = microtime(true);
        var_dump($tEnd - $tStart);

        $this->assertEquals(array_column($expectedContents, 'id'), array_column($rows, 'id'));
    }
}