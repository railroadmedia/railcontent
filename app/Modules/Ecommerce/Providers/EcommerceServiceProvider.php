<?php

namespace App\Modules\Ecommerce\Providers;

use App\Modules\Ecommerce\Listeners\EcommerceEventListener;
use App\Modules\Ecommerce\Listeners\Shopify\ShopifyEventListener;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;

class EcommerceServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserCreated::class => [
            EcommerceEventListener::class . '@handleUserCreated',
        ],
        UserUpdated::class => [
            ShopifyEventListener::class . '@handleUserUpdated',
        ],
    ];

    /**
     * UsoraServiceProvider constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // middleware is controlled in the route files
        Route::middleware([])
            ->group(__DIR__ . '/../routes/routes.php')
            ->group(__DIR__ . '/../routes/shopify.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        parent::register();
    }
}
