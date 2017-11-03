<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Illuminate\Http\UploadedFile;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class RemoteStorageJsonControllerTest extends RailcontentTestCase
{

    protected function setUp()
    {
        parent::setUp();
    }


    public function test_put() // PUT|PATCH | remote-storage/json/{json}   | json.update
    {
        $useThisFilenameWithoutExtension = $this->faker->word;

        // https://stackoverflow.com/a/44068554

        $filenameAbsolute = $this->faker->image(sys_get_temp_dir());

        $filenameAbsolute = $this->changeImageNameLocally(
            $filenameAbsolute,
            $useThisFilenameWithoutExtension
        );

        $useThisFilename = $this->concatNameAndExtension(
            $useThisFilenameWithoutExtension,
            $this->getExtensionFromAbsolute($filenameAbsolute)
        );

        if ($useThisFilename !== $this->getFilenameRelativeFromAbsolute($filenameAbsolute)) {
            $this->fail(
                '$useThisFilename !== $this->getFilenameRelativeFromAbsolute($filenameAbsolute)'
            );
        }

        $filenameToUseTestDirectoryPrefixAdded = $this->s3DirectoryForThisInstance . '/' . $useThisFilename;

        $response = $this->call(
            'PUT',
            '/railcontent/remote-storage',
            [
                'target' => $filenameToUseTestDirectoryPrefixAdded,
                'file' => new UploadedFile($filenameAbsolute, $useThisFilename)
            ]
        );

        $this->assertEquals(201, $response->status());

        $this->assertEquals(
            'https://' . config('railcontent.awsCloudFront') . $filenameToUseTestDirectoryPrefixAdded,
            json_decode($response->getContent())->results
        );
    }
}