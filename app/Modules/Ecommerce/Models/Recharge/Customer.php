<?php

namespace App\Modules\Ecommerce\Models\Recharge;

use Carbon\Carbon;

class Customer
{
    public int $id;
    public object $analyticsData;
    public bool $applyCreditToNextRecurringCharge;
    public Carbon $createdAt;
    public string $email;
    public object $externalCustomerId;
    public ?Carbon $firstChargeProcessedAt;
    public string $firstName;
    public bool $hasPaymentMethodInDunning; // (failed charge)
    public bool $hasValidPaymentMethod;
    public string $hash;
    public string $lastName;
    public ?string $phone;
    public int $activeSubscriptionCount;
    public int $totalSubscriptionsCount;
    public bool $isTaxExempt;
    public Carbon $updatedAt;

    public function __construct($customerData)
    {
        $this->id = $customerData->id;
        $this->analyticsData = $customerData->analytics_data;
        $this->applyCreditToNextRecurringCharge = $customerData->apply_credit_to_next_recurring_charge;
        $this->createdAt = Carbon::parse($customerData->created_at);
        $this->email = $customerData->email;
        $this->externalCustomerId = $customerData->external_customer_id;
        $this->firstChargeProcessedAt = !is_null($customerData->first_charge_processed_at) ? Carbon::parse($customerData->first_charge_processed_at) : null;
        $this->firstName = $customerData->first_name;
        $this->hasPaymentMethodInDunning = $customerData->has_payment_method_in_dunning;
        $this->hasValidPaymentMethod = $customerData->has_valid_payment_method;
        $this->hash = $customerData->hash;
        $this->lastName = $customerData->last_name;
        $this->phone = $customerData->phone;
        $this->activeSubscriptionCount = $customerData->subscriptions_active_count;
        $this->totalSubscriptionsCount = $customerData->subscriptions_total_count;
        $this->isTaxExempt = $customerData->tax_exempt;
        $this->updatedAt = Carbon::parse($customerData->updated_at);
    }
}
