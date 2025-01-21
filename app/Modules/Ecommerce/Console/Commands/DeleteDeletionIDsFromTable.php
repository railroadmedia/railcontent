<?php

namespace Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;

class DeleteDeletionIDsFromTable extends Command
{
    //name and signature of console command
    protected $signature = 'product:delete
                            {--search= : the IDs of the product to delete. input as numbers seperated by commas.}
                            {--delete : confirm delete? if not confirmed, will instead display tables.}';

    //
    protected $name = 'DeleteIDs';
    //The console command description.
    protected $description = 'Delete product ids';


    //Execute the console command.
    public function handle(): void
    {
        //set up variables for usage
        $query = Product::query();  //establish query in Product model
        $search = $this->option('search');
        $array = explode(",", $search); //convert input string to array bcs i cant figure out how to input an array into terminal
        //$method  = $this->option('method');
        $confirm = $this->option('delete') == 'true';   //check if you're sure you're deleting
        //if (!$method) {$method = 'id';} //if method not specified, set as id

        $query->whereIn('id', $array);


        if ($confirm) { //delete
            $query->delete();
        }
        else {  //just show tables
        $this->table(['id', 'name'], $query->select(['id', 'name'])->get()->toArray());

        //could add in here a message to say there is a searched item alrdy missing...
        }







    }
}
