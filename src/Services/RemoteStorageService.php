<?php

namespace Railroad\Railcontent\Services;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;

class RemoteStorageService
{
    static $visibilityPublic = ['visibility' => 'public'];

    /** @var Filesystem */
    public $filesystem;

    protected $availableVisibilities = [
        'public' => 'public'
    ];

    public function __construct($optionalPathPrefix = '')
    {
        $client = new S3Client([
            'credentials' => [
                'key'    => config('railcontent.awsS3_remote_storage.accessKey'),
                'secret' => config('railcontent.awsS3_remote_storage.accessSecret')
            ],
            'region' => config('railcontent.awsS3_remote_storage.region'),
            'version' => 'latest',
        ]);

        $adapter = new AwsS3V3Adapter(
            $client, config('railcontent.awsS3_remote_storage.bucket'), $optionalPathPrefix
        );
        $this->filesystem = new Filesystem($adapter);
    }

    /**
     * @param string $filenameRelative
     * @param string $filenameAbsolute
     * @return bool
     *
     * Note that 'put' is create or update accordingly. In League\Flysystem there also exist separate create
     * (called 'write') and update methods. They could be used if there was a need to return error if expectation
     * of file to create or update did exist or not already (respectively). For now just using "put" works though.
     *  - Jonathan, Oct 2017
     */
    public function put($filenameRelative, $filenameAbsolute)
    {
        $this->filesystem->write(
            $filenameRelative,
            file_get_contents($filenameAbsolute),
            self::$visibilityPublic
        );

        return true;
    }

    /**
     * @param $target
     * @return bool|false|string
     */
    public function read($target)
    {
        return $this->filesystem->read($target);
    }

    /**
     * @param string $target
     * @return bool
     */
    public function exists($target)
    {
        return $this->filesystem->has($target);
    }

    /**
     * @param string $target
     * @return bool
     */
    public function delete($target)
    {
        $this->filesystem->delete($target);

        return true;
    }

    /**
     * @param string $target
     * @param string $newName
     * @return bool
     */
    public function rename($target, $newName)
    {
        $this->filesystem->move($target, $newName);

        return true;
    }

    /**
     * @param string $original
     * @param string $duplicate
     * @return bool
     */
    public function copy($original, $duplicate)
    {
        $this->filesystem->copy($original, $duplicate);

        return true;
    }

    /**
     * @param string $target
     * @return bool|false|string
     */
    public function getMimetype($target)
    {
        return $this->filesystem->mimeType($target);
    }

    /**
     * @param string $target
     * @return bool|false|string
     */
    public function getTimestamp($target)
    {
        return $this->filesystem->lastModified($target);
    }

    /**
     * @param string $target
     * @return bool|false|int
     */
    public function getSize($target)
    {
        return $this->filesystem->fileSize($target);
    }

    /**
     * @param string $target
     * @return bool
     */
    public function createDir($target)
    {
        $this->filesystem->createDirectory($target);

        return true;
    }

    /**
     * @param string $target
     * @return bool
     */
    public function deleteDir($target)
    {
        $this->filesystem->deleteDirectory($target);

        return true;
    }

    /**
     * @param null|string $targetDir
     * @return array
     */
    public function listContents($targetDir = null)
    {
        if(!empty($targetDir)){
            return $this->filesystem->listContents($targetDir, true)->toArray();
        }

        return [];
    }
}