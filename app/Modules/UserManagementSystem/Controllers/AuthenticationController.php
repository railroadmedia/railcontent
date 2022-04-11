<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\DataTransferObjects\AuthenticationType;
use Modules\UserManagementSystem\Models\User;

class AuthenticationController extends Controller
{
    use ValidatesRequests;

    /**
     * @param Request $request
     * @param AuthenticationType $authenticationType
     * @return JsonResponse|RedirectResponse
     */
    public function login(Request $request, AuthenticationType $authenticationType)
    {
        try {
            $validationRules = [
                'email' => 'required|string',
                'password' => 'required|string',
            ];

            // we need a device name if token auth is being requested
            if ($authenticationType == AuthenticationType::Token) {
                $validationRules['device_name'] = 'required|string';
            }

            $this->validate(
                $request,
                $validationRules
            );
        } catch (ValidationException $exception) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $exception->errors()]);
            }

            return redirect()
                ->to(
                    config('user_management_system.login_page_path') .
                    ($request->has('redirect') ? ('?redirect_to=' . $request->get('redirect')) : '')
                )
                ->withErrors($exception->errors());
        }

        $passedCheck = auth()->guard('user-management-system')
            ->validate(['email' => $request->get('email'), 'password' => $request->get('password')]);

        if ($passedCheck) {
            $user = User::query()->where(['email' => $request->get('email')])->firstOrFail();

            auth()->login($user);

            // return token if client want a token to use the json api
            if ($authenticationType == AuthenticationType::Token && $request->wantsJson()) {
                $token = $user->createToken($request->get('device_name'));

                return response()->json(['token' => $token->plainTextToken, 'user' => $user]);
            }

            // do web cookie auth
            if ($authenticationType == AuthenticationType::Cookie &&
                auth()->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
                // todo: this needs to go to the users last used brand home page or the one stored in this devices cookie
                return redirect()->to($request->get('redirect', '/members'));
            }
        }

        if ($authenticationType == AuthenticationType::Token && $request->wantsJson()) {
            throw new AuthenticationException();
        }

        return redirect()
            ->to(
                config('user_management_system.login_page_path') .
                ($request->has('redirect') ? ('?redirect_to=' . $request->get('redirect')) : '')
            )
            ->withErrors(
                ['invalid-credentials' => 'Wrong password or email. Try again or click Forgot password to reset it.']
            );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        session()->put('skip-third-party-auth-check', true);

        $user = auth()->user();

        if (!empty($user)) {
            auth()->logout();
        }

        return $request->has('redirect') ? redirect()->away($request->get('redirect')) :
            redirect()->to(config('usora.login_page_path'));
    }
}
