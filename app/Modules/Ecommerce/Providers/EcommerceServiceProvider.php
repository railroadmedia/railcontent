<?php

namespace App\Modules\Ecommerce\Providers;

use App\Modules\Ecommerce\Console\Commands\MigrateFixMissingStripeCustomerIds;
use App\Modules\Ecommerce\Console\Commands\MigrateExistingStripeMusoraGatewayPaymentsToDrumeo;
use App\Modules\Ecommerce\Console\Commands\MigrateStripeCustomersToMusora;
use App\Modules\Ecommerce\Console\Commands\ProcessAppleExpiredSubscriptions;
use App\Modules\Ecommerce\Console\Commands\UnifySubscriptions;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
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
        $this->commands(
            [
                UnifySubscriptions::class,
                ProcessAppleExpiredSubscriptions::class,
                MigrateExistingStripeMusoraGatewayPaymentsToDrumeo::class,
                MigrateStripeCustomersToMusora::class,
                MigrateFixMissingStripeCustomerIds::class,
            ]
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
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
