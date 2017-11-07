<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 10/26/2017
 * Time: 4:45 PM
 */

namespace Railroad\Railcontent\Tests\Functional\Controllers;


use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentServiceTest extends RailcontentTestCase
{
    protected $contentFactory;

    protected $datumFactory;

    protected $fieldFactory;

    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);

        $this->serviceBeingTested = $this->app->make(ContentService::class);

    }

    public function test_get_by_id()
    {
        $content = $this->contentFactory->create();

        $results = $this->serviceBeingTested->getById($content['id']);

        $this->assertEquals(
            array_merge($content, [
                'id' => $content['id']
            ])
            , $results);
    }

    public function test_get_by_id_when_id_not_exist()
    {
        $results = $this->serviceBeingTested->getById($this->faker->numberBetween());

        $this->assertEquals(
           null
            , $results
        );
    }

    public function test_get_by_id_content_with_fields_and_datum()
    {
        $content = $this->contentFactory->create();

        $randomField = $this->fieldFactory->create(
            $content['id']

        );

        $randomDatum = $this->datumFactory->create(
            $content['id']

        );

        $results = $this->serviceBeingTested->getById($content['id']);

        unset(
            $randomField['field_id'],
            $randomDatum['datum_id']
        );

        $this->assertEquals(
            array_merge($content, [
                    'id' => $content['id'],
                    'fields' => [$randomField],
                    'data' => [$randomDatum]
                ])

            , $results);
    }

}
