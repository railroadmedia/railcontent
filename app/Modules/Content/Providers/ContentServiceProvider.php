<?php

namespace App\Modules\Content\Providers;

use App\Modules\Content\Console\Commands\VerifyUserContextPerformance;
use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Observers\ContentFieldObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class ContentServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        parent::boot();

        $this->commands([
            VerifyUserContextPerformance::class
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sanity-cms.php',
            'content'
        );

        // middleware is controlled in the route files
        Route::middleware([])
            ->group(__DIR__ . '/../routes/admin.php');

        $this->loadViewsFrom(__DIR__ . '/../views', 'content');

        ContentField::observe(ContentFieldObserver::class);
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
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
