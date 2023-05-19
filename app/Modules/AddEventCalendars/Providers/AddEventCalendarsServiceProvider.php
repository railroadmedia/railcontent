<?php

namespace App\Modules\AddEventCalendars\Providers;

use App\Modules\AddEventCalendars\Console\Commands\AddEventCommand;
use App\Modules\AddEventCalendars\Console\Commands\BrandCalendarSync;
use App\Modules\AddEventCalendars\Console\Commands\MusoraSync;
use App\Modules\AddEventCalendars\Console\Commands\SyncCalendarData;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AddEventCalendarsServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
    ];

    /**
     * UsoraServiceProvider constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            MusoraSync::class,
            SyncCalendarData::class,
        ]);

        // publish config file
        $this->mergeConfigFrom(
            __DIR__ . '/../config/addevent.php',
            'addevent'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }
}
