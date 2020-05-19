<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\OldStructure;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentDatumControllerOldStructureTest extends RailcontentTestCase
{
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentDatumService::class);

        ResponseService::$oldResponseStructure = true;
    }

    public function test_add_content_datum_controller_method_response()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
                'difficulty' => 1,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content['0'],
                'topic' => $this->faker->word,
            ]
        );

        $key = 'description';
        $value = $this->faker->text(20);

        $key = $this->faker->word;
        $value = $this->faker->text(500);
        $response = $this->call(
            'PUT',
            'railcontent/content/datum',
            [
                'content_id' => $content[0]->getId(),
                'key' => $key,
                'value' => $value,
                'position' => 1,
            ]
        );

        $this->assertEquals(200, $response->status());

        $this->assertTrue(
            in_array(
                [
                    'content_id' => $content[0]->getId(),
                    'key' => $key,
                    'value' => $value,
                    'position' => 0,

                ],
                $response->decodeResponseJson('data')['post']['data']
            )
        );
    }

    public function test_add_content_datum_not_pass_the_validation()
    {
        $response = $this->call('PUT', 'railcontent/content/datum');

        $this->assertEquals(422, $response->status());
        $this->assertEquals(
            [
                [
                    "source" => "key",
                    "detail" => "The key field is required.",
                ],
                [
                    "source" => "type",
                    "detail" => "The content type field is required.",
                ],
                [
                    "source" => "id",
                    "detail" => "The content id field is required.",
                ],
            ],
            $response->decodeResponseJson('meta')['errors']
        );

    }

    public function test_add_content_datum_key_not_pass_the_validation()
    {
        $key = $this->faker->text(600);
        $value = $this->faker->text(500);

        $response =
            $this->call('PUT', 'railcontent/content/datum', ['content_id' => 1, 'key' => $key, 'value' => $value]);
        $this->assertEquals(422, $response->status());

        $this->assertEquals([
            [
                "source" => "key",
                "detail" => "The key may not be greater than 255 characters.",
            ],
            [
                "source" => "id",
                "detail" => "The selected content id is invalid.",
            ]
        ], $response->decodeResponseJson('meta')['errors']);
    }

    public function test_update_content_datum_controller_method_response()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
                'type' => $this->faker->word,
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => 1,
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];

        $new_value = $this->faker->text();

        $response = $this->call(
            'PATCH',
            'railcontent/content/datum/' . $data->getId(),
            [
                'content_id' => $content[0]->getId(),
                'value' => $new_value,
                'position' => $data->getPosition(),
            ]
        );
        $this->assertEquals(201, $response->status());

        $this->assertTrue(
            in_array(
                [
                    'content_id' => $content[0]->getId(),
                    'key' => $data->getKey(),
                    'value' => $new_value,
                    'position' => 1,

                ],
                $response->decodeResponseJson('data')['post']['data']
            )
        );
    }

    public function test_update_content_datum_not_pass_validation()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => $this->faker->numberBetween(),
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];

        $response = $this->call(
            'PATCH',
            'railcontent/content/datum/' . $data->getId(),
            [
                'key' => $this->faker->text(500),
            ]
        );

        $this->assertEquals(422, $response->status());
        $this->assertEquals([
            [
                "source" => "key",
                "detail" => "The key may not be greater than 255 characters.",
            ]
        ], $response->decodeResponseJson('meta')['errors']);
    }

    public function test_delete_content_datum_controller()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => $this->faker->numberBetween(),
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];
        $contentDataId = $data->getId();

        $response = $this->call('DELETE', 'railcontent/content/datum/' . $contentDataId);

        $this->assertNull(json_decode($response->content()));
        $this->assertEquals(204, $response->status());
        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_data',
            [
                'id' => $contentDataId,
            ]
        );
    }
}
