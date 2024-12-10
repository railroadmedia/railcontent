<?php

namespace App\Modules\Content\Providers;

use App\Modules\Content\Console\Commands\VerifyUserContextPerformance;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Observers\ContentFieldObserver;
use App\Modules\Content\Policies\ContentPolicy;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Sanity\Client as SanityClient;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        parent::boot();

        $this->commands([
            VerifyUserContextPerformance::class
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sanity-cms.php',
            'content'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/algolia.php',
            'algolia'
        );

        // middleware is controlled in the route files
        Route::middleware([])
            ->group(__DIR__ . '/../routes/admin.php');

        $this->loadViewsFrom(__DIR__ . '/../views', 'content');

        ContentField::observe(ContentFieldObserver::class);
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // model policies
        Gate::policy(Content::class, ContentPolicy::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        parent::register();
        $this->app->bind(SanityClient::class, function ($app) {
            $projectId = config('content.project_id');
            $dataset = config('content.dataset');
            $accessToken = config('content.api_token_wr');
            $apiVersion = '2021-06-07';
            return new SanityClient([
                'projectId' => $projectId,
                'dataset' => $dataset,
                'apiVersion' => $apiVersion,
                'token' => $accessToken,
                'perspective' => 'published',
                'useCdn' => true,
            ]);
        });
    }
}
