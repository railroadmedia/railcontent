<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Response;
use Railroad\Railcontent\Repositories\CategoryRepository;
use Railroad\Railcontent\Services\CategoryService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class CategoryControllerTest extends RailcontentTestCase
{
    /**
     * @var CategoryRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(CategoryService::class);
        $this->classBeingTested = $this->app->make(CategoryRepository::class);
    }

    public function test_store_response_status()
    {
        $slug = implode('-', $this->faker->words());

        $response = $this->call('POST', 'category', ['slug'=>$slug,'position'=>1]);

        $this->assertEquals(200, $response->status());
    }

    public function test_store_not_pass_the_validation()
    {
        $response = $this->call('POST', 'category');

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['slug','position']);
    }

    public function test_store_with_negative_position()
    {
        $slug = implode('-', $this->faker->words());

        $response = $this->call('POST', 'category', ['slug' => $slug, 'position' => -1]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['position']);
    }

    public function test_store_with_slug_huge()
    {
        $slug =  $this->faker->text(500);

        $response = $this->call('POST', 'category', ['slug' => $slug, 'position' => -1]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['slug']);
    }

    public function test_category_created_is_returned_in_json_format()
    {
        $slug = implode('-', $this->faker->words());

        $response = $this->call('POST', 'category', ['slug' => $slug, 'position' => 1]);

        $response->assertJson(
            [
                'id' => '1',
                'slug' => $slug,
                'position' => '1',
                'lft' => '1',
                'rgt' => '2',
                'parent_id' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }

    public function test_category_service_return_new_category_after_create()
    {
        $slug = implode('-', $this->faker->words());
        $category = $this->serviceBeingTested->create($slug, null, 1);

        $expectedResult = new \stdClass();
        $expectedResult->id = 1;
        $expectedResult->slug = $slug;
        $expectedResult->position = 1;
        $expectedResult->lft = 1;
        $expectedResult->rgt = 2;
        $expectedResult->parent_id = null;
        $expectedResult->created_at =  Carbon::now()->toDateTimeString();
        $expectedResult->updated_at =  Carbon::now()->toDateTimeString();

        $this->assertEquals($expectedResult, $category);
    }

    public function test_update_response_status()
    {
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $response = $this->call('PUT', 'category/'.$categoryId, ['slug' => $slug, 'position'=> 1]);

        $this->assertEquals(201, $response->status());
    }

    public function test_update_missing_category_response_status()
    {
        $slug = implode('-', $this->faker->words());

        $response = $this->call('PUT', 'category/1', ['slug' => $slug, 'position'=> 1]);

        $this->assertEquals(404, $response->status());
    }

    public function test_update_with_negative_position()
    {
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $response = $this->call('PUT', 'category/'.$categoryId, ['slug' => $slug, 'position' => -1]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['position']);
    }

    public function test_update_not_pass_the_validation()
    {
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $response = $this->call('PUT', 'category/'.$categoryId);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['slug','position']);
    }

    public function test_after_update_category_is_returned_in_json_format()
    {
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);
        $existingCategory = $this->classBeingTested->getById($categoryId);

        $new_slug = implode('-', $this->faker->words());
        $response = $this->call('PUT', 'category/'.$categoryId,
                                [   'slug' => $new_slug,
                                    'position' => $existingCategory->position
                                ]);

        $response->assertJsonStructure(
            [
                'id' ,
                'slug',
                'position',
                'lft',
                'rgt' ,
                'parent_id',
                'created_at',
                'updated_at',
            ]
        );

        $response->assertJson(
            [
                'id' => $categoryId,
                'slug' => $new_slug,
                'position' => $existingCategory->position,
                'lft' => $existingCategory->lft,
                'rgt' => $existingCategory->rgt,
                'parent_id' => $existingCategory->parent_id,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        );
    }

    public function test_category_service_return_updated_category_after_update()
    {
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $new_slug = implode('-', $this->faker->words());
        $updatedCategory = $this->serviceBeingTested->update($categoryId, $new_slug,  1);

        $expectedResult = new \stdClass();
        $expectedResult->id = $categoryId;
        $expectedResult->slug = $new_slug;
        $expectedResult->position = 1;
        $expectedResult->lft = 1;
        $expectedResult->rgt = 2;
        $expectedResult->parent_id = null;
        $expectedResult->created_at =  Carbon::now()->toDateTimeString();
        $expectedResult->updated_at =  Carbon::now()->toDateTimeString();

        $this->assertEquals($expectedResult, $updatedCategory);
    }

    public function test_service_delete_method_result()
    {
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $delete = $this->serviceBeingTested->delete($categoryId);

        $this->assertTrue($delete);
    }

    public function test_service_delete_method_when_failed()
    {

        $delete = $this->serviceBeingTested->delete(1);

        $this->assertFalse($delete);
    }

    public function test_controller_delete_method_response_status()
    {
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $response = $this->call('DELETE', 'category/'.$categoryId, ['deleteChildren' => 1]);

        $this->assertEquals(200, $response->status());

        $this->assertDatabaseMissing(
            ConfigService::$tableCategories,
            [
                'id'=> $categoryId,
                'slug' => $slug
            ]
        );
    }

    public function test_delete_missing_category_response_status()
    {
        $response = $this->call('DELETE', 'category/1', ['deleteChildren' => 0]);

        $this->assertEquals(404, $response->status());
    }

    public function test_create_category_field_method_from_service_response()
    {
        $key = implode('-', $this->faker->words());
        $value = implode('-', $this->faker->words());
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId,null,$key,$value);

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
        $key = implode('-', $this->faker->words());
        $value = implode('-', $this->faker->words());
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

    public function test_update_category_field_controller_method_response()
    {
        $key = implode('-', $this->faker->words());
        $value = implode('-', $this->faker->words());

        $fieldId = $this->classBeingTested->updateOrCreateField(null,$key,$value);
        $categoryField = $this->serviceBeingTested->createCategoryField(1,$fieldId,$key,$value);

        $new_value = implode('-', $this->faker->words());

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
        $key = implode('-', $this->faker->words());
        $value = implode('-', $this->faker->words());

        $fieldId = $this->classBeingTested->updateOrCreateField(null,$key,$value);
        $categoryField = $this->serviceBeingTested->createCategoryField(1,$fieldId,$key,$value);

        $response = $this->call('PUT', 'category/field/'.$fieldId);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key','value','category_id']);
    }

    public function test_delete_category_field_controller()
    {
        $key = implode('-', $this->faker->words());
        $value = implode('-', $this->faker->words());

        $fieldId = $this->classBeingTested->updateOrCreateField(null,$key,$value);

        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);

        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId,$fieldId,$key,$value);

        $response = $this->call('DELETE', 'category/field/'.$fieldId, ['category_id'=>$categoryId]);

        $this->assertEquals(1, $response->content());
        $this->assertEquals(200, $response->status());
    }

    public function test_update_category_field_method_from_service_response()
    {
        $key = implode('-', $this->faker->words());
        $value = implode('-', $this->faker->words());
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);
        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId,null,$key,$value);

        $new_value = implode('-', $this->faker->words());
        $categoryField = $this->serviceBeingTested->updateCategoryField($categoryId, $categoryField->field_id, $key, $new_value);

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
        $key = implode('-', $this->faker->words());
        $value = implode('-', $this->faker->words());
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);
        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId,null,$key,$value);

        $results = $this->serviceBeingTested->getCategoryField($categoryField->field_id, $categoryId);

        $this->assertEquals($categoryField, $results);
    }

    public function test_delete_category_field_method_from_service_response()
    {
        $key = implode('-', $this->faker->words());
        $value = implode('-', $this->faker->words());
        $slug = implode('-', $this->faker->words());
        $categoryId = $this->classBeingTested->create($slug, null, 1, [], []);
        $categoryField = $this->serviceBeingTested->createCategoryField($categoryId,null,$key,$value);

        $results = $this->serviceBeingTested->deleteCategoryField($categoryField->field_id, $categoryId);

        $this->assertEquals(1, $results);
    }
}