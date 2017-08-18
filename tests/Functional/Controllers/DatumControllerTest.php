<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\CategoryRepository;
use Railroad\Railcontent\Repositories\DatumRepository;
use Railroad\Railcontent\Services\DatumService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class DatumControllerTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(DatumService::class);
        $this->classBeingTested = $this->app->make(DatumRepository::class);
        $this->categoryClass = $this->app->make(CategoryRepository::class);
    }

    public function test_create_category_datum_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(500);
        $type = $this->faker->text(64);
        $slug = implode('-', $this->faker->words());

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);

        $categoryField = $this->serviceBeingTested->createSubjectDatum($categoryId, null, $key, $value, ConfigService::$subjectTypeCategory);

        $expectedResult = new \stdClass();
        $expectedResult->id = 1;
        $expectedResult->subject_id = $categoryId;
        $expectedResult->subject_type = ConfigService::$subjectTypeCategory;
        $expectedResult->data_id = 1;
        $expectedResult->key = $key;
        $expectedResult->value = $value;
        $expectedResult->created_at =  Carbon::now()->toDateTimeString();
        $expectedResult->updated_at =  Carbon::now()->toDateTimeString();

        $this->assertEquals($expectedResult, $categoryField);
    }

    public function test_add_category_data_controller_method_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(500);

        $response = $this->call('POST', 'category/datum', ['category_id'=>1,'key'=>$key, 'value' => $value]);

        $this->assertEquals(200, $response->status());

        $response->assertJsonStructure(
            [
                'id' ,
                'subject_id',
                'subject_type',
                'data_id',
                'created_at',
                'updated_at',
            ]
        );

        $response->assertJson(
            [
                'id' => 1,
                'subject_id' => 1,
                'subject_type' => ConfigService::$subjectTypeCategory,
                'data_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'key' => $key,
                'value' => $value
            ]
        );
    }

    public function test_add_category_datum_not_pass_the_validation()
    {
        $response = $this->call('POST', 'category/datum');

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key','value','category_id']);
    }

    public function test_add_category_datum_key_not_pass_the_validation()
    {
        $key = $this->faker->text(500);
        $value = $this->faker->text(500);

        $response = $this->call('POST', 'category/datum',['category_id'=>1,'key'=>$key, 'value' => $value]);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for key field
        $response->assertSessionHasErrors(['key']);
    }

    public function test_update_category_datum_controller_method_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(500);

        $dataId = $this->classBeingTested->updateOrCreateDatum(null,$key,$value);

        $categoryData = $this->serviceBeingTested->createSubjectDatum(1, $dataId, $key, $value, ConfigService::$subjectTypeCategory);

        $new_value =  $this->faker->text();

        $response = $this->call('PUT', 'category/datum/'.$dataId, ['category_id'=>1,'key'=>$key, 'value' => $new_value]);

        $this->assertEquals(201, $response->status());

        $response->assertJsonStructure(
            [
                'id' ,
                'subject_id',
                'subject_type',
                'data_id',
                'created_at',
                'updated_at',
            ]
        );

        $response->assertJson(
            [
                'id' => 1,
                'subject_id' => 1,
                'subject_type' => ConfigService::$subjectTypeCategory,
                'data_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'key' => $key,
                'value' => $new_value
            ]
        );
    }

    public function test_update_category_datum_not_pass_validation()
    {
        $key = $this->faker->text(255);
        $value =  $this->faker->text(500);

        $dataId = $this->classBeingTested->updateOrCreateDatum(null,$key,$value);
        $categoryData = $this->serviceBeingTested->createSubjectDatum(1, $dataId, $key, $value, ConfigService::$subjectTypeCategory);

        $response = $this->call('PUT', 'category/datum/'.$dataId);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key','value','category_id']);
    }

    public function test_delete_category_datum_controller()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(500);
        $type = $this->faker->text(64);

        $dataId = $this->classBeingTested->updateOrCreateDatum(null, $key, $value);

        $slug = implode('-', $this->faker->words());
        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);

        $categoryData = $this->serviceBeingTested->createSubjectDatum($categoryId, $dataId, $key, $value, ConfigService::$subjectTypeCategory);

        $response = $this->call('DELETE', 'category/datum/'.$dataId, ['category_id'=>$categoryId]);

        $this->assertEquals(1, $response->content());
        $this->assertEquals(200, $response->status());
    }

    public function test_update_category_datum_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(500);
        $type = $this->faker->text(64);
        $slug = implode('-', $this->faker->words());

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);
        $categoryData = $this->serviceBeingTested->createSubjectDatum($categoryId, null, $key, $value, ConfigService::$subjectTypeCategory);

        $new_value = $this->faker->text(500);
        $categoryField = $this->serviceBeingTested->updateSubjectDatum($categoryId, $categoryData->data_id, $key, $new_value, ConfigService::$subjectTypeCategory);

        $expectedResult = new \stdClass();
        $expectedResult->id = 1;
        $expectedResult->subject_id = $categoryId;
        $expectedResult->subject_type = ConfigService::$subjectTypeCategory;
        $expectedResult->data_id = 1;
        $expectedResult->key = $key;
        $expectedResult->value = $new_value;
        $expectedResult->created_at =  Carbon::now()->toDateTimeString();
        $expectedResult->updated_at =  Carbon::now()->toDateTimeString();

        $this->assertEquals($expectedResult, $categoryField);

    }

    public function test_get_category_datum_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(500);
        $type = $this->faker->text(64);
        $slug = implode('-', $this->faker->words());

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);
        $categoryDatum = $this->serviceBeingTested->createSubjectDatum($categoryId, null, $key, $value, ConfigService::$subjectTypeCategory);

        $results = $this->serviceBeingTested->getSubjectDatum($categoryDatum->data_id, $categoryId, ConfigService::$subjectTypeCategory);

        $this->assertEquals($categoryDatum, $results);
    }

    public function test_delete_category_datum_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(500);
        $type = $this->faker->text(64);
        $slug = implode('-', $this->faker->words());

        $categoryId = $this->categoryClass->create($slug, null, 1, ConfigService::$categoryStatusNew, $type);
        $categoryData = $this->serviceBeingTested->createSubjectDatum($categoryId, null, $key, $value, ConfigService::$subjectTypeCategory);

        $results = $this->serviceBeingTested->deleteSubjectDatum($categoryData->data_id, $categoryId, ConfigService::$subjectTypeCategory);

        $this->assertEquals(1, $results);
    }
}
