<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
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

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
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

        $rows = $this->classBeingTested->startFilter(1, 10, 'id', 'asc', $typesToInclude)->get();

        $this->assertEquals(array_column($expectedContents, 'id'), array_column($rows, 'id'));
    }
}