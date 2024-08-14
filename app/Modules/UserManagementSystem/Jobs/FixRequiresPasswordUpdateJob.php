<?php

namespace App\Modules\UserManagementSystem\Jobs;

use Auth;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class FixRequiresPasswordUpdateJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    public function __construct(private readonly int $firstId, private readonly int $lastId)
    {
    }

    public function handle(): void
    {
        $users = User::query()
            ->where('requires_password_update', true)
            ->select(['id', 'email', 'requires_password_update'])
            ->whereBetween('id', [$this->firstId, $this->lastId])
            ->get();

        foreach ($users as $user) {
            if (!Auth::attempt(['email' => $user->email, 'password' => config('user_management_system.default_user_password')])) {
                $this->setFlag($user);
            }
        }
    }

    private function setFlag(User $user): void
    {
        try {
            $user->requires_password_update = false;
            $user->save();
        } catch (Throwable $ex) {
            Log::error('Error updating requires_password_update flag for email ' . $user->email);
            Log::error($ex);
        }
    }
}
