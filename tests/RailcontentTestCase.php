<?php

namespace Railroad\Railcontent\Tests;

use Carbon\Carbon;
use Exception;
use Faker\Generator;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Router;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Railroad\Railcontent\Providers\RailcontentServiceProvider;
use Railroad\Railcontent\Services\RemoteStorageService;
use Railroad\Railcontent\Tests\Resources\Models\User;

class RailcontentTestCase extends BaseTestCase
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * @var AuthManager
     */
    protected $authManager;

    /**
     * @var Router
     */
    protected $router;

    /** @var string $s3DirectoryForThisInstance */
    protected $s3DirectoryForThisInstance;

    /** @var RemoteStorageService $remoteStorageService */
    protected $remoteStorageService;

    protected function setUp()
    {
        $this->awsConfigInitForTesting();
        parent::setUp();

        $this->artisan('migrate', []);
        $this->artisan('cache:clear', []);

        $this->faker = $this->app->make(Generator::class);
        $this->databaseManager = $this->app->make(DatabaseManager::class);
        $this->authManager = $this->app->make(AuthManager::class);
        $this->router = $this->app->make(Router::class);

        $this->s3DirectoryForThisInstance = '/test' . time();
        $this->remoteStorageService = new RemoteStorageService($this->s3DirectoryForThisInstance);

        Carbon::setTestNow(Carbon::now());
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // setup package config for testing
        $defaultConfig = require(__DIR__ . '/../config/railcontent.php');

        $app['config']->set('railcontent.database_connection_name', 'testbench');
        $app['config']->set('railcontent.cache_duration', 60);
        $app['config']->set('railcontent.table_prefix', $defaultConfig['table_prefix']);
        $app['config']->set('railcontent.brand', $defaultConfig['brand']);
        $app['config']->set('railcontent.available_languages', $defaultConfig['available_languages']);
        $app['config']->set('railcontent.default_language', $defaultConfig['default_language']);
        $app['config']->set('railcontent.validation', $defaultConfig['validation']);

        // setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set(
            'database.connections.testbench',
            [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]
        );

        // allows access to built in user auth
        $app['config']->set('auth.providers.users.model', User::class);

        $app['config']->set('railcontent.awsS3_remote_storage', [
            'accessKey' => env('AWS_S3_REMOTE_STORAGE_ACCESS_KEY'),
            'accessSecret' => env('AWS_S3_REMOTE_STORAGE_ACCESS_SECRET'),
            'region' => env('AWS_S3_REMOTE_STORAGE_REGION'),
            'bucket' => env('AWS_S3_REMOTE_STORAGE_BUCKET')
        ]);

        $app['config']->set('railcontent.awsCloudFront', 'd1923uyy6spedc.cloudfront.net');

        $app['db']->connection()->getSchemaBuilder()->create(
            'users',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('email');
            }
        );

        // register provider
        $app->register(RailcontentServiceProvider::class);
    }

    /**
     * We don't want to use mockery so this is a reimplementation of the mockery version.
     *
     * @param  array|string $events
     * @return $this
     *
     * @throws Exception
     */
    public function expectsEvents($events)
    {
        $events = is_array($events) ? $events : func_get_args();

        $mock = $this->getMockBuilder(Dispatcher::class)
            ->setMethods(['fire', 'dispatch'])
            ->getMockForAbstractClass();

        $mock->method('fire')->willReturnCallback(
            function ($called) {
                $this->firedEvents[] = $called;
            }
        );

        $mock->method('dispatch')->willReturnCallback(
            function ($called) {
                $this->firedEvents[] = $called;
            }
        );

        $this->app->instance('events', $mock);

        $this->beforeApplicationDestroyed(
            function () use ($events) {
                $fired = $this->getFiredEvents($events);
                if ($eventsNotFired = array_diff($events, $fired)) {
                    throw new Exception(
                        'These expected events were not fired: [' .
                        implode(', ', $eventsNotFired) . ']'
                    );
                }
            }
        );

        return $this;
    }

    /**
     * @return int
     */
    public function createAndLogInNewUser()
    {
        $userId = $this->databaseManager->connection()->query()->from('users')->insertGetId(
            ['email' => $this->faker->email]
        );

        $this->authManager->guard()->onceUsingId($userId);

        request()->setUserResolver(
            function () use ($userId) {
                return User::query()->find($userId);
            }
        );

        return $userId;
    }

    /**
     * @return Connection
     */
    public function query()
    {
        return $this->databaseManager->connection();
    }

    protected function tearDown()
    {
        $contentsList = $this->remoteStorageService->listContents($this->s3DirectoryForThisInstance);
        $notDeleted = [];

        /*
         * We're injecting an instance of RemoteStorageService into this test class (This file).
         * When we do that we're setting a "root" dir of `$this->s3DirectoryForThisInstance` (which
         * looks something like "/test1509570412"). But when we're done we want to delete everything
         * added to s3 for running these tests. That means not only the files added to the directory,
         * but also the directory itself. We can't call deleteDir() on root-even if it's only root
         * relative to this test class instance. So, just create another instance of RemoteStorageService
         * and do not declare a "root", thus defaulting to the one in the config. Then you can target
         * the one created for the test class with deleteDir.
         *      Jonathan, Nov 2017
         */
        $newRemoteStorageService = new RemoteStorageService();
        $deleteDir = $newRemoteStorageService->deleteDir($this->s3DirectoryForThisInstance);

        if(!$deleteDir){
            $this->fail('Failed to delete directory ' . $this->s3DirectoryForThisInstance . '.');
        }

        foreach($contentsList as $item){
            if($this->remoteStorageService->exists($item['path'])){
                $notDeleted[] = $item['path'];
            };
        }

        if(!empty($notDeleted)){
            $this->fail('contents not deleted (' . var_export($notDeleted, true) . ')');
        }

        parent::tearDown();
    }

    // -------------------- used by RemoteStorage Service & Controller tests --------------------

    /**
     * @param string $dir
     */
    protected function awsConfigInitForTesting($dir = '/')
    {
        include __DIR__ . '../../.env.testing';

        if (empty(env('AWS_S3_REMOTE_STORAGE_ACCESS_KEY'))) {
            $this->fail(
                "You must provide a value for the AWS_S3_REMOTE_STORAGE_ACCESS_KEY \'putenv' (" .
                "environmental variable setting) function in `/.env.testing`."
            );
        }
        if (empty(env('AWS_S3_REMOTE_STORAGE_ACCESS_SECRET'))) {
            $this->fail(
                "You must provide a value for the AWS_S3_REMOTE_STORAGE_ACCESS_SECRET \'putenv' (" .
                "environmental variable setting) function in `/.env.testing`."
            );
        }
        if (empty(env('AWS_S3_REMOTE_STORAGE_REGION'))) {
            $this->fail(
                "You must provide a value for the AWS_S3_REMOTE_STORAGE_REGION \'putenv' (" .
                "environmental variable setting) function in `/.env.testing`."
            );
        }
        if (empty(env('AWS_S3_REMOTE_STORAGE_BUCKET'))) {
            $this->fail(
                "You must provide a value for the AWS_S3_REMOTE_STORAGE_BUCKET \'putenv' (" .
                "environmental variable setting) function in `/.env.testing`."
            );
        }
    }

    /**
     * @param string|null $useThisFilenameWithoutExtension
     * @return string
     */
    protected function create($useThisFilenameWithoutExtension = null){
        $filenameAbsolute = $this->faker->image(sys_get_temp_dir());

        if(!empty($useThisFilenameWithoutExtension)){
            $filenameAbsolute = $this->changeImageNameLocally($filenameAbsolute, $useThisFilenameWithoutExtension);
        }

        $filenameRelative = $this->getFilenameRelativeFromAbsolute($filenameAbsolute);

        $upload = $this->remoteStorageService->put($filenameRelative, $filenameAbsolute);

        if(!$upload){
            $this->fail('s3 upload appears to have failed.');
        }

        return $filenameAbsolute;
    }

    /**
     * @param string $filenameRelative
     * @return string
     */
    protected function getExtensionFromRelative($filenameRelative){
        $stringExplodedToCreateArray = explode(".", $filenameRelative);
        $extension = end($stringExplodedToCreateArray);
        if(!$extension){
            $this->fail('No file extension retrieved from the image created by Faker.');
        }
        if(!is_string($extension)){
            $this->fail('Value retrieved for file extension is not a string.');
        }
        return $extension;
    }

    /**
     * @param string $filenameAbsolute
     * @return string
     */
    protected function getExtensionFromAbsolute($filenameAbsolute){
        return $this->getExtensionFromRelative($this->getFilenameRelativeFromAbsolute($filenameAbsolute));
    }

    /**
     * @param string $filenameAbsolute
     * @return string
     */
    protected function getFilenameRelativeFromAbsolute($filenameAbsolute)
    {
        $tempDirPath = sys_get_temp_dir() . '/';

        return str_replace($tempDirPath, '', $filenameAbsolute);
    }

    /**
     * @param string $filenameRelative
     * @return string
     */
    protected function getFilenameAbsoluteFromRelative($filenameRelative)
    {
        return sys_get_temp_dir() . '/' . $filenameRelative;
    }

    /**
     * @param string $filenameAbsolute
     * @param string $name
     * @return string
     */
    protected function changeImageNameLocally($filenameAbsolute, $name)
    {
        $extension = $this->getExtensionFromAbsolute($filenameAbsolute);
        $nameWithExtension = $this->concatNameAndExtension($name, $extension);
        $newFilenameAbsolute = sys_get_temp_dir() . '/' . $nameWithExtension;
        rename($filenameAbsolute, $newFilenameAbsolute);
        return $newFilenameAbsolute;
    }

    /**
     * @param string $name
     * @param string $extension
     * @return string
     */
    protected function concatNameAndExtension($name, $extension)
    {
        return $name . '.' . $extension;
    }

}