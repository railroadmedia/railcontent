<?php

namespace Modules\UserManagementSystem\Tests\Unit\Commands;

use App\Modules\UserManagementSystem\Jobs\SendAccountSetupEmailJob;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;
use Tests\traits\CreatesReflectionMethod;
use Tests\traits\CreatesReflectionProperty;

class SendAccountSetupEmailTest extends TestCase
{
    use CreatesReflectionProperty;
    use CreatesReflectionMethod;

    /** @var Collection<User>  */
    private Collection $usersToReceiveNotification;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();

        $this->usersToReceiveNotification = User::factory()
            ->count(5)
            ->create([
                'requires_password_update' => true,
                'created_at' => now()->subDay()->subHour()
            ]);
    }

    public function test_dispatched_finds_users_to_notify_and_ignores_new_users(): void
    {
        Log::shouldReceive("info");

        $this->artisan("user:sendAccountSetupEmail")
            ->assertSuccessful();

        $this->assertOnlyValidUsersSelected($this->usersToReceiveNotification);
    }

    public function test_dispatched_finds_users_to_notify_with_new_users_after_one_day(): void
    {
        Log::shouldReceive("info");
        $recentUser = User::factory()
            ->create([
                'requires_password_update' => true,
                'created_at' => now()
            ]);

        $this->travel(1)->day();
        $this->travel(1)->second();

        $this->artisan("user:sendAccountSetupEmail")
            ->assertSuccessful();

        $this->assertOnlyValidUsersSelected(Collection::make([$recentUser]));
    }

    public function test_dispatched_finds_users_to_notify_without_user_who_updated_password(): void
    {
        Log::shouldReceive("info");

        $updatedUser = $this->usersToReceiveNotification->pop();
        $updatedUser->requires_password_update = false;
        $updatedUser->saveQuietly();

        $this->artisan("user:sendAccountSetupEmail")
            ->assertSuccessful();

        $this->assertOnlyValidUsersSelected($this->usersToReceiveNotification);
    }

    public function test_not_dispatched_when_no_users_to_notify(): void
    {
        Log::shouldReceive("info");

        $this->usersToReceiveNotification->each(function (User $user) {
            $user->requires_password_update = false;
            $user->saveQuietly();
        });

        $this->artisan("user:sendAccountSetupEmail")
            ->assertSuccessful();
        Queue::assertNotPushed(SendAccountSetupEmailJob::class);
    }

    private function assertOnlyValidUsersSelected(Collection $users): void
    {
        Queue::assertPushedOn('command', SendAccountSetupEmailJob::class, function (SendAccountSetupEmailJob $job) use ($users) {
            $query = $this->getReflectionMethod($job, 'getQuery')->invoke($job);
            $jobUsers = $query->get();
            $extra = $jobUsers->diff($users);
            $missing = $users->diff($jobUsers);
            return $extra->isEmpty() && $missing->isEmpty();
        });
    }
}
