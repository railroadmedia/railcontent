<?php

namespace App\Modules\EventTracking\Listeners;

use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\EventTracking\Services\CustomerIoService;
use Avo;
use Modules\UserManagementSystem\Events\User\UserCreated;

class EventTrackerListener
{
    private CustomerIoService $customerIoService;

    public function __construct(CustomerIoService $customerIoService)
    {
        $this->customerIoService = $customerIoService;
    }

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

        // wait for the original CustomerIoService to create the user profile
        sleep(5);

        Avo::account_created(AvoHelper::defaultEventProperties());
    }
}
