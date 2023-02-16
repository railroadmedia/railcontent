<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class LandingPage extends Page
{
    public function url(): string
    {
        return "/";
    }

    public function assert(Browser $browser): void
    {
        $browser->assertSee("Musicians start here");
    }

    public function navigateToSong(Browser $browser)
    {
        $browser->visit('/songs/i-won-t-hold-you-back/382497')
            ->assertSee("I Won't Hold You Back");
    }
}
