<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Services\AccessCodeService;
use App\Modules\UserManagementSystem\Services\UserAuthenticationService;
use App\Modules\UserManagementSystem\Services\UserService;
use Illuminate\Routing\Controller;
use App\Modules\Ecommerce\Requests\AccessCodeClaimRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class AccessCodeController extends Controller
{
    private AccessCodeService $accessCodeService;
    private UserService $userService;
    private UserAuthenticationService $userAuthenticationService;

    public function __construct(
        AccessCodeService $accessCodeService,
        UserService $userService,
        UserAuthenticationService $userAuthenticationService
    ) {
        $this->accessCodeService = $accessCodeService;
        $this->userService = $userService;
        $this->userAuthenticationService = $userAuthenticationService;
    }

    public function claim(AccessCodeClaimRequest $request): JsonResponse
    {
        if ($request->get('credentials_type') === 'existing') {
            if (auth()->check()) {
                $user = auth()->user();
            } elseif ($this->userAuthenticationService->authenticate(
                $request->get('email'),
                $request->get('password')
            )) {
                $user = $this->userService->getByEmailOrNull($request->get('email'));
            } else {
                return response()->json(['error' => 'Invalid Credentials'], status: 401);
            }
        } else {
            $user = $this->userService->createUser($request->get('email'), $request->get('password'));
        }

        $rawAccessCode = $request->get('access_code');

        try {
            $this->accessCodeService->claim($rawAccessCode, $user, $request->get('context'));
        } catch (Throwable $e) {
            $message = [
                'access-code-claimed-success' => false,
                'access-code-claimed-message' => $e->getMessage(),
            ];
            return response()->json($message, 400);
        }

        $this->userAuthenticationService->login($user);

        $message = [
            'access-code-claimed-success' => true,
            'access-code-claimed-message' => 'Your access code has been claimed successfully!',
        ];

        return response()->json($message);
    }
}
