<?php

namespace App\Modules\HelpScout\Providers;

use App\Modules\HelpScout\Console\Commands\GetMailBoxes;
use App\Modules\HelpScout\Console\Commands\RegisterWebHook;
use App\Modules\HelpScout\Console\Commands\UnregisterWebHook;
use App\Modules\HelpScout\Console\Commands\WebHooks;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class HelpScoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        parent::boot();

        $this->commands([
            GetMailBoxes::class,
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
     */
    public function register(): void
    {
    }
}
