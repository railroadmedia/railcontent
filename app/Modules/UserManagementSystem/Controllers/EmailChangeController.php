<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\Rule;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Carbon\Carbon;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Notifications\AnonymousNotifiable;
use Modules\UserManagementSystem\Models\EmailChange;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Events\EmailChangeRequest;
use Modules\UserManagementSystem\Notifications\EmailChange as EmailChangeNotification;

class EmailChangeController extends Controller
{
    use ValidatesRequests;

    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * EmailChangeController constructor.
     *
     * @param Hasher $hasher
     */
    public function __construct(
        Hasher $hasher,
    ) {
        $this->hasher = $hasher;
    }

    /**
     * Perform an email change request action.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function request(Request $request)
    {
        try {
            $request->validate([
                'email' => [
                    Rule::unique(config('user_management_system.database_connection_name') . '.usora_users')->ignore(
                        user()->id
                    ),
                    'email',
                    'max:255'
                ],
                'user_password' => 'required'
            ]);
        } catch (ValidationException $e) {
            $messagesByField = $e->validator->getMessageBag()->getMessages();
            $messagesForFieldFailingField = reset($messagesByField);

            foreach ($messagesForFieldFailingField as $messagesForField) {
                $errorMessageToUser = $messagesForField;
                break;
            }
            $default = 'Please try again, and contact support if the problem persists.';
            $message = ['error-message' => ($errorMessageToUser ?? $default)];

            return redirect()->back()->withErrors($message);
        }
        $user = user();

        if ($request->get('email') == user()->email) {
            return back()
                ->with(['error-message' => "Please choose a new email."]);
        }

        if (
            !$this->hasher->check($request->get('user_password'), $user->password)
        ) {
            return redirect()->back()->with('error-message', 'The current password you entered is incorrect.');
        }

        $payload = [
            'email' => $request->get('email'),
            'token' => $this->createNewToken($request->get('email')),
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];

        $emailChange = EmailChange::where('user_id', $user->id)->first();

        if (!$emailChange) {
            $emailChange = new EmailChange();
        }

        $emailChange->email = $payload['email'];
        $emailChange->token = $payload['token'];
        $emailChange->user_id = $user->id;
        $emailChange->brand = brand();
        $emailChange->save();

        event(new EmailChangeRequest($payload['token'], $payload['email']));

        $this->sendEmailChangeNotification($payload['token'], $payload['email']);

        $message = [
            'successes' => new MessageBag(
                ['password' => 'An email confirmation link has been sent to your new email address.']
            ),
        ];

        return $request->has('redirect') ?
            redirect()
                ->away($request->get('redirect'))
                ->with($message) :
            redirect()
                ->back()
                ->with($message);
    }

    /**
     * Perform an email change confirmation action.
     * @bodyParam code required
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function confirm(Request $request)
    {
        try {
            $validationRules = ['code' => 'bail|required|string'];
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

            $message = ['code' => 'Error: ' . ($errorMessageToUser ?? $default)];

            return redirect()->back()->withErrors($message);
        }

        $emailChange = EmailChange::where('token', $request->get('code'))->first();

        if (!$emailChange) {
            return redirect()->back()->withErrors(['error-message' => 'Token is invalid']);
        }

        if (Carbon::parse(
                $emailChange->updated_at
                    ->format('Y-m-d H:i:s')
            ) <
            Carbon::now()
                ->subHours(config('user_management_system.email_change_token_ttl'))) {
// todo: error message does not appear
                return redirect()
                    ->back()
                    ->withErrors(['error-message' => 'Your email reset code has expired.']);

        }

        $user = User::find($emailChange->user_id);

        $oldUser = clone($user);

        $user->email = $emailChange->email;
        $user->save();

        event(new UserUpdated($user, $oldUser));
        $emailChange->save();

        $message = [
            'successes' => new MessageBag(
                ['password' => 'Your email has been updated successfully.']
            ),
        ];

        return $request->has('redirect_to') ?
            redirect()
                ->away($request->get('redirect'))
                ->with($message) :
            redirect()
                ->to(
                    route('platform.profile.settings.login-credentials', [
                        'userId' => $user->id,
                        'brand' => $emailChange->brand
                    ])
                )
                ->with($message);
    }

    /**
     * Generates a token
     * Similar with Illuminate\Auth\Passwords\DatabaseTokenRepository::createNewToken
     *
     * @param string $hash
     * @return string
     */
    public function createNewToken(
        $hash
    ) {
        return hash_hmac('sha256', Str::random(40), $hash);
    }

    /**
     * @param $token
     * @param $email
     */
    public function sendEmailChangeNotification($token, $email)
    {
        $class = config('user_management_system.email_change_notification_class');
        (new AnonymousNotifiable)->route(config('user_management_system.email_change_notification_channel'), $email)
            ->notify(new $class($token));
    }
}
