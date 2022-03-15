<?php

namespace Railroad\Railcontent\Providers;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\PhpFileCache;
use Doctrine\Common\Cache\RedisCache;
use Doctrine\Common\EventManager;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Cache\DefaultCacheFactory;
use Doctrine\ORM\Cache\RegionsConfiguration;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMException;
use Gedmo\DoctrineExtensions;
use Gedmo\Sortable\SortableListener;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Railroad\Doctrine\TimestampableListener;
use Railroad\Doctrine\Types\Carbon\CarbonDateTimeTimezoneType;
use Railroad\Doctrine\Types\Carbon\CarbonDateTimeType;
use Railroad\Doctrine\Types\Carbon\CarbonDateType;
use Railroad\Doctrine\Types\Carbon\CarbonTimeType;
use Railroad\Railcontent\Commands\CalculateTotalXP;
use Railroad\Railcontent\Commands\ComputePastStats;
use Railroad\Railcontent\Commands\ComputeWeeklyStats;
use Railroad\Railcontent\Commands\CreateSearchIndexes;
use Railroad\Railcontent\Commands\CreateVimeoVideoContentRecords;
use Railroad\Railcontent\Commands\CreateYoutubeVideoContentRecords;
use Railroad\Railcontent\Commands\DeleteContentAndHierarchiesForUserPlaylists;
use Railroad\Railcontent\Commands\ExpireCache;
use Railroad\Railcontent\Commands\MigrateContentColumns;
use Railroad\Railcontent\Commands\MigrateContentFields;
use Railroad\Railcontent\Commands\MigrateContentInstructors;
use Railroad\Railcontent\Commands\MigrateContentStyles;
use Railroad\Railcontent\Commands\MigrateContentToElasticsearch;
use Railroad\Railcontent\Commands\MigrateContentToNewStructure;
use Railroad\Railcontent\Commands\MigrateContentVideos;
use Railroad\Railcontent\Commands\MigrateUserPlaylist;
use Railroad\Railcontent\Commands\OrphanContent;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Hydrators\RailcontentHydrator;
use Railroad\Railcontent\Listeners\AssignCommentEventListener;
use Railroad\Railcontent\Listeners\ContentEventListener;
use Railroad\Railcontent\Listeners\SearchableListener;
use Railroad\Railcontent\Listeners\UserContentProgressEventListener;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Routes\RouteRegistrar;
use Railroad\Railcontent\Types\UserType;
use Redis;

class RailcontentServiceProvider extends ServiceProvider
{
    /**
     * @var RouteRegistrar
     */
    private $routeRegistar;

    /**
     * RailcontentServiceProvider constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);

        $this->routeRegistar = $application->make(RouteRegistrar::class);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->listen = [
            ContentDeleted::class => [ContentEventListener::class.'@handleDelete'],
            ContentSoftDeleted::class => [ContentEventListener::class.'@handleSoftDelete'],
            UserContentProgressSaved::class => [UserContentProgressEventListener::class.'@handle'],
            CommentCreated::class => [AssignCommentEventListener::class.'@handle'],
        ];

        parent::boot();

        $this->publishes([
                             __DIR__.'/../../config/railcontent.php' => config_path('railcontent.php'),
                         ]);

        if (config('railcontent.data_mode') == 'host') {
            $this->loadMigrationsFrom(__DIR__.'/../../migrations');
        }

        //load package routes
        if (config('railcontent.autoload_all_routes') == true) {
            $this->routeRegistar->registerAll();
        }

        $this->commands([
                            CreateSearchIndexes::class,
                            CreateVimeoVideoContentRecords::class,
                            CreateYoutubeVideoContentRecords::class,
                            ExpireCache::class,
                            MigrateContentFields::class,
                            OrphanContent::class,
                            MigrateUserPlaylist::class,
                            DeleteContentAndHierarchiesForUserPlaylists::class,
                            CalculateTotalXP::class,
                            MigrateContentToNewStructure::class,
                            ComputePastStats::class,
                            ComputeWeeklyStats::class,
                            MigrateContentToElasticsearch::class,
                            MigrateContentColumns::class,
                            MigrateContentInstructors::class,
                            MigrateContentVideos::class,
                            MigrateContentStyles::class,
                        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     * @throws AnnotationException
     * @throws ORMException
     */
    public function register()
    {
        Type::overrideType('datetime', CarbonDateTimeType::class);
        Type::overrideType('datetimetz', CarbonDateTimeTimezoneType::class);
        Type::overrideType('date', CarbonDateType::class);
        Type::overrideType('time', CarbonTimeType::class);
        !Type::hasType('user_id') ? Type::addType('user_id', UserType::class) : null;

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

        // file cache
        $phpFileCache = new PhpFileCache($proxyDir);

        // redis cache instance is referenced in laravel container to be reused when needed
        AnnotationRegistry::registerLoader('class_exists');

        $annotationReader = new AnnotationReader();

        $cachedAnnotationReader =
            new CachedReader($annotationReader, $phpFileCache, config('railcontent.development_mode'));

        $driverChain = new MappingDriverChain();

        DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
            $driverChain,
            $cachedAnnotationReader
        );

        foreach (config('railcontent.entities') as $driverConfig) {
            $annotationDriver = new AnnotationDriver(
                $cachedAnnotationReader, $driverConfig['path']
            );

            $driverChain->addDriver(
                $annotationDriver,
                $driverConfig['namespace']
            );
        }

        // timestamps
        $timestampableListener = new TimestampableListener();
        $timestampableListener->setAnnotationReader($cachedAnnotationReader);

        //sort
        $sortableListener = new SortableListener();
        $sortableListener->setAnnotationReader($cachedAnnotationReader);

        //search
        $searchableListener = new SearchableListener();

        //add timestamps, sortable and searchable listeners to event manager
        $eventManager = new EventManager();
        $eventManager->addEventSubscriber($timestampableListener);
        $eventManager->addEventSubscriber($sortableListener);
        $eventManager->addEventSubscriber($searchableListener);

        //orm config
        $ormConfiguration = new Configuration();

        // disable second level cache
        //        $factory = new DefaultCacheFactory(new RegionsConfiguration(), $redisCache);
        //        $ormConfiguration->setSecondLevelCacheEnabled();
        //        $ormConfiguration->getSecondLevelCacheConfiguration()->setCacheFactory($factory);

        $ormConfiguration->addCustomStringFunction(
            'MATCH_AGAINST',
            'Railroad\\Railcontent\\Extensions\\Doctrine\\MatchAgainst'
        );
        $ormConfiguration->addCustomStringFunction(
            'UNIX_TIMESTAMP',
            'Railroad\\Railcontent\\Extensions\\Doctrine\\UnixTimestamp'
        );
        // set file caching
        $ormConfiguration->setMetadataCacheImpl($phpFileCache);
        $ormConfiguration->setQueryCacheImpl($phpFileCache);
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

        // database config
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

        if (config('railcontent.enable_query_log')) {
            $logger = new EchoSQLLogger();

            $entityManager->getConnection()
                ->getConfiguration()
                ->setSQLLogger($logger);
        }

        // register the entity manager as a singleton
        app()->instance(RailcontentEntityManager::class, $entityManager);
    }
}
