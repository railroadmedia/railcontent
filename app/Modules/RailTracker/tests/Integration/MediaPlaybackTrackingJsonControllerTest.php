<?php

namespace App\Modules\RailTracker\tests\Integration;

use App\Modules\RailTracker\Repositories\MediaPlaybackRepository;
use App\Modules\RailTracker\Services\MediaPlaybackService;
use App\Modules\RailTracker\tests\RailtrackerTestCase;
use Carbon\Carbon;

class MediaPlaybackTrackingJsonControllerTest extends RailtrackerTestCase
{
    public function test_store_validation()
    {
        $this->createAndLogInNewUser();
        $response = $this->call('put', '/railtracker/media-playback-session/store', []);

        $response->assertJsonValidationErrors(
            [
                'media_id',
                'media_type',
                'media_category',
            ]
        );

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function test_store_validation_extras()
    {
        $this->createAndLogInNewUser();
        $response = $this->call(
            'put',
            '/railtracker/media-playback-session/store',
            [
                'current_second' => 'non-int',
                'seconds_played' => 'non-int',
            ]
        );

        $response->assertJsonValidationErrors(
            [
                'media_id',
                'media_type',
                'media_category',
                'current_second',
                'seconds_played',
            ]
        );

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function test_store_logged_in_user_by_session_id()
    {
        $userId = $this->createAndLogInNewUser();

        $attributes = [
            'media_id' => $this->faker->word . rand(),
            'media_length_seconds' => rand(),
            'media_type' => 'video',
            'media_category' => 'vimeo',
            'session_id' => railtracker_session_token(),
        ];

        session()->flush();

        $response = $this->call(
            'put',
            '/railtracker/media-playback-session/store',
            $attributes
        );

        $this->assertArraySubsetMatch(
            [
                'type' => 'media-playback-session',
                'media_id' => $attributes['media_id'],
                'media_length_seconds' => $attributes['media_length_seconds'],
                'user_id' => $userId,
                'current_second' => 0,
                'seconds_played' => 0,
                'started_on' => Carbon::now()
                    ->toDateTimeString(),
                'last_updated_on' => Carbon::now()
                    ->toDateTimeString()
            ],
            $response->json()
        );

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_store_logged_in_user_by_auth()
    {
        $userId = $this->createAndLogInNewUser();

        $attributes = [
            'media_id' => $this->faker->word . rand(),
            'media_length_seconds' => rand(),
            'media_type' => 'video',
            'media_category' => 'vimeo',
        ];

        $response = $this->call(
            'put',
            '/railtracker/media-playback-session/store',
            $attributes
        );

        $this->assertArraySubsetMatch(
            [
                'type' => 'media-playback-session',
                'media_id' => $attributes['media_id'],
                'media_length_seconds' => $attributes['media_length_seconds'],
                'user_id' => $userId,
                'current_second' => 0,
                'seconds_played' => 0,
                'started_on' => Carbon::now()
                    ->toDateTimeString(),
                'last_updated_on' => Carbon::now()
                    ->toDateTimeString()
            ],
            $response->json()
        );

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_validation()
    {
        $userId = $this->createAndLogInNewUser();
        $attributes = [
            'media_id' => $this->faker->word . rand(),
            'media_length_seconds' => rand(),
            'media_type' => 'video',
            'media_category' => 'vimeo',
            'current_second' => rand(),
            'seconds_played' => rand(),
        ];

        $response = $this->call(
            'put',
            '/railtracker/media-playback-session/store',
            $attributes
        );

        $sessionId = $response->json()['id'];
        unset($attributes['current_second']);
        unset($attributes['seconds_played']);

        $response = $this->call(
            'patch',
            '/railtracker/media-playback-session/update/' . $sessionId,
            $attributes
        );

        $response->assertJsonValidationErrors(
            [
                'current_second',
                'seconds_played',
            ]
        );
    }

    public function test_update_all()
    {
        $userId = $this->createAndLogInNewUser();

        $attributes = [
            'media_id' => $this->faker->word . rand(),
            'media_length_seconds' => rand(),
            'media_type' => 'video',
            'media_category' => 'vimeo',
            'current_second' => rand(),
            'seconds_played' => rand(),
        ];

        $response = $this->call(
            'put',
            '/railtracker/media-playback-session/store',
            $attributes
        );

        $sessionId = $response->json()['id'];
        $attributes['current_second'] = rand();
        $attributes['seconds_played'] = rand();

        $response = $this->call(
            'patch',
            '/railtracker/media-playback-session/update/' . $sessionId,
            $attributes
        );

        $this->assertArraySubsetMatch(
            [
                'type' => 'media-playback-session',
                'id' => $sessionId,
                'media_id' => $attributes['media_id'],
                'media_length_seconds' => $attributes['media_length_seconds'],
                'user_id' => $userId,
                'current_second' => $attributes['current_second'],
                'seconds_played' => $attributes['seconds_played'],
                'started_on' => Carbon::now()
                    ->toDateTimeString(),
                'last_updated_on' => Carbon::now()
                    ->toDateTimeString()
            ],
            $response->json()
        );
    }
}
