<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
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
        $users =
            UserAccessPermission::query()
                ->join('usora_users', 'usora_users.id', '=', 'user_access_permissions.user_id')
                ->where('permission_id', '=', 94)
                ->where('permission_id', '!=', 92)
                ->where('usora_users.membership_level', '=', 'plus')
                ->get();

        $shouldUpdate = [];
        foreach ($users as $item) {
            $userIdOrEmail = $item['user_id'];
            $user = $userService->getByIdOrNull($userIdOrEmail);

            if (!$user) {
                $this->error("User $userIdOrEmail not found");
            }

            $shouldModify = true;

            foreach (
                $accessPermissionsService->getUserAccessPermissions($userIdOrEmail)
                    ->getCollection() as $userPermission
            ) {
                if ($userPermission->permission_id == 92) {
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
                if ($userPermission->permission_id == 94) {
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
