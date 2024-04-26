<?php

namespace App\Modules\Ecommerce\Models\Recharge;

class PaymentMethod
{
    public int $id;
    public object $paymentDetails;
    public bool $default;

    public function __construct($paymentMethodData)
    {
        $this->id = $paymentMethodData->id;
        $this->paymentDetails = $paymentMethodData->payment_details;
        $this->default = $paymentMethodData->default;
    }
}
