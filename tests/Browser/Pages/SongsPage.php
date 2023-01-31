<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class SongsPage extends Page
{

    public function url(): string
    {
        return "/$this->brand/songs";
    }

    public function assert(Browser $browser): void
    {
        $browser->assertSee("All Songs");
    }


    public function navigateToSong(Browser $browser)
    {
        $browser->visit('/songs/i-won-t-hold-you-back/382497')
            ->assertSee("I Won't Hold You Back");
    }
}
