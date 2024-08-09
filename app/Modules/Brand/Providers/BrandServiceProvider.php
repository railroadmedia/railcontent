<?php

namespace App\Modules\Brand\Providers;

use App\Modules\Brand\ViewComposers\BrandViewComposer;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class BrandServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
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
        // publish config file
        $this->mergeConfigFrom(
            __DIR__ . '/../config/brands.php',
            'brands'
        );

        // view composers
        view()->composer('*', BrandViewComposer::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();
    }
}
