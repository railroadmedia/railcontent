<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentLike;
use App\Modules\Content\Models\ContentUserProgress;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class ContentMetadataTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_liked_content_missing_user_id_uses_authenticated_user()
    {
        $content = Content::factory()->create();
        $this->likeContent($content);
        $response = $this->getJson(
            route('content.is_liked_by_user', ['content' => $content->id]),
        );
        $response->assertOk();
        $response->assertJson([$content->id => true]);
    }

    public function test_liked_content_non_existent_user_returns_error()
    {
        $content = Content::factory()->create();
        // get the highest user ID and add to it, to make an ID that won't exist
        $maxUser = User::orderByDesc('id')->first();
        $maxId = $maxUser->id + 50;
        // verify user doesn't exist in db
        $noUser = User::find($maxId);
        // safety fallback - delete the user
        $noUser?->delete();
        $this->assertDatabaseMissing(User::class, ['id' => $maxId]);

        $response = $this->getJson(
            route('content.is_liked_by_user', ['content' => $content, 'user' => $maxId]),
        );
        $response->assertStatus(500);
        $this->assertStringContainsString('No query results for model', $response->getContent());
    }

    public function test_liked_content_non_existent_content_returns_error()
    {
        // get the highest content and add to it, to make an ID that won't exist
        $maxContent = Content::orderByDesc('id')->first();
        $maxId = ($maxContent?->id ?? 0) + 50;
        // verify content doesn't exist in db
        $noContent = Content::find($maxId);
        // safety fallback - delete the content
        $noContent?->delete();
        $this->assertDatabaseMissing(Content::class, ['id' => $maxId]);
        $response = $this->getJson(
            route('content.is_liked_by_user', ['content' => $maxId, 'user' => $this->user->id]),
        );
        $response->assertStatus(500);
        $this->assertStringContainsString('No query results for model', $response->getContent());
    }

    public function test_liked_content_user_has_liked_content_returns_true()
    {
        $content = Content::factory()->create();
        $this->likeContent($content);
        $response = $this->getJson(
            route('content.is_liked_by_user', ['content' => $content->id, 'user' => $this->user->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => true];

        $response->assertJson($expectedJson);
    }

    public function test_liked_content_user_has_not_liked_content_returns_false()
    {
        $content = Content::factory()->create();
        $response = $this->getJson(
            route('content.is_liked_by_user', ['content' => $content->id, 'user' => $this->user->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => false];
        $response->assertJson($expectedJson);
    }

    public function test_liked_content_user_has_unliked_content_returns_false()
    {
        $content = Content::factory()->create();
        $like = $this->likeContent($content);
        $response = $this->getJson(
            route('content.is_liked_by_user', ['content' => $content->id, 'user' => $this->user->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => true];
        $response->assertJson($expectedJson);

        $like->delete();
        $response = $this->getJson(
            route('content.is_liked_by_user', ['content' => $content->id, 'user' => $this->user->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => false];
        $response->assertJson($expectedJson);
    }

    private function likeContent(?Content $content = null): ContentLike
    {
        $content = $content ?? Content::factory()->create();
        $like = new ContentLike(['content_id' => $content->id,  'user_id' => $this->user->id, 'created_on' => now()]);
        // DEV NOTE: use createQuietly to avoid attempted calls to CustomerIO to sync the new content like
        $like->saveQuietly();
        return $like;
    }

    public function test_content_user_progress_returns_not_started_when_user_has_not_started()
    {
        $content = Content::factory()->create();
        $response = $this->getJson(
            route('content.user_progress', ['content' => $content->id, 'user' => $this->user->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::NotStarted->value, 'percent' => 0]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_not_started_when_no_content_progress_created()
    {
        $content = Content::factory()->create();
        $response = $this->getJson(
            route('content.user_progress', ['content' => $content->id, 'user' => $this->user->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::NotStarted->value, 'percent' => 0]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_started_when_user_has_not_completed()
    {
        $content = Content::factory()->create();
        $progress = $this->createContentProgress($content, false);
        $progress->progress_percent = 25;
        $progress->save();
        $response = $this->getJson(
            route('content.user_progress', ['content' => $content->id, 'user' => $this->user->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::Started->value, 'percent' => 25]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_completed_when_user_has_completed()
    {
        $content = Content::factory()->create();
        $this->createContentProgress($content, true);
        $response = $this->getJson(
            route('content.user_progress', ['content' => $content->id, 'user' => $this->user->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::Completed->value, 'percent' => 100]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_uses_session_user_when_not_provided()
    {
        $content = Content::factory()->create();
        $this->createContentProgress($content, true);
        $response = $this->getJson(
            route('content.user_progress', ['content' => $content->id]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::Completed->value, 'percent' => 100]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_error_if_multiple_entries()
    {
        $content = Content::factory()->create();
        $this->createContentProgress($content, false);
        $this->createContentProgress($content, true);
        $response = $this->getJson(
            route('content.user_progress', ['content' => $content->id]),
        );
        $response->assertNotFound();
        $expectedJson = ['error' => "Multiple ContentUserProgress found for Content {$content->id} and User {$this->user->id}"];
        $response->assertJson($expectedJson);
    }

    private function createContentProgress(Content $content, bool $isCompleted): ContentUserProgress
    {
        $progress = new ContentUserProgress([
            'content_id' => $content->id,
            'user_id' => $this->user->id,
            'state' => $isCompleted ? ProgressState::Completed->value : ProgressState::Started->value,
            'started_on' => now(),
            'updated_on' => now(),
        ]);
        if ($isCompleted) {
            $progress->progress_percent = 100;
            $progress->completed_on = now();
        }
        $progress->save();
        return $progress;
    }
}
