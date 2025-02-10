<?php

namespace App\Modules\EventTracking\Providers;

use App\Modules\EventTracking\Destinations\RudderDestination;
use App\Modules\EventTracking\Listeners\UserCreatedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Avo;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Railroad\Usora\Events\User\UserCreated as UsoraUserCreated;

class EventTrackingServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserCreated::class  => [
            UserCreatedListener::class
        ],
        UsoraUserCreated::class => [
            UserCreatedListener::class
        ]
    ];

    public function boot(): void
    {
    }

    public function register(): void
    {
        parent::register();

        Avo::init_avo([
            "env" => "prod",
            "logger" => logger(),
            "rudder_stack_instance" => new RudderDestination(),
        ]);
    }
}
