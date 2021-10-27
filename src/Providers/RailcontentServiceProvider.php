<?php

namespace Railroad\Railcontent\Providers;

use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Validator;
use PDO;
use Railroad\Railcontent\Commands\AddDefaultShowNewField;
use Railroad\Railcontent\Commands\CalculateContentPopularity;
use Railroad\Railcontent\Commands\CalculateTotalXP;
use Railroad\Railcontent\Commands\CleanContentTopicsAndStyles;
use Railroad\Railcontent\Commands\CleanMetadata;
use Railroad\Railcontent\Commands\ComputePastStats;
use Railroad\Railcontent\Commands\ComputeWeeklyStats;
use Railroad\Railcontent\Commands\CreateCoaches;
use Railroad\Railcontent\Commands\CreateSearchIndexes;
use Railroad\Railcontent\Commands\CreateVimeoVideoContentRecords;
use Railroad\Railcontent\Commands\CreateYoutubeVideoContentRecords;
use Railroad\Railcontent\Commands\CreateYoutubeVideoContentRecordsViaClientAPI;
use Railroad\Railcontent\Commands\ExpireCache;
use Railroad\Railcontent\Commands\RepairMissingDurations;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentDeleted;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\HierarchyUpdated;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Listeners\AssignCommentEventListener;
use Railroad\Railcontent\Listeners\ContentEventListener;
use Railroad\Railcontent\Listeners\UnassignCommentEventListener;
use Railroad\Railcontent\Listeners\UserContentProgressEventListener;
use Railroad\Railcontent\Listeners\VersionContentEventListener;
use Railroad\Railcontent\Listeners\ContentTotalXPListener;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Validators\MultipleColumnExistsValidator;

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
            StatementPrepared::class => [
                function (StatementPrepared $event) {

                    // we only want to use assoc fetching for this packages database calls
                    // so we need to use a separate 'mask' connection

                    if ($event->connection->getName() ==
                        ConfigService::$connectionMaskPrefix . ConfigService::$databaseConnectionName) {
                        $event->statement->setFetchMode(PDO::FETCH_ASSOC);
                    }
                }
            ],
            ContentCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentDeleted::class => [ContentEventListener::class . '@handleDelete'],
            ContentSoftDeleted::class => [ContentEventListener::class . '@handleSoftDelete'],
            ContentFieldCreated::class => [
               // VersionContentEventListener::class . '@handleFieldCreated',
                ContentTotalXPListener::class . '@handleFieldCreated',
            ],
            ContentFieldUpdated::class => [
               // VersionContentEventListener::class . '@handleFieldUpdated',
                ContentTotalXPListener::class . '@handleFieldUpdated',
            ],
            ContentFieldDeleted::class => [
               // VersionContentEventListener::class . '@handleFieldDeleted',
                ContentTotalXPListener::class . '@handleFieldDeleted',
            ],
            ContentDatumCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumDeleted::class => [VersionContentEventListener::class . '@handle'],
            CommentCreated::class => [AssignCommentEventListener::class . '@handle'],
            CommentDeleted::class => [UnassignCommentEventListener::class . '@handle'],
            UserContentProgressSaved::class => [UserContentProgressEventListener::class . '@handle'],
            HierarchyUpdated::class => [ContentTotalXPListener::class . '@handleHierarchyUpdated'],
        ];

        parent::boot();

        $this->setupConfig();

        $this->publishes(
            [
                __DIR__ . '/../../config/railcontent.php' => config_path('railcontent.php'),
            ]
        );

        if (ConfigService::$dataMode == 'host') {
            $this->loadMigrationsFrom(__DIR__ . '/../../migrations');
        }

        //load package routes file
        $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        $this->commands(
            [
                AddDefaultShowNewField::class,
                ComputePastStats::class,
                ComputeWeeklyStats::class,
                CreateSearchIndexes::class,
                CreateVimeoVideoContentRecords::class,
                RepairMissingDurations::class,
                CreateYoutubeVideoContentRecords::class,
                CreateYoutubeVideoContentRecordsViaClientAPI::class,
                ExpireCache::class,
                CalculateTotalXP::class,
                CleanMetadata::class,
                CleanContentTopicsAndStyles::class,
                CalculateContentPopularity::class,
                CreateCoaches::class,
            ]
        );

        Validator::extend(
            'exists_multiple_columns',
            MultipleColumnExistsValidator::class . '@validate',
            'The value entered does not exist in the database, or does not match the requirements to be ' .
            'set as the :attribute for this content-type with the current or requested content-status. Please ' .
            'double-check the input value and try again.'
        );
    }

    private function setupConfig()
    {
        // caching
        ConfigService::$cacheTime = config('railcontent.cache_duration');

        // database
        ConfigService::$databaseConnectionName = config('railcontent.database_connection_name');
        ConfigService::$connectionMaskPrefix = config('railcontent.connection_mask_prefix');
        ConfigService::$dataMode = config('railcontent.data_mode');

        // tables
        ConfigService::$tablePrefix = config('railcontent.table_prefix');

        ConfigService::$tableContent = ConfigService::$tablePrefix . 'content';
        ConfigService::$tableContentHierarchy = ConfigService::$tablePrefix . 'content_hierarchy';
        ConfigService::$tableContentVersions = ConfigService::$tablePrefix . 'versions';
        ConfigService::$tableContentFields = ConfigService::$tablePrefix . 'content_fields';
        ConfigService::$tableContentData = ConfigService::$tablePrefix . 'content_data';
        ConfigService::$tablePermissions = ConfigService::$tablePrefix . 'permissions';
        ConfigService::$tableContentPermissions = ConfigService::$tablePrefix . 'content_permissions';
        ConfigService::$tableUserPermissions = ConfigService::$tablePrefix . 'user_permissions';
        ConfigService::$tableUserContentProgress = ConfigService::$tablePrefix . 'user_content_progress';
        ConfigService::$tablePlaylists = ConfigService::$tablePrefix . 'playlists';
        ConfigService::$tablePlaylistContents = ConfigService::$tablePrefix . 'playlist_contents';
        ConfigService::$tableComments = ConfigService::$tablePrefix . 'comments';
        ConfigService::$tableCommentsAssignment = ConfigService::$tablePrefix . 'comment_assignment';
        ConfigService::$tableCommentLikes = ConfigService::$tablePrefix . 'comment_likes';
        ConfigService::$tableContentLikes = ConfigService::$tablePrefix . 'content_likes';
        ConfigService::$tableSearchIndexes = ConfigService::$tablePrefix . 'search_indexes';
        ConfigService::$tableContentStatistics = ConfigService::$tablePrefix . 'content_statistics';
        ConfigService::$tableContentFollows = ConfigService::$tablePrefix . 'content_follows';

        // brand
        ConfigService::$brand = config('railcontent.brand');
        ConfigService::$availableBrands = config('railcontent.available_brands');

        // lanuage
        ConfigService::$defaultLanguage = config('railcontent.default_language');
        ConfigService::$availableLanguages = config('railcontent.available_languages');

        // middlware
        ConfigService::$controllerMiddleware = config('railcontent.controller_middleware');

        // api middleware
        ConfigService::$apiMiddleware = config('railcontent.api_middleware');

        // validation rules defined for each brand and content type
        ConfigService::$validationRules = config('railcontent.validation');

        // validation rules defined for each brand and content type
        ConfigService::$validationExemptionDate = config('railcontent.validation_exemption_date');

        // restrict which fields can be listed to avoid massive queries
        ConfigService::$fieldOptionList = config('railcontent.field_option_list', []);

        //restrict which content type can have comment
        ConfigService::$commentableContentTypes = config('railcontent.commentable_content_types');

        ConfigService::$commentsAssignationOwnerIds = config('railcontent.comment_assignation_owner_ids');

        ConfigService::$statisticsContentTypes = config('railcontent.statistics_content_types');

        ConfigService::$searchIndexValues = config('railcontent.search_index_values');
        ConfigService::$indexableContentStatuses = config('railcontent.indexable_content_statuses');

        ConfigService::$videoSync = config('railcontent.video_sync');

        ConfigService::$redisPrefix = config('railcontent.cache_prefix');
        ConfigService::$cacheDriver = config('railcontent.cache_driver');

        // decorators
        ConfigService::$decorators = config('railcontent.decorators');
        ConfigService::$useCollections = config('railcontent.use_collections');

        ConfigService::$commentLikesDecoratorAmountOfUsers = config('railcontent.comment_likes_amount_of_users');

        ConfigService::$contentHierarchyMaxDepth = config('railcontent.content_hierarchy_max_depth');
        ConfigService::$contentHierarchyDecoratorAllowedTypes = config(
            'railcontent.content_hierarchy_decorator_allowed_types' . ''
        );

        // aggregates
        ConfigService::$tableCommentsAggregates = [
            ConfigService::$tableCommentLikes => [
                'selectColumn' => 'COUNT(`' . ConfigService::$tableCommentLikes . '`.`id`) as `like_count`',
                'foreignField' => 'comment_id',
                'localField' => 'id',
                'groupBy' => ConfigService::$tableComments . '.id',
            ],
        ];
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}