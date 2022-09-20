<?php

namespace App\Modules\EventDataSynchronizer\Services;

use App\Modules\UserManagementSystem\Services\UserService;

class CustomerIoMentorSyncService
{
    private UserService $userService;

    public function __construct(
        UserService $userService,
    ) {
        $this->userService = $userService;
    }

    public function getMentorAttributes(int $mentorUserId, ?string $primaryBrand): array
    {
        $mentorUser = $this->userService->getByIdOrNull($mentorUserId);
        $data = [];
        $data['assigned_mentor_email'] = $mentorUser?->email ?? '';
        $data['primary_brand'] = $primaryBrand ?? '';
        return $data;
    }
}
