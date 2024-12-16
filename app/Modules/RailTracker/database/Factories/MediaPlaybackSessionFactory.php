<?php

namespace App\Modules\RailTracker\database\Factories;

use App\Modules\Content\Models\Content;
use App\Modules\RailTracker\Enums\MediaTypeEnum;
use App\Modules\RailTracker\Models\MediaPlaybackSession;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;
use Ramsey\Uuid\Uuid;

class MediaPlaybackSessionFactory extends Factory
{
    protected $model = MediaPlaybackSession::class;

    public function definition(): array
    {
        return [
            'uuid' => Uuid::uuid4()->toString(),
            'started_on' => Carbon::now(),
            'last_updated_on' => Carbon::now(),
        ];
    }

    public static function createSession(
        User $user,
        Content $content,
        MediaTypeEnum $mediaTypeEnum,
        int $lengthSeconds,
        int $secondsPlayed,
        int $currentSeconds,
        array $attributes = []
    ): MediaPlaybackSession {
        $attributes = array_merge(
            $attributes,
            [
                'media_id' => $content->id,
                'media_length_seconds' => $lengthSeconds,
                'user_id' => $user->id,
                'type_id' => $mediaTypeEnum->value,
                'seconds_played' => $secondsPlayed,
                'current_second' => $currentSeconds,
            ]
        );
        return MediaPlaybackSession::factory()->create($attributes);
    }
}
