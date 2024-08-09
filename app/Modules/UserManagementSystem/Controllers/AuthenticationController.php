<?php

namespace Modules\UserManagementSystem\Controllers;

use App\Modules\UserManagementSystem\Services\UserAuthenticationService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthenticationController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function __construct(private readonly UserAuthenticationService $userAuthenticationService)
    {
    }

    /*******************************************************************************************************************
     * New web log in flow
     ******************************************************************************************************************/
    public function checkEmail(Request $request): JsonResponse
    {
        ['email' => $email] = $request->validate([
            'email' => 'required|email|exists:usora_users,email',
        ]);

        /** @var User $user */
        $user = User::firstWhere('email', $email);

        if ($user->doesRequirePasswordUpdate()) {
            Auth::logout(); // make sure there are no active sessions
            $this->userAuthenticationService->sendSetupAccountEmail($user);

            return response()->json([
                'message' => 'User requires password update. Email sent to user.',
                'is_setup' => false,
                'links' => [
                    'resend-email' => route('user_management_system.login.send-account-setup-email'),
                ],
            ], 200);
        }

        return response()->json([
            'message' => 'success',
            'is_setup' => true,
            'links' => [
                'login' => route('user_management_system.login'),
            ],
        ], 200);
    }

    public function sendAccountSetupEmail(Request $request): JsonResponse
    {
        ['email' => $email] = $request->validate([
            'email' => 'required|email|exists:usora_users,email',
        ]);

        /** @var User $user */
        $user = User::firstWhere('email', $email);

        $this->userAuthenticationService->sendSetupAccountEmail($user);
        return response()->json();
    }

    /**
     * @throws AuthenticationException
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:usora_users,email',
                'password' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $email = $request->get('email');
        $password = $request->get('password');

        $remember = config('user_management_system.force_remember', false) || (bool)$request->get('remember', false);

        $request->attributes->set('remember', $remember);

        if ($this->userAuthenticationService->authenticate($email, $password)) {
            $user = User::firstWhere('email', $email);

            auth()->login($user, $remember);

            $this->authenticated($user, $password);

            return response()->json([
                'message' => 'success',
                'redirect_to' => $request->get('redirect_to', '/' . brand()),
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    /*******************************************************************************************************************
     * Old web log in flow
     ******************************************************************************************************************/
    /**
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     * @throws AuthenticationException
     */
    public function loginCookie(Request $request): RedirectResponse
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

        if (
            config('user_management_system.force_remember', false) == true ||
            (bool)$request->get('remember', false) == true
        ) {
            $remember = true;
        }

        $request->attributes->set('remember', $remember);

        $passedCheck = auth()->guard('user-management-system')
            ->validate(['email' => $request->get('email'), 'password' => $request->get('password')]);

        if ($passedCheck) {
            $user = User::query()->where(['email' => $request->get('email')])->firstOrFail();

            auth()->login($user, $remember);

            $this->authenticated($user, $request->get('password'));

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
    public function loginGeneratedKey(Request $request): RedirectResponse
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
    public function checkForAuthThenRedirectBackWithAuthKey(Request $request): RedirectResponse
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
    public function loginToken(Request $request): JsonResponse
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

        if (
            config('user_management_system.force_remember', false) == true ||
            (bool)$request->get('remember', false) == true
        ) {
            $remember = true;
        }

        $request->attributes->set('remember', $remember);

        $passedCheck = auth()->guard('user-management-system')
            ->validate(['email' => $request->get('email'), 'password' => $request->get('password')]);

        if ($passedCheck) {
            $user = User::query()->where(['email' => $request->get('email')])->firstOrFail();

            auth()->login($user, $remember);

            $this->authenticated($user, $request->get('password'));

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
    public function logoutCookie(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if (!empty($user)) {
            auth()->logout();
            session()->flush();
        }

        return $request->has('redirect_to') ? redirect()->away($request->get('redirect_to')) :
            redirect()->to(config('usora.login_page_path'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logoutToken(Request $request): JsonResponse
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
    public function loginAsUser(Request $request, $userId): RedirectResponse
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


    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return void
     * @throws AuthenticationException
     */
    private function authenticated(User $user, string $password): void
    {
        if ($user->needs_logout) {
            Log::info("User $user->id has authenticated for the first time after needing to log out. Logging user out of other devices.");
            $user->update(['needs_logout' => false]);
            Auth::guard('user-management-system')->logoutOtherDevices($password);
        }

        event(new UserEvent($user->id, 'authenticated'));
    }
}
