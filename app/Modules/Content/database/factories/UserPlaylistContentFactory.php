<?php

namespace App\Modules\Content\database\factories;

use App\Modules\Content\Models\UserPlaylistContent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPlaylistContentFactory extends Factory
{
    protected $model = UserPlaylistContent::class;

    public function definition(): array
    {
        return [
            'content_id' => rand(),
            'user_playlist_id' => rand(),
            'position' => 1,
            'created_at' => Carbon::now()->addDays(-40),
        ];
    }
}
