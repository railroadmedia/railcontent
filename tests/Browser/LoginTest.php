<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Modules\UserManagementSystem\Models\User;
use Tests\Browser\Pages\MembersHomePage;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'caleb+annual_subscription_all_brands_1@drumeo.com')
                ->type('password', 'caleb+annual_subscription_all_brands_1@drumeo.com')
                ->press('@submit-button')
                ->on(new MembersHomePage());
        });
    }


//
//    /**
//     * A Dusk test example.
//     */
//    public function test_login2(): void
//    {
//        $user = User::query()->find(472552);
//
//        $this->browse(function (Browser $browser) use ($user) {
//            $browser->loginAs($user)
//                ->visit('/drumeo');
//        });
//    }
}
