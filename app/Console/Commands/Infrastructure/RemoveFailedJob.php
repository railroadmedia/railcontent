<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Console\Command as CommandBase;
use Illuminate\Support\Facades\DB;

class RemoveFailedJob extends CommandBase
{
    protected $signature = 'jobs:removeFailed {id}';
    protected $description = 'Remove record from failed_jobs table';

    public function handle(): void
    {
        $id = $this->argument('id');
        DB::table('failed_jobs')->where('id', '=', $id)->delete();
    }

}
