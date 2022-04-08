<?php

namespace Modules\UserManagementSystem\Tests;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\URL;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * @var Factory
     */
    protected Generator|Factory $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();

        parent::setUp();

        URL::forceRootUrl('https://testing.musora.com');
    }


}
