<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\CategoryRepository;
use Railroad\Railcontent\Repositories\FieldRepository;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class FieldRepositoryTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(FieldRepository::class);
        $this->categoryClass = $this->app->make(CategoryRepository::class);
    }

    public function test_insert_field()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $field = $this->classBeingTested->updateOrCreateField(1, $key, $value);

        $this->assertEquals(1, $field);

        $this->assertDatabaseHas(
            ConfigService::$tableFields,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value

            ]
        );
    }

    public function test_update_field()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $field = $this->classBeingTested->updateOrCreateField(1, $key, $value);

        $this->assertEquals(1, $field);

        $this->assertDatabaseHas(
            ConfigService::$tableFields,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value

            ]
        );

        $new_value = $this->faker->text(255);
        $field = $this->classBeingTested->updateOrCreateField(1, $key, $new_value);

        $this->assertEquals(1, $field);

        $this->assertDatabaseMissing(
            ConfigService::$tableFields,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value

            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableFields,
            [
                'id' => 1,
                'key' => $key,
                'value' => $new_value

            ]
        );
    }

    public function test_delete_field()
    {
        $id = 1;
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);

        $this->classBeingTested->updateOrCreateField($id, $key, $value);

        $this->assertDatabaseHas(
            ConfigService::$tableFields,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value

            ]
        );

        $this->classBeingTested->deleteField($id, $key);

        $this->assertDatabaseMissing(
            ConfigService::$tableFields,
            [
                'id' => 1,
                'key' => $key,
                'value' => $value

            ]
        );
    }

    public function test_link_category_field()
    {
        $slug = implode('-',$this->faker->words());
        $type = $this->faker->text(64);

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);

        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $fieldId = $this->classBeingTested->updateOrCreateField(null, $key, $value);

        $result = $this->classBeingTested->linkSubjectField($fieldId, $categoryId, ConfigService::$subjectTypeCategory);

        $this->assertEquals(1, $result);
    }

    public function test_get_category_field()
    {
        $slug = implode('-',$this->faker->words());
        $type = $this->faker->text(64);

        $categoryId = $this->categoryClass->create($slug, null, 1,  ConfigService::$categoryStatusNew, $type);

        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $fieldId = $this->classBeingTested->updateOrCreateField(null, $key, $value);

        $linkCategoryFieldId = $this->classBeingTested->linkSubjectField($fieldId, $categoryId, ConfigService::$subjectTypeCategory);

        $results = $this->classBeingTested->getSubjectField($fieldId, $categoryId);

        $expectedResults = new \stdClass();
        $expectedResults->id = $linkCategoryFieldId;
        $expectedResults->subject_id = $categoryId;
        $expectedResults->subject_type = ConfigService::$subjectTypeCategory;
        $expectedResults->field_id = $fieldId;
        $expectedResults->created_at = Carbon::now()->toDateTimeString();
        $expectedResults->updated_at = Carbon::now()->toDateTimeString();
        $expectedResults->key = $key;
        $expectedResults->value = $value;

        $this->assertEquals($expectedResults, $results);
    }

    public function test_unlink_category_field()
    {
        $slug = implode('-',$this->faker->words());
        $type = $this->faker->text(64);

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);

        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $fieldId = $this->classBeingTested->updateOrCreateField(null, $key, $value);

        $this->classBeingTested->linkSubjectField($fieldId, $categoryId, ConfigService::$subjectTypeCategory);

        $results = $this->classBeingTested->unlinkCategoryField($fieldId, $categoryId);

        $this->assertEquals(1, $results);
    }

}
