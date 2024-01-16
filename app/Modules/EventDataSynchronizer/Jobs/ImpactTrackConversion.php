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

    public function __construct(
        private $user,
        private $brand,
        private $order) {
    }

    public function handle()
    {

        $promoCodesList = array_map(function($code) {
            return $code['code'];
        }, $this->order['discount_codes']);
        $promoCodesString = implode(',', $promoCodesList);
        $products = $this->getAllProducts($this->order['line_items']);
        $orderId = $this->order['id'];
        $userID = $this->user->id;
        $email = $this->user->email;
        $currency = $this->order['currency'];
        try {
            Tracker::queue(
                $this->brand,
                function () use ($products, $promoCodesString, $orderId, $userID, $email, $currency) {
                    Tracker::trackTransactionAPI(
                        $products,
                        $orderId,
                        $promoCodesString,
                        $userID,
                        $email,
                        currency: $currency
                    );
                }
        );
        } catch (Throwable $exception) {
            error_log("Error in ImpactTrackConversion with order: $orderId");
            error_log($exception);
        }
    }

    private function getAllProducts(array $lineItems = []): array
    {
        return collect($lineItems)
            ->map(function ($lineItem) {
                return [
                    'id' => $lineItem['product_id'],
                    'name' => $lineItem['name'],
                    'quantity' => $lineItem['quantity'],
                    'sku' => $lineItem['sku'],
                    'brand' => $lineItem['vendor'],
                    'value' => $lineItem['price'],
                    'category' => '',
                    'variant_id' => $lineItem['variant_id'],
                    'variant_name' => $lineItem['variant_title']
                ];
            })
            ->toArray();
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
