<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentLiked;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railforums\EventListeners\ThreadEventListener;
use Railroad\Railforums\Events\PostCreated;
use Railroad\Railforums\Events\PostLiked;
use Railroad\Railforums\Events\ThreadCreated;
use Railroad\Railnotifications\Listeners\NotificationEventListener;
use Railroad\Railtracker\Events\MediaPlaybackTracked;
use App\Listeners\Content\ContentProgressEventListener;

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
        ThreadCreated::class => [
            ThreadEventListener::class.'@onCreated',
        ],
        CommentCreated::class => [
            NotificationEventListener::class.'@handleCommentCreated',
        ],
        CommentLiked::class =>[
            NotificationEventListener::class.'@handleCommentLiked',
        ],
//        MediaPlaybackTracked::class => [
//            ContentProgressEventListener::class . '@handleMediaPlaybackTracked',
//        ],
        UserContentProgressSaved::class => [
            ContentProgressEventListener::class . '@handleUserProgressSaved',
        ],
        UserContentsProgressReset::class => [
            ContentProgressEventListener::class . '@handleReset',
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
