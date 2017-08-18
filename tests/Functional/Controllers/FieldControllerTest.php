<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\CategoryRepository;
use Railroad\Railcontent\Repositories\FieldRepository;
use Railroad\Railcontent\Services\FieldService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class FieldControllerTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(FieldService::class);
        $this->classBeingTested = $this->app->make(FieldRepository::class);
        $this->categoryClass = $this->app->make(CategoryRepository::class);
    }

    public function test_create_category_field_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $slug = implode('-', $this->faker->words());
        $type = $this->faker->text(64);
        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);

        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId, null, $key, $value, ConfigService::$subjectTypeCategory);

        $expectedResult = new \stdClass();
        $expectedResult->id = 1;
        $expectedResult->subject_id = $categoryId;
        $expectedResult->subject_type = ConfigService::$subjectTypeCategory;
        $expectedResult->field_id = 1;
        $expectedResult->key = $key;
        $expectedResult->value = $value;
        $expectedResult->created_at =  Carbon::now()->toDateTimeString();
        $expectedResult->updated_at =  Carbon::now()->toDateTimeString();

        $this->assertEquals($expectedResult, $categoryField);
    }

    public function test_add_category_field_controller_method_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $response = $this->call('POST', 'category/field', ['category_id'=>1,'key'=>$key, 'value' => $value]);

        $this->assertEquals(200, $response->status());

        $response->assertJsonStructure(
            [
                'id' ,
                'subject_id',
                'subject_type',
                'field_id',
                'created_at',
                'updated_at',
            ]
        );

        $response->assertJson(
            [
                'id' => 1,
                'subject_id' => 1,
                'subject_type' => ConfigService::$subjectTypeCategory,
                'field_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'key' => $key,
                'value' => $value
            ]
        );
    }

    public function test_add_category_field_not_pass_the_validation()
    {
        $response = $this->call('POST', 'category/field');

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key','value','category_id']);
    }

    public function test_add_category_field_key_value_not_pass_the_validation()
    {
        $key = $this->faker->text(500);
        $value = $this->faker->text(500);
        $response = $this->call('POST', 'category/field',['category_id'=>1,'key'=>$key, 'value' => $value]);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key','value']);
    }

    public function test_update_category_field_controller_method_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);

        $fieldId = $this->classBeingTested->updateOrCreateField(null,$key,$value);

        $categoryField = $this->serviceBeingTested->createCategoryField(1, $fieldId, $key, $value, ConfigService::$subjectTypeCategory);

        $new_value =$this->faker->text(255);

        $response = $this->call('PUT', 'category/field/'.$fieldId, ['category_id'=>1,'key'=>$key, 'value' => $new_value]);

        $this->assertEquals(201, $response->status());

        $response->assertJsonStructure(
            [
                'id' ,
                'subject_id',
                'subject_type',
                'field_id',
                'created_at',
                'updated_at',
            ]
        );

        $response->assertJson(
            [
                'id' => 1,
                'subject_id' => 1,
                'subject_type' => ConfigService::$subjectTypeCategory,
                'field_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'key' => $key,
                'value' => $new_value
            ]
        );
    }

    public function test_update_category_field_not_pass_validation()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);

        $fieldId = $this->classBeingTested->updateOrCreateField(null,$key,$value);
        $categoryField = $this->serviceBeingTested->createCategoryField(1, $fieldId, $key, $value, ConfigService::$subjectTypeCategory);

        $response = $this->call('PUT', 'category/field/'.$fieldId);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key','value','category_id']);
    }

    public function test_delete_category_field_controller()
    {
        $key = $this->faker->text(255);
        $value =  $this->faker->text(255);
        $type = $this->faker->text(64);

        $fieldId = $this->classBeingTested->updateOrCreateField(null,$key,$value);

        $slug = implode('-', $this->faker->words());
        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);

        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId, $fieldId, $key, $value, ConfigService::$subjectTypeCategory);

        $response = $this->call('DELETE', 'category/field/'.$fieldId, ['category_id'=>$categoryId]);

        $this->assertEquals(1, $response->content());
        $this->assertEquals(200, $response->status());
    }

    public function test_update_category_field_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value =  $this->faker->text(255);
        $slug = implode('-', $this->faker->words());
        $type = $this->faker->text(64);

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);
        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId, null, $key, $value, ConfigService::$subjectTypeCategory);

        $new_value = implode('-', $this->faker->words());
        $categoryField = $this->serviceBeingTested->updateCategoryField($categoryId, $categoryField->field_id, $key, $new_value, ConfigService::$subjectTypeCategory);

        $expectedResult = new \stdClass();
        $expectedResult->id = 1;
        $expectedResult->subject_id = $categoryId;
        $expectedResult->subject_type = ConfigService::$subjectTypeCategory;
        $expectedResult->field_id = 1;
        $expectedResult->key = $key;
        $expectedResult->value = $new_value;
        $expectedResult->created_at =  Carbon::now()->toDateTimeString();
        $expectedResult->updated_at =  Carbon::now()->toDateTimeString();

        $this->assertEquals($expectedResult, $categoryField);

    }

    public function test_get_category_field_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $slug = implode('-', $this->faker->words());
        $type = $this->faker->text(64);

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);
        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId, null, $key, $value, ConfigService::$subjectTypeCategory);

        $results = $this->serviceBeingTested->getCategoryField($categoryField->field_id, $categoryId, ConfigService::$subjectTypeCategory);

        $this->assertEquals($categoryField, $results);
    }

    public function test_delete_category_field_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $slug = implode('-', $this->faker->words());
        $type = $this->faker->text(64);

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);
        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId, null, $key, $value, ConfigService::$subjectTypeCategory);

        $results = $this->serviceBeingTested->deleteCategoryField($categoryField->field_id, $categoryId, ConfigService::$subjectTypeCategory);

        $this->assertEquals(1, $results);
    }
}
