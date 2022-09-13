<?php


namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\FullTextSearchRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class FullTextSearchRepositoryTest extends RailcontentTestCase
{
    /**
     * @var FullTextSearchRepository
     */
    protected $classBeingTested;

    protected $contentFactory;

    protected $fieldFactory;

    protected $datumFactory;

    public function test_indexes_are_created()
    {
        $content =
            $this->contentFactory->create(
                $this->faker->slug(),
                $this->faker->randomElement(config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [])
            );

        $titleField = $this->fieldFactory->create($content['id'], 'title');
        $otherField = $this->fieldFactory->create($content['id'], $this->faker->word);
        $content['fields'] = [$titleField, $otherField];

        $descriptionData = $this->datumFactory->create($content['id'], 'description');
        $otherData = $this->datumFactory->create($content['id'], $this->faker->word);
        $content['data'] = [$descriptionData, $otherData];

        $this->classBeingTested->createSearchIndexes([$content]);

        $this->assertDatabaseHas(
            ConfigService::$tableSearchIndexes,
            [
                'content_id' => $content['id'],
                'high_value' => $content['slug'] . ' ' . $titleField['value'],
                'medium_value' => $titleField['value'] .
                    ' ' .
                    $otherField['value'] .
                    ' ' .
                    $descriptionData['value'] .
                    ' ' .
                    $otherData['value'],
                'low_value' => $titleField['value'] . ' ' . $otherField['value'] . ' ' . $descriptionData['value'],
            ]
        );
    }

    public function test_search()
    {
        for ($i = 1; $i < 10; $i++) {
            $content[$i] = (array)$this->contentFactory->create(
                $this->faker->word,
                $this->faker->randomElement(config('railcontent.showTypes', [])[config('railcontent.brand')] ?? []),
                ContentService::STATUS_PUBLISHED
            );

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title');
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], $this->faker->word);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData = $this->datumFactory->create($content[$i]['id'], 'description');
            $otherData = $this->datumFactory->create($content[$i]['id'], $this->faker->word);
            $content[$i]['data'] = [$descriptionData, $otherData];
        }

        $this->classBeingTested->createSearchIndexes($content);

        $results = $this->classBeingTested->search($content[1]['slug'] . ' ' . $titleField[1]['value']);

        //check that first result it's the content with given slug and title
        $this->assertArraySubset([0 => $content[1]['id']], $results);
    }

    public function test_search_no_results()
    {
        for ($i = 0; $i < 10; $i++) {
            $content[$i] =
                $this->contentFactory->create(
                    $this->faker->slug(),
                    $this->faker->randomElement(config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [])
                );

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', 'field' . $i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'other field' . $i);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData = $this->datumFactory->create($content[$i]['id'], 'description' . $i);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum' . $i);
            $content[$i]['data'] = [$descriptionData, $otherData];
        }
        $this->classBeingTested->createSearchIndexes($content);

        $results = $this->classBeingTested->search('rock lessons');

        //check that no results are found
        $this->assertEquals([], $results);
    }

    public function test_search_many_results_paginated()
    {
        $page = 1;
        $limit = 10;
        for ($i = 0; $i < 15; $i++) {
            $content[$i] =
                $this->contentFactory->create(
                    'slug',
                    $this->faker->randomElement(config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [])
                );

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', 'field ' . $i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'other field ' . $i);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData = $this->datumFactory->create($content[$i]['id'], 'description ' . $i);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum ' . $i);
            $content[$i]['data'] = [$descriptionData, $otherData];
        }

        $this->classBeingTested->createSearchIndexes($content);
        $results = $this->classBeingTested->search('slug field description', $page, $limit);

        //check that the results are returned paginated
        $this->assertEquals($limit, count($results));
    }

    protected function setUp(): void
    {
        $this->setConnectionType('mysql');

        parent::setUp();

        $this->classBeingTested = $this->app->make(FullTextSearchRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
    }

}
