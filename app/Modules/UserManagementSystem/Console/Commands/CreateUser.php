<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\UserManagementSystem\Services\TestingService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\UserManagementSystem\Models\User;

class CreateUser extends Command
{
    protected $name = 'UserCreate';
    protected $signature = 'user:create {productId} {--createdAt=}';
    protected $description = 'Creates a test user with a purchased product';

    public function handle(
        TestingService $testingService,
    ): void {
        $productId = $this->argument('productId');
        $createdAt = $this->option('createdAt');
        $user = $testingService->createTestUser($productId, $createdAt);
        $this->info("Created test user id:$user->id email: $user->email password: $user->email");
    }
}
