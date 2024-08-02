<?php

namespace App\Modules\Ecommerce\Enums;

enum PaymentType: string
{
    case CreditCard = 'CREDIT_CARD';
    case PayPal = 'PAYPAL';
    case ApplePay = 'APPLE_PAY';
    case GooglePay = 'GOOGLE_PAY';
    case SepaDebit = 'SEPA_DEBIT';
}
