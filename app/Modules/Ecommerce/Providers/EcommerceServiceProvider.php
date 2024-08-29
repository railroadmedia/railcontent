<?php

namespace App\Modules\Ecommerce\Providers;

use App\Modules\Ecommerce\Listeners\EcommerceEventListener;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Railroad\Usora\Events\User\UserUpdated as UsoraUserUpdated;

class EcommerceServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserCreated::class => [
            EcommerceEventListener::class . '@handleUserCreated',
        ],
        UserUpdated::class => [
            EcommerceEventListener::class . '@handleUserUpdated',
        ],
        UsoraUserUpdated::class => [
            EcommerceEventListener::class . '@handleUserUpdated',
        ],
    ];

    /**
     * UsoraServiceProvider constructor.
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        // middleware is controlled in the route files
        Route::middleware([])
            ->group(__DIR__ . '/../routes/routes.php')
            ->group(__DIR__ . '/../routes/shopify.php')
            ->group(__DIR__ . '/../routes/recharge.php')
            ->group(__DIR__ . '/../routes/subscriptions.php');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();
    }
}
