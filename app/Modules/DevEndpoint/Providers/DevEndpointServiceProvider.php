<?php

namespace App\Modules\DevEndpoint\Providers;

use Illuminate\Foundation\Application;
use App\Modules\DevEndpoint\Console\Commands\DevEndpointCommand;
use App\Modules\DevEndpoint\Listeners\DevEndpointsListener;
use Railroad\Railforums\Events\PostLiked;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class DevEndpointServiceProvider extends ServiceProvider
{
    protected $listen = [
//        PostLiked::class => [
//            PlaygroundListener::class . '@handlePostLiked',
//        ],
    ];

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
            __DIR__ . '/../config/devendpoint.php',
            'devendpoint'
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        $this->commands(
            [
                DevEndpointCommand::class,
            ]
        );
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();
    }
}
