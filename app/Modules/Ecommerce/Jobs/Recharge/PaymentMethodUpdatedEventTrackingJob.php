<?php

namespace App\Modules\Ecommerce\Jobs\Recharge;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class PaymentMethodUpdatedEventTrackingJob extends WebhookChildJob
{
    public function __construct(private $contents)
    {
    }

    public function handle(RechargeGateway $rechargeGateway): void
    {
        $customer = $this->contents['customer'];
        $customerId = $customer['id'];
        $shopifyId = $customer['shopify_customer_id'];
        $user = User::query()->where('shopify_id', '=', $shopifyId)->first();
        if (!$user) {
            Log::debug("User not found for shopify_id: $shopifyId");
            return;
        }

        $paymentMethod = $rechargeGateway->getCustomerDefaultPaymentMethod($customerId);

        $expiryDate = null;
        if ($paymentMethod != null) {
            $year = $paymentMethod->paymentDetails->exp_year;
            $month = $paymentMethod->paymentDetails->exp_month;
            $expiryDate = Carbon::now()->setYear($year)->setMonth($month)->endOfMonth()->timestamp;
        }

        $attribute = "_user_payment_primary-method-expiration-date";
        $data = collect(config('event-data-synchronizer.customer_io_brands_to_sync'))
            ->flatMap(fn (string $b) => [
                $b . $attribute => $expiryDate
            ])
            ->toArray();

        dispatchWithDelay(new CustomerIoSyncUserByUserId($user, $data), 30);
    }
}
