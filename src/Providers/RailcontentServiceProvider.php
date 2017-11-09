<?php

namespace Railroad\Railcontent\Providers;

use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PDO;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ContentUpdated;
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
        // this makes all database calls return arrays rather than objects
        $this->listen = [
            StatementPrepared::class => [
                function ($event) {
                    $event->statement->setFetchMode(PDO::FETCH_ASSOC);
                }
            ],
            ContentCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentFieldCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentFieldUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentFieldDeleted::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumDeleted::class => [VersionContentEventListener::class . '@handle'],
        ];

        parent::boot();

        $this->setupConfig();

        $this->publishes(
            [
                __DIR__ . '/../../config/railcontent.php' => config_path('railcontent.php'),
            ]
        );

        $this->loadMigrationsFrom(__DIR__ . '/../../migrations');

        //load package routes file
        $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');

        $this->app->singleton(
            'Illuminate\Contracts\Debug\ExceptionHandler',
            'Railroad\Railcontent\Exceptions\RailcontentException'
        );
    }

    private function setupConfig()
    {
        // caching
        ConfigService::$cacheTime = config('railcontent.cache_duration');

        // database
        ConfigService::$databaseConnectionName = config('railcontent.database_connection_name');

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

        // brand
        ConfigService::$brand = config('railcontent.brand');

        // lanuage
        ConfigService::$defaultLanguage = config('railcontent.default_language');
        ConfigService::$availableLanguages = config('railcontent.available_languages');

        // validation rules defined for each brand and content type
        ConfigService::$validationRules = config('railcontent.validation');

        // restrict which fields can be listed to avoid massive queries
        ConfigService::$fieldOptionList = config('railcontent.field_option_list', []);
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