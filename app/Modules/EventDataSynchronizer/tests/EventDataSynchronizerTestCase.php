<?php

namespace App\Modules\EventDataSynchronizer\tests;

use App\Modules\EventDataSynchronizer\Providers\EventDataSynchronizerServiceProvider;
use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface;
use App\Modules\EventDataSynchronizer\tests\Fixtures\TestingRailforumsUserProvider;
use App\Modules\EventDataSynchronizer\tests\Fixtures\TestingUserProvider;
use Carbon\Carbon;
use Doctrine\Inflector\InflectorFactory;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Routing\Router;
use Railroad\Railcontent\Providers\RailcontentServiceProvider;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railforums\Contracts\UserProviderInterface as RailforumsUserProviderInterface;
use Railroad\Usora\Managers\UsoraEntityManager;
use Railroad\Usora\Providers\UsoraServiceProvider;
use Tests\TestCase;

class EventDataSynchronizerTestCase extends TestCase
{
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

    protected UserProviderInterface $userProvider;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userProvider = app(TestingUserProvider::class);

        $this->app->instance(UserProviderInterface::class, $this->userProvider);
        $this->app->instance(RailforumsUserProviderInterface::class, app(TestingRailforumsUserProvider::class));

        $this->databaseManager = $this->app->make(DatabaseManager::class);
        $this->authManager = $this->app->make(AuthManager::class);
        $this->router = $this->app->make(Router::class);


        Carbon::setTestNow(Carbon::now());



    }


    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
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

        $app['config']->set('event-data-synchronizer.brand', 'testbench');
        $app['config']->set('event-data-synchronizer.users_database_connection_name', 'testbench');
        $app['config']->set('event-data-synchronizer.users_table_name', 'usora_users');

        $app['config']->set(
            'event-data-synchronizer.ecommerce_product_sku_to_content_permission_name_map',
            [
                'product_sku' => 'permission_name',
            ]
        );

        $app['config']->set('ecommerce.database_driver', 'pdo_sqlite');
        $app['config']->set('ecommerce.database_user', 'root');
        $app['config']->set('ecommerce.database_password', 'root');
        $app['config']->set('ecommerce.database_in_memory', true);

        // usora
        config()->set('usora.authentication_controller_middleware', []);

        // db
        config()->set('usora.data_mode', 'host');
        config()->set('usora.database_connection_name', config('usora.connection_mask_prefix') . 'testbench');
        config()->set('usora.authentication_controller_middleware', []);

        // database
        config()->set('usora.database_user', 'root');
        config()->set('usora.database_password', 'root');
        config()->set('usora.database_driver', 'pdo_sqlite');
        config()->set('usora.database_in_memory', true);

        config()->set('usora.redis_host', 'redis');
        config()->set('usora.development_mode', true);
        config()->set('usora.database_driver', 'pdo_sqlite');
        config()->set('usora.database_user', 'root');
        config()->set('usora.database_password', 'root');
        config()->set('usora.database_in_memory', true);
        config()->set(
            'usora.tables',
            [
                'users' => 'usora_users',
                'user_fields' => 'usora_user_fields',
                'email_changes' => 'usora_email_changes',
                'password_resets' => 'usora_password_resets',
                'remember_tokens' => 'usora_remember_tokens',
                'firebase_tokens' => 'usora_user_firebase_tokens'
            ]
        );

        // if new packages entities are required for testing, their entity directory/namespace config should be merged here
        config()->set(
            'usora.entities',
            [
                [
                    'path' => __DIR__ . '/../vendor/railroad/usora/src/Entities',
                    'namespace' => 'App\Modules\UserManagementSystem\Entities',
                ],
            ]
        );

        config()->set('usora.autoload_all_routes', true);
        config()->set('usora.route_middleware_public_groups', ['test_public_route_group']);
        config()->set('usora.route_middleware_logged_in_groups', ['test_logged_in_route_group']);

        // railcontent
        config(
            [
                'railcontent' => [
                    'database_connection_name' => 'testbench',
                    'connection_mask_prefix' => 'railcontent_',
                    'data_mode' => 'host',
                    'table_prefix' => 'railcontent_',
                    'brand' => 'testbench',
                    'available_brands' => ['testbench'],
                    'redis_host' => 'redis',
                    'decorators' => [
                        'content' => [
                            \Railroad\Railcontent\Decorators\Hierarchy\ContentSlugHierarchyDecorator::class,
                            \Railroad\Railcontent\Decorators\Entity\ContentEntityDecorator::class,
                        ]
                    ],
                ]
            ]
        );

        // register providers
        $app->register(EventDataSynchronizerServiceProvider::class);

        $app->register(RailcontentServiceProvider::class);
        $app->register(UsoraServiceProvider::class);

        // make sure usora is using the same connection as ecom and laravel
        $usoraEntityManager = app(UsoraEntityManager::class);
        $newUsoraEntityManager = UsoraEntityManager::create(
            $usoraEntityManager->getConnection(),
            $usoraEntityManager->getConfiguration(),
            $usoraEntityManager->getEventManager()
        );
        app()->instance(UsoraEntityManager::class, $newUsoraEntityManager);

        // register global doctrine inflector
        $inflector = InflectorFactory::create()->build();

        app()->instance('DoctrineInflector', $inflector);

        // this is required for railcontent connection masking to work properly from test to test
        RepositoryBase::$connectionMask = null;
    }
}
