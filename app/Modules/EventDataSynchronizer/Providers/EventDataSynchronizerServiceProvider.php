<?php

namespace App\Modules\EventDataSynchronizer\Providers;

use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\EventDataSynchronizer\Console\Commands\CustomerIOSyncUser;
use App\Modules\EventDataSynchronizer\Console\Commands\ExpiredProductResync;
use App\Modules\EventDataSynchronizer\Console\Commands\MigrateMinutesWatchedPoints;
use App\Modules\EventDataSynchronizer\Console\Commands\PackBonusExpirationDateResyncTool;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncCustomerIoOrders;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncPoints;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncUserTotalXp;
use App\Modules\EventDataSynchronizer\Console\Commands\UserContentProductPermissionsResyncTool;
use App\Modules\EventDataSynchronizer\Console\Commands\UserMembershipOwnedProductSyncTool;
use App\Modules\EventDataSynchronizer\Listeners\SubscriptionSyncListener;
use App\Modules\Mentor\Events\StudentMentorsUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Railroad\Ecommerce\Events\AccessCodeClaimed;
use Railroad\Ecommerce\Events\AppSignupFinishedEvent;
use Railroad\Ecommerce\Events\AppSignupStartedEvent;
use Railroad\Ecommerce\Events\AugustContestReferralClaimed;
use Railroad\Ecommerce\Events\MobileOrderEvent;
use Railroad\Ecommerce\Events\MobilePaymentEvent;
use Railroad\Ecommerce\Events\OrderEvent;
use Railroad\Ecommerce\Events\PaymentEvent;
use Railroad\Ecommerce\Events\PaymentMethods\PaymentMethodCreated;
use Railroad\Ecommerce\Events\PaymentMethods\PaymentMethodUpdated;
use Railroad\Ecommerce\Events\Subscriptions\CommandSubscriptionRenewFailed;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionCreated;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionRenewed;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionRenewFailed;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionUpdated;
use Railroad\Ecommerce\Events\UserProducts\UserProductCreated;
use Railroad\Ecommerce\Events\UserProducts\UserProductDeleted;
use Railroad\Ecommerce\Events\UserProducts\UserProductUpdated;
use App\Modules\EventDataSynchronizer\Console\Commands\HelpScoutIndex;
use App\Modules\EventDataSynchronizer\Console\Commands\ProductOwnerUserFieldResyncTool;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncCustomerIoExistingDevices;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncCustomerIoForUpdatedUserProductsAndSubscriptions;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncCustomerIoOldEvents;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncExistingHelpScout;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncHelpScout;
use App\Modules\EventDataSynchronizer\Console\Commands\SyncHelpScoutAsync;
use App\Modules\EventDataSynchronizer\Console\Commands\UserContentPermissionsResyncTool;
use App\Modules\EventDataSynchronizer\Console\Commands\UserMembershipFieldsResyncTool;
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
use Railroad\Referral\Events\ReferralClaimed;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Railroad\Referral\Events\EmailInvite;

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
        PaymentMethodCreated::class => [
            CustomerIoSyncEventListener::class . '@handleUserPaymentMethodCreated',
        ],
        PaymentMethodUpdated::class => [
            CustomerIoSyncEventListener::class . '@handleUserPaymentMethodUpdated',
        ],
        UserProductCreated::class => [
            CustomerIoSyncEventListener::class . '@handleUserProductCreated',
            UserProductToUserContentPermissionListener::class . '@handleCreated',
            HelpScoutEventListener::class . '@handleUserProductCreated',
            UserMembershipFieldsListener::class . '@handleUserProductCreated',
        ],
        UserProductUpdated::class => [
            CustomerIoSyncEventListener::class . '@handleUserProductUpdated',
            UserProductToUserContentPermissionListener::class . '@handleUpdated',
            HelpScoutEventListener::class . '@handleUserProductUpdated',
            UserMembershipFieldsListener::class . '@handleUserProductUpdated',
        ],
        UserProductDeleted::class => [
            CustomerIoSyncEventListener::class . '@handleUserProductDeleted',
            UserProductToUserContentPermissionListener::class . '@handleDeleted',
            HelpScoutEventListener::class . '@handleUserProductDeleted',
            UserMembershipFieldsListener::class . '@handleUserProductDeleted',
        ],
        UserAccessPermissionsUpdated::class => [
            CustomerIoSyncEventListener::class . '@handleUserAccessPermissionsUpdated',
            UserProductToUserContentPermissionListener::class . '@handleUserAccessPermissionsUpdated',
            HelpScoutEventListener::class . '@handleUserAccessPermissionsUpdated',
            UserMembershipFieldsListener::class . '@handleUserAccessPermissionsUpdated',
            SubscriptionSyncListener::class . '@handleUserAccessPermissionsUpdated',
        ],
        SubscriptionCreated::class => [
            CustomerIoSyncEventListener::class . '@handleSubscriptionCreated',
            HelpScoutEventListener::class . '@handleSubscriptionCreated',
        ],
        SubscriptionUpdated::class => [
            CustomerIoSyncEventListener::class . '@handleSubscriptionUpdated',
            HelpScoutEventListener::class . '@handleSubscriptionUpdated',
        ],
        SubscriptionRenewed::class => [
            CustomerIoSyncEventListener::class . '@handleSubscriptionRenewed',
            HelpScoutEventListener::class . '@handleSubscriptionRenewed',
        ],
        SubscriptionRenewFailed::class => [
            CustomerIoSyncEventListener::class . '@handleSubscriptionRenewalAttemptFailed',
            HelpScoutEventListener::class . '@handleSubscriptionRenewalAttemptFailed',
        ],
        OrderEvent::class => [
            CustomerIoSyncEventListener::class . '@handleOrderPlaced',
        ],
        PaymentEvent::class => [
            CustomerIoSyncEventListener::class . '@handlePaymentPaid',
        ],

        AppSignupStartedEvent::class => [
            CustomerIoSyncEventListener::class . '@handleAppSignupStarted',
        ],
        AppSignupFinishedEvent::class => [
            CustomerIoSyncEventListener::class . '@handleAppSignupFinished',
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
        CommandSubscriptionRenewFailed::class => [
            UserProductToUserContentPermissionListener::class . '@handleSubscriptionRenewalFailureFromDatabaseError'
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
        MobileOrderEvent::class => [

        ],
        MobilePaymentEvent::class => [
            CustomerIoSyncEventListener::class . '@handleMobilePaymentPlaced',
        ]
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
                SyncCustomerIoForUpdatedUserProductsAndSubscriptions::class,
                UserContentPermissionsResyncTool::class,
                UserContentProductPermissionsResyncTool::class,
                PackBonusExpirationDateResyncTool::class,
                SyncHelpScout::class,
                SyncExistingHelpScout::class,
                HelpScoutIndex::class,
                SyncHelpScoutAsync::class,
                SyncCustomerIoOldEvents::class,
                SyncCustomerIoExistingDevices::class,
                UserMembershipFieldsResyncTool::class,
                UserMembershipOwnedProductSyncTool::class,
                ProductOwnerUserFieldResyncTool::class,
                SyncUserTotalXp::class,
                IsDrumeoLifetimeUserFieldResyncTool::class,
                CustomerIOSyncUser::class,
                ExpiredProductResync::class,
                MigrateMinutesWatchedPoints::class,
                SyncPoints::class,
                SyncCustomerIoOrders::class,
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
