<?php

use Railroad\Railcontent\Services\RemoteStorageService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class RemoteStorageServiceTest extends RailcontentTestCase
{

    /** @var  RemoteStorageService */
    protected $remoteStorageService;

    /** @var string */
    protected $s3DirectoryForThisInstance;

    /*
     * about filename vs filepath...
     *
     * 1. filenameRelative: `foo.jpg` // this is the name of the *file* relative to (from **within** the current dir)
     * 2. filenameAbsolute: `/bar/qux/foo.jpg` // this is the *absolute* filepath.
     * 3. filenameWithoutExtension: `foo`
     *
     * There does not appear to be a standard.
     *  * https://stackoverflow.com/questions/2119156/name-of-a-path-containing-the-complete-file-name
     *  * https://stackoverflow.com/questions/2235173/file-name-path-name-base-name-naming-standard-for-pieces-of-a-path
     */

    public function test_create()
    {
        $useToCreateFileName = $this->faker->word;
        $filenameAbsolute = $this->create($useToCreateFileName);
        $this->assertEquals(
            $this->getFilenameAbsoluteFromRelative(
                $useToCreateFileName . '.' . $this->getExtensionFromRelative($this->getFilenameRelativeFromAbsolute($filenameAbsolute))
            ),
            $filenameAbsolute
        );
    }

    public function test_read()
    {
        $name = $this->faker->word;
        $filenameAbsolute = $this->create($name);
        $nameWithExtension = $this->concatNameAndExtension($name, $this->getExtensionFromAbsolute($filenameAbsolute));
        $this->assertEquals(
            file_get_contents($this->getFilenameAbsoluteFromRelative($nameWithExtension)),
            $this->remoteStorageService->filesystem->read($nameWithExtension)
        );
    }

    public function test_update()
    {
        $name = $this->faker->word;
        $filenameAbsolute = $this->create($name);
        $extension = $this->getExtensionFromAbsolute($filenameAbsolute);
        $nameWithExtension = $this->concatNameAndExtension($name, $extension);
        $newFileAbsolute = $this->changeImageNameLocally($this->faker->image(sys_get_temp_dir()), $name);
        $this->assertTrue($this->remoteStorageService->put($nameWithExtension, $newFileAbsolute));
        $this->assertEquals(
            file_get_contents($newFileAbsolute),
            $this->remoteStorageService->filesystem->read($nameWithExtension)
        );
    }

    public function test_exist()
    {
        $name = $this->faker->word;
        $this->assertTrue($this->remoteStorageService->exists(
            $this->concatNameAndExtension($name, $this->getExtensionFromAbsolute($this->create($name)))
        ));
    }

    public function test_delete()
    {
        $filenameRelative = $this->getFilenameRelativeFromAbsolute($this->create());
        $this->assertTrue($this->remoteStorageService->delete($filenameRelative));
        $this->assertFalse($this->remoteStorageService->exists($filenameRelative));
    }

    public function test_rename()
    {
        $originalName = $this->faker->word;
        $newName = $this->faker->word;

        $filenameAbsolute = $this->create($originalName);
        $fileExtension = $this->getExtensionFromAbsolute($filenameAbsolute);

        $originalNameWithExtension = $this->concatNameAndExtension($originalName, $fileExtension);
        $newNameWithExtension = $this->concatNameAndExtension($newName, $fileExtension);

        $this->assertTrue($this->remoteStorageService->rename($originalNameWithExtension, $newNameWithExtension));
        $this->assertEquals(
            file_get_contents($this->getFilenameAbsoluteFromRelative($originalNameWithExtension)),
            $this->remoteStorageService->filesystem->read($newNameWithExtension)
        );
        $this->assertFalse($this->remoteStorageService->exists($originalNameWithExtension));
    }

    public function test_copy()
    {
        $originalName = $this->faker->word;
        $newName = $this->faker->word;

        $filenameAbsolute = $this->create($originalName);
        $fileExtension = $this->getExtensionFromAbsolute($filenameAbsolute);

        $originalNameWithExtension = $this->concatNameAndExtension($originalName, $fileExtension);
        $newNameWithExtension = $this->concatNameAndExtension($newName, $fileExtension);

        $this->assertTrue($this->remoteStorageService->copy($originalNameWithExtension, $newNameWithExtension));
        $this->assertTrue($this->remoteStorageService->exists($originalNameWithExtension));
        $this->assertTrue($this->remoteStorageService->exists($newNameWithExtension));
        $this->assertEquals(
            file_get_contents($filenameAbsolute),
            $this->remoteStorageService->read($originalNameWithExtension)
        );
        $this->assertEquals(
            file_get_contents($filenameAbsolute),
            $this->remoteStorageService->read($newNameWithExtension)
        );
    }

    public function test_getMimetype()
    {
        $filenameAbsolute = $this->create();
        $this->assertEquals(
            exif_read_data($filenameAbsolute)['MimeType'],
            $this->remoteStorageService->getMimetype($this->getFilenameRelativeFromAbsolute($filenameAbsolute))
        );
    }

    public function test_getTimestamp()
    {
        $filenameAbsolute = $this->create();
        $expected = exif_read_data($filenameAbsolute)['FileDateTime'];
        $actual = $this->remoteStorageService->getTimestamp($this->getFilenameRelativeFromAbsolute($filenameAbsolute));

        /*
         * Actual may be a second or two behind expected because of time file transfer time.
         * Time in exif data of local file is when **dummy** file was created, time retrieved is when file was created
         * in s3 (when transfer was complete).
         */
        $difference = $actual - $expected;
        $this->assertTrue($difference < 5);
    }

    public function test_getSize()
    {
        $filenameAbsolute = $this->create();
        $this->assertEquals(
            exif_read_data($filenameAbsolute)['FileSize'],
            $this->remoteStorageService->getSize($this->getFilenameRelativeFromAbsolute($filenameAbsolute))
        );
    }

    public function test_createDir()
    {
        $pass = false;
        $word = $this->faker->word;
        $this->remoteStorageService->createDir($word);
        $contents = $this->remoteStorageService->listContents();
        foreach($contents as $item){
            if($item['basename'] === $word && $item['type'] === 'dir'){
                $pass = true;
            }
        }
        $this->assertTrue($pass);
    }

    public function test_deleteDir()
    {
        $pass = false;
        $word = $this->faker->word;
        $this->remoteStorageService->createDir($word);
        $contents = $this->remoteStorageService->listContents();
        foreach($contents as $item){
            if($item['basename'] === $word && $item['type'] === 'dir'){
                $pass = true;
            }
        }
        $this->assertTrue($pass);
        $this->remoteStorageService->deleteDir($word);
        $this->assertTrue(empty($this->remoteStorageService->listContents()));
    }

    public function test_listContents()
    {
        $passFile = false;
        $passDir = false;
        $wordFile = $this->faker->word;
        $wordDir = $this->faker->word;
        $filenameAbsolute = $this->create($wordFile);
        $dir =  $this->remoteStorageService->createDir($wordDir);
        $this->assertTrue($dir);
        $contents = $this->remoteStorageService->listContents();
        $expectedFileName = $this->concatNameAndExtension(
            $wordFile,
            $this->getExtensionFromAbsolute($filenameAbsolute)
        );
        foreach($contents as $item){
            if($item['basename'] === $expectedFileName && $item['type'] === 'file'){
                $passFile = true;
            }
            if($item['basename'] === $wordDir && $item['type'] === 'dir'){
                $passDir = true;
            }
        }
        $this->assertTrue($passFile && $passDir);
    }
}