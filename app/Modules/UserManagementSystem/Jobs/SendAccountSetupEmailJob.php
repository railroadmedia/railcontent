<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Mail\Agnostic;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Mail;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class SendAccountSetupEmailJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    protected array $ids;

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    /**
     * @throws Exception
     */
    public function getQuery(): Builder
    {
        return User::query()
            ->where('requires_password_update', true)
            ->where('created_at', '<', now()->subDays(1));
    }

    public function handleItem($user): void
    {
        /** @var User $user */
        try {
            $token = md5($user->email . config('shopify.multipass.account_creation_secret_key'));

            $mailToStudent = new Agnostic();
            $mailToStudent->to($user->email);
            $mailToStudent->from('team@musora.com', 'Musora');
            $mailToStudent->subject('Ready to explore Musora? 🚀');
            $mailToStudent->view('emails.account-setup-follow-up');
            $mailToStudent->with([
                'setupAccountUrl' => route('user_management_system.create-account-page', [
                    'email' => $user->email,
                    'verification_token' => $token
                ]),
                'logo' => 'https://www.musora.com/musora-cdn/image/width=400,quality=85/https://musora-web-platform.s3.amazonaws.com/musora/logo.png',
            ]);

            Mail::queue($mailToStudent);
        } catch (Throwable $ex) {
            Log::error('Error sending email for ' . $user->email);
            Log::error($ex);
        }
    }

    public function handleAllItems($users): bool
    {
        foreach ($users as $user) {
            $this->handleItem($user);
        }
        return true;
    }
}
