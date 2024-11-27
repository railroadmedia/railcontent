<?php

namespace App\Modules\Content\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Railroad\Railcontent\Services\UserPermissionsService;

class UserPermissionsController extends Controller
{
    public function __construct(
        private readonly UserPermissionsService $userPermissionsService
    ) {
    }

    public function getUserPermissionData(): JsonResponse
    {
        $permissions = $this->userPermissionsService->getUserPermissions(user()->id);
        $data = [
            "permissions" => Arr::pluck($permissions, 'permission_id'),
            "isAdmin" => user()->isAdmin(),
            "isABasicMember" => user()->isABasicMember()
        ];
        return response()->json($data);
    }
}
