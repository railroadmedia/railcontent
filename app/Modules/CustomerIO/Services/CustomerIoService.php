<?php

namespace App\Modules\CustomerIO\Services;

use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Events\CustomerCreated;
use App\Modules\CustomerIO\Events\CustomerUpdated;
use App\Modules\CustomerIO\Models\Customer;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Throwable;

class CustomerIoService
{
    private string $userIdCustomFieldName;

    public function __construct(
        private CustomerIoApiGateway $customerIoApiGateway,
    ) {
        $this->userIdCustomFieldName = config('customer-io.customer_attribute_name_for_user_id', 'user_id');
    }

    /**
     * @param string $accountName
     * @param string $id
     * @param bool $includeExternalAttributes
     * @return Customer
     * @throws Exception
     */
    public function getCustomerById(string $accountName, string $id, bool $includeExternalAttributes = true): Customer
    {
        // customer.io account/workspace details
        $accountConfigData = $this->getAccountConfigData($accountName);

        /**
         * @var Customer $customer
         */
        $customer =
            Customer::query()
            ->where([
                'uuid' => $id,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->firstOrFail();

        if ($includeExternalAttributes) {
            $externalCustomerData = $this->customerIoApiGateway->getCustomer(
                $accountConfigData['app_api_key'],
                $customer->email
            );

            $customer->setExternalAttributes($externalCustomerData['attributes']);
        }

        return $customer;
    }

    public function getCustomerIoProfileByEmail(array $accountConfigData, string $email): array
    {
        $customerIoProfile = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $email
        );

        return $customerIoProfile['attributes'];
    }

    /**
     * @param string $accountName
     * @param string $userId
     * @param bool $includeExternalAttributes
     * @return Customer
     * @throws Exception
     */
    public function getCustomerByUserId(string $accountName, string $userId): Customer
    {
        // customer.io account/workspace details
        $accountConfigData = $this->getAccountConfigData($accountName);

        /**
         * @var Customer $customer
         */
        $customer =
            Customer::query()
            ->where([
                'user_id' => $userId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->firstOrFail();

        return $customer;
    }

    public function getCustomerByEmail(string $accountName, string $email): ?Customer
    {
        // customer.io account/workspace details
        $accountConfigData = $this->getAccountConfigData($accountName);

        /**
         * @var Customer|null $customer
         */
        $customer =
            Customer::query()
            ->where([
                'email' => $email,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        return $customer;
    }

    /**
     * @param string $accountName
     * @param string $userId
     * @param int $limit
     * @param int $amountToSkip
     * @return Customer
     * @throws Exception
     */
    public function getCustomerEventsByUserId(string $accountName, string $userId, int $limit = 25, int $amountToSkip = 0): Customer
    {
        // customer.io account/workspace details
        $accountConfigData = $this->getAccountConfigData($accountName);

        /**
         * @var $customer Customer
         */
        $customer =
            Customer::query()
            ->where([
                'user_id' => $userId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->firstOrFail();

        return $this->customerIoApiGateway->getCustomerActivities(
            $accountConfigData['app_api_key'],
            $customer->email,
            'event',
            null,
            $limit,
            $amountToSkip
        );
    }

    /**
     * If no ID is passed, one will be generated automatically.
     * If no $createdAtTimestamp is passed it will use the current time.
     *
     * @param $email
     * @param $accountName
     * @param array $customAttributes
     * @param string|null $id
     * @param integer|null $userId
     * @param integer|null $createdAtTimestamp
     * @throws Exception
     * @throws Throwable
     */
    public function createCustomer(
        $email,
        $accountName,
        array $customAttributes = [],
        ?string $id = null,
        ?int $userId = null,
        ?int $createdAtTimestamp = null
    ) {
        // customer.io account/workspace details
        $accountConfigData = $this->getAccountConfigData($accountName);
        if (empty($createdAtTimestamp)) {
            $createdAtTimestamp = Carbon::now()->timestamp;
        }
        Customer::upsert(
            [
                'uuid' => $userId ?? bin2hex(openssl_random_pseudo_bytes(16)),
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
                'email' => $email,
                'user_id' => $userId,
                'created_at' => Carbon::createFromTimestamp($createdAtTimestamp),
                'updated_at' => Carbon::createFromTimestamp($createdAtTimestamp)

            ],
            ['workspace_id', 'uuid'],
            ['email', 'user_id', 'updated_at']
        );

        $customer =
            Customer::onWriteConnection()
            ->where([
                'email' => $email,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        // set the user id custom attribute if its not empty
        if (!empty($userId)) {
            $customAttributes[$this->userIdCustomFieldName] = $userId;
        }

        // sync to customer.io using their API
        $this->customerIoApiGateway->addOrUpdateCustomer(
            $accountConfigData['site_id'],
            $accountConfigData['track_api_key'],
            $customer->email,
            $customer->uuid,
            $customAttributes,
            $createdAtTimestamp
        );

        event(new CustomerCreated($customer));

        return $customer;
    }

    /**
     * Looks up the customer based on the $uuid and $accountName config data. Can update their email, custom fields,
     * or created at time.
     *
     * To delete a customer attribute value in Customer.IO you must pass it as a null value in the array.
     *
     * @param $uuid
     * @param $accountName
     * @param array $customAttributes
     * @param null $email
     * @param integer|null $userId
     * @param integer|null $createdAtTimestamp
     * @return mixed
     * @throws Exception
     */
    public function updateCustomer(
        Customer $customer,
        $accountName,
        array $customAttributes = [],
        $email = null,
        ?int $userId = null,
        ?int $createdAtTimestamp = null
    ) {
        $accountConfigData = $this->getAccountConfigData($accountName);
        $oldCustomer = clone $customer;

        if (!empty($email)) {
            $customer->email = $email;
            if ($oldCustomer->email !== $email) {
                /**
                 * Updates email and updates the identifier in customer.io as well using cio_id.
                 * This is needed to avoid conflicts of identifiers in customer.io.
                 */
                $this->updateCustomerIdentifier($accountName, $oldCustomer, $customer);
            }
        }

        if (!empty($userId)) {
            $customer->user_id = $userId;
            $customer->uuid = $userId;
            $customAttributes[$this->userIdCustomFieldName] = $userId;
        }

        if (!empty($createdAtTimestamp)) {
            $customer->setCreatedAt(Carbon::createFromTimestamp($createdAtTimestamp));
        }

        $customer->setUpdatedAt(Carbon::now());

        // save to the database
        $customer->saveOrFail();


        // sync to customer.io using their API
        $this->customerIoApiGateway->addOrUpdateCustomer(
            $accountConfigData['site_id'],
            $accountConfigData['track_api_key'],
            $customer->email,
            null,
            $customAttributes,
            $createdAtTimestamp
        );

        event(new CustomerUpdated($oldCustomer, $customer));

        return $customer;
    }

    /**
     * Looks up the customer based on the $email and $accountName config data. If none exists, this creates a new one,
     * otherwise it updates the existing customer in the database and via the API.
     *
     * @throws Throwable
     */
    public function createOrUpdateCustomerByEmail(
        string $lookupEmail,
        string $accountName,
        ?array $customAttributes = [],
        ?int $userId = null,
        ?int $createdAtTimestamp = null,
        ?bool $forceSync = false
    ): ?Customer {
        // TP-29 NOTE: if account is about to sync to a prospect workspace and forceSync flag is false, don't sync
        if (!$this->shouldSyncProfileToProspectWorkspace($accountName, $lookupEmail) && !$forceSync) {
            // Log::debug('Customer not a prospect, not syncing to customer.io. Email: ' . $lookupEmail);
            return null;
        }
        $accountConfigData = $this->getAccountConfigData($accountName);

        /**
         * @var Customer $customer
         */
        $customer =
            Customer::onWriteConnection()
            ->where([
                'email' => $lookupEmail,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        if (empty($customer)) {
            $customer = $this->createCustomer(
                $lookupEmail,
                $accountName,
                $customAttributes,
                null,
                $userId,
                $createdAtTimestamp
            );
        } else {
            $customer = $this->updateCustomer(
                $customer,
                $accountName,
                $customAttributes,
                null,
                $userId,
                $createdAtTimestamp
            );
        }

        return $customer;
    }

    /**
     * @param string $accountName
     * @param Customer $oldCustomer
     * @param Customer $newCustomer
     * @return void
     * @throws Exception
     */
    public function updateCustomerIdentifier(
        string $accountName,
        Customer $oldCustomer,
        Customer $newCustomer,
    ): void {
        $accountConfigData = $this->getAccountConfigData($accountName);

        // to update customer ids we need to use cio_id
        $cioCustomer = $this->getCustomerIoProfileByEmail($accountConfigData, $oldCustomer->email);
        if (Arr::has($cioCustomer, 'cio_id')) {
            $this->customerIoApiGateway->updateCustomerByCioId(
                $accountConfigData['site_id'],
                $accountConfigData['track_api_key'],
                $cioCustomer['cio_id'],
                [
                    'email' => $newCustomer->email,
                ]
            );
        }
    }

    /**
     * Looks up the customer based on the user id and $accountName config data. If none exists, this creates a new one,
     * otherwise it updates the existing customer in the database and via the API.
     *
     * If a new email is passed it will be updated in customer.io via the api
     *
     * @throws Throwable
     */
    public function createOrUpdateCustomerByUserId(
        int $userId,
        string $accountName,
        string $userEmail,
        ?array $customAttributes = [],
        ?int $createdAtTimestamp = null,
        ?bool $forceSync = false
    ): ?Customer {
        // TP-29 NOTE: if account is about to sync to a prospect workspace and forceSync flag is false, don't sync
        if (!$this->shouldSyncProfileToProspectWorkspace($accountName, $userEmail) && !$forceSync) {
            // Log::debug('Customer not a prospect, not syncing to customer.io. Email: ' . $userEmail);
            return null;
        }
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var Customer $customer */
        $customer =
            Customer::onWriteConnection()
            ->where([
                'user_id' => $userId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        if (empty($customer)) {
            // There may be a customer entry under the users email only with no user id so we should sync that one
            // if none is found under the user id. This func will create/update as needed.
            // This fixes a bug where sometimes createOrUpdateCustomerByUserId is called while the update by
            // email job is still in the queue or has failed. -Caleb March 2022
            $this->createOrUpdateCustomerByEmail(
                $userEmail,
                $accountName,
                $customAttributes,
                $userId,
                $createdAtTimestamp
            );
        } else {
            $customer = $this->updateCustomer(
                $customer,
                $accountName,
                $customAttributes,
                $userEmail,
                $userId,
                $createdAtTimestamp
            );
        }

        return $customer;
    }

    /**
     * @throws Throwable
     */
    public function deleteCustomer(int $userId, $accountName)
    {
        $accountConfigData = $this->getAccountConfigData($accountName);

        $customer =
            Customer::query()
            ->where([
                'user_id' => $userId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        if (!$customer) {
            Log::info("User $userId does not exist in the customer io workspace '$accountName'");
            return null;
        }

        $this->customerIoApiGateway->deleteCustomer(
            $accountConfigData['site_id'],
            $accountConfigData['track_api_key'],
            $customer->email
        );
        $customer->delete();
        return $customer;
    }

    /**
     * @param string $email
     * @param string $formNameToProcess
     * @param array $requestParams
     * @return array|void
     * @throws Exception
     */
    public function processForm(string $email, string $formNameToProcess, array $requestParams): array
    {
        $brand = config('customer-io.forms.brand');
        $allConfiguredForms = config('customer-io.forms.' . $brand, []);

        $customers = [];

        foreach ($allConfiguredForms as $formName => $formConfig) {
            if ($formName === $formNameToProcess) {
                foreach ($formConfig['accounts_to_sync'] as $accountName) {
                    $accountConfigData = $this->getAccountConfigData($accountName);

                    /** @var Customer $customer */
                    $customer =
                        Customer::onWriteConnection()
                        ->where([
                            'email' => $email,
                            'workspace_name' => $accountConfigData['workspace_name'],
                            'workspace_id' => $accountConfigData['workspace_id'],
                            'site_id' => $accountConfigData['site_id'],
                        ])
                        ->first();

                    $customAttributeNames = array_keys($formConfig['custom_attributes']);
                    $customAttributes = [];
                    foreach ($requestParams as $param => $value) {
                        if (in_array($param, $customAttributeNames)) {
                            $customAttributes[$param] = $value;
                        }
                    }

                    if (empty($customer)) {
                        $customer = $this->createCustomer($email, $accountName, $customAttributes);
                    } else {
                        $customer = $this->updateCustomer(
                            $customer,
                            $accountName,
                            $customAttributes
                        );
                    }

                    sleep(1);

                    foreach ($formConfig['events'] as $eventName) {
                        $eventData = [
                            'timestamp' => Carbon::now()->timestamp,
                            'brand' => $brand,
                            'form_name' => $formName,
                        ];
                        foreach (config('customer-io.forms_events_UTM_parameters', []) as $param => $dataKey) {
                            $eventData[$dataKey] = $requestParams[$param] ?? null;
                        }

                        $this->createEvent($customer->email, $accountName, $eventName, array_filter($eventData));
                    }

                    $customers[] = $customer;
                }
            }
        }

        if (!empty($customers)) {
            return $customers;
        }

        throw new Exception('Failed to process form: ' . $formNameToProcess . ' for email address: ' . $email);
    }

    /**
     * @param $uuid
     * @param $accountName
     * @param $eventName
     * @param array $eventData
     * @param null $eventType
     * @param null $createdAtTimestamp
     * @return bool
     * @throws Exception
     */
    public function createEvent(
        $email,
        $accountName,
        $eventName,
        array $eventData = [],
        $eventType = null,
        $createdAtTimestamp = null
    ): bool {
        $accountConfigData = $this->getAccountConfigData($accountName);

        $this->customerIoApiGateway->createEvent(
            $accountConfigData['site_id'],
            $accountConfigData['track_api_key'],
            $email,
            $eventName,
            $eventData,
            $eventType,
            $createdAtTimestamp
        );

        return true;
    }

    /**
     * @param string|null $email
     * @param string|null $uuid
     * @param string $accountName
     * @param string $eventName
     * @param null $eventType
     * @param null $createdAtTimestamp
     * @return Customer
     * @throws Exception
     */
    public function createEventForEmailOrId(
        ?string $email,
        ?string $uuid,
        string $accountName,
        string $eventName,
        $eventType = null,
        $createdAtTimestamp = null
    ): Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        if (!empty($uuid)) {
            /**
             * @var $customer Customer
             */
            $customer =
                Customer::query()
                ->where([
                    'uuid' => $uuid,
                    'workspace_name' => $accountConfigData['workspace_name'],
                    'workspace_id' => $accountConfigData['workspace_id'],
                    'site_id' => $accountConfigData['site_id'],
                ])
                ->first();
        } else {
            /**
             * @var $customer Customer
             */
            $customer =
                Customer::query()
                ->where([
                    'email' => $email,
                    'workspace_name' => $accountConfigData['workspace_name'],
                    'workspace_id' => $accountConfigData['workspace_id'],
                    'site_id' => $accountConfigData['site_id'],
                ])
                ->first();

            if (empty($customer)) {
                $customer = $this->createCustomer($email, $accountName, []);

                sleep(5);
            }
        }

        if (!empty($customer)) {
            $this->customerIoApiGateway->createEvent(
                $accountConfigData['site_id'],
                $accountConfigData['track_api_key'],
                $customer->email,
                $eventName,
                $eventType,
                $createdAtTimestamp
            );

            return $customer;
        }

        throw new Exception(
            'Customer not found when trying to trigger event. Args: ' . var_export(func_get_args(), true)
        );
    }

    /**
     * @param integer $userId
     * @param string $accountName
     * @param string $eventName
     * @param array $eventData
     * @param string|null $eventType
     * @param integer|null $createdAtTimestamp
     * @return Customer
     * @throws Exception
     */
    public function createEventForUserId(
        int $userId,
        string $accountName,
        string $eventName,
        array $eventData = [],
        ?string $eventType = null,
        ?int $createdAtTimestamp = null
    ): Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /**
         * @var $customer Customer
         */
        $customer =
            Customer::query()
            ->where([
                'user_id' => $userId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        if (!empty($customer)) {
            $this->customerIoApiGateway->createEvent(
                $accountConfigData['site_id'],
                $accountConfigData['track_api_key'],
                $customer->email,
                $eventName,
                $eventData,
                $eventType,
                $createdAtTimestamp
            );

            return $customer;
        }

        throw new Exception(
            'Customer not found when trying to trigger event with user id. Args: ' . var_export(func_get_args(), true)
        );
    }

    /**
     * @param string $uuid
     * @param string $accountName
     * @param string $eventName
     * @param $customerIoTransactionalMessageId
     * @param $customerEmail
     * @param $customerId
     * @param null $eventType
     * @param null $createdAtTimestamp
     * @return bool
     * @throws Exception
     */
    public function sendTransactionalEmail(
        string $accountName,
        $customerIoTransactionalMessageId,
        $customerEmail,
        $messageDataArray = []
    ): bool {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /**
         * @var $customer Customer
         */
        $customer =
            Customer::query()
            ->where([
                'email' => $customerEmail,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        if (empty($customer)) {
            $customer = $this->createCustomer($customerEmail, $accountName);

            // we must sleep because there is a delay until when the customer can be used in the API after its created
            sleep(5);
        }

        $this->customerIoApiGateway->sendTransactionalEmail(
            $accountConfigData['app_api_key'],
            $customerIoTransactionalMessageId,
            $customerEmail,
            $messageDataArray
        );

        return true;
    }

    /**
     * @param $accountName
     * @return array
     * @throws Exception
     */
    public function getAccountConfigData($accountName): array
    {
        $accountConfig = config('customer-io.accounts')[$accountName] ?? [];

        if (
            empty($accountConfig) ||
            empty($accountConfig['workspace_name']) ||
            empty($accountConfig['workspace_id']) ||
            empty($accountConfig['site_id'])
        ) {
            // incorrect config, error
            throw new Exception(
                'Failed to connect to customer.io account, no config exists for account name: ' . $accountName
            );
        }

        return $accountConfig;
    }

    /**
     * @param $userId
     * @param $accountName
     * @param $deviceData
     * @param null $createdAtTimestamp
     * @return Customer
     * @throws Exception
     */
    public function syncDeviceForUserId(
        $userId,
        $accountName,
        $deviceData,
        $createdAtTimestamp = null
    ): Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /**
         * @var $customer Customer
         */
        $customer = Customer::query()->where(
            [
                'user_id' => $userId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ]
        )->first();

        if (!empty($customer)) {
            $this->customerIoApiGateway->addOrUpdateCustomerDevice(
                $accountConfigData['site_id'],
                $accountConfigData['track_api_key'],
                $customer->email,
                $deviceData,
                $createdAtTimestamp
            );

            return $customer;
        }

        return;
    }

    /**
     * Note, secondary customer row is always hard-deleted. It's not soft deleted.
     *
     * @param string $accountName
     * @param string $primaryCustomerId
     * @param string $secondaryCustomerId
     * @return false|Customer
     * @throws Exception
     */
    public function mergeCustomers(
        string $accountName,
        string $primaryCustomerId,
        string $secondaryCustomerId
    ): bool|Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var Customer $primaryCustomer */
        $primaryCustomer = Customer::query()->where(
            [
                'uuid' => $primaryCustomerId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ]
        )->first();

        /** @var Customer $secondaryCustomer */
        $secondaryCustomer = Customer::query()->where(
            [
                'uuid' => $secondaryCustomerId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ]
        )->first();

        if (empty($primaryCustomer) || empty($secondaryCustomer)) {
            throw new Exception(
                'Could not merge customer ids because one is missing from the database. ' .
                    '$primaryCustomerId:' . $primaryCustomerId .
                    ' - $secondaryCustomerId:' . $secondaryCustomerId . ' - $accountName: ' . $accountName
            );
        }

        try {
            $this->customerIoApiGateway->mergeCustomers(
                $accountConfigData['site_id'],
                $accountConfigData['track_api_key'],
                $primaryCustomer->email,
                $secondaryCustomer->email
            );

            // if the secondary customer was created first, set the primary created at to match
            if (Carbon::parse($secondaryCustomer->created_at) < Carbon::parse($primaryCustomer->created_at)) {
                $primaryCustomer->created_at = $secondaryCustomer->created_at;
                $primaryCustomer->save();

                $this->customerIoApiGateway->addOrUpdateCustomer(
                    $accountConfigData['site_id'],
                    $accountConfigData['track_api_key'],
                    $primaryCustomer->email,
                    $primaryCustomerId,
                    [],
                    Carbon::parse($secondaryCustomer->created_at)->timestamp
                );
            }
        } catch (Exception $exception) {
            error_log($exception);
            error_log(
                'Failed to merge customer.io customers. Secondary customer will not be deleted from database.' .
                    '$primaryCustomerId:' . $primaryCustomerId .
                    ' - $secondaryCustomerId:' . $secondaryCustomerId . ' - $accountName: ' . $accountName
            );

            return false;
        }

        $secondaryCustomer->forceDelete();

        return $primaryCustomer;
    }

    public function shouldSyncProfileToProspectWorkspace(string $accountName, string $email): bool
    {
        $isProspectWorkspace = in_array($accountName, config('event-data-synchronizer.customer_io_account_name_prospect_workspaces'));

        // TP-29 NOTE: if account name is musora_prospects and user is not a prospect in that workspace, don't sync
        return $isProspectWorkspace
            ? !is_null($this->getCustomerByEmail($accountName, $email))
            : true;
    }
}
