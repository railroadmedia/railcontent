<?php

namespace Modules\UserManagementSystem\Tests\Feature;

use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();

        auth()->loginUsingId($user->id);

        $loggedInUser = auth()->user();

        dd($loggedInUser);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
