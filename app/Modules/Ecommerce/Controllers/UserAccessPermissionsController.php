<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Resources\UserAccessPermissionResource;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class UserAccessPermissionsController extends Controller
{

    private UserAccessPermissionsService $userAccessPermissionsService;

    public function __construct(UserAccessPermissionsService $userAccessPermissionsService)
    {
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    public function index(Request $request)
    {
        $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissionsList(
            $request->get('user_id'),
            $request->get('page'),
            $request->get('limit')
        );
        $userAccessPermissions->determineActiveTimes();
        return UserAccessPermissionResource::collection($userAccessPermissions->getCollection()->sortBy('actualStartTime'));
    }

}
