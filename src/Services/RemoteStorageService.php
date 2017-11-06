<?php

namespace Railroad\Railcontent\Services;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

class RemoteStorageService
{
    static $visibilityPublic = ['visibility' => 'public'];

    /** @var Filesystem */
    public $filesystem;

    protected $availableVisibilities = [
        'public' => 'public'
    ];

    public function __construct($optionalPathPrefix = null)
    {
        $client = new S3Client([
            'credentials' => [
                'key'    => config('railcontent.awsS3_remote_storage.accessKey'),
                'secret' => config('railcontent.awsS3_remote_storage.accessSecret')
            ],
            'region' => config('railcontent.awsS3_remote_storage.region'),
            'version' => 'latest',
        ]);

        $adapter = new AwsS3Adapter(
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
        return $this->filesystem->put(
            $filenameRelative,
            file_get_contents($filenameAbsolute),
            self::$visibilityPublic
        );
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
        return $this->filesystem->delete($target);
    }

    /**
     * @param string $target
     * @param string $newName
     * @return bool
     */
    public function rename($target, $newName)
    {
        return $this->filesystem->rename($target, $newName);
    }

    /**
     * @param string $original
     * @param string $duplicate
     * @return bool
     */
    public function copy($original, $duplicate)
    {
        return $this->filesystem->copy($original, $duplicate);
    }

    /**
     * @param string $target
     * @return bool|false|string
     */
    public function getMimetype($target)
    {
        return $this->filesystem->getMimetype($target);
    }

    /**
     * @param string $target
     * @return bool|false|string
     */
    public function getTimestamp($target)
    {
        return $this->filesystem->getTimestamp($target);
    }

    /**
     * @param string $target
     * @return bool|false|int
     */
    public function getSize($target)
    {
        return $this->filesystem->getSize($target);
    }

    /**
     * @param string $target
     * @return bool
     */
    public function createDir($target)
    {
        return $this->filesystem->createDir($target);
    }

    /**
     * @param string $target
     * @return bool
     */
    public function deleteDir($target)
    {
        return $this->filesystem->deleteDir($target);
    }

    /**
     * @param null|string $targetDir
     * @return array
     */
    public function listContents($targetDir = null)
    {
        if(!empty($targetDir)){
            return $this->filesystem->listContents($targetDir, true);
        }else{
            return $this->filesystem->listContents();
        }
    }
}