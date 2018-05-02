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
    
    public function test_put()
    {
        $this->markAsRisky();

        $useThisFilenameWithoutExtension = $this->faker->word;

        $filenameAbsolute = $this->changeImageNameLocally(
            $this->faker->image(sys_get_temp_dir()),
            $useThisFilenameWithoutExtension
        );

        $useThisFilename = $this->concatNameAndExtension(
            $useThisFilenameWithoutExtension,
            $this->getExtensionFromAbsolute($filenameAbsolute)
        );

        if ($useThisFilename !== $this->getFilenameRelativeFromAbsolute($filenameAbsolute)) {
            $this->fail( '$useThisFilename !== $this->getFilenameRelativeFromAbsolute($filenameAbsolute)' );
        }

        $filenameToUseTestDirectoryPrefixAdded = $this->s3DirectoryForThisInstance . '/' . $useThisFilename;

        $response = $this->call( 'PUT', '/railcontent/remote', [
            'target' => $filenameToUseTestDirectoryPrefixAdded,
            'file' => new UploadedFile($filenameAbsolute, $useThisFilename)
        ] );

        $this->assertEquals(201, $response->status());

        $this->assertEquals(
            'https://' . config('railcontent.awsCloudFront') . $filenameToUseTestDirectoryPrefixAdded,
            json_decode($response->getContent())->results
        );
    }
}