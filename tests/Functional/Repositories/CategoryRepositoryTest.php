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

    public function test_create_no_parent_fields_data()
    {
        $slug = implode('-', $this->faker->words());

        $categoryId = $this->classBeingTested->create($slug, null, 0, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'id' => $categoryId,
                'slug' => $slug,
                'lft' => 1,
                'rgt' => 4,
                'parent_id' => null,
                'position' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }

    public function test_create_full_category_tree()
    {
        $slug = implode('-', $this->faker->words());
        $childSlug = implode('-', $this->faker->words());

        $categoryId = $this->classBeingTested->create($slug, null, [], []);
        $childCategoryId = $this->classBeingTested->create($childSlug, $categoryId, [], []);

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $slug,
                'lft' => 1,
                'rgt' => 4,
                'parent_id' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableCategories,
            [
                'slug' => $childSlug,
                'lft' => 2,
                'rgt' => 3,
                'parent_id' => $categoryId,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }
}