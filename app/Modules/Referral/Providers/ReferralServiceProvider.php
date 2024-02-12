<?php

namespace App\Modules\Referral\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ReferralServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->mergeConfigFrom(
            __DIR__ . '/../config/referral.php',
            'referral'
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
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
