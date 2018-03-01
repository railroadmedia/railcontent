<?php

namespace Railroad\Railcontent\Tests\Integration;

use Railroad\Railcontent\Services\RemoteStorageService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
//use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\SoundsliceService;

class SoundsliceServiceTest extends RailcontentTestCase
{
    const TEST_FOLDER_ID = 5232;
    const S3_DIR = 'soundslice-dev-1802';

    /** @var $soundSliceService SoundsliceService */
    protected $soundSliceService;

    protected function setUp()
    {
        parent::setUp();

        include __DIR__ . '../../../.env.testing';
        if (empty(env('AWS_S3_SOUNDSLICE_ACCESS_KEY'))) { $this->fail("You must provide a value for the " .
            "AWS_S3_SOUNDSLICE_ACCESS_KEY \'putenv' (environmental variable setting) function in `/.env.testing`.");}
        if (empty(env('AWS_S3_SOUNDSLICE_ACCESS_SECRET'))) { $this->fail("You must provide a value for the " .
            "AWS_S3_SOUNDSLICE_ACCESS_SECRET \'putenv' (environmental variable setting) function in `/.env.testing`.");}
        if (empty(env('AWS_S3_SOUNDSLICE_REGION'))) { $this->fail("You must provide a value for the " .
            "AWS_S3_SOUNDSLICE_REGION \'putenv' (environmental variable setting) function in `/.env.testing`.");}
        if (empty(env('AWS_S3_SOUNDSLICE_BUCKET'))) { $this->fail("You must provide a value for the " .
            "AWS_S3_SOUNDSLICE_BUCKET \'putenv' (environmental variable setting) function in `/.env.testing`.");}

        $this->app['config']->set(
            'railcontent.awsS3_soundslice',
            [
                'accessKey' => env('AWS_S3_SOUNDSLICE_ACCESS_KEY'),
                'accessSecret' => env('AWS_S3_SOUNDSLICE_ACCESS_SECRET'),
                'region' => env('AWS_S3_SOUNDSLICE_REGION'),
                'bucket' => env('AWS_S3_SOUNDSLICE_BUCKET')
            ]
        );

        $this->soundSliceService = $this->app->make(SoundsliceService::class);
    }


    public function test_create_score()
    {
        $folderId = self::TEST_FOLDER_ID;

        $ourSlug = 'test_' . implode('_', $this->faker->words()) . '_jonathan_1802_dev';
        $artist = $this->faker->words(rand(2,5), true);

        $response = $this->soundSliceService->createScore($ourSlug, $folderId, $artist, true);

        $slug = $response['slug'];

        $this->assertDatabaseHas('railcontent_content', [
            'type' => 'soundslice.score',
            'slug' => $slug
        ]);

        $body = $this->soundSliceService->get($response['slug']);

        $this->assertEquals($ourSlug, $body['name'] ?? '');
    }

    public function test_list()
    {
        $response = $this->soundSliceService->list();

        $this->assertNotEmpty($response);
    }

//    public function test_delete()
//    {
//        /* doesn't fucking work */
//
//        $slug = 'xxxxxxxxxx'; // MANUALLY ENTERED ONE TO DELETE - TEMPORARY - REPLACE WITH FIRST CREATING A TESTING ONE
//
////        $slug = $this->soundSliceService->createScore(
////            'test_' . implode('_', $this->faker->words()) . '_jonathan_1802_dev'
////        )['slug'];
//
//        $listResponse = $this->soundSliceService->list();
//
//        foreach($listResponse as $item){
//            if(!empty($item->slug) && $item->slug == $slug){
//                $response = $this->soundSliceService->delete($slug);
//                $this->assertTrue($response);
//            }
//        }
//    }

//    public function test_create_folder()
//    {
//        // works, but no delete-folder function, so will spam your account with fucking folders.
//
//        $response = $this->request('api/v1/folders/', 'POST', ['form_params' => ['name' => $name]]);
//        $body = (array) json_decode((string) $response->getBody());
//        return $body['id'] ?? false;
//    }

//        $name = 'zztestSoundsliceServiceTest' . rand(000, 999);
//        $id = $this->soundSliceService->createFolder($name);
//        $this->assertNotFalse($id);
//
////        $response = $this->soundSliceService->deleteFolder($id);
//    }

//    public function test_delete_folder()
//    {
//        // Doesn't work. Returns 405 method not allowed. API probably fucked (or at least not in line with what' in docs)
//        $response = $this->soundSliceService->deleteFolder(5269);
//
//        $this->assertNotFalse($response);
//    }

    public function test_get()
    {

    }

    public function test_download_from_s3(){
        // urlForTestFile
        // 'https://s3.us-east-2.amazonaws.com/soundslice/DTME+-+Week+5+-+soundslice-ex3.musicxml';

        $tempDir = sys_get_temp_dir();

        $name = 'DTME - Week 5 - soundslice-ex3.musicxml';

        $foo = $this->soundSliceService->getFile($name);
//        $size = $this->soundSliceService->getSize($name);

        $this->assertNotEmpty($foo);
    }

    public function test_upload_to_soundslice()
    {
        $slug = '152572';
        $name = 'DTME - Week 5 - soundslice-ex3.musicxml';

        $this->soundSliceService->uploadNotationFromS3($slug, $name);

        $this->markTestIncomplete();
    }

}