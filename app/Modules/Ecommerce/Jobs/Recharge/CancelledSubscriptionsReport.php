<?php

namespace App\Modules\Ecommerce\Jobs\Recharge;

use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Recharge\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\UserManagementSystem\Models\User;
use Railroad\Mailora\Mail\General;

class CancelledSubscriptionsReport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected const TIMEOUT = 840;

    /**
     * @param  Carbon  $createdAtMin
     * @param  Carbon  $createdAtMax
     * @param  array  $to
     * @param  array|null  $cc
     */
    public function __construct(
        protected Carbon $createdAtMin,
        protected Carbon $createdAtMax,
        protected array $to,
        protected ?array $cc = null,
    ) {
    }

    public function handle(RechargeGateway $rechargeGateway): void
    {
        try {
            $subscriptions = $rechargeGateway->getSubscriptionsByStatus(
                'cancelled',
                $this->createdAtMin,
                $this->createdAtMax
            );

            if ($subscriptions->isEmpty()) {
                Log::info(
                    sprintf(
                        'CancelledSubscriptionsReport: No cancelled subscriptions for %s - %s.',
                        $this->createdAtMin->toDateString(),
                        $this->createdAtMax->toDateString()
                    )
                );
                return;
            }

            // extract the customer data
            $customersData = $subscriptions->mapWithKeys(function (Subscription $subscription) use ($rechargeGateway) {
                // email isn't guaranteed to exist in the payload, so we have to treat it carefully
                $email = $subscription->email;
                $mcProfile = null;
                if ($email) {
                    $user = User::firstWhere('email', $email);
                    if ($user) {
                        $mcProfile = sprintf('%s/musora-center#/users/%s', get_musora_brand_base_url(), $user->id);
                    }
                }
                try {
                    $rechargeProfile = $rechargeGateway->getCustomerProfile($subscription->customerId);
                } catch (\Exception $exception) {
                    $rechargeProfile = null;
                }
                $data = [];
                if ($rechargeProfile) {
                    $data['recharge_profile'] = sprintf('<a href="%s">%s</a>', $rechargeProfile, $rechargeProfile);
                }
                if ($mcProfile) {
                    $data['mc_profile'] = sprintf('<a href="%s">%s</a>', $mcProfile, $mcProfile);
                }
                return [$email ?? 'Unknown email' => $data];
            });

            $mailable = new General($customersData->toArray(), 'emails.agnostic-array');
            $mailable->to($this->to);
            if ($this->cc) {
                $mailable->cc($this->cc);
            }
            $mailable->from('system@musora.com', 'Musora System');
            $mailable->subject(
                sprintf(
                    'Cancelled Recharge Subscriptions %s - %s.',
                    $this->createdAtMin->toDateString(),
                    $this->createdAtMax->toDateString()
                )
            );

            Mail::send($mailable);
            Log::info(
                sprintf(
                    'CancelledSubscriptionsReport: Report sent to: %s%s.',
                    implode(', ', $this->to),
                    !is_null($this->cc) ? '. cc: '.implode(', ', $this->cc) : ''
                )
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
