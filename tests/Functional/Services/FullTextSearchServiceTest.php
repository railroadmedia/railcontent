<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\FullTextSearchRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\FullTextSearchService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class FullTextSearchServiceTest extends RailcontentTestCase
{
    /**
     * @var FullTextSearchService
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    protected $fieldFactory;

    /**
     * @var ContentDatumFactory $datumFactory
     */
    protected $datumFactory;

    /**
     * @var FullTextSearchRepository $fullSearchRepository
     */
    protected $fullSearchRepository;

    protected function setUp()
    {
        $this->setConnectionType('mysql');
        parent::setUp();

        $this->classBeingTested = $this->app->make(FullTextSearchService::class);

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
        $this->fullSearchRepository = $this->app->make(FullTextSearchRepository::class);
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
        $limit = 10;
        for ($i = 0; $i < 15; $i++) {
            $content[$i] = $this->contentFactory->create(
                'slug',
                $this->faker->randomElement(ConfigService::$searchableContentTypes)
            );

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', 'field ' . $i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'other field ' . $i);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData = $this->datumFactory->create(
                $content[$i]['id'],
                'description',
                'description ' . $this->faker->word
            );
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum ' . $i);
            $content[$i]['data'] = [$descriptionData, $otherData];
        }

        $this->artisan('command:createSearchIndexesForContents');

        $results = $this->classBeingTested->search('slug field description', $page, $limit);

        $contents = $results['results'];
        $expectedContents = array_splice($contents, 0, $limit);

        $this->assertArraySubset($expectedContents, $results['results']);
        $this->assertEquals(count($content), $results['total_results']);
    }

}
