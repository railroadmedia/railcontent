<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;

class OnboardingControllerTest extends UserManagementSystemTestCase
{
    // TODO: fix all of these tests. They all throw ErrorException: Redis::connect(): php_network_getaddresses: getaddrinfo for redis failed: Name or service not known...
    private $fakeEmail;


    protected function setUp(): void
    {
        parent::setUp();

        $this->fakeEmail = $this->faker->email();
        $user = User::factory()->create([
            'email' => $this->fakeEmail,
            'password' => "12345678",
        ]);
        auth()->login($user);
    }


    public function test_gears_missing_brand()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-gears',
            [
                'data' => ['test_one', 'test_two']
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_gears_missing_data()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-gears',
            [
                'brand' => 'drumeo',
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_gears_success()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $fakeData = [$this->faker->word(), $this->faker->word()];
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-gears',
            [
                'brand' => 'drumeo',
                'data' => $fakeData
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $user = User::query()->where(['email' => $this->fakeEmail])->firstOrFail();

        foreach ($user->onboardingGear as $gear) {
            $this->assertTrue(in_array($gear->gear, $fakeData));
        }
    }

    public function test_topics_missing_brand()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-topics',
            [
                'data' => ['test_one', 'test_two']
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_topics_missing_data()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-topics',
            [
                'brand' => 'drumeo',
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_topics_success()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $fakeData = [$this->faker->word(), $this->faker->word()];
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-topics',
            [
                'brand' => 'drumeo',
                'data' => $fakeData
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $user = User::query()->where(['email' => $this->fakeEmail])->firstOrFail();

        foreach ($user->onboardingTopics as $topic) {
            $this->assertTrue(in_array($topic->topic, $fakeData));
        }
    }


    public function test_genres_missing_brand()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-genres',
            [
                'data' => ['test_one', 'test_two']
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_genres_missing_data()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-genres',
            [
                'brand' => 'drumeo',
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_genres_success()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $fakeData = [$this->faker->word(), $this->faker->word()];
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-genres',
            [
                'brand' => 'drumeo',
                'data' => $fakeData
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $user = User::query()->where(['email' => $this->fakeEmail])->firstOrFail();

        foreach ($user->onboardingGenres as $genre) {
            $this->assertTrue(in_array($genre->genre, $fakeData));
        }
    }


    public function test_experience_missing_brand()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-experience',
            [
                'data' => "test"
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_experience_missing_data()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-experience',
            [
                'brand' => 'drumeo',
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }


    public function test_skip_account_missing_brand()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-skip-account-setup',
            [
                'skip' => true
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_skip_account_missing_data()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-skip-account-setup',
            [
                'brand' => 'drumeo',
            ]
        );

        $this->assertEquals(302, $response->getStatusCode());
    }


    public function test_experience_success()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $fakeExperienceLevel = rand(0, 3);
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-experience',
            [
                'brand' => 'drumeo',
                'experience_level' => $fakeExperienceLevel
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $user = User::query()->where(['email' => $this->fakeEmail])->firstOrFail();
        $this->assertEquals($user->onboardingExperience->first()->experience_level, $fakeExperienceLevel);
    }

    public function test_experience_success_one()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $fakeExperienceLevel = 1;
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-experience',
            [
                'brand' => 'drumeo',
                'experience_level' => $fakeExperienceLevel
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $user = User::query()->where(['email' => $this->fakeEmail])->firstOrFail();
        $this->assertEquals($user->onboardingExperience->first()->experience_level, $fakeExperienceLevel);
    }


    public function test_skip_account_success()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $user = User::query()->where(['email' => $this->fakeEmail])->firstOrFail();
        $this->assertEquals($user->drumeo_onboarding_skip_setup, 0);
        $this->assertEquals($user->pianote_onboarding_skip_setup, 0);
        $this->assertEquals($user->guitareo_onboarding_skip_setup, 0);
        $this->assertEquals($user->singeo_onboarding_skip_setup, 0);

        $response = $this->post_skip_setup_account('drumeo', true);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->post_skip_setup_account('pianote', true);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->post_skip_setup_account('guitareo', true);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->post_skip_setup_account('singeo', true);
        $this->assertEquals(200, $response->getStatusCode());

        $user = User::query()->where(['email' => $this->fakeEmail])->firstOrFail();
        $this->assertEquals($user->drumeo_onboarding_skip_setup, 1);
        $this->assertEquals($user->pianote_onboarding_skip_setup, 1);
        $this->assertEquals($user->guitareo_onboarding_skip_setup, 1);
        $this->assertEquals($user->singeo_onboarding_skip_setup, 1);


        $response = $this->post_skip_setup_account('drumeo', false);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->post_skip_setup_account('pianote', false);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->post_skip_setup_account('guitareo', false);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->post_skip_setup_account('singeo', false);
        $this->assertEquals(200, $response->getStatusCode());

        $user = User::query()->where(['email' => $this->fakeEmail])->firstOrFail();
        $this->assertEquals($user->drumeo_onboarding_skip_setup, 0);
        $this->assertEquals($user->pianote_onboarding_skip_setup, 0);
        $this->assertEquals($user->guitareo_onboarding_skip_setup, 0);
        $this->assertEquals($user->singeo_onboarding_skip_setup, 0);
    }

    public function post_skip_setup_account($brand, $skip)
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        return $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/onboarding-skip-account-setup',
            [
                'brand' => $brand,
                'skip' => $skip
            ]
        );
    }


}
