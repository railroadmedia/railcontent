<?php

namespace Railroad\Railcontent\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
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
        parent::boot();

        $this->setupConfig();

        $this->publishes(
            [
                __DIR__ . '/../../config/railcontent.php' => config_path('railcontent.php'),
            ]
        );

        $this->loadMigrationsFrom(__DIR__ . '/../../migrations');

        //load package routes file
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    private function setupConfig()
    {
        // Caching
        ConfigService::$cacheTime = config('railcontent.cache_duration');

        // Database
        ConfigService::$databaseConnectionName = config('railcontent.database_connection_name');

        // Tables
        ConfigService::$tableCategories = config('railcontent.tables.categories');
        ConfigService::$tableContent = config('railcontent.tables.content');
        ConfigService::$tableContentCategories = config('railcontent.tables.content_categories');
        ConfigService::$tableVersions = config('railcontent.tables.versions');
        ConfigService::$tableFields = config('railcontent.tables.fields');
        ConfigService::$tableSubjectFields = config('railcontent.tables.subject_fields');
        ConfigService::$tableData = config('railcontent.tables.data');
        ConfigService::$tableSubjectData = config('railcontent.tables.subject_data');

        //Subject type category
        ConfigService::$subjectTypeCategory = config('railcontent.subject_type_category');

        //Subject type content
        ConfigService::$subjectTypeContent = config('railcontent.subject_type_content');
    }
}