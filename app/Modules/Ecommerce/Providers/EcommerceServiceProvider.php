<?php

namespace App\Modules\Ecommerce\Providers;

use App\Modules\Ecommerce\Listeners\EcommerceEventListener;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Modules\UserManagementSystem\Events\User\UserCreated;

class EcommerceServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserCreated::class => [
            EcommerceEventListener::class . '@handleUserCreated',
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


        $this->mergeConfigFrom(
            __DIR__ . '/../config/shopify.php',
            'shopify'
        );
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
