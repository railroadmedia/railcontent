<?php

namespace Railroad\Railcontent\Tests;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Dotenv\Dotenv;
use Exception;
use Faker\Generator;
use Faker\ORM\Doctrine\Populator;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Railroad\Doctrine\Hydrators\FakeDataHydrator;
use Railroad\Doctrine\Providers\DoctrineServiceProvider;
use Railroad\Permissions\Providers\PermissionsServiceProvider;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\CommentAssignment;
use Railroad\Railcontent\Entities\CommentLikes;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentInstructor;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\ContentTopic;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Middleware\ContentPermissionsMiddleware;
use Railroad\Railcontent\Providers\RailcontentServiceProvider;
use Railroad\Railcontent\Services\RemoteStorageService;
use Railroad\Railcontent\Tests\Fixtures\UserProvider;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Doctrine\Contracts\UserProviderInterface as DoctrineUserProviderInterface;
use Railroad\DoctrineArrayHydrator\Contracts\UserProviderInterface as DoctrineArrayHydratorUserProviderInterface;
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

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $permissionServiceMock;

    /**
     * @var string database connexion type
     * by default it's testbench; for full text search it's mysql
     */
    protected $connectionType = 'testbench';

    /**
     * @var EntityManager
     */
    protected $entityManager;

    protected $serializer;

    protected $fakeDataHydrator;

    protected $populator;

    protected function setUp()
    {
        parent::setUp();

        // Run the schema update tool using our entity metadata
        $this->entityManager = app(EntityManager::class);

        $this->entityManager->getMetadataFactory()
            ->getCacheDriver()
            ->deleteAll();

        // make sure laravel is using the same connection
        DB::connection()
            ->setPdo(
                $this->entityManager->getConnection()
                    ->getWrappedConnection()
            );
        DB::connection()
            ->setReadPdo(
                $this->entityManager->getConnection()
                    ->getWrappedConnection()
            );

        $userProvider = new UserProvider();

        $this->app->instance(UserProviderInterface::class, $userProvider);
        $this->app->instance(DoctrineArrayHydratorUserProviderInterface::class, $userProvider);
        $this->app->instance(\Railroad\Doctrine\Contracts\UserProviderInterface::class, $userProvider);

        $this->artisan('migrate:fresh', []);
        $this->artisan('cache:clear', []);

        $this->createUsersTable();

        $this->faker = $this->app->make(Generator::class);
        $this->fakeDataHydrator = new FakeDataHydrator($this->entityManager);

        $this->databaseManager = $this->app->make(DatabaseManager::class);
        $this->authManager = $this->app->make(AuthManager::class);
        $this->router = $this->app->make(Router::class);
        $this->serializer =
            SerializerBuilder::create()
                ->setSerializationContextFactory(
                    function () {
                        return SerializationContext::create()
                            ->setSerializeNull(true);
                    }
                )
                ->build();

        $this->permissionServiceMock =
            $this->getMockBuilder(PermissionService::class)
                ->disableOriginalConstructor()
                ->getMock();
        $this->app->instance(PermissionService::class, $this->permissionServiceMock);

        Carbon::setTestNow(Carbon::now());

        //call the ContentPermissionsMiddleware
        $middleware = $this->app->make(ContentPermissionsMiddleware::class);
        $middleware->handle(
            request(),
            function () {
            }
        );
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
        $app['config']->set('railcontent.validation', $defaultConfig['validation']);
        $app['config']->set(
            'railcontent.comment_assignation_owner_ids',
            $defaultConfig['comment_assignation_owner_ids']
        );
        $app['config']->set('railcontent.comment_likes_amount_of_users', $defaultConfig['comment_likes_amount_of_users']);
        $app['config']->set('railcontent.searchable_content_types', $defaultConfig['searchable_content_types']);
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
                ],
            ]
        );

        // database
        if ($this->getConnectionType() == "mysql") {
            //mysql
            $app['config']->set('doctrine.database_driver', $defaultConfig['database_driver']);
            $app['config']->set('doctrine.database_name', $defaultConfig['database_name']);
            $app['config']->set('doctrine.database_user', $defaultConfig['database_user']);
            $app['config']->set('doctrine.database_password', $defaultConfig['database_password']);
            $app['config']->set('doctrine.database_host', $defaultConfig['database_host']);

            $app['config']->set(
                'database.connections.' . $defaultConfig['database_connection_name'],
                [
                    'driver' => 'mysql',
                    'database' => $defaultConfig['database_name'],
                    'username' => $defaultConfig['database_user'],
                    'password' => $defaultConfig['database_password'],
                    'host' => $defaultConfig['database_host'],
                ]
            );
        } else {
            $app['config']->set('doctrine.database_driver', 'pdo_sqlite');
            $app['config']->set('doctrine.database_user', 'root');
            $app['config']->set('doctrine.database_password', 'root');
            $app['config']->set('doctrine.database_in_memory', true);
            $app['config']->set('doctrine.development_mode', true);
        }

        // if new packages entities are required for testing, their entity directory/namespace config should be merged here
        $app['config']->set(
            'doctrine.entities',
            array_merge(
                $defaultConfig['entities']
            )
        );
        $app['config']->set('doctrine.redis_host', $defaultConfig['redis_host']);
        $app['config']->set('doctrine.redis_port', $defaultConfig['redis_port']);

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
                'bucket' => env('AWS_S3_REMOTE_STORAGE_BUCKET'),
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
                ],
            ]
        );
        $app['config']->set('cache.default', env('CACHE_DRIVER', 'redis'));
        $app['config']->set('railcontent.cache_prefix', $defaultConfig['cache_prefix']);
        $app['config']->set('railcontent.cache_driver', $defaultConfig['cache_driver']);

        $app['config']->set('railcontent.decorators', $defaultConfig['decorators']);
        $app['config']->set('railcontent.use_collections', $defaultConfig['use_collections']);
        $app['config']->set('railcontent.content_hierarchy_max_depth', $defaultConfig['content_hierarchy_max_depth']);
        $app['config']->set(
            'railcontent.content_hierarchy_decorator_allowed_types',
            $defaultConfig['content_hierarchy_decorator_allowed_types']
        );

        // vimeo
        $app['config']->set('railcontent.video_sync', $defaultConfig['video_sync']);

        // register provider
        $app->register(DoctrineServiceProvider::class);
        $app->register(RailcontentServiceProvider::class);
        $app->register(PermissionsServiceProvider::class);

        $app->bind(
            'UserProviderInterface',
            function () {
                $mock =
                    $this->getMockBuilder('UserProviderInterface')
                        ->setMethods(['create'])
                        ->getMock();

                $mock->method('create')
                    ->willReturn(
                        [
                            'id' => 1,
                            'email' => $this->faker->email,
                        ]
                    );
                return $mock;
            }
        );
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

        $mock =
            $this->getMockBuilder(Dispatcher::class)
                ->setMethods(['fire', 'dispatch'])
                ->getMockForAbstractClass();

        $mock->method('fire')
            ->willReturnCallback(
                function ($called) {
                    $this->firedEvents[] = $called;
                }
            );

        $mock->method('dispatch')
            ->willReturnCallback(
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
                        'These expected events were not fired: [' . implode(', ', $eventsNotFired) . ']'
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
        $userId = 1;
        $email = $this->faker->email;

        $email = $this->faker->email;
        $userId =
            $this->databaseManager->table('users')
                ->insertGetId(
                    [
                        'email' => $email,
                        'password' => $this->faker->password,
                        'display_name' => $this->faker->name,
                        'created_at' => Carbon::now()
                            ->toDateTimeString(),
                        'updated_at' => Carbon::now()
                            ->toDateTimeString(),
                    ]
                );

        Auth::shouldReceive('check')
            ->andReturn(true);
        Auth::shouldReceive('id')
            ->andReturn($userId);
        $userMockResults = ['id' => $userId, 'email' => $email];
        Auth::shouldReceive('user')
            ->andReturn($userMockResults);

        return $userId;

    }

    protected function createUsersTable()
    {
        if (!$this->app['db']->connection()
            ->getSchemaBuilder()
            ->hasTable('users')) {
            $this->app['db']->connection()
                ->getSchemaBuilder()
                ->create(
                    'users',
                    function (Blueprint $table) {
                        $table->increments('id');
                        $table->string('email');
                        $table->string('password');
                        $table->string('display_name');
                        $table->timestamps();
                    }
                );
        }
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
            $filenameAbsolute = $this->changeImageNameLocally($filenameAbsolute, $useThisFilenameWithoutExtension);
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
            "results" => $results,
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
            "filter_options" => $filter,
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

    public function fakeContent($nr = 1, $contentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);

        if (!array_key_exists('brand', $contentData)) {
            $contentData['brand'] = config('railcontent.brand');
        }

        $contentData['topic'] = new ArrayCollection();
        $contentData['data'] = new ArrayCollection();
        $contentData['tag'] = new ArrayCollection();

        if (array_key_exists('userId',$contentData)) {
            $contentData['user'] =
                $this->app->make(UserProvider::class)
                    ->getUserById($contentData['userId']);
            unset($contentData['userId']);
        }

        $this->populator->addEntity(
            Content::class,
            $nr,
            $contentData

        );
        $fakePopulator = $this->populator->execute();

        return $fakePopulator[Content::class];
    }

    public function fakeHierarchy($nr = 1, $contentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);

        if (empty($contentData)) {
            $contentData = [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(2),
                'childPosition' => 1,
            ];
        }

        $this->populator->addEntity(
            ContentHierarchy::class,
            $nr,
            $contentData

        );

        $fakePopulator = $this->populator->execute();

        return $fakePopulator[ContentHierarchy::class];
    }

    public function fakeUserContentProgress($nr = 1, $contentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);

        $contentData['user'] =
            $this->app->make(UserProvider::class)
                ->getUserById($contentData['userId'] ?? 1);

        if (empty($contentData)) {
            $contentData = [
                'content' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'state' => 'completed',
                'progressPercent' => 100,
            ];
        }

        unset($contentData['userId']);

        $this->populator->addEntity(
            UserContentProgress::class,
            $nr,
            $contentData

        );

        $fakePopulator = $this->populator->execute();

        return $fakePopulator[UserContentProgress::class];
    }

    public function fakeContentInstructor($nr = 1, $contentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);
        if (!array_key_exists('content', $contentData)) {
            $content =
                $this->entityManager->getRepository(Content::class)
                    ->find(1);
        } else {
            $content = $contentData['content'];
        }

        if (empty($contentData)) {
            $contentData = [
                'content' => $content,
                'instructor' => $this->entityManager->getRepository(Content::class)
                    ->find(2),
            ];
        }
        $this->populator->addEntity(
            ContentInstructor::class,
            $nr,
            $contentData

        );
        $fakePopulator = $this->populator->execute();
        for ($i = 0; $i < $nr; $i++) {
            $content->addInstructor($fakePopulator[ContentInstructor::class][$i]);
        }

        return $fakePopulator[ContentInstructor::class];
    }

    public function fakePermission($nr = 1, $contentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);

        if (empty($contentData)) {
            $contentData = [
                'name' => $this->faker->word,
                'brand' => config('railcontent.brand'),
            ];
        }
        $this->populator->addEntity(
            Permission::class,
            $nr,
            $contentData

        );
        $fakePopulator = $this->populator->execute();

        return $fakePopulator[Permission::class];
    }

    public function fakeComment($nr = 1, $commentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);

        if (empty($commentData)) {
            $commentData = [
                'userId' => 1,
                'deletedAt' => null,
            ];
        }
        if (!array_key_exists('content', $commentData)) {
            $commentData['content'] = $this->fakeContent(
                1,
                [
                    'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                    'brand' => $this->faker->randomElement(config('railcontent.available_brands')),
                ]
            )[0];
        }
        $commentData['user'] =
            $this->app->make(UserProvider::class)
                ->getUserById($commentData['userId'] ?? 1);
        unset($commentData['userId']);

        $this->populator->addEntity(
            Comment::class,
            $nr,
            $commentData
        );

        $fakePopulator = $this->populator->execute();

        return $fakePopulator[Comment::class];
    }

    public function fakeContentPermission($nr = 1, $commentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);

        if (empty($commentData)) {
            $commentData = [
                'userId' => 1,
                'brand' => config('railcontent.brand'),
            ];
        }
        if (!array_key_exists('permission', $commentData)) {
            $commentData['permission'] = $this->fakePermission()[0];
        }

        $this->populator->addEntity(
            ContentPermission::class,
            $nr,
            $commentData
        );

        $fakePopulator = $this->populator->execute();

        return $fakePopulator[ContentPermission::class];
    }

    public function fakeUserPermission($nr = 1, $commentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);

        if (empty($commentData)) {
            $commentData = [
                'userId' => 1,
                'startDate' => Carbon::now(),
            ];
        }
        if (!array_key_exists('permission', $commentData)) {
            $commentData['permission'] = $this->fakePermission()[0];
        }
        $commentData['user'] =
            $this->app->make(UserProvider::class)
                ->getUserById($commentData['userId'] ?? 1);

        unset ($commentData['userId']);

        $this->populator->addEntity(
            UserPermission::class,
            $nr,
            $commentData
        );

        $fakePopulator = $this->populator->execute();

        return $fakePopulator[UserPermission::class];
    }

    public function fakeContentData($nr = 1, $contentData = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);

        $this->populator->addEntity(
            ContentData::class,
            $nr,
            $contentData
        );

        $fakePopulator = $this->populator->execute();

        return $fakePopulator[ContentData::class];
    }

    public function fakeContentTopic($nr = 1, $topic = [])
    {
        $this->populator = new Populator($this->faker, $this->entityManager);
        if (!array_key_exists('content', $topic)) {
            $content =
                $this->entityManager->getRepository(Content::class)
                    ->find(1);
        } else {
            $content = $topic['content'];
        }

        if (empty($topic)) {
            $topic = [
                'content' => $content,
                'topic' => $this->faker->word,
                'position' => 1,
            ];
        }
        $this->populator->addEntity(
            ContentTopic::class,
            $nr,
            $topic

        );
        $fakePopulator = $this->populator->execute();

        for ($i = 0; $i < $nr; $i++) {
            $content->addTopic($fakePopulator[ContentTopic::class][$i]);
        }
        return $fakePopulator[ContentTopic::class];
    }

    public function fakeCommentLike($nr = 1, $commentLikeData = [])
    {
        if (empty($commentLikeData)) {
            $commentLikeData = [
                'userId' => 1,
                'comment' => $this->fakeComment(),
            ];
        }

        $commentLikeData['user'] =
            $this->app->make(UserProvider::class)
                ->getUserById($commentLikeData['userId'] ?? 1);

        unset ($commentLikeData['userId']);

        $this->populator->addEntity(
            CommentLikes::class,
            $nr,
            $commentLikeData

        );
        $fakePopulator = $this->populator->execute();

        return $fakePopulator[CommentLikes::class];
    }

    public function fakeCommentAssignation($nr = 1, $assignationData = [])
    {
        if (empty($assignationData)) {
            $assignationData = [
                'comment' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'userId' => rand(),
            ];
        }

        $assignationData['user'] =
            $this->app->make(UserProvider::class)
                ->getUserById($assignationData['userId'] ?? 1);

        unset ($assignationData['userId']);

        $this->populator->addEntity(
            CommentAssignment::class,
            $nr,
            $assignationData

        );
        $fakePopulator = $this->populator->execute();

        return $fakePopulator[CommentAssignment::class];
    }

}