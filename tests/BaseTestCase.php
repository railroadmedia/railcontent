<?php

namespace Tests;

use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as FoundationBaseTestCase;
use Illuminate\Support\Facades\URL;

abstract class BaseTestCase extends FoundationBaseTestCase
{

    /**
     * @var Generator|Factory
     */
    protected Generator|Factory $faker;

    protected function setUp(): void
    {
        putenv('RAILFORUMS_DATA_MODE="client"'); //hack to skip rail forums migrations

        $this->faker = Factory::create();

        Carbon::setTestNow(Carbon::now());

        parent::setUp();

        URL::forceRootUrl('https://testing.musora.com');
    }

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        return $app;
    }
}
