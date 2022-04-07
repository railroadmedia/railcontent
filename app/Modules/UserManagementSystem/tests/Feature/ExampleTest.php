<?php

namespace Modules\UserManagementSystem\Tests\Feature;

use Illuminate\Support\Facades\Hash;
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
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $worked = auth()->attempt(['email' => $email, 'password' => $password]);

        $loggedInUser = auth()->user();

        dd($loggedInUser);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
