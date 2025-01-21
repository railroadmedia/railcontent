<?php

namespace Database\Seeders;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use App\Modules\Content\Models\UserPlaylistLike;
use App\Modules\Content\Models\UserPlaylistPinned;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\UserManagementSystem\Models\User;

class CmsPlaylistContentSeeder extends Seeder
{
    public function run(): void
    {
        $count = 100;
        $userId = 519690;

        $playlist = new UserPlaylist();
        $playlist->user_id = $userId;
        $playlist->type = "user-playlist";
        $playlist->name = "Seed-" . Carbon::now()->timestamp;
        $playlist->brand = "drumeo";

        $playlist->save();

        $contentIds = Content::query()->select('id')->where('type', '!=', 'instructors')->limit(100)->inRandomOrder()->get();
        for ($i = 0; $i < $count; $i++) {
            $contentId = $contentIds[$i]['id'];
            $content = new UserPlaylistContent();
            $content->content_id = $contentId;
            $content->user_playlist_id = $playlist->id;
            $content->position = $i;
            $content->save();
        }
    }
}
