<?php

namespace App\Providers;

use App\ViewComposers\MarketingCartSidebarViewComposer;
use App\ViewComposers\MarketingPagesProductsViewComposer;
use App\ViewComposers\NavigationViewComposer;
use App\ViewComposers\RailanalyticsIframeTrackingViewComposer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Contracts\UserProviderInterface as EcommerceUserProviderInterface;
use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface as EventDataSynchronizerUserProviderInterface;
use Railroad\DoctrineArrayHydrator\Contracts\UserProviderInterface as ArrayHydratorUserProviderInterface;
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
        $request = Request::instance();

        // This is only for cloudflare performance testing to be able to access URLs behind our auth. This should
        // never be used for anything other than bots we control.
        if (str_starts_with($request->server->get('REQUEST_URI'), '/url-token-auth/')) {
            $token = Str::betweenFirst($request->server->get('REQUEST_URI'), '/url-token-auth/', '/');
            $realPath = Str::after($request->server->get('REQUEST_URI'), $token . '/');

            $request->headers->add(['Authorization' => "Bearer {$token}"]);

            $request->server->set('REQUEST_URI', '/' . $realPath);
        }
        if (!$this->app->environment('production')) {
            $this->app->register(\App\Modules\DevEndpoint\Providers\DevEndpointServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->environment('production')) {
            Mail::alwaysTo('musora-dev-test-5632c3@inbox.mailtrap.io');
        }

        view()->composer('*', NavigationViewComposer::class);

        view()->composer(
            [
                'drumeo.sales.partials._nav',
                'pianote.sales.nav',
                'pianote._partials._nav',
                'guitareo.sales.partials._nav',
                'singeo.sales.partials._nav',
            ],
            MarketingCartSidebarViewComposer::class
        );

        view()->composer(
            [
                'drumeo.shop.*',
                'drumeo.lead-gen.*',
                'drumeo.pages.*',
                'drumeo.products.*',
                'drumeo.sales.*',
                'guitareo.lead-gen.*',
                'guitareo.pages.*',
                'guitareo.products.*',
                'guitareo.sales.*',
                'guitareo.shop.*',
                'pianote.lead-gen.*',
                'pianote.pages.*',
                'pianote.products.*',
                'pianote.sales.*',
                'pianote.shop.*',
                'singeo.lead-gen.*',
                'singeo.pages.*',
                'singeo.products.*',
                'singeo.sales.*',
                'singeo.shop.*',
                'musora.shop.*',
            ],
            MarketingPagesProductsViewComposer::class
        );

        view()->composer(
            [
                'partials._railanalytics-brand-tracking-iframe',
            ],
            RailanalyticsIframeTrackingViewComposer::class
        );

        //        app()->instance(EcommerceUserProviderInterface::class, app()->make(EcommerceUserProvider::class));
        //        app()->instance(RailforumsUserProviderInterface::class, app()->make(RailforumsUserProvider::class));
        //        app()->instance(
        //            EventDataSynchronizerUserProviderInterface::class,
        //            app()->make(EventDataSynchronizerUserProvider::class)
        //        );

        $this->app->singleton(EcommerceUserProviderInterface::class, function ($app) {
            return $app->make(EcommerceUserProvider::class);
        });
        $this->app->singleton(ArrayHydratorUserProviderInterface::class, function ($app) {
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

        // handle host forwarding (ngrok, etc)
        if (app()->environment('local', 'development') && isset($_SERVER['HTTP_X_FORWARDED_HOST']) ) {
            // without this, we get errors for the manifest (and probably other things) because of CORS and the different domains with ngrok and the app
            $this->app['url']->forceRootUrl($_SERVER['HTTP_X_FORWARDED_PROTO'].'://'.$_SERVER['HTTP_X_FORWARDED_HOST']);
        }
    }
}
