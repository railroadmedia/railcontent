<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Railanalytics\Tracker;
use Throwable;

class ImpactTrackConversion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct($order) {
        $this->order = $order;

    }

    public function handle(CartService $cartService) {
        try {
            $cartService->refreshCart();
            $promoCode = $cartService->getCart()->getPromoCode();
            $order = $this->order;

            Tracker::queue(
                $order->getBrand(),
                function () use ($order, $promoCode) {
                    $products = [];

                    foreach ($order->getOrderItems() as $orderItem) {
                        $product = $orderItem->getProduct();
                        $products[] = [
                            'id' => $product->getId(),
                            'name' => $product->getName(),
                            'category' => $product->getType(),
                            'value' => $orderItem->getFinalPrice(),
                            'quantity' => $orderItem->getQuantity(),
                            'sku' => $product->getSku(),
                            'discount' => $orderItem->getTotalDiscounted()
                        ];
                    }

                    Tracker::trackTransactionAPI(
                        $products,
                        $order->getId(),
                        $promoCode
                    );
                }
        );
        } catch (Throwable $exception) {
            error_log("There is with the Impact Track Conversion job in event data sync.");
            error_log($exception);
        }
    }


    /**
     * The job failed to process.
     *
     * @param  Throwable  $exception
     */
    public function failed(Throwable $exception)
    {
        error_log($exception);
    }

}
