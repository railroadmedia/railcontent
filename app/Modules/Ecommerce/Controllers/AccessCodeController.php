<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Services\AccessCodeService;
use App\Modules\UserManagementSystem\Services\UserAuthenticationService;
use App\Modules\UserManagementSystem\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use App\Modules\Ecommerce\Requests\AccessCodeClaimRequest;
use Exception;

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

    public function claim(AccessCodeClaimRequest $request): RedirectResponse
    {
        if ($request->has('user_email')) {
            if ($this->userAuthenticationService->authenticate($request->get('user_email'), $request->get('user_password'))) {
                $user = $this->userService->getByEmailOrNull($request->get('user_email'));
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['Invalid credentials.']);
            }
        } else {
            $user = $this->userService->createUser($request->get('email'), $request->get('password'));
        }

        $rawAccessCode = $request->get('access_code');

        try {
            $accessCode = $this->accessCodeService->claim($rawAccessCode, $user, $request->get('context'));
        } catch (Exception $e) {
            redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'access-code-claimed-success' => false,
                    'access-code-claimed-message' => $e->getMessage(),
                ]);
        }

        $this->userAuthenticationService->login($user);

        $message = [
            'access-code-claimed-success' => true,
            'access-code-claimed-message' => 'Your access code has been claimed successfully!',
        ];

        $redirectRoute =
            (in_array($accessCode->brand, config('ecommerce.available_brands')) &&
                $accessCode->brand != 'musora') ? $accessCode->brand : "drumeo";

        return $request->has('redirect')
            ? redirect()->away($request->get('redirect'))->with($message)
            : redirect()->to('/' . $redirectRoute)->with($message);
    }
}
