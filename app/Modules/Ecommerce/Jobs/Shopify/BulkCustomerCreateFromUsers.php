<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\FindsCustomersForUsers;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\StagesUploadToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsShopifyCustomer;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Signifly\Shopify\Shopify;

/**
 * BulkCustomerCreateFromUsers is a job used to perform a Bulk Operation in shopify to create multiple customers, using
 * the collection of Users provided as a constructor parameter.
 * This job will simulate its process, as best as possible, when the `$execute` parameter is set to false.
 * The general flow of the process is as follows:
 * 1. Create a new ShopifySync entry for this batch of users
 * 2. Build up the json data for each user, so that it can be created as a Customer in Shopify, using the
 *    [CustomerInput](https://shopify.dev/docs/api/admin-graphql/2023-07/input-objects/CustomerInput) format
 * 3. Compile those json data and save them all in a .jsonl-formatted file that we'll store
 * 4. Make a GraphQL mutation post to Shopify to get them to create a staged upload for us
 * 5. Make a GraphQL mutation post to Shopify to upload our .jsonl file into that staged upload area
 * 6. Make a GraphQL mutation post to Shopify to request a `bulkOperationRunMutation` to create the customers,
 *    using the .jsonl file that Shopify now has, and to provide our necessary data for each customer they create
 * 7. Add a new PollBulkOperationCustomer job to this job's batch, that will continually poll Shopify for our results
 *
 * Please refer to the PollBulkOperationCustomer class for notes on the process from there.
 * @see https://shopify.dev/docs/api/usage/bulk-operations/imports for full details from Shopify
 */
class BulkCustomerCreateFromUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable, SyncsShopifyCustomer, StagesUploadToShopify, FindsCustomersForUsers;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    protected CustomerRepository $customerRepository;
    protected AddressRepository $addressRepository;
    protected Shopify $shopify;

    /**
     * @param Collection $users the users to create Shopify Customers for
     * @param bool $execute are we executing this process, or simulating?
     */
    public function __construct(protected Collection $users, protected bool $execute)
    {
    }

    public function handle(CustomerRepository $customerRepository, AddressRepository $addressRepository, Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->shopify = $shopify;

        // start the sync log
        $shopifySync = $this->execute
            ? ShopifySync::create([
                "resource" => "customer_create_bulk",
                "started_at" => Carbon::now()
            ])
            : null;

        $usersData = [];
        // build up the payload for each user
        $this->users->each(function (User $user) use (&$usersData) {
            // find any of our Customers with the same email address
            $userCustomers = $this->getCustomersForUser($user);
            if ($this->checkUserIsNew($user, $userCustomers)) {
                $usersData[] = json_encode($this->createCustomerData($user, $userCustomers));
            }
        });

        // safety check for edge case that all users in this batch were already synced as customers
        if (empty($usersData)) {
            return;
        }

        try {
            // build a jsonl formatted file
            // DEV NOTE: as per the [JSON Lines specs](https://jsonlines.org/), the line separator is '\n'
            $filename = $this->createFileForUserData(implode("\n", $usersData));

            if ($this->execute) {
                // stage the upload with Shopify
                $requestParameters = $this->createStagedUpload($filename);

                // pull out the url that we need
                $uploadUrl = $requestParameters[$this->responseUrlKey];
                unset($requestParameters[$this->responseUrlKey]);
                // and attach the file
                $requestParameters["file"] = $this->getStoredFile($filename);

                // post the file to Shopify
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $uploadUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $requestParameters);
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    $this->logError(curl_error($ch));
                    return;
                }
                curl_close($ch);

                // grab the key from the returned xml, so we can use it to call the bulk operation
                $stagedUploadPath = (string)simplexml_load_string($result)[0]->Key;

                // build up the GraphQL query to send
                $bulkQuery = $this->getBulkOperationQuery($stagedUploadPath);
                // and send it
                $gqlUrl = $this->shopify->getBaseUrl() . "/graphql.json";
                $bulkResponse = $this->shopify->graphQl()->post($gqlUrl, ["query" => $bulkQuery]);

                if ($bulkResponse->successful()) {
                    $responseBody = json_decode($bulkResponse->body());

                    // check for any errors
                    $responseErrors = $responseBody->errors ?? $responseBody->data->customerCreate->userErrors ?? [];
                    if (!empty($responseErrors)) {
                        throw new Exception(sprintf("%s: Error(s) returned while attempting to call bulkOperationRunMutation on Shopify for file %s: %s",
                            $this->getClassName(), $filename, collect($responseErrors)->implode("message", " ")));
                    }

                    // check the status and make sure it's CREATED
                    $bulkOperationData = $responseBody->data->bulkOperationRunMutation->bulkOperation;
                    if ($bulkOperationData?->status !== "CREATED") {
                        throw new Exception(sprintf("%s: Unexpected status returned while attempting to call bulkOperationRunMutation on Shopify for file %s: %s",
                            $this->getClassName(), $filename, $bulkOperationData?->status ?? null));
                    }

                    // grab the bulk operation id from the response, and pass that to the polling job
                    // DEV NOTE: adding the job to the batch means that it becomes next in line (before the next BulkCustomerCreateFromUsers in the batch)
                    $this->batch()->add(new PollBulkOperationCustomer($bulkOperationData->id, $shopifySync, $filename));
                } else {
                    throw new Exception(sprintf("%s: bulkOperationRunMutation GraphQl mutation failed: %s",
                        $this->getClassName(), $bulkResponse->reason()));
                }
            } else {
                $this->logInfo(sprintf("%s: running in simulation mode. File %s was created in storage.", $this->getClassName(), $filename));
            }
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return;
        }
    }

    /**
     * Check for any Customers with the User's email address, that have already been synced to Shopify.
     * Log an error if the User has synced Customer(s).
     *
     * @param User $user
     * @param Collection<Customer> $userCustomers
     * @return bool true if the User or any related Customers does not have any record in Shopify
     */
    protected function checkUserIsNew(User $user, Collection $userCustomers): bool
    {
        // check for any of the user's customer entities that may have already been synced
        $alreadySyncedUserCustomers = $userCustomers->filter(fn (Customer $customer) => !is_null($customer->getShopifyId()));
        if ($alreadySyncedUserCustomers->isNotEmpty()){
            /** @var Customer $syncedCustomer */
            $syncedCustomer = $alreadySyncedUserCustomers->first();
            $shopifyId = $syncedCustomer->getShopifyId();
            if ($this->execute) {
                $user->shopify_id = $shopifyId;
                $user->save();
            }
            $this->logError(sprintf("%s: Customer(s) with email address %s were already synced" .
                " to Shopify. User ID %s has been given the shopify_id %s and was skipped", $this->getClassName(), $user->email, $user->id, $shopifyId));
        }

        return $alreadySyncedUserCustomers->isEmpty();
    }

    /**
     * Create the data to post to Shopify to create a Customer from our User
     *
     * DEV NOTE: we don't bother looking at the user's customers because our system doesn't allow for
     * new Customers to be made after a User already exists with the same email address.
     *
     * @param User $user
     * @param Collection<Customer> $userCustomers
     * @return array
     */
    protected function createCustomerData(User $user, Collection $userCustomers): array
    {
        $customerData = [
            "email" => $user->email,
            "firstName" => $user->first_name,
            "lastName" => $user->last_name,
            "note" => $user->support_note,
            "phone" => $this->getPhoneNumberForUser($user),
            // "tags" => "",
        ];

        // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
        // we can use meta fields for stuff like our user id, etc
        $customerData["metafields"] = [
            [
                "key" => "_id",
                "value" => (string)$user->id,
                "type" => "number_integer",
                "namespace" => "users"
            ]
        ];

        $customerData["addresses"] = $this->createAddressesData($user, $userCustomers);

        return ["input" => $customerData];
    }

    /**
     * Get all addresses for this user and its customers, then format it to meet Shopify's expectation
     *
     * @param User $user
     * @param Collection<Customer> $customers
     * @return Collection
     */
    protected function createAddressesData(User $user, Collection $customers): Collection
    {
        $addressData = collect();
        // get all the addresses for the user
        $addresses = collect($this->addressRepository->getUserShippingAddresses($user->id));

        // and its customers
        $customers->each(fn(Customer $customer) => $addresses->push(
            ...$this->addressRepository->getCustomerShippingAddresses($customer->getId())
        ));

        $addresses = $this->cleanUpAddresses($addresses);

        $addresses->each(function($addressArray) use ($addressData) {
            $addressData->push ($addressArray);
        });

        return $addressData;
    }

    /**
     * Create the .jsonl file for the given user data
     *
     * @param string $userData
     * @return string the name of the file created
     * @throws Exception
     */
    protected function createFileForUserData(string $userData): string
    {
        $filename = $this->getClassName() . "-" . preg_replace('~\D~', '', microtime(true)) . ".jsonl";

        if (app()->environment("local", "development")){
            $storageResult = Storage::put($filename, $userData);
        } else {
            $storageResult = Storage::disk('musora_web_platform_s3')->put($filename, $userData);
        }

        if (!$storageResult) {
            throw new Exception(sprintf("%s: Failed to write .jsonl file", $this->getClassName()));
        }

        return $filename;
    }

    /**
     * Get the file's content from storage
     *
     * @param string $filename
     * @return string
     * @throws Exception
     */
    protected function getStoredFile(string $filename): string
    {
        if (app()->environment("local", "development")){
            if (Storage::missing($filename)) {
                throw new Exception(sprintf("%s: File %s was not found in storage and cannot be uploaded to Shopify",
                    $this->getClassName(), $filename));
            }
            return Storage::get($filename);
        } else {
            if (Storage::disk('musora_web_platform_s3')->missing($filename)) {
                throw new Exception(sprintf("%s: File %s was not found in storage and cannot be uploaded to Shopify",
                    $this->getClassName(), $filename));
            }
            return Storage::disk('musora_web_platform_s3')->get($filename);
        }
    }

    /**
     * Get the GraphQL query to perform the bulk operation
     *
     * @param string $stagedUploadPath
     * @return string
     */
    protected function getBulkOperationQuery(string $stagedUploadPath): string
    {
        return <<<GQL
            mutation {
                bulkOperationRunMutation(
                    mutation: "{$this->getMutationString()}"
                    stagedUploadPath: "$stagedUploadPath"
                ) {
                    bulkOperation {
                        id
                        url
                        status
                    }
                    userErrors {
                        message
                        field
                    }
                }
            }
        GQL;
    }

    /**
     * Get the string to pass as the mutation.
     * Use the string to request Shopify return the customer's id, email, metafields, and addresses,
     * as well as returning any errors when attempting the customerCreate mutation.
     *
     * @return string
     */
    protected function getMutationString(): string
    {
        return 'mutation customerCreate($input: CustomerInput!) {'
            .   ' customerCreate(input: $input) { '
            .       ' customer { '
            .           ' id email metafields { '
            .               'edges { '
            .                   'node { '
            .                       'key value type namespace'
            .                   '}'
            .               '}'
            .           '}'
            .           ' addresses { '
            .               'id address1 address2 city province country zip firstName lastName'
            .           '}'
            .       ' }'
            .       ' userErrors { field message }'
            .   ' }'
            . ' }';
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
    protected function getShopify(): Shopify
    {
        return $this->shopify;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncBulkCustomersToShopify";
    }

    /**
     * @inheritDoc
     */
    protected function getCustomerRepository(): CustomerRepository
    {
        return $this->customerRepository;
    }
}
