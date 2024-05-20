<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\MessageBag;

class ForgotPasswordController extends Controller
{
    //https://dev.musora.com:8443/user-management-system/password/password-reset-form?token=3D9e7849f88258c6dfe08fb901bae4bb5d6e3261a8c4fef02aec98c5d016cdf512&email=caleb+lifetime_all_brands_1@drumeo.com
    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:' . config('user_management_system.database_connection_name') . '.usora_users']);

        $response =
            $this->broker()
                ->sendResetLink(
                    $request->only('email')
                );

        if (!request()->expectsJson()) {
            if ($response === Password::RESET_LINK_SENT) {
                session()->put('skip-third-party-auth-check', true);

                return redirect()
                    ->to(config('user_management_system.login_page_path'))
                    ->with(
                        'status',
                        'Password reset link has been sent to your email.'
                    );
            }

            return back()->withErrors(
                ['email' => 'Failed to reset password, please double check your email or contact support.']
            );
        } else {
            if ($response === Password::RESET_LINK_SENT) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Password reset link has been sent to your email.',
                    ]
                );
            }
            return response()->json(
                [
                    'success' => false,
                    'errors' => 'Failed to reset password, please double check your email or contact support.',
                ]
            );
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
