<?php

namespace App\Modules\EventTracking\Providers;

use App\Modules\EventTracking\Destinations\RudderDestination;
use App\Modules\EventTracking\Listeners\EventTrackerListener;
use App\Modules\EventTracking\Logger;
use App\Providers\EventServiceProvider;
use Avo;
use Illuminate\Support\ServiceProvider;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Rudder\Rudder;

class EventTrackingServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserCreated::class => [
            EventTrackerListener::class . '@handleUserCreated'
        ],
    ];

    public function boot(): void
    {
    }

    public function register(): void
    {
        parent::register();

        Avo::init_avo([
            "env" => app()->isProduction() ? "prod" : "dev",
            "logger" => new Logger(),
            "rudder_stack_instance" => new RudderDestination(),
        ]);
    }
}
