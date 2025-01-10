<?php

namespace App\Modules\Content\database\factories;

use App\Modules\Content\Models\UserPlaylist;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;


class UserPlaylistFactory extends Factory
{
    protected $model = UserPlaylist::class;

    public function definition(): array
    {
        $name = implode(' ', $this->faker->words());
        $brand = 'drumeo';
        return [
            'type' => 'user-playlist',
            'user_id' => rand(),
            'brand' => $brand,
            'name' => $name,
            'created_at' => Carbon::now()->addDays(-40),
        ];
    }
}
