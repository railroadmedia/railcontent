<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Modules\HelpScout\Services\HelpScoutService;
use Exception;
use HelpScout\Api\Customers\Customer;
use HelpScout\Api\Entity\PagedCollection;
use HelpScout\Api\Exception\RateLimitExceededException;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use App\Modules\EventDataSynchronizer\Services\HelpScoutSyncService;
use Modules\UserManagementSystem\Models\User;
use App\Modules\UserManagementSystem\Services\UserService;
use Throwable;

class SyncExistingHelpScout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SyncExistingHelpScout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all existing users from helpscout with matching usora users';

    const RETRY_ATTEMPTS = 3;
    const SLEEP_DELAY = 600;

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(
        DatabaseManager $databaseManager,
        HelpScoutSyncService $helpScoutSyncService,
        HelpScoutService $helpScoutService,
        UserService $userService
    ) {
        $currentPage = null;

        $railhelpscoutConnection = $databaseManager->connection(config('railhelpscout.database_connection_name'));

        while ($currentPage = $this->getNextPage($helpScoutService, $currentPage)) {
            $this->info('Started pocessing customers page #' . $currentPage->getPageNumber());

            $emailsMap = [];
            $customersMap = [];
            $customersSynced = [];

            foreach ($currentPage->toArray() as $customer) {
                $customerEmails = $customer->getEmails()->toArray();

                foreach ($customerEmails as $customerEmail) {
                    $emailsMap[$customerEmail->getValue()] = $customer->getId();
                }

                $customersMap[$customer->getId()] = $customer;
            }

            $users = $userService->getByEmailsOrNull(array_keys($emailsMap));

            $existingCustomersMap =
                $railhelpscoutConnection->table('helpscout_customers')
                    ->whereIn(
                        'external_id',
                        array_keys($customersMap)
                    )
                    ->get()
                    ->pluck('internal_id')
                    ->mapWithKeys(function ($item) {
                        return [$item => true];
                    })
                    ->toArray();

            foreach ($users as $user) {
                if (!isset($existingCustomersMap[$user->id]) && isset($emailsMap[$user->email])) {
                    $customerId = $emailsMap[$user->email];
                    $customer = $customersMap[$customerId];

                    $this->info(
                        'Syncing user ' . $user->email
                        . ', usora id: ' . $user->id
                        . ', helpscout id: ' . $customer->getId()
                    );

                    $this->syncExistingCustomer(
                        $helpScoutSyncService,
                        $helpScoutService,
                        $user,
                        $customer
                    );

                    $existingCustomersMap[$user->id] = true;
                }
            }

            $this->info('Finished pocessing customers page #' . $currentPage->getPageNumber());
        }
    }

    /**
     * @throws Throwable
     */
    protected function getNextPage($railHelpScoutService, $currentPage = null): ?PagedCollection
    {
        $attempt = 1;

        while ($attempt <= self::RETRY_ATTEMPTS) {
            try {
                $nextPage = null;

                if ($currentPage == null) {
                    $nextPage = $railHelpScoutService->getCustomersPage();
                } else {
                    if ($currentPage->getPageNumber() < $currentPage->getTotalPageCount()) {
                        $nextPage = $currentPage->getNextPage();
                    }
                }

                return $nextPage;
            } catch (RateLimitExceededException $rateException) {
                $this->error(
                    'RateLimitExceededException raised when fetching next helpscout customer page, sleeping for '
                    . self::SLEEP_DELAY . ' seconds'
                );

                sleep(self::SLEEP_DELAY);
                $attempt++;
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        return null;
    }

    /**
     * @throws Throwable
     */
    protected function syncExistingCustomer(
        $helpScoutSyncService,
        $railHelpScoutService,
        User $user,
        Customer $customer
    ) {
        $attempt = 1;

        $userAttributes = $helpScoutSyncService->getUsersAttributes($user);
        $brandsAttributesKeys = $helpScoutSyncService->getBrandsMembershipAttributesKeys();

        while ($attempt <= self::RETRY_ATTEMPTS) {
            try {
                $railHelpScoutService->syncExistingCustomer(
                    $user->id,
                    $user->first_name,
                    $user->last_name,
                    $user->email,
                    $userAttributes,
                    $brandsAttributesKeys,
                    $customer
                );

                return;
            } catch (RateLimitExceededException $rateException) {
                $this->error(
                    'RateLimitExceededException raised when syncing user ' . $user->email
                    . ', sleeping for ' . self::SLEEP_DELAY . ' seconds'
                );

                sleep(self::SLEEP_DELAY);
                $attempt++;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }
}
