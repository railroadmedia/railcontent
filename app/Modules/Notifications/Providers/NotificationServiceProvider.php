<?php

namespace App\Modules\Notifications\Providers;

use App\Modules\Notifications\Console\Commands\DailySummaryNotifications;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentLiked;
use App\Modules\Notifications\Listeners\NotificationListener as NotificationEventListener;
use Railroad\Railforums\Events\PostCreated;
use Railroad\Railforums\Events\PostLiked;

class NotificationServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostLiked::class => [
            NotificationEventListener::class . '@handlePostLiked',
        ],
        PostCreated::class => [
            [NotificationEventListener::class, 'handlePostCreated'],
        ],
        CommentCreated::class => [
            NotificationEventListener::class . '@handleCommentCreated',
        ],
        CommentLiked::class => [
            NotificationEventListener::class . '@handleCommentLiked',
        ],
    ];

    public function boot(): void
    {

        $this->commands([
            DailySummaryNotifications::class,
        ]);
    }
}
