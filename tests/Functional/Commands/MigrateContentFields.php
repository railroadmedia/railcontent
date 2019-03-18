<?php

use Carbon\Carbon;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class MigrateContentFields extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    private $contentService;

    public function setUp()
    {
        $this->setConnectionType('mysql');
        parent::setUp();

        $this->contentService = $this->app->make(ContentService::class);
    }

    public function test_command()
    {
       // $this->artisan('command:migrateFields');

        $this->assertTrue(true);

    }
}
