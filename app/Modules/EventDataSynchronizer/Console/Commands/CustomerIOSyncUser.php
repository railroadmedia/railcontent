<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;


use Illuminate\Console\Command;

class CustomerIOSyncUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customerio:syncuser {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync provided users customer io data';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle()
    {

    }
}
