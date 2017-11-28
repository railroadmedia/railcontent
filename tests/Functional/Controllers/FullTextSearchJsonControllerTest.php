<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;


use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class FullTextSearchJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentFactory $contentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $datumFactory;

    protected function setUp()
    {
        $this->setConnectionType('mysql');

        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
    }

    public function test_no_results()
    {
        $response = $this->call('GET', 'railcontent/search');

        $this->assertEquals(200, $response->getStatusCode());
        $response = $response->decodeResponseJson();
        $this->assertEquals([], $response['results']);
        $this->assertEquals(0, $response['total_results']);
    }

    public function test_search_results_paginated()
    {
        $page = 1;
        $limit = 10;
        for ($i = 0; $i < 15; $i++) {
            $content[$i] = $this->contentFactory->create('slug',
                                                        $this->faker->randomElement(ConfigService::$searchableContentTypes),
                                                        ContentService::STATUS_PUBLISHED, ConfigService::$defaultLanguage,
                                                        ConfigService::$brand, rand(), Carbon::yesterday()->toDateTimeString());

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title','field '.$i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'other field '.$i);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData = $this->datumFactory->create($content[$i]['id'], 'description', 'description '.$this->faker->word);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum '.$i);
            $content[$i]['data'] = [$descriptionData, $otherData];
        }

        $this->artisan('command:createSearchIndexes');

        $response = $this->call('GET', 'railcontent/search',[
            'page' => $page,
            'limit' => $limit
        ]);

        $results = $response->decodeResponseJson();
        $contents = $results['results'];
        $expectedContents = array_splice($contents, 0, $limit);
        $espectedResults = array_combine(
            array_column($expectedContents, 'id'),
            $expectedContents
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($espectedResults, $results['results']);
        $this->assertEquals(15, $results['total_results']);
    }



}
