<?php


use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Services\ContentService;
use Tests\TestCase;

class ContentPolicyTest extends TestCase
{
    private User $normalUser;
    private User $adminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->normalUser = User::factory()->create();
        $this->adminUser = User::factory()->create(['permission_level' => User::PERMISSION_LEVEL_ADMIN]);
    }

    public function test_normal_user_can_access_published_content(): void
    {
        $content = Content::factory()->create();
        $this->actingAs($this->normalUser);
        $this->assertTrue(Gate::check('view', $content));
    }

    public function test_admin_user_can_access_content_published_in_the_future(): void
    {
        $content = Content::factory()->create([
            'status' => ContentService::STATUS_PUBLISHED,
            'published_on' => Carbon::now()->addDays(30),
        ]);
        $this->actingAs($this->adminUser);
        $this->assertTrue(Gate::check('view', $content));
    }

    public function test_normal_user_cannot_access_content_published_in_the_future(): void
    {
        $content = Content::factory()->create([
            'status' => ContentService::STATUS_PUBLISHED,
            'published_on' => Carbon::now()->addDays(30),
        ]);
        $this->actingAs($this->normalUser);
        $this->assertFalse(Gate::check('view', $content));
    }

    public function test_normal_user_cannot_access_draft_content(): void
    {
        $content = Content::factory()->create([
            'status' => ContentService::STATUS_DRAFT,
        ]);
        $this->actingAs($this->normalUser);
        $this->assertFalse(Gate::check('view', $content));
    }

    public function test_normal_user_cannot_access_scheduled_content(): void
    {
        $content = Content::factory()->create([
            'status' => ContentService::STATUS_SCHEDULED,
        ]);
        $this->actingAs($this->normalUser);
        $this->assertFalse(Gate::check('view', $content));
    }

    public function test_normal_user_cannot_access_deleted_content(): void
    {
        $content = Content::factory()->create([
            'status' => ContentService::STATUS_DELETED,
        ]);
        $this->actingAs($this->normalUser);
        $this->assertFalse(Gate::check('view', $content));
    }

}
