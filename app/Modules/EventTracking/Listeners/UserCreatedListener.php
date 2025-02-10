<?php

namespace App\Modules\EventTracking\Listeners;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;
use Railroad\Usora\Events\User\UserCreated as UsoraUserCreated;

class UserCreatedListener implements ShouldQueue
{
    public function handle(UsoraUserCreated|UserCreated $event): void
    {
        if ($event instanceof UsoraUserCreated) {
            /** @var User $user */
            $user =  User::find($event->getUser()->getId());
        } else {
            $user = $event->user;
        }

        $properties = [
            'account_created_at' => Carbon::parse($user->created_at)->toIso8601String(),
        ];

        // Only use origin if it's MWP's UserCreated event
        if ($event instanceof UserCreated && $event->originOfCreation) {
            $properties['platform'] = $event->originOfCreation;
        }

        Avo::account_created(
            AvoHelper::defaultEventProperties(
                $properties,
                $user
            )
        );
    }
}
