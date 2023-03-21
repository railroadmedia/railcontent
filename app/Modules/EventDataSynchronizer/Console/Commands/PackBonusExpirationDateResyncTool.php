<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Modules\Ecommerce\Models\UserProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use App\Modules\EventDataSynchronizer\Listeners\UserProductToUserContentPermissionListener;

class PackBonusExpirationDateResyncTool extends Command
{
    protected $name = 'PackBonusExpirationDateResyncTool';
    protected $description = 'PackBonusExpirationDateResyncTool';
    protected $signature = 'PackBonusExpirationDateResyncTool';

    public function handle(UserProductToUserContentPermissionListener $userProductToUserContentPermissionListener)
    {
        $this->info("Processing PackBonusExpirationDateResyncTool");
        $productId = 732;

        $query = UserProduct::query()->select('ecommerce_user_products.*')
            ->join('ecommerce_products', 'ecommerce_products.id', '=', 'ecommerce_user_products.product_id')
            ->where('ecommerce_user_products.product_id', '=', $productId)
            ->where('expiration_date', '=', '2023-03-28');

        $count = $query->count();

        $this->info("$count records to be updated.");
        $done = 0;

        $query->chunk(250, function (Collection $userProducts) use (
            $userProductToUserContentPermissionListener,
            &$done
        ) {
            $newDate = '2023-04-01';
            /** @var UserProduct $userProduct */
            foreach ($userProducts as $userProduct) {
                if ($userProduct->expiration_date < $newDate) {
                    $userProduct->expiration_date = $newDate;
                    $userProduct->save();
                }
            }

            foreach ($userProducts as $userProduct) {
                $userProductToUserContentPermissionListener->syncUserId($userProduct->user_id);
                $done++;
            }

            $this->info('Done ' . $done);
        });
        $this->info("Finished PackBonusExpirationDateResyncTool");
    }
}
