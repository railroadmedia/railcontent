<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Railroad\Railcontent\Repositories\UserPlaylistContentRepository;
use Railroad\Railcontent\Services\UserPlaylistsService;

class PlaylistsSeeder extends Seeder
{
    private $faker;

    private $userPlaylistsService;
    private $userPlaylistContentRepository;

    /**
     * @param $faker
     */
    public function __construct(
        Generator $faker,
        UserPlaylistsService $userPlaylistsService,
        UserPlaylistContentRepository $userPlaylistContentRepository
    ) {
        $this->faker = $faker;
        $this->userPlaylistsService = $userPlaylistsService;
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $contents = [
            'drumeo' => [313436, 374878, 23731, 23722, 23687],
            'pianote' => [221213, 221806, 235188],
            'guitareo' => [191415, 191428, 314651],
            'singeo' => [311478, 327685, 329881],
        ];
        $userId = $this->command->ask('Please enter your user id !!');
        $brand = $this->command->ask('Please enter the brand !!');

        $playlist = $this->userPlaylistsService->create([
                                                            'user_id' => $userId,
                                                            'type' => 'user-playlist',
                                                            'brand' => $brand,
                                                            'name' => $this->faker->word(),
                                                            'description' => $this->faker->paragraph(),
                                                            'thumbnail_url' => $this->faker->imageUrl(),
                                                            'category' => 'Jazz',
                                                            'private' => true,
                                                            'created_at' => Carbon::now()
                                                                ->toDateTimeString(),
                                                        ]);
        foreach ($contents[$brand] ?? [] as $content) {
            $input = [
                'content_id' => $content,
                'user_playlist_id' => $playlist['id'],
                'created_at' => Carbon::now()->toDateTimeString()
            ];

            $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(null, $input);
        }
    }
}
