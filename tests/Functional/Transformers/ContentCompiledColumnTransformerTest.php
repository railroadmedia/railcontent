<?php

namespace Railroad\Railcontent\Tests\Functional\Transformers;

use Carbon\Carbon;
use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Support\Facades\Event;
use Orchestra\Testbench\TestCase as BaseTestCase;
use PDO;
use Railroad\Railcontent\Providers\RailcontentServiceProvider;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\Resources\Models\User;
use Railroad\Railcontent\Transformers\ContentCompiledColumnTransformer;
use Railroad\Response\Providers\ResponseServiceProvider;

class ContentCompiledColumnTransformerTest extends BaseTestCase
{
    /**
     * NOTE: This test uses our real database and rows and must be connected to a local mysql database with
     * production data. In the future we'll create proper content seeders/factories.
     */

    /**
     * @var ContentService
     */
    protected $contentService;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.default', 'mysql');
        config()->set('railcontent.database_connection_name', 'mysql');

        $this->contentService = $this->app->make(ContentService::class);

        Carbon::setTestNow(Carbon::now());

        Event::listen(StatementPrepared::class, function ($event) {
            /** @var StatementPrepared $event */
            $event->statement->setFetchMode(PDO::FETCH_ASSOC);
        });

        ContentRepository::$bypassPermissions = true;
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $defaultConfig = require(__DIR__ . '/../../../config/railcontent.php');

        $app['config']->set('railcontent.elastic_index_name', 'testing');
        $app['config']->set(
            'railcontent.compiled_column_mapping_data_keys',
            $defaultConfig['compiled_column_mapping_data_keys']
        );
        $app['config']->set(
            'railcontent.compiled_column_mapping_field_keys',
            $defaultConfig['compiled_column_mapping_field_keys']
        );
        $app['config']->set('railcontent.database_connection_name', 'mysql');
        $app['config']->set('railcontent.cache_duration', $defaultConfig['cache_duration']);
        $app['config']->set('railcontent.table_prefix', $defaultConfig['table_prefix']);
        $app['config']->set('railcontent.data_mode', $defaultConfig['data_mode']);
        $app['config']->set('railcontent.use_elastic_search', $defaultConfig['use_elastic_search']);
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
        $app['config']->set('railcontent.contentColumnNamesForFields', $defaultConfig['contentColumnNamesForFields']);
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

        $xpConfig = require(__DIR__ . '/../../../config/xp_ranks.php');
        $app['config']->set('xp_ranks', $xpConfig);

        $app['config']->set('database.default', 'mysql');
        $app['config']->set(
            'database.connections.mysql',
            [
                'driver' => 'mysql',
                'host' => 'mysql8',
                'port' => env('MYSQL_PORT', '3306'),
                'database' => 'musora_laravel',
                'username' => 'root',
                'password' => 'root',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'prefix' => '',
                'options' => [
                    \PDO::ATTR_PERSISTENT => true,
                ],
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
                'client' => env('REDIS_CLIENT', 'predis'),

                'options' => [
                    'cluster' => env('REDIS_CLUSTER', 'redis'),
                ],

                'default' => [
                    'url' => env('REDIS_URL', 'redis'),
                    'host' => env('REDIS_HOST', 'redis'),
                    'password' => env('REDIS_PASSWORD', null),
                    'port' => env('REDIS_PORT', 6379),
                    'database' => 0,
                ],

                'cache' => [
                    'url' => env('REDIS_URL', 'redis'),
                    'host' => env('REDIS_HOST', 'redis'),
                    'password' => env('REDIS_PASSWORD', null),
                    'port' => env('REDIS_PORT', 6379),
                    'database' => 0,
                ],
            ],
        );
        $app['config']->set('cache.default', env('CACHE_DRIVER', 'array'));
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
        $app->register(RailcontentServiceProvider::class);
        $app->register(ResponseServiceProvider::class);
    }


    public function test_drumeo_quick_tip()
    {
        config()->set('railcontent.brand', 'drumeo');
        ConfigService::$availableBrands = ['drumeo'];

        ContentCompiledColumnTransformer::$useCompiledColumnForServingData = false;

        $contentWithoutTransformer = $this->contentService->getById(197937);

        ContentCompiledColumnTransformer::$useCompiledColumnForServingData = true;
        $this->contentService->idContentCache = [];

        $contentWithTransformer = $this->contentService->getById(197937);


        // for each field and data make sure there is a match in the transformed data
        $this->assertNotEmpty($contentWithTransformer);

        foreach ($contentWithoutTransformer['data'] as $oldData) {
            $matchFound = false;

            foreach ($contentWithTransformer['data'] as $newData) {
                if ($oldData['key'] === $newData['key'] &&
                    $oldData['value'] == $newData['value'] &&
                    $oldData['position'] == $newData['position']
                ) {
                    $matchFound = true;
                }
            }

            if (!$matchFound) {
                var_dump($oldData);
                $this->fail('Could not find old data key inside the new transformed data.');
            }
        }

        foreach ($contentWithoutTransformer['fields'] as $oldField) {
            $matchFound = false;

            foreach ($contentWithTransformer['fields'] as $newField) {
                if ($oldField['key'] === $newField['key'] &&
                    $oldField['value'] == $newField['value'] &&
                    $oldField['position'] == $newField['position']
                ) {
                    $matchFound = true;
                }
            }

            if (!$matchFound) {
                var_dump($oldField);
                $this->assertEquals($contentWithoutTransformer['fields'], $contentWithTransformer['fields']);
                $this->fail('Could not find old field key inside the new transformed data.');
            }
        }
    }
}
