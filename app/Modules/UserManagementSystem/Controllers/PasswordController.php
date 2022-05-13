<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Models\User;

class PasswordController extends Controller
{
    use ValidatesRequests;
    use AuthorizesRequests;

    /**
     * @var Hasher
     */
    private $hasher;


    /**
     * CookieController constructor.
     *
     * @param Hasher $hasher
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
        $this->middleware([ConvertEmptyStringsToNull::class]);
    }

    /**
     * Reset the given user's password.
     *
     * @permission Must be logged in
     * @permission Only users with edit-users ability
     *
     * @bodyParam current_password required
     * @bodyParam new_password required
     *
     * @param Request $request
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        try {
            $validationRules =
                [
                    'current_password' => 'required',
                    'new_password' => 'required|confirmed|min:8|max:128'
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

            return redirect()->back()->with('error-message', 'Error: ' . ($errorMessageToUser ?? $default));
        }
        $user = user();

        //todo: check if user with pass == with user from auth; if not, $this->authorize('edit-users');
        $user = User::findOrFail($user->id);

        if (
            !$this->hasher->check($request->get('current_password'), $user->password)
        ) {
            return redirect()->back()->with('error-message', 'The current password you entered is incorrect.');
        }

        $user->setPassword($request->get('new_password'));
        $user->save();

        event(new PasswordReset($user));

        return redirect()
            ->back()
            ->with(
                'successes',
                new MessageBag(['password' => 'Your password has been reset successfully.'])
            )
            ->with($message);

    }
}
