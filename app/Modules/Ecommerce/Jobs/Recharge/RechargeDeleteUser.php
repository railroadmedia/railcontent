<?php

namespace App\Modules\Ecommerce\Jobs\Recharge;

use App\Modules\Ecommerce\Gateways\RechargeGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class RechargeDeleteUser implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param \Modules\UserManagementSystem\Models\User $user
     */
    public function __construct(
        protected User $user
    ) {
    }

    public function handle(RechargeGateway $rechargeGateway): void
    {
        $user = $this->user;
        if ($user && $user->shopify_id) {
            $rechargeCustomer = \Arr::first($rechargeGateway
                ->getCustomer($user->shopify_id)
                ->get('customers'));

            if ($rechargeCustomer) {
                try {
                    $rechargeGateway->deleteCustomer(
                        $rechargeCustomer->id
                    );
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }

            }
            }
    }
}
