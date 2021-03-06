<?php

namespace Railroad\Railcontent\Providers;

use Illuminate\Support\Facades\Validator;
use Railroad\Railcontent\Validators\MultipleColumnExistsValidator;
use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PDO;
use Railroad\Railcontent\Commands\CreateSearchIndexes;
use Railroad\Railcontent\Commands\CreateVimeoVideoContentRecords;
use Railroad\Railcontent\Commands\CreateYoutubeVideoContentRecords;
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
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Listeners\ContentEventListener;
use Railroad\Railcontent\Listeners\UnassignCommentEventListener;
use Railroad\Railcontent\Listeners\UserContentProgressEventListener;
use Railroad\Railcontent\Listeners\AssignCommentEventListener;
use Railroad\Railcontent\Listeners\VersionContentEventListener;
use Railroad\Railcontent\Services\ConfigService;

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
            ContentFieldCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentFieldUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentFieldDeleted::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumDeleted::class => [VersionContentEventListener::class . '@handle'],
            CommentCreated::class => [AssignCommentEventListener::class . '@handle'],
            CommentDeleted::class =>[UnassignCommentEventListener::class . '@handle'],
            UserContentProgressSaved::class => [UserContentProgressEventListener::class . '@handle']
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

        $this->commands([
            CreateSearchIndexes::class,
            CreateVimeoVideoContentRecords::class,
            RepairMissingDurations::class,
            CreateYoutubeVideoContentRecords::class,
            ExpireCache::class
        ]);

        Validator::extend('exists_multiple_columns', MultipleColumnExistsValidator::class . '@validate',
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
        ConfigService::$tableUserContentProgress = ConfigService::$tablePrefix . 'user_content_progress';
        ConfigService::$tablePlaylists = ConfigService::$tablePrefix . 'playlists';
        ConfigService::$tablePlaylistContents = ConfigService::$tablePrefix . 'playlist_contents';
        ConfigService::$tableComments = ConfigService::$tablePrefix . 'comments';
        ConfigService::$tableCommentsAssignment = ConfigService::$tablePrefix . 'comment_assignment';
        ConfigService::$tableSearchIndexes = ConfigService::$tablePrefix . 'search_indexes';

        // brand
        ConfigService::$brand = config('railcontent.brand');
        ConfigService::$availableBrands = config('railcontent.available_brands');

        // lanuage
        ConfigService::$defaultLanguage = config('railcontent.default_language');
        ConfigService::$availableLanguages = config('railcontent.available_languages');

        // validation rules defined for each brand and content type
        ConfigService::$validationRules = config('railcontent.validation', []);

        // restrict which fields can be listed to avoid massive queries
        ConfigService::$fieldOptionList = config('railcontent.field_option_list', []);

        //restrict which content type can have comment
        ConfigService::$commentableContentTypes = config('railcontent.commentable_content_types');

        ConfigService::$commentsAssignationOwnerIds = config('railcontent.comment_assignation_owner_ids');

        ConfigService::$searchableContentTypes = config('railcontent.searchable_content_types');

        ConfigService::$searchIndexValues = config('railcontent.search_index_values');

        ConfigService::$videoSync = config('railcontent.video_sync');

        ConfigService::$redisPrefix = config('railcontent.cache_prefix');
        ConfigService::$cacheDriver = config('railcontent.cache_driver');
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