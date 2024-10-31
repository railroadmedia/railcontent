<?php

return [
    App\Modules\EventDataSynchronizer\Providers\EventDataSynchronizerServiceProvider::class,
    App\Modules\Referral\Providers\ReferralServiceProvider::class,
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
    App\Providers\AppServiceProvider::class,
    App\Providers\NovaServiceProvider::class,
    App\Modules\DataVersion\ServiceProviders\DataVersionServiceProvider::class,
];
