<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MigrateTypeBasedContentPermissionsToIdBased extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'MigrateTypeBasedContentPermissionsToIdBased';

    protected $signature = 'MigrateTypeBasedContentPermissionsToIdBased';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MigrateTypeBasedContentPermissionsToIdBased';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        return true;
    }
}
