<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Models\User;

class AuthenticationController extends Controller
{
    use ValidatesRequests;

    /**
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     */
    public function loginCookie(Request $request)
    {
        try {
            $validationRules = [
                'email' => 'required|string',
                'password' => 'required|string',
            ];

            $this->validate(
                $request,
                $validationRules
            );
        } catch (ValidationException $exception) {
            return redirect()
                ->to(
                    config('user_management_system.login_page_path').
                    ($request->has('redirect') ? ('?redirect_to='.$request->get('redirect')) : '')
                )
                ->withErrors($exception->errors());
        }

        $remember = false;

        if (config('user_management_system.force_remember', false) == true ||
            (boolean)$request->get('remember', false) == true) {
            $remember = true;
        }

        $request->attributes->set('remember', $remember);

        $passedCheck = auth()->guard('user-management-system')
            ->validate(['email' => $request->get('email'), 'password' => $request->get('password')]);

        if ($passedCheck) {
            $user = User::query()->where(['email' => $request->get('email')])->firstOrFail();

            auth()->login($user, $remember);

            event(new UserEvent($user->id, 'authenticated'));

            return redirect()->to($request->has('redirect') ? $request->get('redirect') : '/members');
        }

        return redirect()
            ->to(
                config('user_management_system.login_page_path').
                ($request->has('redirect') ? ('?redirect_to='.$request->get('redirect')) : '')
            )
            ->withErrors(
                ['invalid-credentials' => 'Wrong password or email. Try again or click Forgot password to reset it.']
            );
    }

    /**
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     */
    public function loginToken(Request $request)
    {
        try {
            $validationRules = [
                'email' => 'required|string',
                'password' => 'required|string',
                'device_name' => 'required|string',
            ];

            $this->validate(
                $request,
                $validationRules
            );
        } catch (ValidationException $exception) {
            return response()->json(['errors' => $exception->errors()]);
        }

        $remember = false;

        if (config('user_management_system.force_remember', false) == true ||
            (boolean)$request->get('remember', false) == true) {
            $remember = true;
        }

        $request->attributes->set('remember', $remember);

        $passedCheck = auth()->guard('user-management-system')
            ->validate(['email' => $request->get('email'), 'password' => $request->get('password')]);

        if ($passedCheck) {
            $user = User::query()->where(['email' => $request->get('email')])->firstOrFail();

            auth()->login($user, $remember);

            event(new UserEvent($user->id, 'authenticated'));

            event(
                new MobileAppLogin($user, $request->get('firebase_token'), $request->get('platform'))
            );

            $token = $user->createToken($request->get('device_name'));

            return response()->json(['token' => $token->plainTextToken, 'user' => $user]);
        }

        throw new AuthenticationException();
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function logoutCookie(Request $request)
    {
        $user = auth()->user();

        if (!empty($user)) {
            auth()->logout();
        }

        return $request->has('redirect') ? redirect()->away($request->get('redirect')) :
            redirect()->to(config('usora.login_page_path'));
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function logoutToken(Request $request)
    {
        $user = auth()->user();

        dd($user->currentAccessToken());

        if (!empty($request->bearerToken())) {
            user()->tokens()->where('token', $request->bearerToken())->delete();
        }

        return $request->has('redirect') ? redirect()->away($request->get('redirect')) :
            redirect()->to(config('usora.login_page_path'));
    }
}
