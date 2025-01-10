<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class UserPlaylistTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);

    }

    public function test_public_playlist_items_access(): void
    {
        $playlist = UserPlaylist::factory()->create(['user_id' => rand(), 'private' => 0]);
        $item = UserPlaylistContent::factory()->create(['user_playlist_id' => $playlist['id']]);
        $this->getJson(route('playlist.item', [
            'id' => $item['id'],
        ]))
            ->assertStatus(200);
    }

    public function test_private_playlist_items_access(): void
    {
        $playlist = UserPlaylist::factory()->create(['user_id' => rand(), 'private' => 1]);
        $item = UserPlaylistContent::factory()->create(['user_playlist_id' => $playlist['id']]);
        $this->getJson(route('playlist.item', [
            'id' => $item['id'],
        ]))
            ->assertStatus(403);
    }
}
