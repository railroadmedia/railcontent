<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ContentProgressService;
use App\Modules\RailTracker\tests\Integration\MediaPlaybackTrackingJsonControllerTest;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class ContentProgressFeatureTest extends TestCase
{
    public function test_workflow()
    {
        $userId = User::factory()->create()->id;
        $content = Content::factory()->create();
        auth()->loginUsingId($userId);

        $currentVersion = $this->getContentProgressAll()['version'];
        $this->assertEquals(1, $currentVersion);

        $this->post(route('content.user.progress.start'), ['contentId' => $content->id]);


        $this->mediaSessionRequest($content->id, 100, 10, 10);
        $this->assertProgress($content, $userId, ProgressState::Started, 10);

        $currentVersion = $this->getContentProgressAll()['version'];
        $this->assertEquals(3, $currentVersion);

        $this->post(route('content.user.progress.complete'), ['contentId' => $content->id]);

        $currentVersion = $this->getContentProgressAll()['version'];
        $this->assertEquals(3, $currentVersion);

        $this->assertProgress($content, $userId, ProgressState::Completed, 100);
    }

    private function getContentProgressAll()
    {
        $response = $this->get(
            route('content.user.progress.all')
        );
        return $response->json();
    }


    private function mediaSessionRequest(
        int $contentId,
        int $contentLengthSeconds,
        int $currentSeconds,
        int $secondsWatched,

    ): void {
        $this->post(
            route('railtracker.media-playback-session.post'),
            [
                'media_id' => $contentId,
                'media_length_seconds' => $contentLengthSeconds,
                'media_type' => 'test',
                'media_category' => 'test',
                'current_second' => $currentSeconds,
                'seconds_played' => $secondsWatched
            ]
        );
    }


    private function assertProgress($content, $userId, $state, $progress): void
    {
        $this->assertDatabaseHas(
            ContentUserProgress::class,
            [
                'content_id' => $content->id,
                'user_id' => $userId,
                'state' => $state,
                'progress_percent' => $progress,
            ]
        );
    }
}
