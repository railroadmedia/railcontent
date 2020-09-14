<?php

namespace Railroad\Railcontent\Tests\Functional\Commands;

use Railroad\Railcontent\Tests\RailcontentTestCase;

class MigrateContentFields extends RailcontentTestCase
{

    public function setUp()
    {
        $this->setConnectionType('mysql');

        parent::setUp();
    }

    public function test_command()
    {
        $this->artisan('command:migrateFields');

        $this->assertTrue(true);
    }
}
