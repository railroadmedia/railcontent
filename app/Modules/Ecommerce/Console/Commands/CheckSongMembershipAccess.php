<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;

class CheckSongMembershipAccess extends Command
{
    protected $signature = 'ecommerce:CheckSongMembershipAccess';

    protected $description = 'check song user access and update user membership_level';

    public function handle(
        UserAccessPermissionsService $accessPermissionsService,
        UserService $userService
    ) {
        $users = User::query()
            ->whereHas('userAccessPermissions', function (Builder $query) {
                $query->where('permission_id', UserAccessPermissionsCollection::SongsOnlyMembershipPermission);
            })
            ->where('membership_level', 'plus')
            ->with('userAccessPermissions')
            ->get();

        $shouldUpdate = [];
       foreach ($users as $user) {
            $shouldModify = true;
            foreach ($user->userAccessPermissions as $userPermission) {
                if ($userPermission->permission_id == UserAccessPermissionsCollection::MusoraPlusMembershipPermission) {
                    $time = $userPermission->time_fixed ?? $userPermission->start_time;
                    $expirationDate =
                        Carbon::parse($time)
                            ->addMonths($userPermission->time_months)
                            ->addDays($userPermission->time_days)
                            ->addHours($userPermission->time_hours)
                            ->addMinutes($userPermission->time_minutes);
                    if ($expirationDate >
                        Carbon::now()
                            ->subDays(7)) {
                        $shouldModify = false;
                    }
                }
                if ($userPermission->permission_id == UserAccessPermissionsCollection::SongsOnlyMembershipPermission) {
                    $time = $userPermission->time_fixed ?? $userPermission->start_time;
                    $expirationDate =
                        Carbon::parse($time)
                            ->addMonths($userPermission->time_months)
                            ->addDays($userPermission->time_days)
                            ->addHours($userPermission->time_hours)
                            ->addMinutes($userPermission->time_minutes);
                    if ($expirationDate->addDays(7) > Carbon::now()) {
                        $shouldModify = false;
                    }
                }
            }
            if ($shouldModify == true) {
                $user->membership_level = 'basic';
                $user->save();
                $shouldUpdate[$userIdOrEmail] = $userIdOrEmail;
            }
        }
        $this->info('User IDs('.count($shouldUpdate).') that be should modified::');
        $this->info(print_r($shouldUpdate, true));
    }
}
