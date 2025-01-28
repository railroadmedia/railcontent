<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;

class DeleteDeletionIDsFromTable extends Command
{
    //name and signature of console command
    protected $signature = 'product:delete-deletion-ids
                            {--delete : confirm delete these items. if blank, will instead display delete items}';
    //The console command description.
    protected $description = 'Searches Product table and deletes all products with "delete"';

    //Execute the console command.
    public function handle(ShopifySyncService $shopifySyncService): void
    {
        //set up variables for usage
        $query = Product::query();  //establish query in Product model
        $confirm = $this->option('delete') == 'true';   //check if you're sure you want to delete

        //search for items with "delete"
        $query->whereRaw("name LIKE '%delete%'");

        if ($confirm) { //delete items selected
            $query->delete();
        } else {  //just show the id's
            $this->table(['id', 'name'], $query->select(['id', 'name'])->get()->toArray());
            printf("add '--delete' to confirm delete these items\n");
        }







    }
}
