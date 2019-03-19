<?php

namespace Railroad\Railcontent\Providers;

use Doctrine\ORM\EntityManager;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Railroad\Railcontent\Commands\CreateSearchIndexes;
use Railroad\Railcontent\Commands\CreateVimeoVideoContentRecords;
use Railroad\Railcontent\Commands\CreateYoutubeVideoContentRecords;
use Railroad\Railcontent\Commands\ExpireCache;
use Railroad\Railcontent\Commands\MigrateContentFields;
use Railroad\Railcontent\Commands\RepairMissingDurations;
use Railroad\Railcontent\Decorators\Content\ContentPermissionsDecorator;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentDeleted;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Listeners\AssignCommentEventListener;
use Railroad\Railcontent\Listeners\ContentEventListener;
use Railroad\Railcontent\Listeners\RailcontentEventSubscriber;
use Railroad\Railcontent\Listeners\UnassignCommentEventListener;
use Railroad\Railcontent\Listeners\UserContentProgressEventListener;
use Railroad\Railcontent\Listeners\VersionContentEventListener;
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
            ContentCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentDeleted::class => [ContentEventListener::class . '@handleDelete'],
            ContentSoftDeleted::class => [ContentEventListener::class . '@handleSoftDelete'],
            ContentDatumCreated::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumUpdated::class => [VersionContentEventListener::class . '@handle'],
            ContentDatumDeleted::class => [VersionContentEventListener::class . '@handle'],
            CommentCreated::class => [AssignCommentEventListener::class . '@handle'],
            CommentDeleted::class => [UnassignCommentEventListener::class . '@handle'],
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
                RepairMissingDurations::class,
                CreateYoutubeVideoContentRecords::class,
                ExpireCache::class,
                MigrateContentFields::class,
            ]
        );

        Validator::extend(
            'exists_multiple_columns',
            MultipleColumnExistsValidator::class . '@validate',
            'The value entered does not exist in the database, or does not match the requirements to be ' .
            'set as the :attribute for this content-type with the current or requested content-status. Please ' .
            'double-check the input value and try again.'
        );

        config()->set(
            'resora.decorators.content',
            array_merge(
                [
                    ContentPermissionsDecorator::class,
                ],
                config()->get('railcontent.decorators.content', [])
            )
        );

        config()->set(
            'resora.decorators.comment',
            config()->get('railcontent.decorators.comment', [])
        );

        config()->set('resora.default_connection_name', config('railcontent.database_connection_name'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $entityManager = app()->make(EntityManager::class);
        $eventManager = $entityManager->getEventManager();

        $eventManager->addEventSubscriber(new RailcontentEventSubscriber());
    }
}