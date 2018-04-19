<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentServiceTest extends RailcontentTestCase
{
    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $datumFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionsFactory;

    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionsFactory = $this->app->make(ContentPermissionsFactory::class);

        $this->serviceBeingTested = $this->app->make(ContentService::class);

    }

    public function test_get_by_id()
    {
        $content = $this->contentFactory->create();

        $results = $this->serviceBeingTested->getById($content['id']);

        $this->assertEquals(
            array_merge(
                $content->getArrayCopy(),
                [
                    'id' => $content['id']
                ]
            ),
            $results->getArrayCopy()
        );
    }

    public function test_get_by_id_when_id_not_exist()
    {
        $results = $this->serviceBeingTested->getById($this->faker->numberBetween());

        $this->assertEquals(
            null
            ,
            $results
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
            array_merge(
                $content->getArrayCopy(),
                [
                    'id' => $content['id'],
                    'fields' => [$randomField],
                    'data' => [$randomDatum]
                ]
            ),
            $results->getArrayCopy()
        );
    }

}
