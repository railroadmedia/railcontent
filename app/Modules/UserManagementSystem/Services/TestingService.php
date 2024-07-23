<?php

namespace App\Modules\UserManagementSystem\Services;

use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class TestingService
{
    public const EmailPrefix = 'test_';
    public const EmailPostfix = 'musora.com';

    private ShopifySyncService $shopifySyncService;
    private UserService $userService;
    private SubscriptionService $subscriptionService;

    public function __construct(
        ShopifySyncService $shopifySyncService,
        UserService $userService,
        SubscriptionService $subscriptionService
    ) {
        $this->shopifySyncService = $shopifySyncService;
        $this->userService = $userService;
        $this->subscriptionService = $subscriptionService;
    }

    public function createTestUser(int $productId = null, ?string $createdAt = null): User
    {
        if (app()->isProduction()) {
            throw new \Exception("Disabled for production");
        }

        $i = random_int(1000000000, 9999999999);

        $prefix = self::EmailPrefix;
        $postfix = self::EmailPostfix;
        $email = "$prefix$i@$postfix";

        $createdAtDate = $createdAt ? Carbon::parse($createdAt) : Carbon::now();
        $user = $this->userService->createUser($email, $email);
        Log::info("Created test user id:$user->id email: $email password: $email");

        //remove any permissions that may be left over data syncing issues
        UserAccessPermission::query()->where('user_id', $user->id)->delete();

        if (!$productId) {
            return $user;
        }
        $product = Product::find($productId);
        $this->shopifySyncService->syncOrder(
            $user,
            [$product->id],
            $product->brand,
            $createdAtDate,
            $product->price,
            0,
            ShopifyPaymentSourceEnum::Web
        );

        switch ($product->digital_access_time_interval_type) {
            case 'day':
                $nextChargeDate = $createdAtDate->addDays($product->digital_access_time_interval_length);
                break;
            case 'month':
                $nextChargeDate = $createdAtDate->addMonths($product->digital_access_time_interval_length);
                break;
            case 'year':
                $nextChargeDate = $createdAtDate->addYears($product->digital_access_time_interval_length);
                break;
            case '':
            default:
                $nextChargeDate = null;
                break;
        }
        if ($nextChargeDate) {
            $this->subscriptionService->createTestSubscription($user, $product, $nextChargeDate);
        }

        //rerun sync to clean up any bad data in case usora_users is not synced with user_access_permissions
        $this->shopifySyncService->syncCustomerByUser($user);
        return $user;
    }
}
