<?php

namespace App\Modules\FeatureFlagging\tests\Feature\Services;

use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Illuminate\Support\Carbon;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class FeatureFlagFunctionalTest extends TestCase
{
    private FeatureFlagService $ffService;

    public function setUp(): void
    {
        parent::setUp();

        $this->ffService = app(FeatureFlagService::class);

        $this->experiment = $this->ffService->addExperiment(
            $this->faker->unique()->name,
            default_value: $this->faker->unique()->words(2, true)
        );
        $this->branch1 = $this->ffService->addBranch(
            $this->faker->unique()->name,
            $this->faker->unique()->words(2, true),
            $this->experiment->id,
            weight: 1
        );
        $this->branch2 = $this->ffService->addBranch(
            $this->faker->unique()->name,
            $this->faker->unique()->words(2, true),
            $this->experiment->id,
            weight: 1
        );
    }

    public function test_invalid_branch()
    {
        $this->expectException(\InvalidArgumentException::class);
        FeatureFlagging::branch($this->faker->unique()->word);
    }

    public function test_invalid_feature()
    {
        $this->assertTrue(FeatureFlagging::accessible($this->faker->unique()->word));
    }

    public function test_branch()
    {
        // Branch technically run on probability, so it's not strictly possible to ensure this test doesn't pass by accident :D
        // We do what we can. In this case, we set the probability of a given branch to 100% to ensure it gets selected

        $this->ffService->editBranch($this->branch1->id, ['weight' => 1]);
        $this->ffService->editBranch($this->branch2->id, ['weight' => 0]);

        $user = User::factory()->create();
        $content = FeatureFlagging::branch($this->experiment->name, $user);
        $this->assertEquals($content, $this->branch1->content);

        $this->ffService->editBranch($this->branch1->id, ['weight' => 0]);
        $this->ffService->editBranch($this->branch2->id, ['weight' => 1]);
        $user2 = User::factory()->create();
        $content2 = FeatureFlagging::branch($this->experiment->name, $user2);
        $this->assertEquals($content2, $this->branch2->content);
    }

    public function test_feature_no_user()
    {
        $feature = $this->ffService->addFeature($this->faker->unique()->name, active_at: Carbon::now()->addDays(1));
        $isAccessible = FeatureFlagging::accessible($feature->name);
        $this->assertFalse($isAccessible);

        $feature = $this->ffService->addFeature($this->faker->unique()->name, active_at: Carbon::now()->addDays(-1));
        $isAccessible = FeatureFlagging::accessible($feature->name);
        $this->assertTrue($isAccessible);
    }

    public function test_feature_inaccessible()
    {
        $feature = $this->ffService->addFeature($this->faker->unique()->name, active_at: Carbon::now()->addDays(1));
        $user = User::factory()->create();
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertFalse($isAccessible);
    }

    public function test_feature_accessible()
    {
        $feature = $this->ffService->addFeature($this->faker->unique()->name, active_at: Carbon::now()->addDays(-1));
        $user = User::factory()->create();
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertTrue($isAccessible);
    }

    public function test_feature_userid_list()
    {
        $feature = $this->ffService->addFeature($this->faker->unique()->name, active_at: Carbon::now()->addDays(1));
        $user = User::factory()->create();
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertFalse($isAccessible);

        $this->ffService->editFeature($feature->id, ['userid_list' => $user->id]);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertTrue($isAccessible);
    }

    public function test_feature_allow_filter_admin()
    {
        $feature = $this->ffService->addFeature($this->faker->unique()->name, active_at: Carbon::now()->addDays(1));
        $user = User::factory()->create(['permission_level' => User::PERMISSION_LEVEL_ADMIN]);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertFalse($isAccessible);

        $this->ffService->editFeature($feature->id, ['allow_filter' => 'admin']);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertTrue($isAccessible);
    }

    public function test_feature_block_filter_admin()
    {
        $feature = $this->ffService->addFeature($this->faker->unique()->name);
        $user = User::factory()->create(['permission_level' => User::PERMISSION_LEVEL_ADMIN]);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertTrue($isAccessible);

        $this->ffService->editFeature($feature->id, ['block_filter' => 'admin']);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertFalse($isAccessible);
    }

    public function test_feature_block_list_younger_than()
    {
        $feature = $this->ffService->addFeature($this->faker->unique()->name);
        $user = User::factory()->create(['created_at' => Carbon::now()->addDays(-2)]);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertTrue($isAccessible);

        $this->ffService->editFeature($feature->id, ['block_filter' => 'younger_than_1_days']);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertTrue($isAccessible);

        $this->ffService->editFeature($feature->id, ['block_filter' => 'younger_than_3_days']);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertFalse($isAccessible);
    }

    public function test_feature_allow_list_older_than()
    {
        $feature = $this->ffService->addFeature($this->faker->unique()->name, active_at: Carbon::now()->addDays(1));
        $user = User::factory()->create(['created_at' => Carbon::now()->addMonths(-4)]);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertFalse($isAccessible);

        $this->ffService->editFeature($feature->id, ['allow_filter' => 'older_than_3_months']);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertTrue($isAccessible);

        $this->ffService->editFeature($feature->id, ['allow_filter' => 'older_than_5_months']);
        $isAccessible = FeatureFlagging::accessible($feature->name, $user);
        $this->assertFalse($isAccessible);
    }

    public function test_experiment_disabled()
    {
        $experiment = $this->ffService->addExperiment(
            $this->faker->unique()->name,
            default_value: $this->faker->words(2, true)
        );
        $branch1 = $this->ffService->addBranch(
            $this->faker->unique()->name,
            $this->faker->unique()->words(2, true),
            $experiment->id,
            weight: 1
        );
        $this->ffService->setExperimentEnabled($experiment->id, false);
        $user = User::factory()->create();
        $content = FeatureFlagging::branch($experiment->name, $user);
        $this->assertEquals($content, $experiment->default_value);
    }



    public function test_branch_allow_filter_admin()
    {
        $this->ffService->editBranch($this->branch1->id, ['weight' => 10, 'priority' => 1]);
        $this->ffService->editBranch($this->branch2->id, ['weight' => 0, 'priority' => 2]);
        $user = User::factory()->create(['permission_level' => User::PERMISSION_LEVEL_ADMIN]);
        $content = FeatureFlagging::branch($this->experiment->name, $user);
        $this->assertEquals($content, $this->branch1->content);

        // setting the override in branch2 should enforce this path
        $user2 = User::factory()->create(['permission_level' => User::PERMISSION_LEVEL_ADMIN]);
        $this->ffService->editBranch($this->branch2->id, ['userid_list' => $user2->id]);
        $content = FeatureFlagging::branch($this->experiment->name, $user2);
        $this->assertEquals($content, $this->branch2->content);

        // setting both branches to have userid_list should follow the priority stack and land on branch1
        $user3 = User::factory()->create(['permission_level' => User::PERMISSION_LEVEL_ADMIN]);
        $this->ffService->editBranch($this->branch1->id, ['userid_list' => $user3->id, 'weight' => 0]);
        $this->ffService->editBranch($this->branch2->id, ['userid_list' => $user3->id, 'weight' => 0]);
        $content = FeatureFlagging::branch($this->experiment->name, $user3);
        $this->assertEquals($content, $this->branch1->content);
    }

    public function test_branch_allow_list_older_than()
    {
        $this->ffService->editBranch($this->branch1->id, ['weight' => 10, 'priority' => 1]);
        $this->ffService->editBranch($this->branch2->id, ['weight' => 0, 'priority' => 2, 'allow_filter' => 'older_than_1_month']);
        $user = User::factory()->create(['created_at' => Carbon::now()->addMonths(-5)]);
        $content = FeatureFlagging::branch($this->experiment->name, $user);
        $this->assertEquals($content, $this->branch2->content);
    }

    public function test_branch_repeat_user()
    {
        // calling branch with the same user should return the same branch every time.
        $this->ffService->editBranch($this->branch1->id, ['weight' => 1]);
        $this->ffService->editBranch($this->branch2->id, ['weight' => 0]);

        $user = User::factory()->create();
        $content = FeatureFlagging::branch($this->experiment->name, $user);
        $this->assertEquals($content, $this->branch1->content);

        $this->ffService->editBranch($this->branch1->id, ['weight' => 0]);
        $this->ffService->editBranch($this->branch2->id, ['weight' => 1]);

        $content = FeatureFlagging::branch($this->experiment->name, $user);
        $this->assertEquals($content, $this->branch1->content);

        $user2 = User::factory()->create();
        $content = FeatureFlagging::branch($this->experiment->name, $user2);
        $this->assertEquals($content, $this->branch2->content);
    }

    public function test_all_experiments()
    {
        $user = User::factory()->create();
        $experiment1 = $this->ffService->addExperiment(
            $this->faker->unique()->name,
            default_value: $this->faker->unique()->words(2, true)
        );
        $experiment1 = $this->ffService->addExperiment(
            $this->faker->unique()->name,
            default_value: $this->faker->unique()->words(2, true)
        );
        $this->ffService->editBranch($this->branch1->id, ['weight' => 1]);
        $this->ffService->editBranch($this->branch2->id, ['weight' => 0]);
        $allBranches = FeatureFlagging::allBranches($user);
        $this->assertTrue(isset($allBranches[$experiment1->name]), "ExperimentName not found in returned array");
        $this->assertEquals($allBranches[$experiment1->name], $experiment1->default_value);
        $this->assertTrue(isset($allBranches[$this->experiment->name]), "ExperimentName not found in returned array");
        $this->assertEquals($allBranches[$this->experiment->name], $this->branch1->content);
    }

    public function test_all_features()
    {
        $now = Carbon::now();
        $tomorrow = $now->addDay();
        $user = User::factory()->create(['permission_level' => User::PERMISSION_LEVEL_ADMIN]);
        $allowed1 = $this->ffService->addFeature($this->faker->unique()->word);
        $notAllowed1 = $this->ffService->addFeature($this->faker->unique()->word, active_at: $tomorrow);
        $allowed2 = $this->ffService->addFeature($this->faker->unique()->word, active_at: $tomorrow, userid_list: [$user->id]);
        $allFeatures = FeatureFlagging::allowedFeatures($user);
        $this->assertContains($allowed1->name, $allFeatures);
        $this->assertContains($allowed2->name, $allFeatures);
        $this->assertNotContains($notAllowed1->name, $allFeatures);
    }

    public function test_musora_filter()
    {
        $now = Carbon::now();
        $tomorrow = $now->addDay();
        $domains = ['musora', 'drumeo', 'singeo', 'pianote', 'guitareo'];
        $musoraFeature = $this->ffService->addFeature($this->faker->unique()->word, allow_filter: 'musora', active_at: $tomorrow);
        foreach($domains as $domain) {
            $user = User::factory()->create(['email' => "a@$domain.com"]);
            $this->assertTrue(FeatureFlagging::accessible($musoraFeature->name, $user));
        }
        $userBlocked = User::factory()->create();
        $this->assertFalse(FeatureFlagging::accessible($musoraFeature->name, $userBlocked));
    }

}
