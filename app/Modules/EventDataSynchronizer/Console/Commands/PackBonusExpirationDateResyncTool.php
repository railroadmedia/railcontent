<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use App\Modules\EventDataSynchronizer\Listeners\UserProductToUserContentPermissionListener;

class PackBonusExpirationDateResyncTool extends Command
{
    protected $name = 'PackBonusExpirationDateResyncTool';
    protected $description = 'PackBonusExpirationDateResyncTool';
    protected $signature = 'PackBonusExpirationDateResyncTool {productId}';

    public function handle(
        UserProductToUserContentPermissionListener $userProductToUserContentPermissionListener,
        UserMembershipFieldsService $userMembershipFieldsService
    ) {
        $this->info("Processing PackBonusExpirationDateResyncTool");

        $productId = $this->argument('productId');

        /** @var Product $product */
        $product = Product::find($productId);

        if (!$product) {
            $this->info("Product $productId not found");
            return;
        }

        $query = UserProduct::query()->select('ecommerce_user_products.*')
            ->join('ecommerce_products', 'ecommerce_products.id', '=', 'ecommerce_user_products.product_id')
            ->where('ecommerce_user_products.product_id', '=', $productId);

        $count = $query->count();

        $this->info("$count records to be processed.");

        $query->chunk(1000, function (Collection $userProducts) use (
            $userProductToUserContentPermissionListener,
            &$done,
            $product,
            $userMembershipFieldsService
        ) {
            $bonusProductId = 732;
            /** @var UserProduct $userProduct */
            foreach ($userProducts as $userProduct) {
                $userId = $userProduct->user_id;
                $bonusUserProduct = UserProduct::query()->where('user_id', '=', $userId)
                    ->where('product_id', '=', $bonusProductId)
                    ->get()->first();
                if (!$bonusUserProduct) {
                    //$this->info("Bonus User Product not found for user $userId");
                    continue;
                }
                $bonusUserProduct->expiration_date = $product->digital_membership_access_expiration_date;
                $bonusUserProduct->save();
                $userProductToUserContentPermissionListener->syncUserId($userId);
                $userMembershipFieldsService->sync($userId);
            }
        });
        $this->info("Finished PackBonusExpirationDateResyncTool");
    }
}
