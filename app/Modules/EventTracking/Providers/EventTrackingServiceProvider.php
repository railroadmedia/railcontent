<?php

namespace App\Modules\EventTracking\Providers;

use App\Modules\EventTracking\Destinations\RudderDestination;
use App\Providers\EventServiceProvider;
use Avo;

class EventTrackingServiceProvider extends EventServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        parent::register();

        Avo::init_avo([
            "env" => app()->isProduction() ? "prod" : "dev",
            "logger" => logger(),
            "rudder_stack_instance" => new RudderDestination(),
        ]);
    }
}
