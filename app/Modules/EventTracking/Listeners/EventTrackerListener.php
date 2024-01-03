<?php

namespace App\Modules\EventTracking\Listeners;

use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\EventTracking\Events\ReferralPageViewed;
use Avo;
use Modules\UserManagementSystem\Events\User\UserCreated;

class EventTrackerListener
{
    /**
     * @param UserCreated $event
     */
    public function handleUserCreated(UserCreated $event): void
    {
        /*
         * @TODO EVENT TRACKING:
         *
         * This event is going to be responsible for creating the user profile in CustomerIO. Thus:
         *      - We need to migrate the user attributes that are sent to CustomerIO upon profile creation when we
         *        get rid of the old CustomerIoService.
         *      - Handle multiple ids in CustomerIO with id (using musora user id) and email so we can merge them and
         *        get rid of the customer_io_customer
         */

        $user = $event->getUser();
        Avo::account_created(
            AvoHelper::defaultEventProperties(['account_created_at' => $user->created_at->timestamp], $user)
        );
    }

    public function handleReferralPageViewed(ReferralPageViewed $event): void
    {
        // @TODO EVENT TRACKING: trigger event on Avo/Rudderstack
//        Avo::referral_page_viewed(
//            AvoHelper::defaultEventProperties(
//                ['referral_code' => $event->getReferralCode(), 'brand' => $event->getBrand()],
//                $event->getUser()
//            )
//        );
    }


    public function handleReferralLinkCopied(ReferralPageViewed $event): void
    {
        // @TODO EVENT TRACKING: trigger event on Avo/Rudderstack
//        Avo::referral_link_copied(
//            AvoHelper::defaultEventProperties(
//                ['referral_code' => $event->getReferralCode(), 'brand' => $event->getBrand()],
//                $event->getUser()
//            )
//        );
    }
}
