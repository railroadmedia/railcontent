<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Carbon\Carbon;
use Cron\FieldFactory;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\FullTextSearchRepository;
use Railroad\Railcontent\Services\CommentService;
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

    protected $datumFactory;

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
        $result = $this->classBeingTested->search($this->faker->word);

        $this->assertEquals([
            'results' => [],
            'total_results' => 0
        ], $result);
    }

    public function test_search()
    {
        $page = 1;
        $limit = 10;
        for ($i = 0; $i < 15; $i++) {
            $content[$i] = $this->contentFactory->create('slug');

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title','field '.$i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'other field '.$i);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData = $this->datumFactory->create($content[$i]['id'], 'description '.$i);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum '.$i);
            $content[$i]['data'] = [$descriptionData, $otherData];
        }

        $this->fullSearchRepository->createSearchIndexes($content);
        $results = $this->classBeingTested->search('slug field description',$page, $limit);
        $this->assertArraySubset([
            'total_results' => count($content)
        ], $results);
    }

}
