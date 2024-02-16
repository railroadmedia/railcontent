<?php

namespace App\Listeners\Authentication;

use Illuminate\Auth\Events\Authenticated;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Models\User;

class AuthenticationEventListener
{
    public function handleUserAuthenticated(UserEvent $userEvent)
    {
        if ($userEvent->getEventType() == 'authenticated') {
            session()->flash('logged_in_recently');
        }
    }

    public function handleAuthenticatedEvent(Authenticated $authenticatedEvent)
    {
        /** @var User $user */
        $user = $authenticatedEvent->user;
        if ($user->needs_logout) {
            $user->update(['needs_logout' => false]);
        }
    }
}
