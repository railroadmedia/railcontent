<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\FindsCustomers;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SavesShopifyIdOnAddresses;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\UsesStorageForShopifySyncData;
use Carbon\Carbon;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railroad\Ecommerce\Entities\Address;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;

/**
 * ParseBulkOperationResultsForCustomers is a job used to process the Shopify bulk operation results file in our storage,
 * that resulted from the PollBulkOperationCustomer job. Each line of the .jsonl file referenced by $resultsFilename
 * provides data from the result of Shopify creating a customer with our provided data from a grouping of customers,
 * and this job evaluates each one of those to update our customers, along with their addresses, with a  Shopify ID
 * to signify their corresponding data in Shopify.
 * The general flow of the process is as follows:
 * 1. Parse the .jsonl file, where each line is a json_encoded GraphQL payload about the customer that was created,
 *  and the line number from the source file that was used to create it
 * 2. If there were any errors provided in the response, we will log them, and if possible attempt to remedy them
 * 3. Use the returned Shopify ID to set all the customers' shopify_id, identified by the email address
 * 4. Use the returned customer's addresses to identify our address(es) that were used to create them in Shopify, and
 *  set the address(es)'s shopify_id with the corresponding Shopify address's ID. We must do it in this way, because
 *  Shopify doesn't allow for metafields on addresses, so we can't leverage the same process.
 * 5. Finish the ShopifySync entry that was created at the start of this batch
 * 6. Delete the source and result files that were generated for this batch
 */
class ParseBulkOperationResultsForCustomers implements ShouldQueue
{
    use Dispatchable;
    use FindsCustomers;
    use HandlesMaskedEmailAddress;
    use InteractsWithQueue;
    use LogsShopify;
    use Queueable;
    use SavesShopifyIdOnAddresses;
    use SerializesModels;
    use UsesStorageForShopifySyncData;

    // the array of customer data that's in the source file - only populated if necessary
    private array $_sourceFileCustomers = [];

    // the array of shopify IDs that were synced for the customers and their addresses
    private array $shopifyIds = [];

    protected CustomerRepository $customerRepository;
    protected AddressRepository $addressRepository;
    protected EcommerceEntityManager $entityManager;

    public function __construct(protected string $sourceFilename, protected string $resultsFilename, protected ShopifySync $shopifySync)
    {
    }

    public function handle(CustomerRepository $customerRepository, AddressRepository $addressRepository, EcommerceEntityManager $entityManager): void
    {
        // set DI instances that we'll need
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->entityManager = $entityManager;

        try {
            $resultsFile = $this->getFile($this->resultsFilename);
            if (is_null($resultsFile)) {
                throw new Exception(sprintf("%s: Results file %s was not found in storage and cannot be used to".
                    " update our customers", $this->getClassName(), $this->resultsFilename));
            }

            // the results file is a json line file, so we need to break it down, line by line
            $results = explode("\n", $resultsFile);
            foreach ($results as $result) {
                // then json_decode the line and evaluate it
                $responseObject = json_decode($result);
                $responseData = $responseObject->data->customerCreate ?? null;
                if (!empty($responseData)) {
                    $lineNumber = $responseObject->__lineNumber;
                    // check for errors
                    if (!empty($responseData->userErrors)) {
                        $this->handleErrors($responseData, $lineNumber);
                        continue;
                    }
                    // and if everything's good, update the customer
                    if ($responseData->customer) {
                        $this->updateCustomersWithShopifyId($responseData->customer);
                    }
                }
            }

            // we're done! finish the shopifySync record
            $this->shopifySync->update([
                "finished_at" => Carbon::now(),
                "shopify_ids" => $this->shopifyIds
            ]);

            // and delete the files from our storage
            $this->deleteFiles([$this->sourceFilename, $this->resultsFilename]);
        } catch (Exception $e) {
            $this->logError($e->getMessage());
        }
    }

    /**
     * Find the customers with the matching email address, and update them  with the Shopify ID from the customer data.
     *
     * @param object $customerData
     * @return void
     * @throws Exception
     */
    protected function updateCustomersWithShopifyId(object $customerData): void
    {
        // pluck out the shopify id from the response data (comes in the format gid://shopify/Customer/xxxxxxxxxxxxx)
        $shopifyId = str($customerData->id)->afterLast("/");
        $shopifyId = intval($shopifyId->value);

        // pluck out the email address from the response data
        $email = $customerData->email;

        try {
            // find any customers with the same email address, and update them
            $customers = $this->getCustomersForEmail($email);
            $customers->each(function (Customer $customer) use ($shopifyId) {
                if ($customer->getShopifyId() !== $shopifyId) {
                    // grab the eloquent model, so we can update it
                    $customerModel = \App\Modules\Ecommerce\Models\Customer::find($customer->getId());
                    $customerModel->shopify_id = $shopifyId;
                    $customerModel->saveWithoutUpdatedAt();
                    // refresh the doctrine model to get the change
                    $this->entityManager->refresh($customer);
                    // log the success
                    $this->logInfo(sprintf("%s: Customer %s synced with Shopify ID %s", $this->getClassName(), $customer->getId(), $customer->getShopifyId()));
                }
            });

            if ($customerData->addresses) {
                // DEV NOTE: Shopify doesn't allow metafields on addresses, so we don't know what address of ours was
                // used to create it. We need to take the address data and find any of our user's or customers' addresses
                // that match the values, and assign the shopify_id to those
                foreach($customerData->addresses as $address) {
                    $matchedAddresses = $this->findAddressesWithMatchingData(
                        null,
                        $customers,
                        $address->firstName,
                        $address->lastName,
                        $address->address1,
                        $address->address2,
                        $address->city,
                        $address->province,
                        $address->provinceCode,
                        $address->zip,
                        $address->country,
                        $address->countryCode
                    );
                    if ($matchedAddresses->isEmpty()) {
                        // this means we have an address in Shopify that we don't have in our database
                        $this->logError(sprintf("%s: Shopify returned address information that we don't have on".
                            " file for customer(s) with email %s:", $this->getClassName(), $email));
                        $this->logError(print_r($address, true));
                    } else {
                        try {
                            // pluck out the address' shopify id from the response data (comes in the format gid://shopify/MailingAddress/xxxxxxxxxxxxx?model_name=CustomerAddress)
                            $addressShopifyId = str($address->id)->afterLast("/")->before("?");
                            $addressShopifyId = intval($addressShopifyId->value);
                            $this->storeShopifyId($matchedAddresses, $addressShopifyId);
                            $this->shopifyIds[] = $addressShopifyId;
                            // log the success
                            $this->logInfo(sprintf(
                                "%s: Address(es) %s synced with Shopify ID %s",
                                $this->getClassName(),
                                $matchedAddresses->map(fn (Address $address) => $address->getId())->implode(", "),
                                $addressShopifyId
                            ));
                        } catch (ORMException $e) {
                            $this->logError(sprintf(
                                "%s: Failed to save Shopify ID on Address(es): %s",
                                $this->getClassName(),
                                $e->getMessage()
                            ));
                        }
                    }
                }
            }
        } catch (ORMException $e) {
            throw new Exception(sprintf(
                "%s: Could not save Ecommerce entity: %s.",
                $this->getClassName(),
                $e->getMessage()
            ));
        }
    }

    /**
     * Handle any errors that are returned in the response data
     *
     * @param object $responseData
     * @param int $lineNumber
     * @return void
     * @throws Exception
     */
    protected function handleErrors(object $responseData, int $lineNumber): void
    {
        $errors = $responseData->userErrors;
        foreach ($errors as $error) {
            if (str($error->message)->endsWith("is invalid")) {
                // something in the data was invalid and the user couldn't be processed
                $this->logError(sprintf(
                    "%s: Invalid data was provided for User %s. Field(s): %s. Message: %s",
                    $this->getClassName(),
                    $this->getUserValueFromSourceFile($lineNumber, "email"),
                    implode(", ", $error->field),
                    $error->message
                ));
            } elseif ($error->message === "Email has already been taken") {
                // DEV NOTE: we check for existing customers with the same email address and a shopify_id before adding
                // the user to the collection to be synced, so we know that we can't have a case here where the email
                // address was used by one of our synced customers. This means that email address was entered some other
                // way, and we can't do anything about it here
                // the user must've been set as a customer already, so find the applicable customer and copy its shopify_id
                $this->logError(sprintf(
                    "%s: Email address %s already exists in Shopify, but is not associated with"
                    ." any of our synced customers. Please find this customer in Shopify and manually update our records",
                    $this->getClassName(),
                    $this->getUserValueFromSourceFile($lineNumber, "email")
                ));
            }
            //    TODO any other errors we know how to handle
            else {
                // this is some error that we haven't yet identified how to handle, so log an error and print out the error
                $this->logError(sprintf("%s: Shopify returned an error that we have not handled when processing the"
                    ." results. Please update to %s's handleErrors function to handle this error. Our data and the error"
                    ." error response will follow", $this->getClassName(), get_class($this)));
                $this->logError(print_r($this->getSourceFileCustomers()[$lineNumber], true));
                $this->logError(print_r($error, true));
            }

        }
    }

    /**
     * Get the value of the given attribute for the user in our source file at the given line number
     *
     * @param int $lineNumber
     * @param string $attribute
     * @return mixed
     * @throws Exception
     */
    protected function getUserValueFromSourceFile(int $lineNumber, string $attribute): mixed
    {
        $userData = $this->getSourceFileCustomers()[$lineNumber];
        return $userData->$attribute;
    }

    /**
     * Get the array of customers data from the source file
     *
     * @return array
     * @throws Exception
     */
    protected function getSourceFileCustomers(): array
    {
        // if we haven't already unpacked the customers array, we'll have to read the file from storage and break it into the users
        if (empty($this->_sourceFileCustomers)) {

            $sourceFile = $this->getFile($this->sourceFilename);
            if (is_null($sourceFile)) {
                throw new Exception(sprintf("%s: Source file %s was not found in storage and cannot be used to".
                    " update our customers", $this->getClassName(), $this->sourceFilename));
            }

            // the results file is a json line file, so we need to break it down, line by line
            $sourceFileUserStrings = explode("\n", $sourceFile);
            $this->_sourceFileCustomers = collect($sourceFileUserStrings)
                ->transform(function (string $userJson) {
                    return json_decode($userJson)->input;
                })
                ->toArray();
        }

        return $this->_sourceFileCustomers;
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
    protected function getEntityManager(): EcommerceEntityManager
    {
        return $this->entityManager;
    }
}
