<?php

namespace Tests;

use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\URL;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * @var Factory
     */
    protected Generator|Factory $faker;

    protected function setUp(): void
    {
        putenv('RAILCONTENT_DATA_MODE=client');

        $this->faker = Factory::create();

        Carbon::setTestNow(Carbon::now());

        parent::setUp();

        URL::forceRootUrl('https://testing.musora.com');
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
