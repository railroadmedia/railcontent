<?php

namespace App\Listeners\Authentication;

use Modules\UserManagementSystem\Events\UserEvent;

class AuthenticationEventListener
{
    public function handleUserAuthenticated(UserEvent $userEvent)
    {
        if ($userEvent->getEventType() == 'authenticated') {
            session()->flash('logged_in_recently');
        }
    }
}
