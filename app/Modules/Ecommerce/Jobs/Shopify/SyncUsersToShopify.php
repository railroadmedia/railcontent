<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\FindsCustomers;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SavesShopifyIdOnAddresses;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsAddressData;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsShopifyCustomer;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsToShopify;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\REST\Resources\CustomerResource;
use Signifly\Shopify\Shopify;

class SyncUsersToShopify implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use FindsCustomers;
    use HandlesMaskedEmailAddress;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use LogsShopify;
    use Queueable;
    use SavesShopifyIdOnAddresses;
    use SerializesModels;
    use SyncsAddressData;
    use SyncsToShopify;
    use SyncsShopifyCustomer;

    protected const RESULTS_MESSAGE_TYPE = "message_type";
    protected const RESULTS_MESSAGE_TYPE_SUCCESS = "";
    protected const RESULTS_MESSAGE_TYPE_ERROR = "##ERROR## ";
    protected const RESULTS_MESSAGE_TYPE_WARNING = "##WARNING## ";
    protected const RESULTS_MODEL_ID = "model_id";
    protected const RESULTS_MODEL_TYPE = "model_type";
    protected const RESULTS_MODEL_TYPE_CUSTOMER = "Customer";
    protected const RESULTS_MODEL_TYPE_USER = "User";
    protected const RESULTS_ACTION = "action";
    protected const RESULTS_SHOPIFY_ID = "shopify_id";
    protected const RESULTS_FAIL_MESSAGE = "failure_message";

    protected Collection $shopifyIds;
    protected array $results = [];
    protected CustomerRepository $customerRepository;
    protected AddressRepository $addressRepository;
    protected EcommerceEntityManager $entityManager;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected Carbon $lastSyncAt,
        protected bool $simulate,
        protected bool $fresh
    ) {
        $this->shopifyIds = collect();
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @param  Shopify  $shopify
     * @param  CustomerRepository  $customerRepository
     * @param  AddressRepository  $addressRepository
     * @param  EcommerceEntityManager  $entityManager
     * @return void
     */
    public function handle(
        Shopify $shopify,
        CustomerRepository $customerRepository,
        AddressRepository $addressRepository,
        EcommerceEntityManager $entityManager
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->entityManager = $entityManager;

        $this->logDebug(
            sprintf("%s: running batch for users %s - %s", $this->getClassName(), $this->startAtId, $this->endAtId)
        );

        // DEV NOTE: we do not use the SyncsToShopify sync() here. The huge number of Users in our
        // database leads to a unique situation for syncing up to Shopify Customers.
        $this->notifyStartupStatus();
        $batchSize = 50;
        $this->loopUsersSync($batchSize);
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncUsersToShopify";
    }

    /**
     * Get all the users that need to be synced, and perform the sync action on each one
     *
     * @param  int  $batchSize
     * @return void
     */
    private function loopUsersSync(int $batchSize): void
    {
        $fresh = $this->getIsFresh();

        $usersQuery = User::query()
            ->whereBetween("id", [$this->startAtId, $this->endAtId])
            ->where(function (Builder $q) {
                $q->when(!$this->fresh, function (Builder $q) {
                    return $q->whereNull("shopify_id")
                        ->orWhereDate("updated_at", ">", $this->lastSyncAt);
                });
            });
        $totalCount = $usersQuery->count();
        $infoString = "Found {$totalCount} users to be synced.";
        $infoString .= " Performing in batches of {$batchSize}.";
        $this->logInfo($infoString);

        $usersQuery->chunk(
            $batchSize,
            function (Collection $users) {
                $this->shopifyIds = collect();
                $this->results = [];
                $this->createSyncLogIfExecuting();

                $users->each(function (User $user, int $index) {
                    $this->syncUser($user, $this->getIsFresh(), $this->getIsSimulation(), $index + 1);
                });

                // print the results
                $this->logInfo(
                    sprintf(
                        "%s: results for syncing users to Shopify batch for job %s of %s",
                        $this->getClassName(),
                        $this->batch()->processedJobs() + 1,
                        $this->batch()->totalJobs
                    )
                );

                foreach ($this->results as $result) {
                    $endResult = isset($result[self::RESULTS_SHOPIFY_ID]) ? sprintf(
                        "Shopify ID %s",
                        $result[self::RESULTS_SHOPIFY_ID]
                    ) : $result[self::RESULTS_FAIL_MESSAGE];

                    if ($result[self::RESULTS_MESSAGE_TYPE] === self::RESULTS_MESSAGE_TYPE_ERROR) {
                        $this->logError(
                            sprintf(
                                "%s%s ID: %s. %s %s",
                                $result[self::RESULTS_MESSAGE_TYPE],
                                $result[self::RESULTS_MODEL_TYPE],
                                $result[self::RESULTS_MODEL_ID],
                                $result[self::RESULTS_ACTION],
                                $endResult
                            )
                        );
                    } else {
                        $this->logInfo(
                            sprintf(
                                "%s%s ID: %s. %s %s",
                                $result[self::RESULTS_MESSAGE_TYPE],
                                $result[self::RESULTS_MODEL_TYPE],
                                $result[self::RESULTS_MODEL_ID],
                                $result[self::RESULTS_ACTION],
                                $endResult
                            )
                        );
                    }
                }

                // finish the sync log
                $this->finishSyncLogIfExecuting($this->shopifyIds);
            }
        );
    }

    /**
     * @inheritDoc
     */
    protected function getIsFresh(): bool
    {
        return $this->fresh;
    }

    /**
     * Sync the user up to Shopify
     *
     * @param  User  $user
     * @param  bool  $fresh
     * @param  bool  $simulate
     * @param  int|null  $simulatedShopifyId
     * @return void
     */
    private function syncUser(User $user, bool $fresh, bool $simulate, ?int $simulatedShopifyId): void
    {
        // STEP 1: find any of our Customers with the same email address, so we can use the combined data
        $userCustomers = $this->getCustomersForUser($user);

        // STEP 2: determine if updating or creating
        // ensuring to check for any of the user's customer entities that may have already been synced
        $alreadySyncedUserCustomers = $userCustomers->filter(
            fn (Customer $customer) => !is_null($customer->getShopifyId())
        );
        $isCreating = $fresh || (is_null($user->shopify_id) && $alreadySyncedUserCustomers->isEmpty());

        // if we're going to update the user, and we don't have any updates that Shopify needs, record it as skipped and move on
        try {
            if (!$isCreating && !$this->checkForWantedUpdates($user, $userCustomers)) {
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_USER,
                    self::RESULTS_MODEL_ID => $user->id,
                    self::RESULTS_ACTION => "SKIPPED",
                    self::RESULTS_FAIL_MESSAGE => "No local updates required syncing"
                ];
                return;
            }
        } catch (Exception $e) {
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_USER,
                self::RESULTS_MODEL_ID => $user->id,
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => $e->getMessage()
            ];
            return;
        }

        // STEP 3: build up the data structure
        $postData = $this->createCustomerDataForUser($user, $isCreating);

        // STEP 4: send the data to Shopify
        if (!$simulate) {
            $attemptNumber = 1;
            $customerResource = $this->sendDataToShopify(
                $user,
                $postData,
                $isCreating,
                $alreadySyncedUserCustomers,
                $attemptNumber
            );
            if (is_null($customerResource)) {
                // we failed to send the data. the error was recorded within the sendDataToShopify function
                return;
            }

            $shopifyCustomerId = $customerResource->id;
            $this->shopifyIds->push($shopifyCustomerId);

            // record the shopify ID on the User ...
            if ($user->shopify_id !== $shopifyCustomerId) {
                $user->shopify_id = $shopifyCustomerId;
                $user->saveWithoutUpdatedAt();
            }
            try {
                // ... and any of their related Customers
                $userCustomers->each(function (Customer $customer) use ($shopifyCustomerId) {
                    if ($customer->getShopifyId() !== $shopifyCustomerId) {
                        // grab the eloquent model, so we can update it
                        $customerModel = \App\Modules\Ecommerce\Models\Customer::find($customer->getId());
                        $customerModel->shopify_id = $shopifyCustomerId;
                        $customerModel->saveWithoutUpdatedAt();
                        // refresh the doctrine model to get the change
                        $this->entityManager->refresh($customer);
                    }
                });

                // STEP 5: build up the data structure for the User's (and its Customers') Addresses
                $addressesData = $isCreating ? $this->createAddressesDataForUser($user, $userCustomers)
                    : $this->updateAddressesDataForUser($user, $userCustomers);

                // STEP 6: send it to Shopify, if there are any
                $errors = $this->sendAddressDataToShopify($addressesData, $shopifyCustomerId, $this->shopifyIds);
                $this->handleRateLimit();
                $errors->each(fn ($errorMessage) => $this->logError($errorMessage));
            } catch (ORMException $e) {
                $this->logError(
                    sprintf(
                        "%s: Failed to save shopify_id for user or customer with email address %s: %s",
                        $this->getClassName(),
                        $user->email,
                        $e->getMessage()
                    )
                );
            }
        } else {
            // simulating
            $shopifyCustomerId = $user->shopify_id ?? $simulatedShopifyId;
        }
        $this->results[] = [
            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_USER,
            self::RESULTS_MODEL_ID => $user->getId(),
            self::RESULTS_ACTION => $isCreating ? "Created" : "Updated",
            self::RESULTS_SHOPIFY_ID => $shopifyCustomerId
        ];
        $userCustomers->each(function (Customer $customer) use ($isCreating, $shopifyCustomerId) {
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_CUSTOMER,
                self::RESULTS_MODEL_ID => $customer->getId(),
                self::RESULTS_ACTION => $isCreating ? "Created" : "Updated",
                self::RESULTS_SHOPIFY_ID => $shopifyCustomerId
            ];
        });
    }

    /**
     * Compare our data for the given user, and its addresses if necessary, against the data in Shopify,
     * to identify if we need to sync up our changes or not.
     *
     * @param  User  $user
     * @param  Collection<Customer>  $userCustomers
     * @return bool whether the user has updates that Shopify needs
     * @throws Exception
     */
    protected function checkForWantedUpdates(User $user, Collection $userCustomers): bool
    {
        // there are only a few attributes that we care about for the user
        $userKeys = ["email", "first_name", "last_name", "note", "phone"];

        // get the user (or existing customers)'s data from Shopify, so we can compare our values
        $shopifyId = $user->shopify_id ?? $userCustomers->first()?->shopify_id ?? null;
        // safety check, that shouldn't be possible
        if (is_null($shopifyId)) {
            throw new Exception("No Shopify ID found on existing user or customers");
        }
        $userDataResponse = $this->shopify->getCustomer($shopifyId);
        $this->handleRateLimit();
        $shopifyUserData = collect($userDataResponse->getAttributes())->only($userKeys);
        $localUserData = collect($this->createCustomerDataForUser($user, false))->only($userKeys);
        $userChanges = $localUserData->diff($shopifyUserData)->merge($shopifyUserData->diff($localUserData));
        if ($userChanges->isNotEmpty()) {
            return true;
        }

        // if there's no change in the user, then we need to check their addresses
        // DEV NOTE: address setting is really messy and complicated, so we'll just reuse the existing code, even though
        // it will be a little bit worse performance since we'll run it again when actually syncing, but it's worth the
        // tradeoff
        $changes = $this->updateAddressesDataForUser($user, $userCustomers);

        return $changes->isNotEmpty();
    }

    /**
     * Create the data to post to Shopify to create a Customer from our User
     *
     * DEV NOTE: we don't bother looking at the user's customers because our system doesn't allow for
     * new Customers to be made after a User already exists with the same email address.
     *
     * @param  User  $user
     * @param  bool  $isCreating
     * @return array
     */
    private function createCustomerDataForUser(User $user, bool $isCreating): array
    {
        $customerData = [
            "currency" => "USD",
            "email" => $this->getEmailForShopify($user->email),
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "note" => $user->support_note,
            "phone" => $this->getPhoneNumberForUser($user),
            // "tags" => "",
        ];

        if ($isCreating) {
            $customerData["metafields"] = $user->getMetafieldsForShopify();
        } else {
            try {
                $newMetafields = $user->getNewMetafieldsForShopify();
                $this->handleRateLimit();
                if (!empty($newMetafields)) {
                    $customerData["metafields"] = $newMetafields;
                }
            } catch (Exception $exception) {
                $this->logError(
                    sprintf(
                        "%s: Failed to find new metafields to send to Shopify for updating user with email address %s: %s",
                        $this->getClassName(),
                        $user->email,
                        $exception->getMessage()
                    )
                );
            }
        }

        return $customerData;
    }

    /**
     * Send the data to Shopify to create or update a customer. Allowing up to 2 attempts, so that we can retry
     * after certain validation failures.
     *
     * @param  User  $user
     * @param  array  $postData
     * @param  bool  $isCreating
     * @param  Collection  $alreadySyncedUserCustomers
     * @param  int  $attemptNumber
     * @return CustomerResource|null
     */
    private function sendDataToShopify(
        User $user,
        array $postData,
        bool $isCreating,
        Collection $alreadySyncedUserCustomers,
        int $attemptNumber
    ): ?CustomerResource {
        if ($attemptNumber > 2) {
            return null;
        }

        try {
            if ($isCreating) {
                $customerResource = $this->shopify->createCustomer($postData);
            } else {
                $existingCustomerShopifyId = $user->shopify_id ?? $alreadySyncedUserCustomers->first()->getShopifyId();
                $customerResource = $this->shopify->updateCustomer($existingCustomerShopifyId, $postData);
            }
            $this->handleRateLimit();
        } catch (ValidationException $exception) {
            // we can have edge cases where the customer was created in Shopify, but we didn't record their shopify_id,
            // so check for that error and record Shopify's id on our records
            $errors = collect($exception->errors);
            if (collect($errors->get("email"))->contains("has already been taken")) {
                $failures = $this->linkExistingCustomer($user->email);
                $this->handleRateLimit();
                if ($failures->isNotEmpty()) {
                    $failures->each(
                        fn ($failureMessage) => $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                        self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_USER,
                        self::RESULTS_MODEL_ID => $user->id,
                        self::RESULTS_ACTION => "LINK CUSTOMER FAILED",
                        self::RESULTS_FAIL_MESSAGE => $failureMessage
                    ]
                    );
                } else {
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                        self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_USER,
                        self::RESULTS_MODEL_ID => $user->id,
                        self::RESULTS_ACTION => "EXISTING EMAIL",
                        self::RESULTS_FAIL_MESSAGE => "Email account already taken. Shopify ID recorded locally."
                    ];
                }
                return null;
            }

            // a common validation error is that the phone number is invalid. We try our best to set it to
            // something valid, but there's no guarantee it's right. So if that validation failed, try again
            // without a phone number
            if (collect($errors->get("phone"))->contains("Enter a valid phone number")) {
                // remove the phone number from the post data and try again
                $postData["phone"] = null;
                return $this->sendDataToShopify(
                    $user,
                    $postData,
                    $isCreating,
                    $alreadySyncedUserCustomers,
                    ++$attemptNumber
                );
            }

            // a known validation error is that the phone number is already in use. This is a bit of an odd unique
            // constraint by Shopify, but it is what it is. So if that validation failed, try again
            // without a phone number
            if (collect($errors->get("phone"))->contains("Phone has already been taken")) {
                // remove the phone number from the post data and try again
                $postData["phone"] = null;
                return $this->sendDataToShopify(
                    $user,
                    $postData,
                    $isCreating,
                    $alreadySyncedUserCustomers,
                    ++$attemptNumber
                );
            }

            // a different validation error occurred that we can't handle, so report it here
            $this->logError(
                sprintf(
                    "%s: Validation failed when sending customer data to Shopify: %s",
                    $this->getClassName(),
                    $exception->getMessage()
                )
            );
            $this->logError(
                sprintf(
                    "%s: Please investigate for user or customers with email address %s. Attempted customer data: %s",
                    $this->getClassName(),
                    $user->email,
                    json_encode($postData)
                )
            );
            // record the failure in the table then exit out for this user
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_USER,
                self::RESULTS_MODEL_ID => $user->id,
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => $exception->getMessage()
            ];
            return null;
        }
        return $customerResource;
    }

    /**
     * Get all addresses for this user and its customers, then format it to meet Shopify's expectation
     *
     * @param  User  $user
     * @param  Collection<Customer>  $customers
     * @return Collection
     */
    private function createAddressesDataForUser(User $user, Collection $customers): Collection
    {
        $addressData = collect();
        // get all the addresses for the user
        $addresses = collect($this->addressRepository->getUserShippingAddresses($user->id));

        // and its customers
        $customers->each(fn (Customer $customer) => $addresses->push(
            ...$this->addressRepository->getCustomerShippingAddresses($customer->getId())
        ));

        $addresses = $this->cleanUpAddressesForRest($addresses);

        $addresses->each(function ($addressArray) use ($addressData) {
            $addressData->push($addressArray);
        });

        return $addressData;
    }

    /**
     * Find and compare all local versions of addresses for the user provided, against the addresses
     * for the customer in Shopify. If we have any changes, or any new addresses, format those to
     * meet Shopify's expectations.
     *
     * @param  User  $user
     * @param  Collection<Customer>  $userCustomers
     * @return Collection formatted data for addresses to update
     */
    private function updateAddressesDataForUser(User $user, Collection $userCustomers): Collection
    {
        $addressData = collect();

        $shopifyCustomerId = $user->shopify_id;
        // first, get the address information from Shopify
        $shopifyAddressesResponse = $this->shopify->getCustomerAddresses($shopifyCustomerId);
        $this->handleRateLimit();
        $shopifyAddresses = $shopifyAddressesResponse->map(
            fn (ApiResource $apiResource) => $apiResource->getAttributes()
        );

        // keep track of the local addresses that we've checked, so we know not to check if they're new
        $checkedLocalAddressIds = collect();

        // get data for all the addresses that need to be updated
        $updateFailures = $this->addDataForUpdatedAddresses(
            $shopifyCustomerId,
            $shopifyAddresses,
            $checkedLocalAddressIds,
            $addressData
        );
        $updateFailures->each(
            fn ($failureMessage) => $this->results[] = [
            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_USER,
            self::RESULTS_MODEL_ID => $user->id,
            self::RESULTS_ACTION => "ADDRESS FAILED",
            self::RESULTS_FAIL_MESSAGE => $failureMessage
        ]
        );

        // next, check for any additional addresses that the user has, that haven't yet been synced up to Shopify
        $allLocalAddressData = $this->createAddressesDataForUser($user, $userCustomers);
        $this->addDataForNewAddresses($allLocalAddressData, $shopifyAddresses, $checkedLocalAddressIds, $addressData);

        return $addressData;
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->simulate;
    }

    /**
     * @inheritDoc
     */
    protected function getAddressRepository(): AddressRepository
    {
        return $this->addressRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return ShopifySync::RESOURCE_CUSTOMER;
    }

    /**
     * @inheritDoc
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // we do not use the SyncsToShopify sync() here.
        // All of that is done in the handle function, and so this function is never used.
        return collect();
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase|EntityRepository
    {
        return $this->customerRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getLimit(): ?int
    {
        // limits were already applied in the initial command
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function getLastSyncAtOverride(): null|Carbon
    {
        return $this->lastSyncAt;
    }

    /**
     * @inheritDoc
     */
    protected function getCustomerRepository(): CustomerRepository
    {
        return $this->customerRepository;
    }


    /**
     * @inheritDoc
     */
    protected function getEntityManager(): EcommerceEntityManager
    {
        return $this->entityManager;
    }
}
