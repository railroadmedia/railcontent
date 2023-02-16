<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class MembersHomePage extends Page
{

    public function url(): string
    {
        return "/$this->brand";
    }

    public function assert(Browser $browser): void
    {
        $browser->assertSee("Continue")
            ->assertSee("Popular Conversations")
            ->assertSee("My Stats");
    }

}
