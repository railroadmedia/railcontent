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

    public function __construct(private CustomerIoApiGateway $customerIoApiGateway)
    {
        $this->userIdCustomFieldName = config('customer-io.customer_attribute_name_for_user_id', 'user_id');
    }

    /**
     * @throws Exception
     */
    public function getCustomerByEmail(
        string $accountName,
        string $email,
        ?bool $includeExternalAttributes = true
    ): ?Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        $customer =
            Customer::query()
            ->where([
                'email' => $email,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        if ($customer  && $includeExternalAttributes) {
            $externalCustomerData = $this->customerIoApiGateway->getCustomer(
                $accountConfigData['app_api_key'],
                $customer->email
            );

            $customer->setExternalAttributes($externalCustomerData['attributes']);
        }

        return $customer;
    }

    /**
     * @throws Exception
     */
    public function getCustomerIoProfileByEmail(array $accountConfigData, string $email): array
    {
        $customerIoProfile = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $email
        );

        return $customerIoProfile['attributes'];
    }

    /**
     * @throws Exception
     */
    public function getCustomerByUserId(string $accountName, int $userId): Customer
    {
        $accountConfigData = $this->getAccountConfigData($accountName);

        return Customer::query()
            ->where([
                'user_id' => $userId,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->firstOrFail();
    }

    /**
     * @throws Exception
     */
    public function getCustomerEventsByUserId(string $accountName, int $userId, ?int $limit = 25, ?int $amountToSkip = 0): array
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
     * @throws Exception
     */
    public function createCustomer(
        string $email,
        string $accountName,
        ?array $customAttributes = [],
        ?int $userId = null,
        ?int $createdAtTimestamp = null
    ): Customer {
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

        // set the user id custom attribute if it is not empty
        if (!empty($userId)) {
            $customAttributes[$this->userIdCustomFieldName] = $userId;
        }

        // sync to customer.io using their API
        $this->customerIoApiGateway->addOrUpdateCustomer(
            $accountConfigData['site_id'],
            $accountConfigData['track_api_key'],
            $customer->email,
            $customAttributes,
            $createdAtTimestamp
        );

        event(new CustomerCreated($customer));

        return $customer;
    }

    /**
     * @throws Throwable
     */
    public function updateCustomer(
        Customer $customer,
        string $accountName,
        ?array $customAttributes = [],
        ?int $userId = null,
        ?int $createdAtTimestamp = null
    ): Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);
        $oldCustomer = clone $customer;

        if (!empty($userId)) {
            $customer->user_id = $userId;
            $customAttributes[$this->userIdCustomFieldName] = $userId;
        }

        if (!empty($createdAtTimestamp)) {
            $customer->setCreatedAt(Carbon::createFromTimestamp($createdAtTimestamp));
        }

        if ($customAttributes) {
            $customer->setUpdatedAt(Carbon::now());

            $customer->saveOrFail();

            $this->customerIoApiGateway->addOrUpdateCustomer(
                $accountConfigData['site_id'],
                $accountConfigData['track_api_key'],
                $customer->email,
                $customAttributes,
                $createdAtTimestamp
            );

            event(new CustomerUpdated($oldCustomer, $customer));
        }

        return $customer;
    }

    /**
     * Looks up the customer based on the $email and $accountName config data. If none exists, this creates a new one,
     * otherwise it updates the existing customer in the database and via the API.
     * @throws Throwable
     */
    public function createOrUpdateCustomerByEmail(
        string $email,
        string $accountName,
        ?array $customAttributes = [],
        ?int $userId = null,
        ?int $createdAtTimestamp = null,
        ?bool $forceSync = false
    ): ?Customer {
        // TP-29 NOTE: if account is about to sync to a prospect workspace and forceSync flag is false, don't sync
        if (!$this->shouldSyncProfileToProspectWorkspace($accountName, $email) && !$forceSync) {
            // Log::debug('Customer not a prospect, not syncing to customer.io. Email: ' . $lookupEmail);
            return null;
        }

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

        if (empty($customer)) {
            $customer = $this->createCustomer(
                $email,
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
                userId: $userId,
                createdAtTimestamp: $createdAtTimestamp
            );
        }

        return $customer;
    }

    /**
     * @throws Exception
     */
    public function updateCustomerEmail(string $accountName, string $newEmail, string $oldEmail): void
    {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var Customer $customer */
        $customer =
            Customer::onWriteConnection()
            ->where([
                'email' => $oldEmail,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ])
            ->first();

        if ($customer) {
            $customer->email = $newEmail;
            $customer->saveOrFail();

            $this->updateCustomerIdentifier($accountName, $oldEmail, $newEmail);
        }
    }

    /**
     * @throws Exception
     */
    public function updateCustomerIdentifier(
        string $accountName,
        string $oldEmail,
        string $newEmail,
    ): void {
        $accountConfigData = $this->getAccountConfigData($accountName);

        // to update customer ids we need to use cio_id
        $cioCustomer = $this->getCustomerIoProfileByEmail($accountConfigData, $oldEmail);
        if (Arr::has($cioCustomer, 'cio_id')) {
            $this->customerIoApiGateway->updateCustomerByCioId(
                $accountConfigData['site_id'],
                $accountConfigData['track_api_key'],
                $cioCustomer['cio_id'],
                [
                    'email' => $newEmail,
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
            // There may be a customer entry under the users email only with no user id, so we should sync that one
            // if none is found under the user id. This func will create/update as needed.
            // This fixes a bug where sometimes createOrUpdateCustomerByUserId is called while the update by
            // email job is still in the queue or has failed. -Caleb March 2022
            return $this->createOrUpdateCustomerByEmail(
                $userEmail,
                $accountName,
                $customAttributes,
                $userId,
                $createdAtTimestamp
            );
        }

        return $this->updateCustomer(
            $customer,
            $accountName,
            $customAttributes,
            $userId,
            $createdAtTimestamp
        );
    }

    /**
     * @throws Exception
     */
    public function deleteCustomer(int $userId, string $accountName): ?Customer
    {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var Customer $customer */
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
     * @throws Throwable
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

                        $customEventAttributes = array_keys($formConfig['custom_event_attributes'] ?? []);
                        foreach ($requestParams as $param => $value) {
                            if (in_array($param, $customEventAttributes)) {
                                $eventData[$param] = $value;
                            }
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
     * @throws Exception
     */
    public function createEvent(
        string $email,
        string $accountName,
        string $eventName,
        ?array $eventData = [],
        ?string $eventType = null,
        ?int $createdAtTimestamp = null
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
     * @throws Exception
     */
    public function createEventForEmailOrId(
        string $email,
        string $accountName,
        string $eventName,
        ?string $eventType = null,
        ?int $createdAtTimestamp = null
    ): ?Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var $customer Customer */
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
            $customer = $this->createCustomer($email, $accountName);

            sleep(5);
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

        return null;
    }

    /**
     * @throws Exception
     */
    public function createEventForUserId(
        int $userId,
        string $accountName,
        string $eventName,
        ?array $eventData = [],
        ?string $eventType = null,
        ?int $createdAtTimestamp = null
    ): Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var Customer $customer */
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
     * @throws Exception
     */
    public function sendTransactionalEmail(
        string $accountName,
        string $customerIoTransactionalMessageId,
        string $customerEmail,
        ?array $messageDataArray = []
    ): bool {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var Customer $customer */
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
            $this->createCustomer($customerEmail, $accountName);

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
     * @throws Exception
     */
    public function getAccountConfigData(string $accountName): array
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
     * @throws Exception
     */
    public function syncDeviceForUserId(
        int $userId,
        string $accountName,
        array $deviceData,
        ?int $createdAtTimestamp = null
    ): ?Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var Customer $customer */
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

        return null;
    }

    /**
     * Note, secondary customer row is always hard-deleted. It is not softly deleted.
     * @throws Exception
     */
    public function mergeCustomers(
        string $accountName,
        string $primaryCustomerEmail,
        string $secondaryCustomerEmail
    ): bool|Customer {
        $accountConfigData = $this->getAccountConfigData($accountName);

        /** @var Customer $primaryCustomer */
        $primaryCustomer = Customer::query()->where(
            [
                'email' => $primaryCustomerEmail,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ]
        )->first();

        /** @var Customer $secondaryCustomer */
        $secondaryCustomer = Customer::query()->where(
            [
                'email' => $secondaryCustomerEmail,
                'workspace_name' => $accountConfigData['workspace_name'],
                'workspace_id' => $accountConfigData['workspace_id'],
                'site_id' => $accountConfigData['site_id'],
            ]
        )->first();

        if (empty($primaryCustomer) || empty($secondaryCustomer)) {
            throw new Exception(
                'Could not merge customer ids because one is missing from the database. ' .
                    '$primaryCustomerId:' . $primaryCustomerEmail .
                    ' - $secondaryCustomerId:' . $secondaryCustomerEmail . ' - $accountName: ' . $accountName
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
                    [],
                    Carbon::parse($secondaryCustomer->created_at)->timestamp
                );
            }
        } catch (Exception $exception) {
            error_log($exception);
            error_log(
                'Failed to merge customer.io customers. Secondary customer will not be deleted from database.' .
                    '$primaryCustomerId:' . $primaryCustomerEmail .
                    ' - $secondaryCustomerId:' . $secondaryCustomerEmail . ' - $accountName: ' . $accountName
            );

            return false;
        }

        $secondaryCustomer->forceDelete();

        return $primaryCustomer;
    }

    public function handleUserEmailChanged(string $oldEmail, string $newEmail): void
    {
        try {
            $customers = Customer::where('email', $oldEmail)->get(['workspace_name']);
            $customers->each(function (Customer $customer) use ($oldEmail, $newEmail) {
                $this->updateCustomerEmail(
                    accountName: $customer->workspace_name,
                    newEmail: $newEmail,
                    oldEmail: $oldEmail
                );
            });
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    public function shouldSyncProfileToProspectWorkspace(string $accountName, string $email): bool
    {
        $isProspectWorkspace = in_array($accountName, config('event-data-synchronizer.customer_io_account_name_prospect_workspaces'));

        // TP-29 NOTE: if account name is musora_prospects and user is not a prospect in that workspace, don't sync
        return $isProspectWorkspace
            ? !is_null($this->getCustomerByEmail($accountName, $email, false))
            : true;
    }
}
