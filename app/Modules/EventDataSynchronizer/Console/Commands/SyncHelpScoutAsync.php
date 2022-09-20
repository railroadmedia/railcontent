<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Modules\EventDataSynchronizer\Jobs\SynchUsoraHelpscout;
use Illuminate\Console\Command;

class SyncHelpScoutAsync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SyncHelpScoutAsync {user=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all database users with helpscout using async jobs';

    public function __construct(
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $userId = $this->argument('user');

        dispatch(new SynchUsoraHelpscout((int) $userId));

        $this->info('Dispatched SynchUsoraHelpscout to start syncing usora users starting with id: ' . $userId);
    }
}
