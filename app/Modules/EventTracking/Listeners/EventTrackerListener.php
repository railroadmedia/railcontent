<?php

namespace App\Modules\EventTracking\Listeners;

use Avo;
use Modules\UserManagementSystem\Events\User\UserCreated;

class EventTrackerListener
{
    /**
     * @param UserCreated $userCreated
     */
    public function handleUserCreated(UserCreated $event): void
    {
        Avo::account_created([
            'user_id_' => strval($event->getUser()->id),
            'musora_user_id' => $event->getUser()->id
        ]);
    }
}
