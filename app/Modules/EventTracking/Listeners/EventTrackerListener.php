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
        Avo::account_created(AvoHelper::defaultEventProperties());
    }
}
