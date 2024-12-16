<?php

namespace App\Modules\FeatureFlagging\Providers;

use App\Modules\FeatureFlagging\Managers\FeatureFlagManager;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\Router;
use App\Modules\FeatureFlagging\Contracts\FeatureFlagsContract;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use App\Modules\FeatureFlagging\Middlewares\GuardFeature;
use Modules\FeatureFlagging\Console\Commands\AddBranch;
use Modules\FeatureFlagging\Console\Commands\AddExperiment;
use Modules\FeatureFlagging\Console\Commands\AddFeature;
use Modules\FeatureFlagging\Console\Commands\AddRemoveUsersToBranch;
use Modules\FeatureFlagging\Console\Commands\AddRemoveUsersToFeature;
use Modules\FeatureFlagging\Console\Commands\DeleteBranch;
use Modules\FeatureFlagging\Console\Commands\DeleteFeature;
use Modules\FeatureFlagging\Console\Commands\EditBranch;
use Modules\FeatureFlagging\Console\Commands\EditFeature;
use Modules\FeatureFlagging\Console\Commands\EnableFeature;
use Modules\FeatureFlagging\Console\Commands\ShowExperiments;
use Modules\FeatureFlagging\Console\Commands\ShowFeatures;
use Modules\FeatureFlagging\Console\Commands\ToggleExperiment;
use Modules\FeatureFlagging\Console\Commands\ProcessAllUsersForExperiment;
use Modules\FeatureFlagging\Support\QueryBuilderMixin;

class FeatureFlaggingServiceProvider extends ServiceProvider
{
    /**
     * UsoraServiceProvider constructor.
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        parent::boot();
        $this->mergeConfigFrom(
            __DIR__ . '/../config/featureflagging.php',
            'featureflagging'
        );
        $this->bladeDirectives();
        $this->schedulingMacros();
        $this->middleware();
        $this->queryBuilder();

        $this->commands(
            [
                AddBranch::class,
                AddFeature::class,
                AddExperiment::class,
                DeleteBranch::class,
                DeleteFeature::class,
                EditBranch::class,
                EditFeature::class,
                EnableFeature::class,
                ShowExperiments::class,
                ShowFeatures::class,
                ToggleExperiment::class,
                AddRemoveUsersToFeature::class,
                AddRemoveUsersToBranch::class,
                ProcessAllUsersForExperiment::class,
            ]
        );
    }



    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();

        if (method_exists($this->app, 'scoped')) {
            $this->app->scoped(FeatureFlagsContract::class, FeatureFlagManager::class);
        } else {
            $this->app->singleton(FeatureFlagsContract::class, FeatureFlagManager::class);
        }
    }

    protected function bladeDirectives()
    {
        Blade::if('feature', function (string $feature, $applyIfOn = true) {
            $a = auth()->id();
            return    $applyIfOn
                ? FeatureFlagging::accessible($feature)
                : ! FeatureFlagging::accessible($feature);
        });
    }

    protected function schedulingMacros()
    {
        if (! Event::hasMacro('skipWithoutFeature')) {
            /** @noRector \Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector */
            Event::macro('skipWithoutFeature', function (string $feature): Event {
                /** @var Event $this */
                return $this->skip(fn () => ! FeatureFlagging::accessible($feature));
            });
        }

        if (! Event::hasMacro('skipWithFeature')) {
            /** @noRector \Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector */
            Event::macro('skipWithFeature', function ($feature): Event {
                /** @var Event $this */
                return $this->skip(fn () => FeatureFlagging::accessible($feature));
            });
        }
    }

    protected function middleware()
    {
        $this->app->make(Router::class)
            ->aliasMiddleware('feature', GuardFeature::class);
    }

    protected function queryBuilder()
    {
        Builder::mixin(new QueryBuilderMixin());
    }
}
