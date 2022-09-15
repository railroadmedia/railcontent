<?php

namespace App\Providers;

use App\ViewComposers\NavigationViewComposer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Railroad\Ecommerce\Contracts\UserProviderInterface as EcommerceUserProviderInterface;
use Railroad\EventDataSynchronizer\Providers\UserProviderInterface as EventDataSynchronizerUserProviderInterface;
use Railroad\Railcontent\Providers\RailcontentURLProviderInterface;
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
        // This is for clearing the tmp folder on lambda container invocations to stop the same tmp files being
        // shared across requests which can cause recursion issues.
        $this->app->terminating(function () {
            if (app()->environment() !== 'development') {
                exec("rm -rf /tmp/..?* /tmp/.[!.]* /tmp/*");
            }
        });

        if (!$this->app->environment('production')) {
            Mail::alwaysTo('musora-dev-test-5632c3@inbox.mailtrap.io');
        }

        view()->composer('*', NavigationViewComposer::class);

        //        app()->instance(EcommerceUserProviderInterface::class, app()->make(EcommerceUserProvider::class));
        //        app()->instance(RailforumsUserProviderInterface::class, app()->make(RailforumsUserProvider::class));
        //        app()->instance(
        //            EventDataSynchronizerUserProviderInterface::class,
        //            app()->make(EventDataSynchronizerUserProvider::class)
        //        );

        $this->app->singleton(EcommerceUserProviderInterface::class, function ($app) {
            return $app->make(EcommerceUserProvider::class);
        });

        $this->app->singleton(RailforumsUserProviderInterface::class, function ($app) {
            return $app->make(RailforumsUserProvider::class);
        });

        $this->app->singleton(EventDataSynchronizerUserProviderInterface::class, function ($app) {
            return $app->make(EventDataSynchronizerUserProvider::class);
        });

        $this->app->singleton(MusoraUserProviderInterface::class, function ($app) {
            return $app->make(MusoraApiUserProvider::class);
        });

        $this->app->singleton(ProductProviderInterface::class, function ($app) {
            return $app->make(MusoraApiProductProvider::class);
        });

        $this->app->singleton(RailTrackerProviderInterface::class, function ($app) {
            return $app->make(RailTrackerProvider::class);
        });

        $this->app->singleton(ChatProviderInterface::class, function ($app) {
            return $app->make(MusoraApiChatProvider::class);
        });

        $this->app->singleton(RailcontentURLProviderInterface::class, function ($app) {
            return $app->make(RailcontentURLProvider::class);
        });

        //railnotifications package providers
        $this->app->singleton(\Railroad\Railnotifications\Contracts\UserProviderInterface::class, function ($app) {
            return $app->make(RailnotificationsUserProvider::class);
        });

        $this->app->singleton(\Railroad\Railnotifications\Contracts\ContentProviderInterface::class, function ($app) {
            return $app->make(RailnotificationsContentProvider::class);
        });

        $this->app->singleton(\Railroad\Railnotifications\Contracts\RailforumProviderInterface::class, function ($app) {
            return $app->make(RailnotificationsForumProvider::class);
        });
    }
}
