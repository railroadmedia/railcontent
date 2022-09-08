<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Carbon\Carbon;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

//use MikeMcLin\WpPassword\Facades\WpPassword;
use Modules\UserManagementSystem\Models\EmailChange;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Events\EmailChangeRequest;

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
    )
    {
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
                'email' => 'email|max:255|unique:' .
                    config('user_management_system.database_connection_name') . '.usora_users'
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

            return redirect()->back()->with($message);
        }
        $user = user();

        if (!$request->get('email')) {
            return back()
                ->withInput($request->except('email'))
                ->withErrors(
                    ['email' => 'Email is missing from request']
                );
        }

        if (!$request->get('user_password')) {
            return back()
                ->withInput($request->except('email'))
                ->withErrors(
                    ['user_password' => 'Email is missing from request']
                );
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
        $emailChange->save();


        event(new EmailChangeRequest($payload['token'], $payload['email']));

//        todo: sendEmailChangeNotification($payload['token'], $payload['email']);

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
            //todo: check if <code> <exists> also!
//            $validationRules = ['code' => 'bail|required|string|exists'];
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

        // todo: email_change_token_ttl should be declared in a config file
        if (Carbon::parse(
                $emailChange->updated_at
                    ->format('Y-m-d H:i:s')
            ) <
            Carbon::now()
//                ->subHours(config('usora.email_change_token_ttl')))
                ->subHours(24)) {
            {
                return redirect()
                    ->back()
                    ->withErrors(['code' => 'Your email reset code has expired.']);
            }
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

        //todo: define route of redirect!
        return $request->has('redirect') ?
            redirect()
                ->away($request->get('redirect'))
                ->with($message) :
            redirect()
                ->back()
//                ->to(config('usora.email_change_confirmation_success_redirect_path'))
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

//    /**
//     * @param $token
//     * @param $email
//     */
//    public function sendEmailChangeNotification($token, $email)
//    {
//        $class = config('usora.email_change_notification_class');
//
//        (new AnonymousNotifiable)->route(config('usora.email_change_notification_channel'), $email)
//            ->notify(new $class($token));
//    }
}
