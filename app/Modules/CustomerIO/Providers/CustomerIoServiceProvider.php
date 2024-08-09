<?php

namespace App\Modules\CustomerIO\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CustomerIoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        $this->mergeConfigFrom(
            __DIR__ . '/../config/customer-io.php',
            'customer-io'
        );

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/customer-io.php');
    }
}
