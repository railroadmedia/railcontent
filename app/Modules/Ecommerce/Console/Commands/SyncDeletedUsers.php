<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Recharge\RechargeDeleteUser;
use App\Modules\Ecommerce\Jobs\RevenueCat\RevenuecatDeleteUser;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoDeleteUser;
use Illuminate\Database\Eloquent\Collection;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\Shopify;
use Throwable;

class SyncDeletedUsers extends Command
{
    protected $signature = 'ecommerce:SyncDeletedUsers
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated.}';

    protected $description = 'Sync deleted users with Shopify, Recharge, RevenueCat and CustomerIO.';

    private Shopify $shopify;
    private SubscriptionService $subscriptionService;

    public function __construct(Shopify $shopify, SubscriptionService $subscriptionService)
    {
        parent::__construct();
        $this->shopify = $shopify;
        $this->subscriptionService = $subscriptionService;
    }

    public function handle(): void
    {
        $this->info('Starting SyncDeletedUsers command...');

        $isSimulation = $this->getIsSimulation();

        $this->withExecutionTime(function () use ($isSimulation) {
            User::query()
                ->where('email', 'like', 'musora+deleted%')
                ->whereNotNull('shopify_id')
                ->orderBy('created_at', 'desc')
                ->chunk(100, function (Collection $users) use ($isSimulation) {
                    foreach ($users as $user) {
                        try {
                            $this->processUser($user, $isSimulation);
                        } catch (Throwable $exception) {
                            $this->error("Error processing user ID: {$user->id}. Error: {$exception->getMessage()}");
                        }
                    }
                });
        });

        $this->info('SyncDeletedUsers command completed.');
    }

    private function processUser(User $user, bool $isSimulation): void
    {
        if ($isSimulation) {
            $this->info("Simulation mode: No actions taken for user ID: {$user->id}.");
            return;
        }

        $this->info("Processing user ID: {$user->id}, Shopify ID: {$user->shopify_id}");

        // Cancel subscriptions
        $this->subscriptionService->cancelAllSubscriptions($user, 'Account deleted');

        // Update Shopify customer
        $this->updateShopifyCustomer($user);

        // Dispatch deletion jobs
        dispatch_sync(new RevenuecatDeleteUser($user));
        dispatch_sync(new CustomerIoDeleteUser($user->id));
        dispatch_sync(new RechargeDeleteUser($user));

        $this->info("Successfully synced user ID: {$user->id}.");
    }

    private function updateShopifyCustomer(User $user): void
    {
        try {
            $this->shopify->updateCustomer($user->shopify_id, ['email' => $user->email]);
        } catch (ValidationException $exception) {
            $this->error("Validation error for Shopify customer ID: {$user->shopify_id}. {$exception->getMessage()}");
            throw $exception;
        } catch (Throwable $exception) {
            $this->error("Error updating Shopify customer ID: {$user->shopify_id}. {$exception->getMessage()}");
            throw $exception;
        }
    }

    private function getIsSimulation(): bool
    {
        return !$this->option('execute');
    }
}
