<?php

namespace App\Modules\UserManagementSystem\Services;

use App\Mail\Agnostic;
use Illuminate\Support\Facades\Mail;
use Modules\UserManagementSystem\Models\User;

class UserAuthenticationService
{
    public function __construct()
    {
    }

    public function authenticate(string $email, string $password): bool
    {
        return auth()->guard('user-management-system')
            ->validate(['email' => $email, 'password' => $password]);
    }

    public function login(User $user): void
    {
        auth()->loginUsingId($user->getId(), true);
    }

    public function sendSetupAccountEmail(User $user, bool $queue = false): void
    {
        $token = md5($user->email . config('shopify.multipass.account_creation_secret_key'));

        $mailToStudent = new Agnostic();
        $mailToStudent->to($user->email);
        $mailToStudent->from('team@musora.com', 'Musora');
        $mailToStudent->subject('One more step');
        $mailToStudent->view('emails.account-setup');
        $mailToStudent->with([
            'setupAccountUrl' => route('user_management_system.create-account-page', [
                'email' => $user->email,
                'verification_token' => $token
            ]),
        ]);

        if ($queue) {
            Mail::queue($mailToStudent);
            return;
        }

        Mail::send($mailToStudent);
    }
}
