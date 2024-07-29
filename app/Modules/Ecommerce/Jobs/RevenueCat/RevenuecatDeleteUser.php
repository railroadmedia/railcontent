<?php

namespace App\Modules\Ecommerce\Jobs\RevenueCat;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\ApiGateways\RevenueCatApiGateway;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class RevenuecatDeleteUser extends WebhookChildJob
{
    use Dispatchable;

    public function __construct(private User $user)
    {
    }

    public function handle(
        RevenueCatApiGateway $revenueCatApiGateway
    ): void {
        $user = $this->user;
        //delete RevenueCat account if exists
        if($user->revenuecat_origin_app_user_id) {
            try {
                $revenueCatApiGateway->deleteAccount($user->revenuecat_origin_app_user_id);
            } catch (\Exception $e) {
                Log::error("Failed to delete Revenuecat account for user $user->id");
                Log::error($e);
            }
        }
    }
}
