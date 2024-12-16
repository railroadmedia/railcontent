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

class ContentProgressControllerTest extends TestCase
{
    public function test_content_progress_start()
    {
        $userId = User::factory()->create()->id;
        $content = Content::factory()->create();
        auth()->loginUsingId($userId);

        $currentVersion = $this->get(route('content.user.progress.all'))->json()['version'];
        $this->assertEquals(1, $currentVersion);

        $response = $this->post(route('content.user.progress.start'), ['contentId' => $content->id]);

        $currentVersion = $this->get(route('content.user.progress.all'))->json()['version'];
        $this->assertEquals(2, $currentVersion);
        $this->assertContentProgress($content, $userId, ProgressState::Started, 0);
    }

    public function test_content_progress_copmlete()
    {
        $userId = User::factory()->create()->id;
        $content = Content::factory()->create();
        auth()->loginUsingId($userId);

        $currentVersion = $this->get(route('content.user.progress.all'))->json()['version'];
        $this->assertEquals(1, $currentVersion);

        $response = $this->post(route('content.user.progress.complete'), ['contentId' => $content->id]);

        $currentVersion = $this->get(route('content.user.progress.all'))->json()['version'];
        $this->assertEquals(2, $currentVersion);
        $this->assertContentProgress($content, $userId, ProgressState::Completed, 100);
    }

    public function test_content_progress_reset()
    {
        $userId = User::factory()->create()->id;
        $content = Content::factory()->create();
        auth()->loginUsingId($userId);

        $currentVersion = $this->get(route('content.user.progress.all'))->json()['version'];
        $this->assertEquals(1, $currentVersion);

        $response = $this->post(route('content.user.progress.start'), ['contentId' => $content->id]);
        $response = $this->post(route('content.user.progress.complete'), ['contentId' => $content->id]);
        $response = $this->post(route('content.user.progress.reset'), ['contentId' => $content->id]);

        $currentVersion = $this->get(route('content.user.progress.all'))->json()['version'];
        $this->assertEquals(4, $currentVersion);
        $this->assertDatabaseMissing(ContentUserProgress::class, ['content_id' => $content->id, 'user_id' => $userId]);
    }

    private function assertContentProgress($content, $userId, $state, $progress): void
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
