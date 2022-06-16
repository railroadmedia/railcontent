<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Railroad\Railforums\Events\PostCreated;
use Railroad\Railforums\Events\PostLiked;
use Railroad\Railnotifications\Listeners\NotificationEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PostLiked::class => [
            NotificationEventListener::class.'@handlePostLiked',
        ],
        PostCreated::class => [
            NotificationEventListener::class.'@handlePostCreated',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
