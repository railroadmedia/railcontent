<?php

namespace App\Modules\EventDataSynchronizer\Providers;

use App\Modules\Ecommerce\Events\AccessCodeClaimed;
use App\Modules\Ecommerce\Events\AugustContestReferralClaimed;
use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\EventDataSynchronizer\Console\Commands\CustomerIOSyncUser;
use App\Modules\EventDataSynchronizer\Console\Commands\MigrateMinutesWatchedPoints;
use App\Modules\EventDataSynchronizer\Console\Commands\PackBonusExpirationDateResyncTool;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncPoints;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncUserTotalXp;
use App\Modules\EventDataSynchronizer\Console\Commands\UserContentProductPermissionsResyncTool;
use App\Modules\EventDataSynchronizer\Console\Commands\UserMembershipSyncByPermissions;
use App\Modules\EventDataSynchronizer\Console\Commands\UserMembershipSyncCustom;
use App\Modules\Mentor\Events\StudentMentorsUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use App\Modules\EventDataSynchronizer\Console\Commands\HelpScoutIndex;
use App\Modules\EventDataSynchronizer\Console\Commands\ProductOwnerUserFieldResyncTool;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncCustomerIoExistingDevices;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncExistingHelpScout;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncHelpScout;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncHelpScoutAsync;
use App\Modules\EventDataSynchronizer\Console\Commands\UserContentPermissionsResyncTool;
use App\Modules\EventDataSynchronizer\Console\Commands\IsDrumeoLifetimeUserFieldResyncTool;
use App\Modules\EventDataSynchronizer\Events\FirstActivityPerDay;
use App\Modules\EventDataSynchronizer\Events\LiveStreamEventAttended;
use App\Modules\EventDataSynchronizer\Events\UTMLinks;
use App\Modules\EventDataSynchronizer\Listeners\ContentProgressEventListener;
use App\Modules\EventDataSynchronizer\Listeners\CustomerIo\CustomerIoSyncEventListener;
use App\Modules\EventDataSynchronizer\Listeners\HelpScout\HelpScoutEventListener;
use App\Modules\EventDataSynchronizer\Listeners\UserMembershipFieldsListener;
use App\Modules\EventDataSynchronizer\Listeners\UserProductToUserContentPermissionListener;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentDeleted;
use Railroad\Railcontent\Events\CommentLiked;
use Railroad\Railcontent\Events\CommentUnLiked;
use Railroad\Railcontent\Events\ContentFollow;
use Railroad\Railcontent\Events\ContentUnfollow;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Events\UserContentsProgressReset;
use Railroad\Railcontent\Events\HigherKeyProgressUpdated;
use Railroad\Railforums\Events\PostCreated;
use Railroad\Railforums\Events\ThreadCreated;
use Railroad\Railtracker\Events\MediaPlaybackTracked;
use App\Modules\Referral\Events\ReferralClaimed;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use App\Modules\Referral\Events\EmailInvite;

class EventDataSynchronizerServiceProvider extends EventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserCreated::class => [
            CustomerIoSyncEventListener::class . '@handleUserCreated',
            HelpScoutEventListener::class . '@handleUserCreated',
        ],
        UserUpdated::class => [
            CustomerIoSyncEventListener::class . '@handleUserUpdated',
            HelpScoutEventListener::class . '@handleUserUpdated',
        ],
        UserAccessPermissionsUpdated::class => [
            CustomerIoSyncEventListener::class . '@handleUserAccessPermissionsUpdated',
            UserProductToUserContentPermissionListener::class . '@handleUserAccessPermissionsUpdated',
            HelpScoutEventListener::class . '@handleUserAccessPermissionsUpdated',
            UserMembershipFieldsListener::class . '@handleUserAccessPermissionsUpdated',
        ],
        CommentLiked::class => [
            CustomerIoSyncEventListener::class . '@handleCommentLiked',
            ContentProgressEventListener::class . '@handleCommentLiked',
        ],
        CommentUnLiked::class => [
            ContentProgressEventListener::class . '@handleCommentUnLiked',
        ],
        CommentCreated::class => [
            CustomerIoSyncEventListener::class . '@handleCommentCreated',
            ContentProgressEventListener::class . '@handleCommentCreated',
        ],
        CommentDeleted::class => [
            ContentProgressEventListener::class . '.@handleCommentDeleted',
        ],
        ThreadCreated::class => [
            CustomerIoSyncEventListener::class . '@handleForumsThreadCreated',
        ],
        PostCreated::class => [
            CustomerIoSyncEventListener::class . '@handleForumsPostCreated',
        ],
        UserContentProgressSaved::class => [
            ContentProgressEventListener::class . '@handleUserProgressSaved',
            CustomerIoSyncEventListener::class . '@handleUserContentProgressSaved',
        ],
        LiveStreamEventAttended::class => [
            CustomerIoSyncEventListener::class . '@handleLiveLessonAttended',
        ],
        FirstActivityPerDay::class => [
            CustomerIoSyncEventListener::class . '@handleFirstActivityPerDay',
        ],
        UTMLinks::class => [
//            CustomerIoSyncEventListener::class . '@handleUTMLinks',
        ],
        MobileAppLogin::class => [
            CustomerIoSyncEventListener::class . '@handleMobileAppLogin',
        ],
        ContentFollow::class => [
            CustomerIoSyncEventListener::class . '@handleContentFollow',
        ],
        ContentUnfollow::class => [
            CustomerIoSyncEventListener::class . '@handleContentUnfollow',
        ],
        EmailInvite::class => [
            CustomerIoSyncEventListener::class . '@handleReferralInvite',
        ],
        StudentMentorsUpdated::class => [
            CustomerIoSyncEventListener::class . '@handleMentorUpdated',
        ],
        UserContentsProgressReset::class => [
            ContentProgressEventListener::class . '@handleReset',
        ],
        MediaPlaybackTracked::class => [
            ContentProgressEventListener::class . '@handleMediaPlaybackTracked',
        ],
        HigherKeyProgressUpdated::class => [
            ContentProgressEventListener::class . '@handleHeighKeyProgressUpdates',
        ],
        AccessCodeClaimed::class => [
            CustomerIoSyncEventListener::class . '@handleAccessCodeClaimed',
        ],
        ReferralClaimed::class => [
            CustomerIoSyncEventListener::class . '@handleReferralClaimed',
        ],
        AugustContestReferralClaimed::class => [
            CustomerIoSyncEventListener::class . '@handleAugustContestReferralClaimed',
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->commands(
            [
                UserContentPermissionsResyncTool::class,
                UserContentProductPermissionsResyncTool::class,
                PackBonusExpirationDateResyncTool::class,
                SyncHelpScout::class,
                SyncExistingHelpScout::class,
                HelpScoutIndex::class,
                SyncHelpScoutAsync::class,
                SyncCustomerIoExistingDevices::class,
                UserMembershipSyncByPermissions::class,
                UserMembershipSyncCustom::class,
                ProductOwnerUserFieldResyncTool::class,
                SyncUserTotalXp::class,
                IsDrumeoLifetimeUserFieldResyncTool::class,
                CustomerIOSyncUser::class,
                MigrateMinutesWatchedPoints::class,
                SyncPoints::class,
            ]
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../config/event-data-synchronizer.php',
            'event-data-synchronizer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }
}
