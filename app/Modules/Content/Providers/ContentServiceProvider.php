<?php

namespace App\Modules\Content\Providers;

use App\Modules\Content\Console\Commands\CoachBulkDataUpdate;
use App\Modules\Content\Console\Commands\CoachBulkImageUpdate;
use App\Modules\Content\Console\Commands\FixProgressOnUnpublishedContent;
use App\Modules\Content\Console\Commands\ImportSongsDuration;
use App\Modules\Content\Console\Commands\PredefinedPlaylists;
use App\Modules\Content\Console\Commands\RebuildSearchIndexes;
use App\Modules\Content\Console\Commands\RecalculatePlaylistDuration;
use App\Modules\Content\Console\Commands\SongDuration;
use App\Modules\Content\Console\Commands\WorkoutsImport2023;
use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Observers\ContentFieldObserver;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Modules\Content\Console\Commands\MigrateMissingPlaylistsItems;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        ContentField::observe(ContentFieldObserver::class);

        $this->commands([
                            CoachBulkDataUpdate::class,
                            CoachBulkImageUpdate::class,
                            RebuildSearchIndexes::class,
                            FixProgressOnUnpublishedContent::class,
                            PredefinedPlaylists::class,
                            MigrateMissingPlaylistsItems::class,
                            SongDuration::class,
                            ImportSongsDuration::class,
                            RecalculatePlaylistDuration::class,
                            WorkoutsImport2023::class
                        ]);
    }
}
