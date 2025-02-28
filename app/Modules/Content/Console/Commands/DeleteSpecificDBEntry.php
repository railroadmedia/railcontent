<?php

namespace App\Modules\Content\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * @codeCoverageIgnore - there is no value in testing this class,
 * since it requires integration with Sanity
 */
class DeleteSpecificDBEntry extends Command
{
    //name and signature of console command
    protected $signature = 'delete-specific-id
                            {table : table name}
                            {id : id of row to delete}';
    //The console command description.
    protected $description = 'Deletes a single entry from a specified table based on the id';

    //Execute the console command.
    public function handle(): void
    {
        //set up variables for usage
        $table = $this->argument('table');
        $id = $this->argument('id');
        DB::table($table)->select('id')->delete($id);

        $this->info('Entry Deleted.');
    }
}
