<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\database\factories\SubscriptionFactory;
use App\Modules\Ecommerce\database\factories\UserProductFactory;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\UserManagementSystem\Models\User;

class CreateUser extends Command
{

    protected $name = 'UserCreate';
    protected $signature = 'user:create {productId}';

    protected $description = 'Creates a test user with a purchased product';

    public function handle(UserMembershipFieldsService $userMembershipFieldsService)
    {
        if (app()->isProduction()) {
            throw new \Exception("Disabled for production");
        }
        $i = User::query()->where('email', 'like', "test+user%")->count() + 1;

        $email = "test+user$i@musora.com";
        $start = Carbon::today();
        $endMonth = $start->addMonth();
        $endYear = $start->addYear();

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($email),
            'display_name' => "test+user$i",
            'first_name' => 'test',
            'last_name' => "user$i"
        ]);
        $this->info("Created user: $email password: $email");
        $productId = $this->argument('productId');
        $product = Product::find($productId); // musora basic annual
        UserProductFactory::createUserProduct($user, $product);

        if ($product->type == Product::TYPE_DIGITAL_SUBSCRIPTION) {
            SubscriptionFactory::createWith($user, $product);
        }

        $userMembershipFieldsService->sync($user->id);
    }
}
