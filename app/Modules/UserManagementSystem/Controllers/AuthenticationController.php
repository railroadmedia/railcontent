<?php

namespace Modules\UserManagementSystem\Controllers;

use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthenticationController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     * @throws AuthenticationException
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
                    config('user_management_system.login_page_path') .
                    ($request->has('redirect_to') ? ('?redirect_to=' . $request->get('redirect_to')) : '')
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
            if ($user->needs_logout) {
                Auth::logoutOtherDevices($request->get('password'));
                $user->update(['needs_logout' => false]);
            }
            auth()->login($user, $remember);

            event(new UserEvent($user->id, 'authenticated'));

            return redirect()->away($request->has('redirect_to') ? $request->get('redirect_to') : '/' . brand());
        }

        return redirect()
            ->to(
                config('user_management_system.login_page_path') .
                ($request->has('redirect_to') ? ('?redirect_to=' . $request->get('redirect_to')) : '')
            )
            ->withErrors(
                ['invalid-credentials' => 'Wrong password or email. Try again or click Forgot password to reset it.']
            );
    }
    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function loginGeneratedKey(Request $request)
    {
        // auth logic is not inside middleware AuthenticateViaKeyIfAvailable

        if (!empty(user())) {
            return redirect()->to($request->has('redirect_to') ? $request->get('redirect_to') : '/' . brand());
        }

        return redirect()
            ->to(
                config('user_management_system.login_page_path') .
                ($request->has('redirect_to') ? ('?redirect_to=' . $request->get('redirect_to')) : '')
            )
            ->withErrors(
                ['invalid-credentials' => 'Wrong password or email. Try again or click Forgot password to reset it.']
            );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function checkForAuthThenRedirectBackWithAuthKey(Request $request)
    {
        $redirectToUrl = strtok($request->get('redirect_to'), '?');

        if (empty($redirectToUrl)) {
            throw new NotFoundHttpException();
        }

        if (!empty(user())) {
            $urlWithAuthKey = $redirectToUrl .
                '?user_id=' . user()->id .
                '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password);

            return redirect()->away($urlWithAuthKey);
        }

        return redirect()->away($redirectToUrl);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     * @throws AuthenticationException
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
            if ($user->needs_logout) {
                Auth::logoutOtherDevices($request->get('password'));
                $user->update(['needs_logout' => false]);
            }
            auth()->login($user, $remember);

            event(new UserEvent($user->id, 'authenticated'));

            event(
                new MobileAppLogin($user, $request->get('firebase_token'), $request->get('platform'))
            );

            $token = $user->createToken($request->get('device_name'));
            $user->withAccessToken($token);
            $user['login_as_users'] = user()->hasRole('login_as_users');

            $attributes = $user->toArray();
            $toRemove = ['shopify_id'];
            $attributes = array_diff_key($attributes, array_flip($toRemove));
            return response()->json(['token' => $token->plainTextToken, 'user' => $attributes]);
        }

        return response()->json(
            [
                'success' => false,
                "message" => 'Invalid Email or Password'
            ]
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logoutCookie(Request $request)
    {
        $user = auth()->user();

        if (!empty($user)) {
            auth()->logout();
        }

        return $request->has('redirect_to') ? redirect()->away($request->get('redirect_to')) :
            redirect()->to(config('usora.login_page_path'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logoutToken(Request $request)
    {
        $user = auth()->user();

        if (!empty($user) && !empty($user->currentAccessToken())) {
            $user->currentAccessToken()->delete();
            auth()->logout();
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Successfully logged out',
            ]
        );
    }

    /**
     * @param Request $request
     * @param $userId
     * @return RedirectResponse
     */
    public function loginAsUser(Request $request, $userId)
    {
        $this->authorize('login_as_users');

        if (!empty(user()) && user()->isAdmin()) {
            auth()->logout();
            auth()->loginUsingId($userId);

            $user = auth()->user();
            $token = $user->createToken('ios');
            $user->withAccessToken($token);

            return $request->wantsJson()
                ? response()->json(['token' => $token->plainTextToken, 'user' => $user])
                : redirect()->to('/members');
        }

        throw new NotFoundHttpException();
    }
}
