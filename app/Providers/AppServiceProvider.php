<?php

namespace App\Providers;

use App\ViewComposers\NavigationViewComposer;
use Illuminate\Support\ServiceProvider;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;
use Railroad\MusoraApi\Contracts\UserProviderInterface;
use Railroad\MusoraApi\Contracts\RailTrackerProviderInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', NavigationViewComposer::class);

        app()->instance(UserProviderInterface::class, app()->make(MusoraApiUserProvider::class));
        app()->instance(ProductProviderInterface::class, app()->make(MusoraApiProductProvider::class));
        app()->instance(RailTrackerProviderInterface::class, app()->make(RailTrackerProvider::class));
    }
}
