<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */
        Railroad\Railcontent\Providers\RailcontentServiceProvider::class,
        Railroad\Response\Providers\ResponseServiceProvider::class,
        Railroad\Ecommerce\Providers\EcommerceServiceProvider::class,
        Railroad\Usora\Providers\UsoraServiceProvider::class,
        Railroad\Railforums\Providers\ForumServiceProvider::class,
        App\Modules\EventDataSynchronizer\Providers\EventDataSynchronizerServiceProvider::class,
        Railroad\Permissions\Providers\PermissionsServiceProvider::class,
        Railroad\MusoraApi\Providers\MusoraApiServiceProvider::class,
        Railroad\Railnotifications\NotificationsServiceProvider::class,
        App\Modules\Referral\Providers\ReferralServiceProvider::class,
        Railroad\Points\Providers\PointsServiceProvider::class,
        Railroad\Railtracker\Providers\RailtrackerServiceProvider::class,
        \Railroad\Railanalytics\AnalyticsServiceProvider::class,
        \Railroad\Location\Providers\LocationServiceProvider::class,
        \Railroad\RemoteStorage\Providers\RemoteStorageServiceProvider::class,
        \Railroad\LeadTracker\Providers\LeadTrackerServiceProvider::class,
        Jenssegers\Agent\AgentServiceProvider::class,

        /*
         * Module Service Providers
         */
        Modules\UserManagementSystem\Providers\UserManagementSystemServiceProvider::class,
        App\Modules\Brand\Providers\BrandServiceProvider::class,
        App\Modules\Ecommerce\Providers\EcommerceServiceProvider::class,
        App\Modules\Mentor\Providers\MentorServiceProvider::class,
        App\Modules\HelpScout\Providers\HelpScoutServiceProvider::class,
        App\Modules\CustomerIO\Providers\CustomerIoServiceProvider::class,
        App\Modules\Content\Providers\ContentServiceProvider::class,
        App\Modules\Notifications\Providers\NotificationServiceProvider::class,
        App\Modules\Reporting\Providers\ReportingServiceProvider::class,
        App\Modules\AddEventCalendars\Providers\AddEventCalendarsServiceProvider::class,
        App\Modules\EventTracking\Providers\EventTrackingServiceProvider::class,
        App\Modules\MusoraApi\Providers\MusoraApiServiceProvider::class,
        App\Modules\MusoraCenter\Providers\MusoraCenterServiceProvider::class,
        App\Modules\FeatureFlagging\Providers\FeatureFlaggingServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\NovaServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\VaporUiServiceProvider::class,

        Venturecraft\Revisionable\RevisionableServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        'Agent' => Jenssegers\Agent\Facades\Agent::class,
        'FeatureFlag' => App\Modules\FeatureFlagging\Facades\FeatureFlagging::class,
    ])->toArray(),

];
