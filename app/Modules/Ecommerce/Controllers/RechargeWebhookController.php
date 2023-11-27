<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use App\Modules\EventTracking\Services\CustomerIoService;
use Modules\UserManagementSystem\Models\User;

class RechargeWebhookController extends Controller
{
    private CustomerIoService $customerIoService;

    public function __construct(CustomerIoService $customerIoService)
    {
        $this->customerIoService = $customerIoService;
    }

    public function subscriptionCancelled(Request $request): void
    {
        try {
            Log::debug('Recharge subscription cancelled webhook received');
            //Log::debug(print_r($request->all(), true));

            $subscription = $request->get('subscription');
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

            $this->customerIoService->syncCancellationDataFromRecharge(
                $user,
                $product,
                Carbon::parse($subscription['cancelled_at']),
                $subscription['cancellation_reason']
            );
        } catch (\Exception $e) { //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
