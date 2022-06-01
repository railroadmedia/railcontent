<?php

namespace App\Providers;

use App\ViewComposers\NavigationViewComposer;
use Illuminate\Support\ServiceProvider;
use Railroad\Ecommerce\Contracts\UserProviderInterface as EcommerceUserProviderInterface;
use Railroad\EventDataSynchronizer\Providers\UserProviderInterface as EventDataSynchronizerUserProviderInterface;
use Railroad\Railforums\Contracts\UserProviderInterface as RailforumsUserProviderInterface;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;
use Railroad\MusoraApi\Contracts\UserProviderInterface as MusoraUserProviderInterface;
use Railroad\MusoraApi\Contracts\RailTrackerProviderInterface;
use Railroad\MusoraApi\Contracts\ChatProviderInterface;

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

        app()->instance(MusoraUserProviderInterface::class, app()->make(MusoraApiUserProvider::class));
        app()->instance(ProductProviderInterface::class, app()->make(MusoraApiProductProvider::class));
        app()->instance(RailTrackerProviderInterface::class, app()->make(RailTrackerProvider::class));
        app()->instance(ChatProviderInterface::class, app()->make(MusoraApiChatProvider::class));
    }
}
