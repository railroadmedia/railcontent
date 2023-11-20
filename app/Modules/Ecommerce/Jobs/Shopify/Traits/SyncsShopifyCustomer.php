<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\PollBulkOperationCustomer;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Address;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Repositories\AddressRepository;

trait SyncsShopifyCustomer
{
    use LogsShopify;

    /**
     * Perform the full sync process for this local data: create the local file,
     * create a staged upload with Shopify, send the file to Shopify, and add the
     * next job to poll for the results.
     *
     * @param array $data
     * @param ShopifySync|null $shopifySync
     * @param string $resourceType
     * @return void
     * @throws Exception
     */
    protected function syncData(array $data, ?ShopifySync $shopifySync, string $resourceType): void
    {
        if ($resourceType != User::class && $resourceType != Customer::class) {
            $this->logError(sprintf("%s: Unknown resource type %s. Can only sync data for User or Customer with".
                " the SyncsShopifyCustomer trait ", $this->getClassName(), $resourceType));
            return;
        }

        // build a jsonl formatted file
        // DEV NOTE: as per the [JSON Lines specs](https://jsonlines.org/), the line separator is '\n'
        $filename = $this->createFileForLocalData(implode("\n", $data));

        $this->logDebug(sprintf("%s: created file %s", $this->getClassName(), $filename));

        if ($this->execute) {
            // make sure the shopify sync isn't null when executing
            assert(!is_null($shopifySync));

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
                    $this->logError(sprintf("%s: bulkOperationRunMutation failed to create. Response body printed below.",
                        $this->getClassName()));
                    $this->logError(print_r($responseBody, true));
                    throw new Exception(sprintf("%s: Unexpected status returned while attempting to call bulkOperationRunMutation on Shopify for file %s: %s",
                        $this->getClassName(), $filename, $bulkOperationData?->status ?? null));
                }

                // grab the bulk operation id from the response, and pass that to the polling job
                $this->logDebug(sprintf("%s: bulkOperationRunMutation succeeded. Shopify created operation ID %s",
                    $this->getClassName(), $bulkOperationData->id));
                PollBulkOperationCustomer::dispatchSync($bulkOperationData->id, $shopifySync, $filename, $resourceType, $this->getIsUsingMask());
            } else {
                throw new Exception(sprintf("%s: bulkOperationRunMutation GraphQl mutation failed: %s",
                    $this->getClassName(), $bulkResponse->reason()));
            }
        } else {
            $this->logInfo(sprintf("%s: running in simulation mode. File %s was created in storage.", $this->getClassName(), $filename));
        }
    }

    /**
     * For the given collection of Addresses, clean up the data and format it in a way that Shopify will accept for GraphQL
     *
     * @param Collection<Address> $addresses
     * @return Collection
     */
    protected function cleanUpAddresses(Collection $addresses): Collection
    {
        $addresses = $this->filterAndSortAddressesToClean($addresses);

        // transform it to fit Shopify's data structure
        $addresses->transform(function(Address $address) {
            return  [
                "address1" => $address->getStreetLine1(),
                "address2" => $address->getStreetLine2(),
                "city" => $address->getCity(),
                "country" => $address->getCountry(),
                "firstName" => $address->getFirstName(),
                "lastName" => $address->getLastName(),
                "province" => $address->getRegion(),
                "zip" => $address->getZip()
            ];
        });

        // and make sure it's unique - Shopify won't allow multiple addresses with the same data
        return $addresses->unique(function (array $address) {
            // ignore case
            return strtoupper($address["address1"]).
                strtoupper($address["address2"]).
                strtoupper($address["city"]).
                strtoupper($address["country"]).
                strtoupper($address["firstName"]).
                strtoupper($address["lastName"]).
                strtoupper($address["province"]).
                strtoupper($address["zip"]);
        });
    }

    /**
     * For the given collection of Addresses, clean up the data and format it in a way that Shopify will accept for
     * the REST API
     *
     * @param Collection<Address> $addresses
     * @return Collection
     */
    protected function cleanUpAddressesForRest(Collection $addresses): Collection
    {
        $addresses = $this->filterAndSortAddressesToClean($addresses);

        // transform it to fit Shopify's data structure (plus our internal id, so we can reference it to update)
        $addresses->transform(function(Address $address) {
            return  [
                "ecommerce_address_id" => $address->getId(),
                "address1" => $address->getStreetLine1(),
                "address2" => $address->getStreetLine2(),
                "city" => $address->getCity(),
                "country" => $address->getCountry(),
                "first_name" => $address->getFirstName(),
                "last_name" => $address->getLastName(),
                "name" => "{$address->getFirstName()} {$address->getLastName()}",
                "province" => $address->getRegion(),
                "zip" => $address->getZip()
            ];
        });

        // and make sure it's unique - Shopify won't allow multiple addresses with the same data
        return $addresses->unique(function (array $address) {
            // ignore case
            return strtoupper($address["address1"]).
                strtoupper($address["address2"]).
                strtoupper($address["city"]).
                strtoupper($address["country"])
                .strtoupper($address["first_name"]).
                strtoupper($address["last_name"]).
                strtoupper($address["name"]).
                strtoupper($address["province"]).
                strtoupper($address["zip"]);
        });
    }

    /**
     * We only want to use certain addresses, and want them ordered to start with the most recent,
     * so filter then sort, and return the addresses.
     *
     * @param  Collection  $addresses
     * @return Collection
     */
    private function filterAndSortAddressesToClean(Collection $addresses): Collection
    {
        // only use addresses that have at least streetLine1, since we may have addresses with no real data
        $addresses = $addresses->filter(function (Address $address) {
            return !empty($address->getStreetLine1());
        });

        // order them to start with the most recent, just in case of duplicates (we have some cases where the region is all caps, and some not, etc)
        return $addresses->sort(function (Address $address1, Address $address2) {
            return $address1->getUpdatedAt() < $address2->getUpdatedAt();
        });
    }

    /**
     * Get the E.164 formatted phone number for the given user
     *
     * @param User $user
     * @return string|null
     */
    protected function getPhoneNumberForUser(User $user): ?string
    {
        // get the raw phone number value
        $phoneNumber = $user->phone_number;

        if (empty($phoneNumber)) {
            return null;
        }

        // get the user's country, so we can supply the country code
        $address = $this->cleanUpAddresses(
            collect($this->getAddressRepository()->getUserShippingAddresses($user->id))
        )->first();

        if (is_array($address) && array_key_exists("country", $address)) {
            $countryName = $address["country"];
        } else {
            $countryName = $address?->getCountry();
        }
        $countryCode = $this->countryNameToISO3166($countryName ?? "Canada");

        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumberObject = $phoneUtil->parse($phoneNumber, $countryCode);
            return $phoneUtil->format($phoneNumberObject, PhoneNumberFormat::E164);
        } catch (NumberParseException $e) {
            $this->logError(sprintf("Unable to format phone number %s for User ID %s: %s", $phoneNumber, $user->id, $e->getMessage()));
        }
        return null;
    }

    /**
     * Get the E.164 formatted phone number for the collection of customers
     *
     * @param Collection<Customer> $customers
     * @return string|null
     */
    private function getPhoneNumberForCustomer(Collection $customers): ?string
    {
        // get the raw phone number value
        $phoneNumber = $this->getCustomerValueFor($customers, "getPhone");

        if (empty($phoneNumber)) {
            return null;
        }

        // get the customers' latest address and get the country, so we can supply the country code
        $addresses = collect();
        $customers->each(fn(Customer $customer) => $addresses->push(
            ...$this->addressRepository->getCustomerShippingAddresses($customer->getId())
        ));

        $address = $this->cleanUpAddresses($addresses)->first();
        $countryCode = $this->countryNameToISO3166($address["country"] ?? "Canada");

        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumberObject = $phoneUtil->parse($phoneNumber, $countryCode);
            return $phoneUtil->format($phoneNumberObject, PhoneNumberFormat::E164);
        } catch (NumberParseException $e) {
            $this->logError(sprintf("Unable to format phone number %s for Customer email %s: %s",
                $phoneNumber, $customers->first()->getEmail(), $e->getMessage()));
        }
        return null;
    }

    /**
     * Get the ISO 3166 country code for the given country name
     * @author https://www.php.net/manual/en/locale.getdisplayregion.php#119895
     *
     * @param $countryName
     * @return string|null
     */
    protected function countryNameToISO3166($countryName): ?string
    {
        $language = "EN";
        $countryCode_list = array('AF', 'AX', 'AL', 'DZ', 'AS', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BY', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BO', 'BQ', 'BA', 'BW', 'BV', 'BR', 'IO', 'BN', 'BG', 'BF', 'BI', 'KH', 'CM', 'CA', 'CV', 'KY', 'CF', 'TD', 'CL', 'CN', 'CX', 'CC', 'CO', 'KM', 'CG', 'CD', 'CK', 'CR', 'CI', 'HR', 'CU', 'CW', 'CY', 'CZ', 'DK', 'DJ', 'DM', 'DO', 'EC', 'EG', 'SV', 'GQ', 'ER', 'EE', 'ET', 'FK', 'FO', 'FJ', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GM', 'GE', 'DE', 'GH', 'GI', 'GR', 'GL', 'GD', 'GP', 'GU', 'GT', 'GG', 'GN', 'GW', 'GY', 'HT', 'HM', 'VA', 'HN', 'HK', 'HU', 'IS', 'IN', 'ID', 'IR', 'IQ', 'IE', 'IM', 'IL', 'IT', 'JM', 'JP', 'JE', 'JO', 'KZ', 'KE', 'KI', 'KP', 'KR', 'KW', 'KG', 'LA', 'LV', 'LB', 'LS', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MK', 'MG', 'MW', 'MY', 'MV', 'ML', 'MT', 'MH', 'MQ', 'MR', 'MU', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'ME', 'MS', 'MA', 'MZ', 'MM', 'NA', 'NR', 'NP', 'NL', 'NC', 'NZ', 'NI', 'NE', 'NG', 'NU', 'NF', 'MP', 'NO', 'OM', 'PK', 'PW', 'PS', 'PA', 'PG', 'PY', 'PE', 'PH', 'PN', 'PL', 'PT', 'PR', 'QA', 'RE', 'RO', 'RU', 'RW', 'BL', 'SH', 'KN', 'LC', 'MF', 'PM', 'VC', 'WS', 'SM', 'ST', 'SA', 'SN', 'RS', 'SC', 'SL', 'SG', 'SX', 'SK', 'SI', 'SB', 'SO', 'ZA', 'GS', 'SS', 'ES', 'LK', 'SD', 'SR', 'SJ', 'SZ', 'SE', 'CH', 'SY', 'TW', 'TJ', 'TZ', 'TH', 'TL', 'TG', 'TK', 'TO', 'TT', 'TN', 'TR', 'TM', 'TC', 'TV', 'UG', 'UA', 'AE', 'GB', 'US', 'UM', 'UY', 'UZ', 'VU', 'VE', 'VN', 'VG', 'VI', 'WF', 'EH', 'YE', 'ZM', 'ZW');
        $ISO3166 = NULL;
        foreach ($countryCode_list as $countryCode) {
            $locale_cc = \Locale::getDisplayRegion('-' . $countryCode, $language);
            if (strcasecmp($countryName, $locale_cc) == 0) {
                $ISO3166 = $countryCode;
                break;
            }
        }
        return $ISO3166;
    }

    /**
     * Go through all customers in the collection, and try to get the value for the given attribute function,
     * returning the first non-null value retrieved.
     *
     * @param Collection<Customer> $customers
     * @param string $attributeFunction
     * @return string|null
     */
    private function getCustomerValueFor(Collection $customers, string $attributeFunction): ?string
    {
        $value = null;
        $customers->each(function (Customer $customer) use ($attributeFunction, &$value) {
            if ($value = $customer->$attributeFunction()) {
                // break out because we found the value
                return false;
            }
        });
        return $value;
    }

    /**
     * Create the .jsonl file for the given user or customer data
     *
     * @param string $data
     * @return string the name of the file created
     * @throws Exception
     */
    protected function createFileForLocalData(string $data): string
    {
        $filename = $this->getClassName() . "-" . preg_replace('~\D~', '', microtime(true)) . ".jsonl";

        if (app()->environment("local", "development")){
            $storageResult = Storage::put($filename, $data);
        } else {
            $storageResult = Storage::disk('musora_web_platform_s3')->put($filename, $data);
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
            .               'id address1 address2 city province provinceCode country countryCode zip firstName lastName'
            .           '}'
            .       ' }'
            .       ' userErrors { field message }'
            .   ' }'
            . ' }';
    }

    /**
     * Query Shopify for a customer with the given email address. If found, get our user and/or customers with the
     * same email address, and store the shopify_id to link them to the Shopify customer.
     * Use the Shopify customer's addresses to set the shopify_id for our user/customer's addresses as well.
     *
     * @param  string  $email
     * @return Collection notices for any failures
     */
    protected function linkExistingCustomer(string $email): Collection
    {
        $failures = collect();
        $shopifyCustomers = $this->shopify->getCustomers(["email" => $this->getEmailForShopify($email)]);
        $shopifyAttributes = $shopifyCustomers->first()?->getAttributes() ?? null;

        // this shouldn't be possible, but check just in case
        if (is_null($shopifyAttributes)) {
            $failures->push(
                sprintf(
                    "The email address %s was already in use in Shopify, but no customers were found".
                    " when attempting to retrieve it from Shopify",
                    $this->getEmailForShopify($email)
                )
            );
            return $failures;
        }

        $shopifyCustomerId = $shopifyAttributes["id"];
        // find all of our users and customers with that email address, and store the shopify_id
        $user = User::query()->firstWhere("email", $email);

        if (!is_null($user)) {
            $user->shopify_id = $shopifyCustomerId;
            $user->saveWithoutUpdatedAt();
        }
        $customers = $this->getCustomersForEmail($email);
        try {
            $customers->each(function (Customer $customer) use ($shopifyCustomerId) {
                // grab the eloquent model, so we can update it
                $customerModel = \App\Modules\Ecommerce\Models\Customer::find($customer->getId());
                $customerModel->shopify_id = $shopifyCustomerId;
                $customerModel->saveWithoutUpdatedAt();
                // refresh the doctrine model to get the change
                $this->entityManager->refresh($customer);
            });
        } catch (ORMException $e) {
            $failures->push(
                sprintf(
                    "Failed to store shopify_id %s on customers with email address %s: %s",
                    $shopifyCustomerId,
                    $email,
                    $e->getMessage()
                )
            );
        }

        // find any addresses for our user and/or customers that match Shopify's, and store the shopify_id
        collect($shopifyAttributes["addresses"])->each(function (array $addressData) use ($failures, $email, $customers, $user) {
            $matchedAddresses = $this->findAddressesWithMatchingData(
                $user->id ?? null,
                $customers,
                $addressData["first_name"],
                $addressData["last_name"],
                $addressData["address1"],
                $addressData["address2"],
                $addressData["city"],
                $addressData["province"],
                $addressData["province_code"],
                $addressData["zip"],
                $addressData["country"],
                $addressData["country_code"]
            );
            if ($matchedAddresses->isNotEmpty()) {
                $addressShopifyId = $addressData["id"];
                try {
                    $this->storeShopifyId($matchedAddresses, $addressShopifyId);
                } catch (ORMException $e) {
                    $failures->push(
                        sprintf(
                            "Failed to store shopify_id %s on address(es) for user or customer with email".
                            " address %s: %s",
                            $addressShopifyId,
                            $email,
                            $e->getMessage()
                        )
                    );
                }
            }
        });
        return $failures;
    }

    /**
     * The Address Repository used to interact with the Ecommerce Address entities
     *
     * @return AddressRepository
     */
    abstract protected function getAddressRepository(): AddressRepository;
}
