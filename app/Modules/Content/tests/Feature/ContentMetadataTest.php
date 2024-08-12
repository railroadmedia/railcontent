<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentLike;
use App\Modules\Content\Models\ContentUserProgress;
use Illuminate\Support\Collection;
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

    public function test_liked_content_missing_user_id_uses_authenticated_user(): void
    {
        $content = Content::factory()->create();
        $this->likeContent($content);
        $response = $this->getJson(
            route('content.is_liked_by_user', ['content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $response->assertJson([$content->id => true]);
    }

    public function test_liked_content_non_existent_user_returns_error(): void
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
            route('content.is_liked_by_user', ['user' => $maxId, 'content_ids' => [$content->id]]),
        );
        $response->assertStatus(500);
        $this->assertStringContainsString('No query results for model', $response->getContent());
    }

    public function test_liked_content_non_existent_content_returns_error(): void
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
            route('content.is_liked_by_user', ['user' => $this->user->id, 'content_ids' => [$maxId]]),
        );
        $response->assertStatus(500);
        $this->assertStringContainsString('The selected content_ids.0 is invalid', $response->getContent());
    }

    public function test_liked_content_user_has_liked_content_returns_true(): void
    {
        $content = Content::factory()->create();
        $this->likeContent($content);
        $response = $this->getJson(
            route('content.is_liked_by_user', ['user' => $this->user->id, 'content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => true];

        $response->assertJson($expectedJson);
    }

    public function test_liked_content_user_has_not_liked_content_returns_false(): void
    {
        $content = Content::factory()->create();
        $response = $this->getJson(
            route('content.is_liked_by_user', ['user' => $this->user->id, 'content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => false];
        $response->assertJson($expectedJson);
    }

    public function test_liked_content_user_has_unliked_content_returns_false(): void
    {
        $content = Content::factory()->create();
        $like = $this->likeContent($content);
        $response = $this->getJson(
            route('content.is_liked_by_user', ['user' => $this->user->id, 'content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => true];
        $response->assertJson($expectedJson);

        $like->delete();
        $response = $this->getJson(
            route('content.is_liked_by_user', ['user' => $this->user->id, 'content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => false];
        $response->assertJson($expectedJson);
    }

    public function test_liked_content_user_returns_correct_value_for_multiple_contents(): void
    {
        $likedContent1 = Content::factory()->create();
        $notLikedContent = Content::factory()->create();
        $likedContent2 = Content::factory()->create();
        $this->likeContent($likedContent1);
        $this->likeContent($likedContent2);
        $response = $this->getJson(
            route('content.is_liked_by_user', ['user' => $this->user->id, 'content_ids' => [$likedContent1->id, $notLikedContent->id, $likedContent2->id]]),
        );
        $response->assertOk();
        $expectedJson = [
            $likedContent1->id => true,
            $notLikedContent->id => false,
            $likedContent2->id => true
        ];
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

    public function test_content_user_progress_returns_not_started_when_user_has_not_started(): void
    {
        $content = Content::factory()->create();
        $response = $this->getJson(
            route('content.user_progress', ['user' => $this->user->id, 'content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::NotStarted->value, 'percent' => 0]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_not_started_when_no_content_progress_created(): void
    {
        $content = Content::factory()->create();
        $response = $this->getJson(
            route('content.user_progress', ['user' => $this->user->id, 'content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::NotStarted->value, 'percent' => 0]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_started_when_user_has_not_completed(): void
    {
        $content = Content::factory()->create();
        $progress = $this->createContentProgress($content, false);
        $progress->progress_percent = 25;
        $progress->save();
        $response = $this->getJson(
            route('content.user_progress', ['user' => $this->user->id, 'content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::Started->value, 'percent' => 25]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_completed_when_user_has_completed(): void
    {
        $content = Content::factory()->create();
        $this->createContentProgress($content, true);
        $response = $this->getJson(
            route('content.user_progress', ['user' => $this->user->id, 'content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::Completed->value, 'percent' => 100]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_uses_session_user_when_not_provided(): void
    {
        $content = Content::factory()->create();
        $this->createContentProgress($content, true);
        $response = $this->getJson(
            route('content.user_progress', ['content_ids' => [$content->id]]),
        );
        $response->assertOk();
        $expectedJson = [$content->id => ['state' => ProgressState::Completed->value, 'percent' => 100]];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_error_if_multiple_entries(): void
    {
        $content = Content::factory()->create();
        $this->createContentProgress($content, false);
        $this->createContentProgress($content, true);
        $response = $this->getJson(
            route('content.user_progress', ['content_ids' => [$content->id]]),
        );
        $response->assertNotFound();
        $expectedJson = ['error' => "Multiple ContentUserProgress found for Content {$content->id} and User {$this->user->id}"];
        $response->assertJson($expectedJson);
    }

    public function test_content_user_progress_returns_correct_value_for_multiple_contents(): void
    {
        $startedContent = Content::factory()->create();
        $progress = $this->createContentProgress($startedContent, false);
        $progress->progress_percent = 25;
        $progress->save();
        $completedContent = Content::factory()->create();
        $this->createContentProgress($completedContent, true);
        $notStartedContent = Content::factory()->create();

        $response = $this->getJson(
            route('content.user_progress', ['user' => $this->user->id, 'content_ids' => [$startedContent->id, $completedContent->id, $notStartedContent->id]]),
        );
        $response->assertOk();
        $expectedJson = [
            $startedContent->id => ['state' => ProgressState::Started->value, 'percent' => 25],
            $completedContent->id => ['state' => ProgressState::Completed->value, 'percent' => 100],
            $notStartedContent->id => ['state' => ProgressState::NotStarted->value, 'percent' => 0]
        ];
        $response->assertJson($expectedJson);
    }

    public function test_in_progress_content_returns_correct_value_for_songs(): void
    {
        Content::factory()->count(10)->create();
        $this->createContentWithProgress(5, 2);
        $incompleteContentIds = ContentUserProgress::where('user_id', $this->user->id)
            ->where('state', ProgressState::Started->value)
            ->pluck('content_id');
        $expectedJson = [
            ProgressState::Started->value => $incompleteContentIds->toArray()
        ];

        $response = $this->getJson(
            route('content.in_progress', ['user' => $this->user->id, 'content_type' => 'song']),
        );
        $response->assertOk();
        $response->assertJson($expectedJson);
    }

    public function test_in_progress_content_returns_correct_value_for_songs_in_brand(): void
    {
        Content::factory(['brand' => Brand::Drumeo->value])->count(5)->create();
        $this->createContentWithProgress(5, 2);
        Content::factory(['brand' => Brand::Singeo->value])->count(3)->create();
        $singeoContent = $this->createContentWithProgress(4, 6, Brand::Singeo);

        $expectedJson = [
            ProgressState::Started->value => $singeoContent->get('started')
        ];

        $response = $this->getJson(
            route('content.in_progress', ['content_type' => 'song', 'brand' => Brand::Singeo->value]),
        );
        $response->assertOk();
        $response->assertJson($expectedJson);
    }

    public function test_in_progress_content_returns_error_for_invalid_brand(): void
    {
        $response = $this->getJson(
            route('content.in_progress', ['content_type' => 'song', 'brand' => 'foo-bar-baz']),
        );
        $response->assertStatus(500);
        $this->assertStringContainsString('The selected brand is invalid', $response->getContent());
    }

    private function createContentWithProgress(int $startedCount = 0, int $completedCount = 0, ?Brand $brand = Brand::Drumeo): Collection
    {
        $results = collect();
        if ($startedCount) {
            $startedContents = Content::factory(['brand' => $brand->value])->count($startedCount)->create();
            $startedContents->each(function (Content $content) {
                $progress = $this->createContentProgress($content, false);
                $progress->progress_percent = 25;
                $progress->save();
            });
            $results->put('started', $startedContents->pluck('id')->toArray());
        }
        if ($completedCount) {
            $completedContents = Content::factory(['brand' => $brand->value])->count($completedCount)->create();
            $completedContents->each(function (Content $content) {
                $this->createContentProgress($content, true);
            });
            $results->put('completed', $completedContents->pluck('id')->toArray());
        }
        return $results;
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
