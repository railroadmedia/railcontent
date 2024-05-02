<?php

namespace App\Modules\CustomerIO\tests;

use Carbon\Carbon;
use Dotenv\Dotenv;
use Faker\Generator;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Routing\Router;
use App\Modules\CustomerIO\Providers\CustomerIoServiceProvider;
use Tests\TestCase;

class CustomerIoTestCase extends TestCase
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * @var AuthManager
     */
    protected $authManager;

    /**
     * @var Router
     */
    protected $router;

    protected function setUp(): void
    {
        parent::setUp();

        if (!defined('LARAVEL_START')) {
            define('LARAVEL_START', microtime(true));
        }

        $this->databaseManager = $this->app->make(DatabaseManager::class);
        $this->authManager = $this->app->make(AuthManager::class);
        $this->router = $this->app->make(Router::class);

        Carbon::setTestNow(Carbon::now()->startOfSecond());
    }
}
