<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Enums\MembershipTimeStatus;
use App\Modules\Ecommerce\Models\MembershipTime;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class MembershipTimeService
{

    private ProductService $productService;

    function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getMembershipTimesQuery(int $userId)
    {
        return MembershipTime::query()->where('user_id', '=', $userId);
    }

    public function syncShopifyOrders(int $userId, $orders): Collection
    {
        $existingMembershipTimesLookup = $this->getMembershipTimesQuery($userId)->get()->keyBy(
            function (MembershipTime $membershipTime) {
                return "$membershipTime->shopify_order_id.$membershipTime->shopify_variant_id";
            }
        );

        $variantIds = $orders->pluck('line_items')->flatten(1)->pluck('variant_id')->unique()->toArray();
        $productLookup = $this->productService->getProductsByShopifyIdsQuery($variantIds)->keyBy('shopify_id');;
        foreach ($orders->sortBy('created_at') as $order) {
            $this->syncShopifyOrder($userId, $order, $existingMembershipTimesLookup, $productLookup);
        }
        return $existingMembershipTimesLookup->values();
    }


    private function syncShopifyOrder(
        int $userId,
        $order,
        Collection $existingMembershipTimesLookup,
        Collection $productLookup
    ) {
        $shopifyOrderId = $order["id"];

        foreach ($order['line_items'] as $lineItem) {
            /** @var Product $product */
            $product = $productLookup[$lineItem['variant_id']] ?? null;
            if (!$product || !$product->isMembershipProduct()) {
                continue;
            }

            $key = "$shopifyOrderId.$lineItem[variant_id]";
            $membershipTime = $existingMembershipTimesLookup[$key] ?? null;

            $status = $this->getOrderStatus($order);
            if (!$membershipTime) {
                $membershipTime = new MembershipTime();
                $membershipTime->user_id = $userId;
                $membershipTime->shopify_order_id = $order['id'];
                $membershipTime->shopify_variant_id = $lineItem['variant_id'];
                $membershipTime->order_created_at = Carbon::parse($order['created_at']);
                $membershipTime->membership_time_days = $product->getMembershipTimeDays();
                $membershipTime->membership_time_months = $product->getMembershipTimeMonths();
                $membershipTime->status = $status;
                $membershipTime->save();
                $existingMembershipTimesLookup[$key] = $membershipTime;
            } elseif ($membershipTime->status != $status) {
                //Only ever need to update the order status if order is cancelled
                $membershipTime->status = $status;
                $membershipTime->save();
            }
        }
    }

    private function getOrderStatus($order): MembershipTimeStatus
    {
        if ($order['cancelled_at']) {
            return MembershipTimeStatus::Cancelled;
        }
        return MembershipTimeStatus::Open;
    }

    public function getMembershipExpirationDate(Collection $membershipTimes): ?Carbon
    {
        $membershipTimes = $membershipTimes->where('status', '!=', MembershipTimeStatus::Cancelled)
            ->sortBy('order_created_at');

        $expirationDate = null;

        /** @var MembershipTime $membershipTime */
        foreach ($membershipTimes as $membershipTime) {
            $startDate = $expirationDate != null && $expirationDate > $membershipTime->order_created_at
                ? $expirationDate : Carbon::parse($membershipTime->order_created_at);
            $expirationDate = $startDate->clone()
                ->addDays($membershipTime->membership_time_days)->addMonths($membershipTime->membership_time_months);
            $membershipTime->tempStartDate = $startDate;
            $membershipTime->tempExpirationDate = $expirationDate;
        }
        return $expirationDate;
    }
}
