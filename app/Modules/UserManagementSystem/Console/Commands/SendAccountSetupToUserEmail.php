<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Mail\Agnostic;
use Illuminate\Support\Facades\Log;
use Mail;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class SendAccountSetupToUserEmail extends Command
{
    protected $signature = 'user:sendAccountSetupToUserEmail {email}';
    protected $description = 'Send account setup email to a specific user email';

    public function handle(): void
    {
        $email = $this->argument('email');
        try {
            $user = User::where('email', $email)->first();
            if ($user) {
                $token = md5($user->email . config('shopify.multipass.account_creation_secret_key'));

                $mailToStudent = new Agnostic();
                $mailToStudent->to($user->email);
                $mailToStudent->from('team@musora.com', 'Musora');
                $mailToStudent->subject('Ready to explore Musora?');
                $mailToStudent->view('emails.account-setup-follow-up');
                $mailToStudent->with([
                    'setupAccountUrl' => route('user_management_system.create-account-page', [
                        'email' => $user->email,
                        'verification_token' => $token,
                        'event_tracking_origin' => config('event-tracking.account_password_created_method.reminder')
                    ]),
                ]);

                Mail::queue($mailToStudent);
            }
        } catch (Throwable $ex) {
            Log::error('Error sending email for ' . $email);
            Log::error($ex);
        }
    }
}
