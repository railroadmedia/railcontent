<?php

namespace App\Providers;

use App\ViewComposers\NavigationViewComposer;
use Illuminate\Support\ServiceProvider;
use Railroad\Ecommerce\Contracts\UserProviderInterface as EcommerceUserProviderInterface;
use Railroad\EventDataSynchronizer\Providers\UserProviderInterface as EventDataSynchronizerUserProviderInterface;
use Railroad\Railforums\Contracts\UserProviderInterface as RailforumsUserProviderInterface;

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

        app()->instance(EcommerceUserProviderInterface::class, app()->make(EcommerceUserProvider::class));
        app()->instance(RailforumsUserProviderInterface::class, app()->make(RailforumsUserProvider::class));
        app()->instance(
            EventDataSynchronizerUserProviderInterface::class,
            app()->make(EventDataSynchronizerUserProvider::class)
        );

        //railnotifications package providers
        app()->instance(\Railroad\Railnotifications\Contracts\UserProviderInterface::class, app()->make(RailnotificationsUserProvider::class));
        app()->instance(\Railroad\Railnotifications\Contracts\ContentProviderInterface::class, app()->make(RailnotificationsContentProvider::class));
        app()->instance(\Railroad\Railnotifications\Contracts\RailforumProviderInterface::class, app()->make(RailnotificationsForumProvider::class));

    }
}
