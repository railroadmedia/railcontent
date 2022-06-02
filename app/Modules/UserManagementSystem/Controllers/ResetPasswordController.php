<?php

namespace Modules\UserManagementSystem\Controllers;

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

    /**
     * Reset the given user's password.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function reset(Request $request)
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
                ->withErrors(['password' => 'Password reset failed. Error: '  . ($errorMessageToUser ?? $default)]);

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
                        auth()->loginUsingId($user->getId());
                        event(new UserEvent($user->getId(), 'authenticated'));
                    }
                );

        if (!$isJson)
        {
            if ($response === Password::PASSWORD_RESET) {
                session()->put('skip-third-party-auth-check', true);

//            todo: define redirect path
                return redirect()
                    ->back()
//                ->to(config('usora.login_success_redirect_path'))
                    ->with(
                        'successes',
                        new MessageBag(['password' => 'Your password has been reset successfully.'])
                    );
            }

            return redirect()
                ->back()
                ->withErrors(['password' => 'Password reset failed, please try again.']);
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
    public function broker()
    {
        return Password::broker();
    }
}
