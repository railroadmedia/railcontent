<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class SyncUserToCustomerIo extends Command
{
    protected $signature = 'eventTracking:syncUserToCustomerIo {email}';
    protected $description = 'Sync user attributes to Customer.io';

    public function handle(ShopifySyncService $shopifySyncService): void
    {
        $email = $this->argument('email');
        try {
            /** @var User $user */
            $user = User::whereEmail($email)->first();
            if ($user && $user->shopify_id) {
                $shopifySyncService->syncCustomer($user->shopify_id, $user->email);
                $this->info("Profile for email $email synchorized to Customer.io");
            } else {
                $this->warn("User with email $email not found or does not have a Shopify ID");
            }
        } catch (Throwable $ex) {
            $this->error("Error migrating profile for email $email");
            $this->error($ex);
        }
    }
}
