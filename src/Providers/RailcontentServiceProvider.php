<?php

namespace Railroad\Railcontent\Providers;

use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PDO;
use Railroad\Railcontent\Controllers\ContentController;
use Railroad\Railcontent\Controllers\PermissionController;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\FieldRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Listeners\VersionContentEventListener;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Services\SearchInterface;
use Railroad\Railcontent\Services\SearchService;
use Railroad\Railcontent\Services\UserContentService;

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
                function($event) {
                    $event->statement->setFetchMode(PDO::FETCH_ASSOC);
                }
            ],
            ContentUpdated::class => [VersionContentEventListener::class.'@handle']
        ];

        parent::boot();

        $this->setupConfig();

        $this->publishes(
            [
                __DIR__.'/../../config/railcontent.php' => config_path('railcontent.php'),
            ]
        );

        $this->loadMigrationsFrom(__DIR__.'/../../migrations');

        //load package routes file
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->when(PermissionRepository::class)
            ->needs(SearchInterface::class)
            ->give(ContentRepository::class);

        $this->app
            ->when(PermissionController::class)
            ->needs(SearchInterface::class)
            ->give(PermissionRepository::class);

        $this->app
            ->when(ContentService::class)
            ->needs(SearchInterface::class)
            ->give(ContentRepository::class);

        $this->app
            ->when(ContentController::class)
            ->needs(SearchInterface::class)
            ->give(ContentRepository::class);

        $this->app
            ->when(FieldRepository::class)
            ->needs(SearchInterface::class)
            ->give(ContentRepository::class);

        $this->app
            ->when(SearchService::class)
            ->needs(SearchInterface::class)
            ->give(ContentRepository::class);

        $this->app
            ->when(UserContentService::class)
            ->needs(SearchInterface::class)
            ->give(UserContentRepository::class);

        $this->app
            ->when(UserContentRepository::class)
            ->needs(SearchInterface::class)
            ->give(ContentRepository::class);
    }

    private function setupConfig()
    {
        // Caching
        ConfigService::$cacheTime = config('railcontent.cache_duration');

        // Database
        ConfigService::$databaseConnectionName = config('railcontent.database_connection_name');

        // Tables
        ConfigService::$tableContent = config('railcontent.tables.content');
        ConfigService::$tableVersions = config('railcontent.tables.versions');
        ConfigService::$tableFields = config('railcontent.tables.fields');
        ConfigService::$tableContentFields = config('railcontent.tables.content_fields');
        ConfigService::$tableData = config('railcontent.tables.data');
        ConfigService::$tableContentData = config('railcontent.tables.content_data');
        ConfigService::$tablePermissions = config('railcontent.tables.permissions');
        ConfigService::$tableContentPermissions = config('railcontent.tables.content_permissions');
        ConfigService::$tableUserContent = config('railcontent.tables.user_content');
        ConfigService::$tablePlaylists = config('railcontent.tables.playlists');
        ConfigService::$tableUserContentPlaylists = config('railcontent.tables.user_content_playlists');
        ConfigService::$tableLanguage = config('railcontent.tables.language');
        ConfigService::$tableTranslations = config('railcontent.tables.translations');
        ConfigService::$tableUserPreference = config('railcontent.tables.user_preference');
        ConfigService::$translatableTables = [ConfigService::$tableData, ConfigService::$tableFields, ConfigService::$tableContent];
    }
}