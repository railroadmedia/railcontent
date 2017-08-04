<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\CategoryRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CategoryRepositoryTest extends RailcontentTestCase
{
    /**
     * @var CategoryRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(CategoryRepository::class);
    }

    public function test_create_single()
    {
        $slug = implode('-', $this->faker->words());

        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId,
                'slug' => $slug,
                'lft' => 1,
                'rgt' => 2,
                'parent_id' => null,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }

    public function test_push_position_stack()
    {
        $slug = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());
        $slug3 = implode('-', $this->faker->words());

        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);
        $category2Id = $this->classBeingTested->create($slug2, null, 1, [], []);
        $category3Id = $this->classBeingTested->create($slug3, null, 1, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId,
                'position' => 3,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $category2Id,
                'position' => 2,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $category3Id,
                'position' => 1,
            ]
        );
    }

    public function test_push_position_stack_tree()
    {
        $slug = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());
        $slug3 = implode('-', $this->faker->words());
        $slug4 = implode('-', $this->faker->words());
        $slug5 = implode('-', $this->faker->words());
        $slug6 = implode('-', $this->faker->words());

        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);
        $category2Id = $this->classBeingTested->create($slug2, $categoryId, 1, [], []);
        $category3Id = $this->classBeingTested->create($slug3, $category2Id, 1, [], []);
        $category4Id = $this->classBeingTested->create($slug4, $category2Id, 1, [], []);
        $category5Id = $this->classBeingTested->create($slug5, $categoryId, 1, [], []);
        $category6Id = $this->classBeingTested->create($slug6, $categoryId, 99, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId,
                'position' => 1,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $category2Id,
                'position' => 2,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $category3Id,
                'position' => 2,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $category4Id,
                'position' => 1,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $category5Id,
                'position' => 1,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $category6Id,
                'position' => 3,
            ]
        );
    }

    public function test_push_position_stack_abnormal()
    {
        $slug = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());

        $categoryId = $this->classBeingTested->create($slug, null, 5, [], []);
        $category2Id = $this->classBeingTested->create($slug2, null, -54, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId,
                'slug' => $slug,
                'lft' => 3,
                'rgt' => 4,
                'parent_id' => null,
                'position' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $category2Id,
                'slug' => $slug2,
                'lft' => 1,
                'rgt' => 2,
                'parent_id' => null,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }

    public function test_create_full_category_tree()
    {
        /*
         * --- $slug1 1:16 - 1
         * ------ $slug2 2:13 - 1
         * --------- $slug3 3:4 - 1
         * --------- $slug4 5:6 - 2
         * --------- $slug5 7:8 - 3
         * --------- $slug6 9:12 - 4
         * ------------ $slug7 10:11 - 1
         * ------ $slug8 14:15 - 2
         * --- $slug9 17:18 - 2
         */

        $slug1 = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());
        $slug3 = implode('-', $this->faker->words());
        $slug4 = implode('-', $this->faker->words());
        $slug5 = implode('-', $this->faker->words());
        $slug6 = implode('-', $this->faker->words());
        $slug7 = implode('-', $this->faker->words());
        $slug8 = implode('-', $this->faker->words());
        $slug9 = implode('-', $this->faker->words());

        $categoryId1 = $this->classBeingTested->create($slug1, null, 1, [], []);
        $categoryId2 = $this->classBeingTested->create($slug2, $categoryId1, 1, [], []);
        $categoryId3 = $this->classBeingTested->create($slug3, $categoryId2, 1, [], []);
        $categoryId4 = $this->classBeingTested->create($slug4, $categoryId2, 2, [], []);
        $categoryId5 = $this->classBeingTested->create($slug5, $categoryId2, 3, [], []);
        $categoryId6 = $this->classBeingTested->create($slug6, $categoryId2, 4, [], []);
        $categoryId7 = $this->classBeingTested->create($slug7, $categoryId6, 1, [], []);
        $categoryId8 = $this->classBeingTested->create($slug8, $categoryId1, 2, [], []);
        $categoryId9 = $this->classBeingTested->create($slug9, null, 2, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug1,
                'lft' => 1,
                'rgt' => 16,
                'parent_id' => null,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug2,
                'lft' => 2,
                'rgt' => 13,
                'parent_id' => $categoryId1,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug3,
                'lft' => 3,
                'rgt' => 4,
                'parent_id' => $categoryId2,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug4,
                'lft' => 5,
                'rgt' => 6,
                'parent_id' => $categoryId2,
                'position' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug5,
                'lft' => 7,
                'rgt' => 8,
                'parent_id' => $categoryId2,
                'position' => 3,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug6,
                'lft' => 9,
                'rgt' => 12,
                'parent_id' => $categoryId2,
                'position' => 4,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug7,
                'lft' => 10,
                'rgt' => 11,
                'parent_id' => $categoryId6,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug8,
                'lft' => 14,
                'rgt' => 15,
                'parent_id' => $categoryId1,
                'position' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug9,
                'lft' => 17,
                'rgt' => 18,
                'parent_id' => null,
                'position' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }

    public function test_create_very_simple_category_tree()
    {
        /*
         * --- $slug2 1:4
         * ------ $slug3 2:3
         * --- $slug2 5:6
         */

        $slug1 = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());
        $slug3 = implode('-', $this->faker->words());

        $categoryId1 = $this->classBeingTested->create($slug1, null, 1, [], []);
        $categoryId2 = $this->classBeingTested->create($slug2, $categoryId1, 1, [], []);
        $categoryId3 = $this->classBeingTested->create($slug3, null, 2, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug1,
                'lft' => 1,
                'rgt' => 4,
                'parent_id' => null,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug2,
                'lft' => 2,
                'rgt' => 3,
                'parent_id' => $categoryId1,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug3,
                'lft' => 5,
                'rgt' => 6,
                'parent_id' => null,
                'position' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }

    public function test_update_category_slug()
    {
        $slug = implode('-', $this->faker->words());
        $updated_slug = implode('-', $this->faker->words());

        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);
        $this->classBeingTested->update($categoryId, $updated_slug,1, [], []);
        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId,
                'slug' => $updated_slug,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }

    public function test_update_category_position()
    {
        $slug1 = implode('-', $this->faker->words());
        $slug2 = implode('-', $this->faker->words());
        $slug3 = implode('-', $this->faker->words());

        $categoryId1 = $this->classBeingTested->create($slug1, null, 1, [], []);
        $categoryId11 = $this->classBeingTested->create($slug2, $categoryId1, 1, [], []);
        $categoryId12 = $this->classBeingTested->create($slug3, $categoryId1, 2, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId11,
                'position' => 1,
                'parent_id'=>1,
                'lft' => 2,
                'rgt' => 3,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId12,
                'position' => 2,
                'parent_id'=>1,
                'lft' => 4,
                'rgt' => 5,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $categoryId12 = $this->classBeingTested->update($categoryId12, $slug3,1);

        $this->assertDatabaseHas(
        ConfigService::$tableCategories,
            [
                'id' => $categoryId12,
                'position' => 1,
                'lft' => 2,
                'rgt' => 3,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId11,
                'position' => 2,
                'lft' => 4,
                'rgt' => 5,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }
}