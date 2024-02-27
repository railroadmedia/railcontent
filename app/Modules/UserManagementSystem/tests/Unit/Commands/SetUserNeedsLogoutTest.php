<?php

namespace Modules\UserManagementSystem\Tests\Unit\Commands;

use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class SetUserNeedsLogoutTest extends TestCase
{
    public function test_fails_when_invalid_id()
    {
        $users = User::factory()->count(5)->create();

        $this->assertDatabaseMissing(User::class, ['id' => 9999]);

        $userIds = $users->pluck('id')->implode(' ');

        $this->artisan("user:needs_logout $userIds 9999")
            ->expectsOutput('Invalid user ID 9999')
            ->assertFailed();
    }

    public function test_sets_needs_logout_for_all_users()
    {
        $users = User::factory()->count(5)->create();

        $users->each(fn (User $user) => $this->assertFalse($user->needs_logout));

        $userIdCollection = $users->pluck('id');
        $userIds = $userIdCollection->implode(' ');

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message) use ($userIdCollection) {
                return $message == 'Set needs_logout for user ID '. $userIdCollection->implode(', ');
            });

        $this->artisan("user:needs_logout $userIds")
            ->expectsOutput('Set needs_logout for user ID '. $userIdCollection->implode(', '))
            ->assertSuccessful();

        $users->each(fn(User $user) => $user->refresh());
        $users->each(fn (User $user) => $this->assertTrue($user->needs_logout));
    }
}
