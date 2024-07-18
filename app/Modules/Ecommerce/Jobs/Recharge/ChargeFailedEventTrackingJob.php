<?php

namespace App\Modules\Ecommerce\Jobs\Recharge;

use App\Jobs\WebhookChildJob;
use App\Modules\Brand\Enums\Brand;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\EventTrackingService;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class ChargeFailedEventTrackingJob extends WebhookChildJob
{
    public function __construct(private $contents)
    {
    }

    public function handle(EventTrackingService $eventTrackingService): void
    {
        $charge = $this->contents['charge'];
        $email = $charge['email'];
        Log::debug("Shopify customer email: $email");

        /** @var User $user */
        $user = User::query()->where('email', '=', $email)->first();
        if (!$user) {
            Log::debug("User not found for email: $email");
            return;
        }

        $sku = collect($charge['line_items'])->pluck('sku')->first();
        /** @var Product $product */
        $product = Product::query()->where('sku', '=', $sku)->first();
        if (!$product) {
            Log::debug("Product not found for sku: " . $sku);
            return;
        }

        /**
         * Recharge docs for webhooks doesn't mention any field for number of attempts.
         * Recharge docs for charges mention a charge_attempts field.
         *
         * In the end, what they send in the webhook is number_times_tried
         */
        $eventTrackingService->handleChargeFailed(
            $user,
            $product->brand,
            $charge['number_times_tried']
        );
    }
}
