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
            ->where('created_at', '<', now()->subDays(1))
            ->where('created_at', '>', now()->subDays(2));
    }

    public function handleItem($item): void
    {
        /** @var User $item */
        try {
            $token = md5($item->email . config('shopify.multipass.account_creation_secret_key'));

            $mailToStudent = new Agnostic();
            $mailToStudent->to($item->email);
            $mailToStudent->from('team@musora.com', 'Musora');
            $mailToStudent->subject('Ready to explore Musora?');
            $mailToStudent->view('emails.account-setup-follow-up');
            $mailToStudent->with([
                'setupAccountUrl' => route('user_management_system.create-account-page', [
                    'email' => $item->email,
                    'verification_token' => $token
                ]),
            ]);

            Mail::queue($mailToStudent);
        } catch (Throwable $ex) {
            Log::error('Error sending email for ' . $item->email);
            Log::error($ex);
        }
    }

    public function handleAllItems($items): bool
    {
        foreach ($items as $item) {
            $this->handleItem($item);
            // so it doesn't overload SES
            sleep(1);
        }
        return true;
    }
}
