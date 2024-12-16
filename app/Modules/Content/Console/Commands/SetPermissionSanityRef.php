<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use DB;

class SetPermissionSanityRef extends Command
{
    protected $signature = 'update:sanity_ref-permissions';
    protected $description = 'Set sanity _ref on railcontent_permissions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::statement("
             UPDATE railcontent_permissions
SET sanity_ref = CONCAT('permission_', LOWER(REGEXP_REPLACE(name, '[^a-zA-Z0-9_.]', '')));
        ");

        $this->info('sanity_ref has been updated');
    }
}
