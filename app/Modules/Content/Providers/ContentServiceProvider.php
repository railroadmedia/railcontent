<?php

namespace App\Modules\Content\Providers;

use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Observers\ContentFieldObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
    }
}
