<?php

namespace App\Modules\FeatureFlagging\tests\Feature\Services;

use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Google\Exception;
use Illuminate\Support\Facades\Bus;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;


class FeatureFlagCRUDTest extends TestCase
{

    private FeatureFlagService $ffService;

    public function setUp(): void
    {
        parent::setUp();
        $this->ffService= app(FeatureFlagService::class);

    }

    public function test_crud_feature()
    {
        $name = $this->faker->unique()->name;
        $this->artisan("featureFlag:addFeature '$name'")
            ->assertSuccessful();
        $feature = Feature::whereName($name)->first();
        $this->assertDatabaseHas('features_features',
                                [
                                    'id' => $feature->id,
                                    'name' => $name
                                ]);
        $newDescription = $this->faker->sentence(3);

        $this->ffService->editFeature($feature->id, ['description' => $newDescription]);
        $feature->refresh();
        $this->assertEquals($feature->description, $newDescription);
        try {
            $this->ffService->editFeature($feature->id, ['name' => 'new name']);
            $this->fail('Name should be immutable');
        } catch (\InvalidArgumentException $e) {
        }
        $feature->refresh();
        $this->ffService->deleteFeature($feature->id);
        $this->assertDatabaseMissing('features_features',
            [ 'id' => $feature->id,
                'name' => $feature->name
            ]);
    }

    public function test_create_userid_list_different_formats()
    {
        // add and edit allow for different formats of userids, as a mixed array or as comma separated string
        $feature = $this->ffService->addFeature(
            $this->faker->name,
        );
        $this->assertDatabaseHas('features_features',
            [ 'id' => $feature->id,
                'name' => $feature->name,
            ]);
        $userList = [2, '1', '140'];
        $stringList = '2,1,140';
        $this->assertFeatureUserListUpdated($feature, $userList, $stringList);
        $userList = '11141';
        $this->assertFeatureUserListUpdated($feature, $userList, $userList);
        $userList = '2221,1141';
        $this->assertFeatureUserListUpdated($feature, $userList, $userList);
    }

    private function assertFeatureUserListUpdated($feature, $userList, $userListString)
    {
        $this->ffService->editFeature($feature->id, ['userid_list' => $userList]);
        $feature->refresh();
        $this->assertEquals($feature->userid_list, $userListString);
    }

    public function test_crud_branches()
    {
        $experiment = $this->ffService->addExperiment(
            $this->faker->name,
            default_value: $this->faker->words(2, true));
        $branch1 = $this->ffService->addBranch(
            $this->faker->name,
            $this->faker->words(2, true),
            $experiment->id,
            priority: 1,
            allow_filter: 'admin',
            weight: 10);
        // ----------- CREATE ----------------- //
        $this->assertDatabaseHas('features_branches', [
            'id' => $branch1->id,
            'name' => $branch1->name,
            'content' => $branch1->content,
            'experiment_id' => $branch1->experiment_id]);
        // ----------- EDIT ----------------- //
        $this->ffService->editBranch($branch1->id, ['description' => 'new description']);
        $branch1->refresh();
        try {
            $this->ffService->editBranch($branch1->id, ['name' => 'new name']);
            $this->fail('Name should be immutable');
        } catch (\InvalidArgumentException $e) {
        }
        try {
            $this->ffService->editBranch($branch1->id, ['experiment_id' => '10']);
            $this->fail('Experiment_id should be immutable');
        } catch (\InvalidArgumentException $e) {
        }
        // ----------- DELETE ----------------- //
        $this->ffService->deleteExperiment($experiment->id);
        $this->assertDatabaseMissing('features_features', [
                'id' => $branch1->id,
                'name' => $branch1->name]);
    }

    public function test_invalid_branch()
    {
        $this->expectNotToPerformAssertions();
        $experiment = $this->ffService->addExperiment(
            $this->faker->name,
            default_value: $this->faker->words(2, true));
        try {
            $branch1 = $this->ffService->addBranch(
                $this->faker->name,
                $this->faker->words(2, true),
                $experiment->id,
            );
            $this->fail('A Branch must contain either weight or valid_allow filter');
        } catch (\InvalidArgumentException $e) {
        }
        try {
            $branch1 = $this->ffService->addBranch(
                $this->faker->name,
                $this->faker->words(2, true),
                $experiment->id,
                allow_filter: 'garbage'
            );
            $this->fail('Allow filter must be a valid filter type');
        } catch (\InvalidArgumentException $e) {
        }
        try {
            $branch1 = $this->ffService->addBranch(
                $this->faker->name,
                $this->faker->words(2, true),
                $experiment->id,
                allow_filter: 'admin,garbage'
            );
            $this->fail('Allow filter must be a valid filter type');
        } catch (\InvalidArgumentException $e) {
        }
        $branch1 = $this->ffService->addBranch(
            $this->faker->name,
            $this->faker->words(2, true),
            $experiment->id,
            allow_filter: 'admin,older_than_3_months'
        );
    }

    public function test_crud_experiment()
    {
        $experiment = $this->ffService->addExperiment(
            $this->faker->name,
            default_value: $this->faker->words(2, true));
        // ----------- CREATE ----------------- //
        $this->assertDatabaseHas('features_experiments', [
                'id' => $experiment->id,
                'name' => $experiment->name,
                'default_value' => $experiment->default_value,
                'enabled' => true]);
        // ----------- EDIT ----------------- //

        $this->ffService->setExperimentEnabled($experiment->id, false);
        $experiment->refresh();
        $this->assertDatabaseHas('features_experiments', [
            'id' => $experiment->id,
            'name' => $experiment->name,
            'default_value' => $experiment->default_value,
            'enabled' => false]);
        $name = $experiment->name;
        $this->artisan("featureFlag:toggleExperiment '$name' 1")->assertSuccessful();
        $experiment->refresh();
        // ----------- DELETE WITH CHILDREN ----------------- //
        $branch1 = $this->ffService->addBranch(
            $this->faker->name,
            $this->faker->words(2, true),
            $experiment->id,
            weight: 1);
        $this->assertDatabaseHas('features_branches', [
            'id' => $branch1->id,
            'name' => $branch1->name,
            'content' => $branch1->content,
            'experiment_id' => $branch1->experiment_id]);
        $user = User::factory()->create();
        Bus::fake();
        $content = FeatureFlagging::branch($experiment->name, $user);
        $this->assertEquals($content, $branch1->content);
        $this->assertDatabaseHas('features_tracking', [
            'user_id' => $user->id,
            'experiment_id' => $experiment->id,
            'branch_id' => $branch1->id]);

        $this->ffService->deleteExperiment($experiment->id);

        $this->assertDatabaseMissing('features_experiments', [
            'id' => $experiment->id,
        ]);

        $this->assertDatabaseMissing('features_branches', [
            'id' => $branch1->id,
        ]);
        $this->assertDatabaseMissing('features_tracking', [
            'user_id' => $user->id,
            'experiment_id' => $experiment->id,
            'branch_id' => $branch1->id]);
    }

    public function test_add_remove_users_from_branch()
    {
        $experiment = $this->ffService->addExperiment(
            $this->faker->name,
            default_value: $this->faker->words(2, true));
        $branch1 = $this->ffService->addBranch(
            $this->faker->name,
            $this->faker->words(2, true),
            $experiment->id,
            weight: 1);
        $name = $branch1->name;
        $this->artisan("featureFlag:addRemoveUsersToBranch '$name' 1,2,3 --add")
            ->assertSuccessful();
        $branch1->refresh();
        $this->assertEquals($branch1->userid_list, '1,2,3');
        $this->artisan("featureFlag:addRemoveUsersToBranch '$name' 4,5 --add")
            ->assertSuccessful();
        $branch1->refresh();
        $this->assertEquals($branch1->userid_list, '1,2,3,4,5');
        $this->artisan("featureFlag:addRemoveUsersToBranch '$name' 3,4 --remove")
            ->assertSuccessful();
        $branch1->refresh();
        $this->assertEquals($branch1->userid_list, '1,2,5');
    }

    public function test_add_remove_users_from_feature()
    {
        $name = $this->faker->unique()->name;
        $this->artisan("featureFlag:addFeature '$name'")
            ->assertSuccessful();
        $feature = Feature::whereName($name)->first();
        $this->artisan("featureFlag:addRemoveUsersToFeature '$name' 1,2,3 --add")
            ->assertSuccessful();
        $feature->refresh();
        $this->assertEquals($feature->userid_list, '1,2,3');
        $this->artisan("featureFlag:addRemoveUsersToFeature '$name' 4,5 --add")
            ->assertSuccessful();
        $feature->refresh();
        $this->assertEquals($feature->userid_list, '1,2,3,4,5');
        $this->artisan("featureFlag:addRemoveUsersToFeature '$name' 3,4 --remove")
            ->assertSuccessful();
        $feature->refresh();
        $this->assertEquals($feature->userid_list, '1,2,5');
    }

}
