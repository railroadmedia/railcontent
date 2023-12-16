<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Services\PaymentService;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\Ecommerce\Services\UserProductService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class GrantUserAccess extends Command
{
    protected $signature = 'ecommerce:GrantAccessUntil {userId} {permissionId} {expirationDate}';

    protected $description = 'grant user access until date';

    public function handle(
        UserAccessPermissionsService $accessPermissionsService,
        UserService $userService
    ) {
        $userId = $this->argument('userId');
        $user = $userService->getByIdOrNull($userId);
        $expirationDate = Carbon::parse($this->argument('expirationDate'));
        $permissionId = $this->argument('permissionId');

        if ($user->membership_expiration_date < $expirationDate) {
            $accessPermissionsService->addFixedAccessPermission(
                $user,
                $permissionId,
                Carbon::today(),
                $expirationDate
            );
        } else {
            $this->info("User already has access until $expirationDate");
        }
    }

}
