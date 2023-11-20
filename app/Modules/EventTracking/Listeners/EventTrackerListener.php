<?php

namespace App\Modules\EventTracking\Listeners;

use App\Modules\EventTracking\Avo\AvoHelper;
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

        // @TODO EVENT TRACKING: enable Avo event trigger here when migration from CustomerIO is done.
        // The Avo event trigger is being executed in the CustomerIoSyncNewUserByEmail job. That logic is going to be
        // migrated to this function when migrating the CustomerIO setup.
        // Avo::account_created(AvoHelper::defaultEventProperties());
    }
}
