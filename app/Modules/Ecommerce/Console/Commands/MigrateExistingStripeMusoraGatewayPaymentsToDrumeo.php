<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\UnifySubscriptionsJob;
use App\Modules\Ecommerce\Models\CreditCard;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;

class MigrateExistingStripeMusoraGatewayPaymentsToDrumeo extends Command
{
    protected $signature = 'ecommerce:MigrateExistingStripeMusoraGatewayPaymentsToDrumeo';


    public function handle()
    {
        $this->info("Migrate Existing Stripe Musora Gateway Payments To Drumeo...");

        Payment::query()
            ->where('gateway_name', 'musora')
            ->where('external_provider', 'stripe')
            ->where('created_at', '<', '2023-07-26 00:00:00')
            ->chunk(1000, function ($payments) {
                foreach ($payments as $payment) {
                    $this->info("Migrating payment to drumeo: " . $payment->id);
                    $this->migratePayment($payment);
                }
            });

        CreditCard::query()->where('payment_gateway_name', 'musora') ->chunk(1000, function ($creditCards) {
            foreach ($creditCards as $creditCard) {
                $this->info("Migrating credit card to drumeo: " . $creditCard->id);
                $this->migrateCreditCard($creditCard);
            }
        });
    }

    private function migratePayment(Payment $payment)
    {
        $payment->gateway_name = 'drumeo';
        $payment->save();
    }

    private function migrateCreditCard(CreditCard $creditCard)
    {
        $creditCard->payment_gateway_name = 'drumeo';
        $creditCard->save();
    }

}
