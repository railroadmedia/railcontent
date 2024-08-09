<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class ProductOwnerUserFieldResyncTool extends Command
{
    protected $name = 'ProductOwnerUserFieldResyncTool';
    protected $description = 'ProductOwnerUserFieldResyncTool';
    protected $signature = 'customerio:syncByOwner {productId}';

    public function handle(): void
    {
        $productId = $this->argument("productId");
        $product = Product::find($productId);
        if (!$product) {
            $this->info("Product $productId does not exist");
            return;
        }

        $query = UserProduct::query()->select("user_id")->where("product_id", "=", $productId);
        $this->withProgressBarChunked($query, function (UserProduct $userProduct) {
            $user = new User();
            $user->id = $userProduct->user_id;
            dispatch((new CustomerIoSyncUserByUserId($user)));
            //delay 100 ms to keep customer io requests to 10 per second, i believe limit is 100
            usleep(100000);
        });
    }
}
