<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Resources\AccessCodeCollection;
use App\Modules\Ecommerce\Services\AccessCodeService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;


class AccessCodeJsonController extends Controller
{
    private AccessCodeService $accessCodeService;

    private PermissionService $permissionService;

    public function __construct(
        AccessCodeService $accessCodeService,
        PermissionService $permissionService,
    ) {
        $this->accessCodeService = $accessCodeService;
        $this->permissionService = $permissionService;
    }

    public function index(Request $request): ResourceCollection
    {
        $this->permissionService->canOrThrow(auth()->id(), 'pull.access_codes');
        $results = AccessCode::query()
            ->orderByRequest($request)
            ->paginate();
        return new AccessCodeCollection($results);
    }

    public function search(Request $request): ResourceCollection
    {
        $this->permissionService->canOrThrow(auth()->id(), 'pull.access_codes');

        $term = '%' . $request->get('term') . '%';
        $results = AccessCode::query()
            ->where('code', 'like', $term)
            ->orderByRequest($request)
            ->paginate();
        return new AccessCodeCollection($results);
    }

    public function claim(Request $request)
    {
        $this->permissionService->canOrThrow(auth()->id(), 'claim.access_codes');
        $userId = $request->get('claim_for_user_id');
        $rawAccessCode = $request->get('access_code');
        $context = $request->get('context');
        $this->accessCodeService->claimByUserId($rawAccessCode, $userId, $context);
    }

    public function release(Request $request)
    {
        $this->permissionService->canOrThrow(auth()->id(), 'release.access_codes');
        $accessCodeId = $request->get('access_code_id');
        $this->accessCodeService->release($accessCodeId);
    }
}
