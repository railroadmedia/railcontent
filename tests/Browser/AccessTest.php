<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Laravel\Nova\Testing\Browser\Pages\HomePage;
use Modules\UserManagementSystem\Models\User;
use Tests\Browser\Pages\LandingPage;
use Tests\Browser\Pages\MembersHomePage;
use Tests\DuskTestCase;

class AccessTest extends DuskTestCase
{
    public function test_landing(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new LandingPage());
        });
    }

    /**
     * @dataProvider membersData
     */
    public function test_home($userId): void
    {
        $user = User::query()->find($userId);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(new HomePage());
        });
    }

}
