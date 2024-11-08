<?php

namespace App\Modules\RailTracker\tests\Integration;

use App\Modules\Content\Models\Content;
use App\Modules\RailTracker\Enums\MediaTypeEnum;
use App\Modules\RailTracker\Models\MediaPlaybackSession;
use App\Modules\RailTracker\tests\RailtrackerTestCase;
use Modules\UserManagementSystem\Models\User;
use Ramsey\Uuid\Uuid;

class MediaPlaybackTrackingJsonControllerV2Test extends RailtrackerTestCase
{
    public function test_store()
    {
        $userId = User::factory()->create()->id;
        \Auth::loginUsingId($userId);
        $content = Content::factory()->create();
        $attributes = [
            'content_id' => $content->id,
            'media_type_id' => MediaTypeEnum::VideoYouTube->value,
            'media_length_seconds' => 100,
            'current_second' => rand(),
            'seconds_played' => rand(),
            'session_id' => Uuid::uuid4()->toString()
        ];

        $response = $this->call('post', route('railtracker.v2.media-playback-session.store'), $attributes);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertDatabaseHas(MediaPlaybackSession::class, [
            'media_id' => $content->id,
            'type_id' => $attributes['media_type_id'],
            'media_length_seconds' => $attributes['media_length_seconds'],
            'current_second' => $attributes['current_second'],
            'seconds_played' => $attributes['seconds_played'],
            'uuid' => $attributes['session_id'],
            'user_id' => $userId,
        ]);
    }
}
