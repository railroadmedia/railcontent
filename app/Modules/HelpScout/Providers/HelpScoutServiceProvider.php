<?php

namespace App\Modules\HelpScout\Providers;

use App\Modules\HelpScout\Commands\RegisterWebHook;
use App\Modules\HelpScout\Commands\UnregisterWebHook;
use App\Modules\HelpScout\Commands\WebHooks;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class HelpScoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->commands([
            RegisterWebHook::class,
            UnregisterWebHook::class,
            WebHooks::class,
        ]);
        $this->mergeConfigFrom(__DIR__ . '/../config/helpscout.php', 'helpscout');
        $this->loadViewsFrom(__DIR__ . '/../views', 'helpscout');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
