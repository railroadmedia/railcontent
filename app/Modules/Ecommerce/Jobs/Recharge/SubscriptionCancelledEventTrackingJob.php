<?php

namespace App\Modules\Ecommerce\Jobs\Recharge;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\EventTrackingService;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class SubscriptionCancelledEventTrackingJob extends WebhookChildJob
{
    public function __construct(private $contents)
    {
    }

    public function handle(EventTrackingService $eventTrackingService): void
    {
        $subscription = $this->contents['subscription'];
        $email = $subscription['email'];
        Log::debug("Shopify customer email: $email");

        /** @var User $user */
        $user = User::query()->where('email', '=', $email)->first();
        if (!$user) {
            Log::debug("User not found for email: $email");
            return;
        }

        /** @var Product $product */
        $product = Product::query()->where('sku', '=', $subscription['sku'])->first();
        if (!$product) {
            Log::debug("Product not found for sku: " . $subscription['sku']);
            return;
        }

        // Recharge sends date with no timezone offset and on America/Toronto, so we need to change to PST
        $rctz = CarbonTimeZone::create('America/Toronto');
        $ciotz = CarbonTimeZone::create('America/Vancouver');
        $cancelledAt = Carbon::parse($subscription['cancelled_at'], $rctz)->setTimezone($ciotz);

        $cancellationReason = $subscription['cancellation_reason'] ?? "";
        if ($subscription['cancellation_reason_comments']) {
            $cancellationReason .= " - " . $subscription['cancellation_reason_comments'];
        }

        $eventTrackingService->handleSubscriptionCancelled(
            $user,
            $product->brand,
            $cancelledAt,
            $cancellationReason
        );
    }
}
