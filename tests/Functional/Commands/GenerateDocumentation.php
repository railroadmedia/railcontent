<?php

use Railroad\Railcontent\Tests\RailcontentTestCase;

class GenerateDocumentation extends RailcontentTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function test_command()
    {

        \Illuminate\Support\Facades\Artisan::call('apidoc:generate');

        $this->assertTrue(true);
    }
}
