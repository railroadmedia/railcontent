<?php

namespace Railroad\Railcontent\Providers;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\RedisCache;
use Doctrine\Common\EventManager;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Cache\DefaultCacheFactory;
use Doctrine\ORM\Cache\RegionsConfiguration;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Gedmo\DoctrineExtensions;
use Gedmo\Sortable\SortableListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Railroad\Doctrine\TimestampableListener;
use Railroad\Railcontent\Commands\CreateSearchIndexes;
use Railroad\Railcontent\Commands\CreateVimeoVideoContentRecords;
use Railroad\Railcontent\Commands\CreateYoutubeVideoContentRecords;
use Railroad\Railcontent\Commands\ExpireCache;
use Railroad\Railcontent\Commands\MigrateContentFields;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Hydrators\RailcontentHydrator;
use Railroad\Railcontent\Listeners\ContentEventListener;
use Railroad\Railcontent\Listeners\UserContentProgressEventListener;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Redis;

class RailcontentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->listen = [
            ContentDeleted::class => [ContentEventListener::class . '@handleDelete'],
            ContentSoftDeleted::class => [ContentEventListener::class . '@handleSoftDelete'],
            UserContentProgressSaved::class => [UserContentProgressEventListener::class . '@handle'],
        ];

        parent::boot();

        $this->publishes(
            [
                __DIR__ . '/../../config/railcontent.php' => config_path('railcontent.php'),
            ]
        );

        if (config('railcontent.data_mode') == 'host') {
            $this->loadMigrationsFrom(__DIR__ . '/../../migrations');
        }

        //load package routes file
        $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        $this->commands(
            [
                CreateSearchIndexes::class,
                CreateVimeoVideoContentRecords::class,
                CreateYoutubeVideoContentRecords::class,
                ExpireCache::class,
                MigrateContentFields::class,
            ]
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \Doctrine\ORM\ORMException
     */
    public function register()
    {
        // set proxy dir to temp folder on server
        $proxyDir = sys_get_temp_dir();

        // setup redis
        $redis = new Redis();
        $redis->connect(
            config('railcontent.redis_host'),
            config('railcontent.redis_port')
        );
        $redisCache = new RedisCache();
        $redisCache->setRedis($redis);

        // redis cache instance is referenced in laravel container to be reused when needed
        AnnotationRegistry::registerLoader('class_exists');

        $annotationReader = new AnnotationReader();

        $cachedAnnotationReader = new CachedReader(
            $annotationReader, $redisCache
        );

        $driverChain = new MappingDriverChain();

        DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
            $driverChain,
            $cachedAnnotationReader
        );

        foreach (config('doctrine.entities') as $driverConfig) {
            $annotationDriver = new AnnotationDriver(
                $cachedAnnotationReader, $driverConfig['path']
            );

            $driverChain->addDriver(
                $annotationDriver,
                $driverConfig['namespace']
            );
        }

        // driver chain instance is referenced in laravel container to be reused when needed
        $timestampableListener = new TimestampableListener();
        $timestampableListener->setAnnotationReader($cachedAnnotationReader);

        $sortableListener = new SortableListener();
        $sortableListener->setAnnotationReader($cachedAnnotationReader);

        $eventManager = new EventManager();
        $eventManager->addEventSubscriber($timestampableListener);
        $eventManager->addEventSubscriber($sortableListener);


        $ormConfiguration = new Configuration();

        $factory = new DefaultCacheFactory(new RegionsConfiguration(), $redisCache);
        $ormConfiguration->setSecondLevelCacheEnabled();
        $ormConfiguration->getSecondLevelCacheConfiguration()->setCacheFactory($factory);

        $ormConfiguration->addCustomStringFunction('MATCH_AGAINST','Railroad\\Railcontent\\Extensions\\Doctrine\\MatchAgainst');
        $ormConfiguration->addCustomStringFunction('UNIX_TIMESTAMP','Railroad\\Railcontent\\Extensions\\Doctrine\\UnixTimestamp');

        $ormConfiguration->setMetadataCacheImpl($redisCache);
        $ormConfiguration->setQueryCacheImpl($redisCache);
        $ormConfiguration->setResultCacheImpl($redisCache);
        $ormConfiguration->setProxyDir($proxyDir);
        $ormConfiguration->setProxyNamespace('DoctrineProxies');
        $ormConfiguration->setAutoGenerateProxyClasses(
            config('railcontent.development_mode')
        );
        $ormConfiguration->setMetadataDriverImpl($driverChain);
        $ormConfiguration->setNamingStrategy(
            new UnderscoreNamingStrategy(CASE_LOWER)
        );

        // orm configuration instance is referenced in laravel container to be reused when needed
        if (config('railcontent.database_in_memory') !== true) {
            $databaseOptions = [
                'driver' => config('railcontent.database_driver'),
                'dbname' => config('railcontent.database_name'),
                'user' => config('railcontent.database_user'),
                'password' => config('railcontent.database_password'),
                'host' => config('railcontent.database_host'),
            ];
        } else {
            $databaseOptions = [
                'driver' => config('railcontent.database_driver'),
                'user' => config('railcontent.database_user'),
                'password' => config('railcontent.database_password'),
                'memory' => true,
            ];
        }

        // custom hydrator
        $ormConfiguration->addCustomHydrationMode('Railcontent', RailcontentHydrator::class);

        // register the default entity manager
        $entityManager = RailcontentEntityManager::create(
            $databaseOptions,
            $ormConfiguration,
            $eventManager
        );

        // register the entity manager as a singleton
        app()->instance(RailcontentEntityManager::class, $entityManager);
    }
}