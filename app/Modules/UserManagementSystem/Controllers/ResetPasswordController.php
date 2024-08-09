<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\View\View;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Models\User;

class ResetPasswordController extends Controller
{
    use ValidatesRequests;

    public function passwordResetForm(Request $request): View
    {
        return view('pages.reset', $request->all());
    }

    /**
     * Reset the given user's password.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function resetPasswordWithToken(Request $request): RedirectResponse
    {
        $isJson = request()->expectsJson();

        try {
            $validationRules =
                [
                    'token' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|confirmed|min:8|max:128'
                ];
            $this->validate(
                $request,
                $validationRules
            );
        } catch (ValidationException $e) {
            $messagesByField = $e->validator->getMessageBag()->getMessages();
            $messagesForFieldFailingField = reset($messagesByField);

            foreach ($messagesForFieldFailingField as $messagesForField) {
                $errorMessageToUser = $messagesForField;
                break;
            }

            $default = 'Please try again, and contact support if the problem persists.';

            return redirect()
                ->back()
                ->withErrors(['password' => 'Password reset failed. Error: ' . ($errorMessageToUser ?? $default)]);
        }

        $response =
            $this->broker()
                ->reset(
                    $request->only(
                        'email',
                        'password',
                        'password_confirmation',
                        'token'
                    ),
                    function ($user, $password) {
                        $user->setPassword($password);
                        $user->save();

                        event(new PasswordReset($user));
                        auth()->loginUsingId($user->id);
                        event(new UserEvent($user->id, 'authenticated'));
                    }
                );

        if (!$isJson) {
            if ($response === Password::PASSWORD_RESET) {
                session()->put('skip-third-party-auth-check', true);

                return redirect()
                    ->to(config('user_management_system.login_success_redirect_path'))
                    ->with(
                        'success-message',
                        new MessageBag(['password' => 'Your password has been reset successfully.'])
                    );
            }

            if ($response === Password::INVALID_TOKEN) {
                session()->put('skip-third-party-auth-check', true);

                return redirect()
                    ->back()
                    ->withErrors(['password' => 'Error could not reset password, reset link is expired.']);
            }

            return redirect()
                ->back()
                ->withErrors(['password' => 'Password reset failed, please try again. Error: ' . $response]);
        } else {
            if ($response === Password::PASSWORD_RESET) {
                $user = User::find(auth()->id());
                if (!$user) {
                    return response()->json(
                        [
                            'success' => false,
                            'title' => 'Invalid user identification',
                            'message' => 'Password reset failed, please try again.',
                        ],
                        500
                    );
                }

                return response()->json([
                    'success' => true,
                    'token' => $user->currentAccessToken(),
                    'id' => $user->id,
                ]);
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Password reset failed, please try again.',
                    ],
                    500
                );
            }
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    public function broker(): PasswordBroker
    {
        return Password::broker();
    }
}
