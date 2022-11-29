<?php

namespace App\Providers;

use App\Listeners\Authentication\AuthenticationEventListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\UserManagementSystem\Events\UserEvent;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentLiked;
use Railroad\Railforums\EventListeners\PostEventListener;
use Railroad\Railforums\EventListeners\ThreadEventListener;
use Railroad\Railforums\Events\PostCreated;
use Railroad\Railforums\Events\PostDeleted;
use Railroad\Railforums\Events\PostLiked;
use Railroad\Railforums\Events\ThreadCreated;
use Railroad\Railforums\Events\ThreadDeleted;
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
            NotificationEventListener::class . '@handlePostLiked',
        ],
        PostCreated::class => [
            NotificationEventListener::class . '@handlePostCreated',
            PostEventListener::class . '@onPostCreated'
        ],
        PostDeleted::class => [
            PostEventListener::class . '@onPostDeleted'
        ],
        ThreadCreated::class => [
            ThreadEventListener::class . '@onCreated',
        ],
        ThreadDeleted::class => [
            ThreadEventListener::class . '@onDeleted',
        ],
        CommentCreated::class => [
            NotificationEventListener::class . '@handleCommentCreated',
        ],
        CommentLiked::class => [
            NotificationEventListener::class . '@handleCommentLiked',
        ],
        UserEvent::class => [
            AuthenticationEventListener::class . '@handleUserAuthenticated'
        ]
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
