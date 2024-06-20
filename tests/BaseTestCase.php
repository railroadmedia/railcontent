<?php

namespace Tests;

use App\Modules\EventDataSynchronizer\Middleware\UserActivitySyncMiddleware;
use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as FoundationBaseTestCase;
use Illuminate\Support\Facades\URL;

abstract class BaseTestCase extends FoundationBaseTestCase
{
    protected string $testRouteName = 'test-route';
    protected string $testRoutePath = 'https://test.musora.com';

    /**
     * @var Generator|Factory
     */
    protected Generator|Factory $faker;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

    protected function setUp(): void
    {
        putenv('RAILFORUMS_DATA_MODE="client"'); //hack to skip rail forums migrations

        $this->faker = Factory::create();

        Carbon::setTestNow(Carbon::now());
        parent::setUp();

        URL::forceRootUrl('https://testing.musora.com');

        // DEV NOTE our web_or_api_public middleware uses UserActivitySyncMiddleware and causes issues with the test
        // environment, due to calls to Redis and CustomerIO.
        // Disable the UserActivitySyncMiddleware middleware by default, since it can't be tested and causes errors.
        $this->withoutMiddleware(UserActivitySyncMiddleware::class);
    }

    protected function getRandomName($prefix = null)
    {
        $prefix ??= debug_backtrace(!DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
        $end = $this->faker->regexify('\d{4}-\d{4}-\d{4}-\d{4}');
        return $prefix . $end;
    }
}
