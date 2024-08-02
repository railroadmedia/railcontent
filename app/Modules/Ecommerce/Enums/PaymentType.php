<?php

namespace App\Modules\Ecommerce\Enums;

/**
 *  INFO: https://developer.rechargepayments.com/2021-11/payment_methods/payment_methods_retrieve
 */
enum PaymentType: string
{
    case CreditCard = 'CREDIT_CARD';
    case PayPal = 'PAYPAL';
    case ApplePay = 'APPLE_PAY';
    case GooglePay = 'GOOGLE_PAY';
    case SepaDebit = 'SEPA_DEBIT';
}
