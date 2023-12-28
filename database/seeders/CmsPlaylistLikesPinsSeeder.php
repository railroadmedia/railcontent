<?php

namespace Database\Seeders;

use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistLike;
use App\Modules\Content\Models\UserPlaylistPinned;
use Illuminate\Database\Seeder;
use Modules\UserManagementSystem\Models\User;

class CmsPlaylistLikesPinsSeeder extends Seeder
{
    public function run()
    {
        $maxUserId = User::query()->max("id");

        $playlistCount = UserPlaylist::query()->where('id', '<', 5000)->count();
        $i = 0;
        UserPlaylist::query()->where('id', '<', 5000)->chunk(1000, function ($playlists) use (&$i, $playlistCount, $maxUserId) {
            foreach ($playlists as $playlist) {
                $numberOfLikes = round(100000 / rand(1, 100000)) - 1;

                $data = [];
                for ($j = 0; $j < $numberOfLikes; $j++) {
                    $data[] = [
                        'playlist_id' => $playlist->id,
                        'user_id' => rand(1, $maxUserId),
                        'brand' => $playlist->brand,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }

                $chunked = array_chunk($data, 1000);
                foreach ($chunked as $chunk) {
                    UserPlaylistLike::insert($chunk);
                }


                $pinned = rand(0, 10) >= 9;
                if ($pinned) {
                    $pin = new UserPlaylistPinned();
                    $pin->playlist_id = $playlist->id;
                    $pin->user_id = $playlist->user_id;
                    $pin->brand = $playlist->brand;
                    $pin->created_at = date('Y-m-d H:i:s');
                    $pin->save();
                }
                $i++;
            }
            $this->command->info("$i/$playlistCount");
        });
    }
}
