<?php


namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\SearchRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class SearchRepositoryTest extends RailcontentTestCase
{
    use RefreshDatabase;
    /**
     * @var PermissionRepository
     */
    protected $classBeingTested;

    protected $contentFactory;

    protected $fieldFactory;

    protected $datumFactory;


    protected function setUp()
    {
        $this->setConnectionType('mysql');
        parent::setUp();

        $this->classBeingTested = $this->app->make(SearchRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);

    }

    public function test_indexes_are_created()
    {
        $content = $this->contentFactory->create();

        $titleField = $this->fieldFactory->create($content['id'], 'title');
        $otherField = $this->fieldFactory->create($content['id'], $this->faker->word);
        $content['fields'] = [$titleField, $otherField];

        $descriptionData = $this->datumFactory->create($content['id'], 'description');
        $otherData = $this->datumFactory->create($content['id'], $this->faker->word);
        $content['data'] = [$descriptionData, $otherData];

        $this->classBeingTested->createSearchIndexes([$content]);

        $this->assertDatabaseHas(ConfigService::$tableSearchIndexes,
            [
                'content_id' => $content['id'],
                'high_value' => $content['slug']. ' ' . $titleField['value'],
                'medium_value' => $titleField['value'] . ' ' . $otherField['value'] . ' ' . $descriptionData['value'] . ' ' . $otherData['value'],
                'low_value' => $titleField['value'] . ' ' . $otherField['value'] . ' ' .$descriptionData['value']
            ]);
    }
}
