<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\FullTextSearchService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class FullTextSearchServiceTest extends RailcontentTestCase
{
    /**
     * @var FullTextSearchService
     */
    protected $classBeingTested;

    protected function setUp()
    {
        $this->setConnectionType('mysql');
        parent::setUp();

        $this->classBeingTested = $this->app->make(FullTextSearchService::class);
    }

    public function test_search_no_results()
    {
        $this->artisan('command:createSearchIndexesForContents');
        $result = $this->classBeingTested->search($this->faker->word);

        $this->assertEquals(0, $result['total_results']);
    }

    public function test_search_paginated()
    {
        $page = 1;
        $limit = 5;
        $nr = rand(1,10);

        $contents = $this->fakeContent($nr,
            [
                'slug' => 'slug',
                'type' => $this->faker->randomElement(ConfigService::$searchableContentTypes),
                'title' => 'field '.rand(1, 15)
            ]);

        $expectedContents = array_splice($contents, 0, $limit);

        $diffContents = $this->fakeContent(10,
            [
                'type' => $this->faker->randomElement(ConfigService::$searchableContentTypes),
            ]);

        $this->artisan('command:createSearchIndexesForContents');

        $results = $this->classBeingTested->search('slug field', $page, $limit);

        $this->assertEquals($nr, $results['total_results']);
    }

}
