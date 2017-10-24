<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryFilteringTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
    }

    public function test_empty()
    {
        $rows = $this->classBeingTested->getFiltered(1, 1, 'published_on', 'desc', [], [], []);

        $this->assertEmpty($rows);
    }

    public function test_pagination()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->contentFactory->create([1 => ContentService::STATUS_PUBLISHED, 3 => $i + 1]);
        }

        $rows = $this->classBeingTested->getFiltered(2, 3, 'position', 'asc', [], [], []);

        $this->assertEquals([4, 5, 6], array_column($rows, 'id'));
    }

    public function test_include_types()
    {
        $typesToInclude = [$this->faker->word, $this->faker->word, $this->faker->word];
        $typesToExclude = [$this->faker->word, $this->faker->word, $this->faker->word];

        $expectedIds = [];

        for ($i = 0; $i < 3; $i++) {
            $expectedIds [] = $this->contentFactory->create(
                [1 => ContentService::STATUS_PUBLISHED, 2 => $this->faker->randomElement($typesToInclude)]
            );
        }

        for ($i = 0; $i < 3; $i++) {
            $this->contentFactory->create(
                [1 => ContentService::STATUS_PUBLISHED, 2 => $this->faker->randomElement($typesToExclude)]
            );
        }

        $rows = $this->classBeingTested->getFiltered(1, 10, 'position', 'asc', $typesToInclude, [], []);

        $this->assertEquals($expectedIds, array_column($rows, 'id'));
    }
}