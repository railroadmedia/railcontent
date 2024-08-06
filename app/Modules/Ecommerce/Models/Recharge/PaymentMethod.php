<?php

namespace App\Modules\Ecommerce\Models\Recharge;

use App\Modules\Ecommerce\Enums\PaymentType;

class PaymentMethod
{
    public int $id;
    public object $paymentDetails;
    public ?PaymentType $paymentType;
    public bool $default;

    public function __construct($paymentMethodData)
    {
        $this->id = $paymentMethodData->id;
        $this->paymentDetails = $paymentMethodData->payment_details;
        $this->paymentType = PaymentType::tryFrom($paymentMethodData->payment_type);
        $this->default = $paymentMethodData->default;
    }
}
