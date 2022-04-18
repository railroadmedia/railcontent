<?php

namespace Railroad\Railcontent\Tests;

use Carbon\Carbon;
use Dotenv\Dotenv;
use Exception;
use Faker\Generator;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Railroad\Railcontent\Middleware\ContentPermissionsMiddleware;
use Railroad\Railcontent\Providers\RailcontentServiceProvider;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Services\RemoteStorageService;
use Railroad\Railcontent\Tests\Resources\Models\User;
use Railroad\Response\Providers\ResponseServiceProvider;

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

    /**
     * @var string database connexion type
     * by default it's testbench; for full text search it's mysql
     */
    protected $connectionType = 'mysql';

    protected function setUp(): void
    {
        parent::setUp();

//        /usr/bin/php" /app/railcontent/vendor/phpunit/phpunit/phpunit --configuration /app/railcontent/phpunit.xml --filter Railroad\\Railcontent\\Tests\\Functional\\Controllers\\ApiJsonControllerTest --test-suffix ApiJsonControllerTest.php /app/railcontent/tests/Functional/Controllers --teamcity

        // suppress predis deprecation warnings
        error_reporting(E_ERROR);

        $this->artisan('migrate:fresh', []);
        $this->artisan('cache:clear', []);

        $this->faker = $this->app->make(Generator::class);
        $this->databaseManager = $this->app->make(DatabaseManager::class);
        $this->authManager = $this->app->make(AuthManager::class);
        $this->router = $this->app->make(Router::class);

        RepositoryBase::$connectionMask = null;

        Carbon::setTestNow(Carbon::now());

        //call the ContentPermissionsMiddleware
        $middleware = $this->app->make(ContentPermissionsMiddleware::class);
        $middleware->handle(
            request(),
            function () {
            }
        );

        if (!DB::connection()->getSchemaBuilder()->hasTable('users')) {
            $result = DB::connection()->getSchemaBuilder()->create(
                'users',
                function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('email');
                }
            );
        }
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
        $dotenv = new Dotenv(__DIR__ . '/../', '.env.testing');
        $dotenv->load();

        $defaultConfig = require(__DIR__ . '/../config/railcontent.php');

        $app['config']->set('railcontent.database_connection_name', $this->getConnectionType());
        $app['config']->set('railcontent.cache_duration', $defaultConfig['cache_duration']);
        $app['config']->set('railcontent.table_prefix', $defaultConfig['table_prefix']);
        $app['config']->set('railcontent.data_mode', $defaultConfig['data_mode']);
        $app['config']->set('railcontent.brand', $defaultConfig['brand']);
        $app['config']->set('railcontent.available_brands', $defaultConfig['available_brands']);
        $app['config']->set('railcontent.available_languages', $defaultConfig['available_languages']);
        $app['config']->set('railcontent.default_language', $defaultConfig['default_language']);
        $app['config']->set('railcontent.field_option_list', $defaultConfig['field_option_list']);
        $app['config']->set('railcontent.commentable_content_types', $defaultConfig['commentable_content_types']);
        $app['config']->set('railcontent.showTypes', $defaultConfig['showTypes']);
        $app['config']->set('railcontent.cataloguesMetadata', $defaultConfig['cataloguesMetadata']);
        $app['config']->set('railcontent.topLevelContentTypes', $defaultConfig['topLevelContentTypes']);
        $app['config']->set('railcontent.userListContentTypes', $defaultConfig['userListContentTypes']);
        $app['config']->set('railcontent.appUserListContentTypes', $defaultConfig['appUserListContentTypes']);
        $app['config']->set('railcontent.onboardingContentIds', $defaultConfig['onboardingContentIds']);
        $app['config']->set('railcontent.validation', $defaultConfig['validation']);
        $app['config']->set(
            'railcontent.comment_assignation_owner_ids',
            $defaultConfig['comment_assignation_owner_ids']
        );
        $app['config']->set('railcontent.searchable_content_types', $defaultConfig['searchable_content_types']);
        $app['config']->set('railcontent.statistics_content_types', $defaultConfig['statistics_content_types']);
        $app['config']->set('railcontent.search_index_values', $defaultConfig['search_index_values']);
        $app['config']->set(
            'railcontent.allowed_types_for_bubble_progress',
            $defaultConfig['allowed_types_for_bubble_progress']
        );
        $app['config']->set('railcontent.all_routes_middleware', $defaultConfig['all_routes_middleware']);
        $app['config']->set('railcontent.user_routes_middleware', $defaultConfig['user_routes_middleware']);
        $app['config']->set(
            'railcontent.administrator_routes_middleware',
            $defaultConfig['administrator_routes_middleware']
        );

        $xpConfig = require(__DIR__ . '/../config/xp_ranks.php');
        $app['config']->set('xp_ranks', $xpConfig);

        // setup default database to use sqlite :memory:
        $app['config']->set('database.default', $this->getConnectionType());
        $app['config']->set(
            'database.connections.mysql',
            [
                'driver' => 'mysql',
                'host' => 'mysql',
                'port' => env('MYSQL_PORT', '3306'),
                'database' => env('MYSQL_DB', 'railcontent'),
                'username' => 'root',
                'password' => 'root',
                'charset' => 'utf8',
                'collation' => 'utf8_general_ci',
                'prefix' => '',
                'options' => [
                    \PDO::ATTR_PERSISTENT => true,
                ]
            ]
        );

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

        $app['config']->set(
            'railcontent.awsS3_remote_storage',
            [
                'accessKey' => env('AWS_S3_REMOTE_STORAGE_ACCESS_KEY'),
                'accessSecret' => env('AWS_S3_REMOTE_STORAGE_ACCESS_SECRET'),
                'region' => env('AWS_S3_REMOTE_STORAGE_REGION'),
                'bucket' => env('AWS_S3_REMOTE_STORAGE_BUCKET')
            ]
        );

        $app['config']->set('railcontent.awsCloudFront', 'd1923uyy6spedc.cloudfront.net');

        $app['config']->set(
            'database.redis',
            [
                'client' => 'predis',
                'default' => [
                    'host' => env('REDIS_HOST', 'redis'),
                    'password' => env('REDIS_PASSWORD', null),
                    'port' => env('REDIS_PORT', 6379),
                    'database' => 0,
                ]
            ]
        );
        $app['config']->set('cache.default', env('CACHE_DRIVER', 'redis'));
        $app['config']->set('railcontent.cache_prefix', $defaultConfig['cache_prefix']);
        $app['config']->set('railcontent.cache_driver', $defaultConfig['cache_driver']);

        $app['config']->set('railcontent.decorators', $defaultConfig['decorators']);
        $app['config']->set('railcontent.use_collections', $defaultConfig['use_collections']);
        $app['config']->set('railcontent.content_hierarchy_max_depth', $defaultConfig['content_hierarchy_max_depth']);
        $app['config']->set('railcontent.content_hierarchy_decorator_allowed_types', $defaultConfig['content_hierarchy_decorator_allowed_types']);

        // vimeo
        $app['config']->set('railcontent.video_sync', $defaultConfig['video_sync']);

        // register provider
        $app->register(RailcontentServiceProvider::class);
        $app->register(ResponseServiceProvider::class);
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
        $userId = $this->databaseManager->connection()->table('users')->insertGetId(
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

    protected function tearDown(): void
    {
        Redis::flushDB();
        parent::tearDown();
    }

    // -------------------- used by RemoteStorage Service & Controller tests --------------------

    protected function awsConfigInitForTesting()
    {
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
    protected function create($useThisFilenameWithoutExtension = null)
    {
        $filenameAbsolute = $this->faker->image(sys_get_temp_dir());

        if (!empty($useThisFilenameWithoutExtension)) {
            $filenameAbsolute =
                $this->changeImageNameLocally($filenameAbsolute, $useThisFilenameWithoutExtension);
        }

        $filenameRelative = $this->getFilenameRelativeFromAbsolute($filenameAbsolute);

        $upload = $this->remoteStorageService->put($filenameRelative, $filenameAbsolute);

        if (!$upload) {
            $this->fail('s3 upload appears to have failed.');
        }

        return $filenameAbsolute;
    }

    /**
     * @param string $filenameRelative
     * @return string
     */
    protected function getExtensionFromRelative($filenameRelative)
    {
        $stringExplodedToCreateArray = explode(".", $filenameRelative);
        $extension = end($stringExplodedToCreateArray);
        if (!$extension) {
            $this->fail('No file extension retrieved from the image created by Faker.');
        }
        if (!is_string($extension)) {
            $this->fail('Value retrieved for file extension is not a string.');
        }
        return $extension;
    }

    /**
     * @param string $filenameAbsolute
     * @return string
     */
    protected function getExtensionFromAbsolute($filenameAbsolute)
    {
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

    public function createExpectedResult($status, $code, $results)
    {
        return [
            "status" => $status,
            "code" => $code,
            "results" => $results
        ];
    }

    public function createPaginatedExpectedResult($status, $code, $page, $limit, $totalResults, $results, $filter)
    {
        return [
            "status" => $status,
            "code" => $code,
            "page" => $page,
            "limit" => $limit,
            "total_results" => $totalResults,
            "results" => $results,
            "filter_options" => $filter
        ];
    }

    public function setConnectionType($type = 'testbench')
    {
        $this->connectionType = $type;
    }

    public function getConnectionType()
    {
        return $this->connectionType;
    }

}