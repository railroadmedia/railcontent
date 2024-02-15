<?php

namespace App\Listeners\Authentication;

use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Models\User;

class AuthenticationEventListener
{
    public function handleUserAuthenticated(UserEvent $userEvent)
    {
        if ($userEvent->getEventType() == 'authenticated') {
            session()->flash('logged_in_recently');
            $user = User::find($userEvent->getId());
            if ($user?->needs_logout) {
                $user->needs_logout = false;
                $user->save();
            }
        }
    }
}
