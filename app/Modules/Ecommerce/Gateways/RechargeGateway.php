<?php

namespace App\Modules\Ecommerce\Gateways;

use App\Modules\Ecommerce\Enums\RechargeSubscriptionStatusEnum;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Recharge\Customer;
use App\Modules\Ecommerce\Models\Recharge\PaymentMethod;
use App\Modules\Ecommerce\Models\Recharge\Subscription;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Exception;
use Google\Service\Monitoring\Custom;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\User;

class RechargeGateway
{
    private const API_VERSION_2021_11 = '2021-11';
    private const API_VERSION_2021_01 = '2021-01';
    private $access_token = '';

    private $ch;

    private string $baseUrl;

    public function __construct()
    {
        $this->access_token = config('shopify.recharge.access_token');
        $shopifyDomainBase = Str::before(config('shopify.credentials.domain'), '.myshopify.com');
        $this->baseUrl = sprintf('https://%s-sp.admin.rechargeapps.com/merchant', $shopifyDomainBase);
    }


    /**
     * @throws Exception
     */
    public function call(
        $method = 'GET',
        $url = '/',
        $data = [],
        $options = [],
        $apiVersion = self::API_VERSION_2021_11
    ) {
        // Setup options
        $defaults = [
            'charset' => 'UTF-8',
            'headers' => array(),
            'fail_on_error' => false,
            'return_array' => false,
            'all_data' => false,
            'verify_data' => true,
            'ignore_response' => false
        ];
        $options = array_merge($defaults, $options);

        // Data -> GET Params
        $method = strtoupper($method);
        if ($method === 'GET' && $data) {
            if (!is_array($data)) {
                $data = json_decode($data);
                if (json_last_error() != JSON_ERROR_NONE) {
                    throw new \Exception('Data is malformed. Provide an array OR json-encoded object/array.');
                }
            }

            if (strpos($url, '?') === false) {
                $url .= '?';
            } else {
                $url .= '&';
            }
            $url .= http_build_query($data);
        }

        // Setup headers
        $defaultHeaders = [];
        $defaultHeaders[] = 'Content-Type: application/json; charset=' . $options['charset'];
        $defaultHeaders[] = 'Accept: application/json';

        if ($this->access_token) {
            $defaultHeaders[] = 'X-Recharge-Access-Token: ' . $this->access_token;
        }
        $defaultHeaders[] = "X-Recharge-Version: $apiVersion";
        $headers = array_merge($defaultHeaders, $options['headers']);

        // Setup URL
        if ($options['verify_data']) {
            $url = 'https://api.rechargeapps.com' . $url;
        }

        // Setup CURL
        if (!$this->ch) {
            $this->ch = curl_init();
        }
        $ch = $this->ch;

        $curlOpts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_ENCODING => '',
            CURLOPT_USERAGENT => 'Huel reCharge API Wrapper',
            CURLOPT_FAILONERROR => $options['fail_on_error'],
            CURLOPT_VERBOSE => $options['all_data'],
            CURLOPT_HEADER => 1,
            CURLOPT_NOSIGNAL => 0,
            CURLOPT_TIMEOUT_MS => 30000,
        );

        if (!$data || $curlOpts[CURLOPT_CUSTOMREQUEST] === 'GET') {
            $curlOpts[CURLOPT_POSTFIELDS] = '';
        } else {
            if (is_array($data)) {
                $curlOpts[CURLOPT_POSTFIELDS] = json_encode($data);
            } else {
                // Detect if already a JSON object
                json_decode($data);
                if (json_last_error() == JSON_ERROR_NONE) {
                    $curlOpts[CURLOPT_POSTFIELDS] = $data;
                } else {
                    throw new \Exception('Data is malformed. Provide an array OR json-encoded object/array.');
                }
            }
        }

        if ($options['ignore_response']) {
            $curlOpts[CURLOPT_WRITEFUNCTION] = function ($curl, $input) {
                return 0;
            };
            $curlOpts[CURLOPT_RETURNTRANSFER] = null;
            $curlOpts[CURLOPT_TIMEOUT_MS] = 1;
            $curlOpts[CURLOPT_NOSIGNAL] = 1;
        }
        curl_setopt_array($ch, $curlOpts);

        // Make request

        $response = null;
        $headerSize = null;
        $result = null;
        $info = null;
        $returnError = null;

        $retry = true;
        $maxAttempts = 5;
        $attemptCount = 0;
        while ($retry && $attemptCount < $maxAttempts) {
            $retry = false;
            $attemptCount++;
            $response = curl_exec($ch);
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $result = json_decode(substr($response, $headerSize), $options['return_array']);
            $sleepTime = 1 * $attemptCount;

            $info = array_filter(array_map('trim', explode("\n", substr($response, 0, $headerSize))));


            // Parse errors
            $returnError = [
                'number' => curl_errno($ch),
                'msg' => curl_error($ch)
            ];
            // curl_close($ch);

            // Parse extra info
            $returnInfo = null;
            foreach ($info as $k => $header) {
                if (strpos($header, 'HTTP/') > -1) {
                    $returnInfo['HTTP_CODE'] = $header;
                    continue;
                }
                list($key, $val) = explode(':', $header);
                $returnInfo[trim($key)] = trim($val);
            }

            if (isset($returnInfo['HTTP_CODE']) && (strpos(
                        $returnInfo['HTTP_CODE'],
                        'HTTP/1.1 429 TOO MANY REQUESTS'
                    ) > -1 || $returnInfo['HTTP_CODE'] == 'HTTP/2 429')) {
                Log::warning(
                    '[Recharge\API] Sleeping for ' . $sleepTime . ' seconds (429 Too Many Requests / Method 1)'
                );
                sleep($sleepTime);
                $retry = true;
                continue;
            }

            if (isset($result->warning) && $result->warning == "too many requests") {
                Log::warning('[Recharge\API] Sleeping for ' . $sleepTime . ' seconds (Too Many Requests / Method 2)');
                sleep($sleepTime);
                $retry = true;
                continue;
            }

            if (isset($returnInfo['HTTP_CODE']) && strpos($returnInfo['HTTP_CODE'], 'HTTP/1.1 409 CONFLICT') > -1) {
                Log::warning('[Recharge\API] Sleeping for ' . $sleepTime . ' seconds (409 Conflict)');
                sleep($sleepTime);
                $retry = true;
                continue;
            }

            if (isset($returnInfo['HTTP_CODE']) && strpos($returnInfo['HTTP_CODE'], 'HTTP/1.1 400 BAD REQUEST') > -1) {
                if (isset($result->errors) && isset($result->errors->UNEXPECTED_VARIANT_ERROR_TYPE)) {
                    if (strpos(
                            $result->errors->UNEXPECTED_VARIANT_ERROR_TYPE,
                            'Shopify returned 429 rate limit regarding this call'
                        ) > -1) {
                        Log::info('[Recharge\API] Sleeping for ' . $sleepTime . ' seconds (Shopify 429)');
                        sleep($sleepTime);
                        $retry = true;
                        continue;
                    }
                }
            }

            if ($returnError['number']) {
                // if recharge has taken too long
                if (in_array($returnError['number'], [CURLE_OPERATION_TIMEDOUT, CURLE_OPERATION_TIMEOUTED])) {
                    $retry = true;
                    Log::warning('[Recharge\API] Request timed out, let\'s try again');
                    continue;
                }

                if (stripos($returnError['msg'], 'The requested URL returned error: 429 TOO MANY REQUESTS') !== false) {
                    Log::warning(
                        '[Recharge\API] Sleeping for ' . $sleepTime . ' seconds (429 Too Many Requests / Method 2)'
                    );
                    sleep($sleepTime);
                    $retry = true;
                    continue;
                }

                throw new \Exception('ERROR #' . $returnError['number'] . ': ' . $returnError['msg']);
            }

            if (isset($result->errors)) {
                if (is_array($result->errors) && $result->errors[0] ?? '' == 'shopify_customer_id not found') {
                    // Customer not found, return null result
                    return null;
                }
                throw new \Exception("Error:" . print_r($result->errors, true));
            }
        }

        if ($retry) {
            throw new \Exception("RechargeGateway: Reached maximum of $maxAttempts attempts");
        }

        if ($options['all_data']) {
            if ($options['return_array']) {
                $result['_ERROR'] = $returnError;
                $result['_INFO'] = $returnInfo;
            } else {
                $result->_ERROR = $returnError;
                $result->_INFO = $returnInfo;
            }
            return $result;
        }
        return $result;
    }

    public function getCustomer($shopifyCustomerId)
    {
        return collect(
            $this->call('GET', '/customers', [
                'external_customer_id' => $shopifyCustomerId,
                'limit' => 250
            ])
        );
    }

    /**
     * Get the profile URL for the given Recharge customer ID
     *
     * @param int $customerId
     * @return string
     * @throws Exception
     */
    public function getCustomerProfile(int $customerId): string
    {
        if (empty($this->baseUrl)) {
            throw new \Exception('No base URL found for this Recharge instance.');
        }
        return sprintf('%s/customers/%s', $this->baseUrl, $customerId);
    }

    /**
     * Get the customer from Recharge, for the given Shopify ID
     *
     * @param int $shopifyCustomerId
     * @return Customer|null
     */
    public function getRechargeCustomer(int $shopifyCustomerId): ?Customer
    {
        try {
            $customers = collect(
                $this->call(
                    'GET',
                    '/customers',
                    [
                        'external_customer_id' => $shopifyCustomerId,
                        'limit' => 250
                    ]
                )->customers ?? []
            );
        } catch (Exception $e) {
            Log::error($e);
            return null;
        }

        if ($customers->isEmpty()) {
            return null;
        }

        // transform into our model
        $customers->transform(fn($customerData) => new Customer($customerData));

        // in case there are multiple customers with that shopify id, we should log it for investigation
        if ($customers->count() > 1) {
            Log::error("[Recharge\API] {$customers->count()} customers found for $shopifyCustomerId");
            // sort them so we can grab the latest entry
            $customers = $customers->sortByDesc("createdAt");
        }

        return $customers->first();
    }

    public function getCustomerByRechargeId(int $rechargeCustomerId): ?Customer
    {
        try {
            $customer = $this->call('GET', '/customers/' . $rechargeCustomerId)->customer ?? null;
        } catch (Exception $e) {
            Log::error($e);
            return null;
        }

        if (!$customer) {
            return null;
        }

        return new Customer($customer);
    }

    /**
     * Gets the default payment method for a Recharge customer
     *
     * @param int $rechargeCustomerId
     * @return null|PaymentMethod
     * @throws Exception
     */
    public function getCustomerDefaultPaymentMethod(int $rechargeCustomerId): ?PaymentMethod
    {
        $data = collect(
            $this->call(
                'GET',
                '/payment_methods?customer_id=' . $rechargeCustomerId,
                ['limit' => 3]
            )->payment_methods ?? []
        );

        return $data->filter(fn($p) => $p->default)
            ->transform(fn($data) => new PaymentMethod($data))
            ->first();
    }

    /**
     * Update the customer in Recharge, identified by the given Shopify ID, with the given array of values
     *
     * @param int $shopifyCustomerId
     * @param array $updateValues the key-value array of data to update. e.g. ["email" => "foo@bar.baz", "first_name" => "Foo"]
     * @return bool success or fail in updating all given values
     * @throws Exception
     */
    public function updateCustomer(int $shopifyCustomerId, array $updateValues): bool
    {
        $customer = $this->getRechargeCustomer($shopifyCustomerId);

        if (is_null($customer)) {
            throw new Exception("No Recharge customer found for Shopify ID $shopifyCustomerId");
        }

        $customerData = $this->call(
            'PUT',
            "/customers/{$customer->id}",
            $updateValues
        )?->customer ?? null;

        if (is_null($customerData)) {
            return false;
        }

        $allUpdated = true;
        foreach ($updateValues as $key => $value) {
            if ($customerData->$key != $value) {
                Log::error(
                    "[Recharge\API] Customer data for $key was not updated for customer with Shopify ID $shopifyCustomerId"
                );
                $allUpdated = false;
            }
        }
        return $allUpdated;
    }

    public function getSubscriptions($shopifyCustomerId): Collection
    {
        $response = $this->call('GET', '/subscriptions', [
            'shopify_customer_id' => $shopifyCustomerId,
            'limit' => 250
        ], apiVersion: self::API_VERSION_2021_01);
        try {
            return collect(
                $response?->subscriptions
            )->map(function ($subscription) {
                return new Subscription($subscription);
            });
        } catch (Exception $e) {
            Log::error("RechargeGateway:getSubscriptions: " . $e->getMessage());
            Log::error(print_r($response, true));
            throw $e;
        }
    }

    public function cancelSubscription(
        Subscription $subscription,
        $cancelReason,
        $cancelReasonComments = '',
        $sendEmail = true
    ): void {
        $this->call('POST', "/subscriptions/$subscription->id/cancel", [
            'cancellation_reason' => $cancelReason,
            'cancellation_reason_comments' => $cancelReasonComments,
            'send_email' => $sendEmail
        ]);
        $subscription->status = RechargeSubscriptionStatusEnum::Cancelled->value;
        $subscription->cancellationReason = $cancelReason;
        $subscription->createdAt = Carbon::now();
    }

    public function createTestCustomer(User $user)
    {
        if (app()->isProduction()) {
            throw new \Exception("Not for production use");
        }
        $response = $this->call(
            'POST',
            "/customers",
            [
                'email' => $user->email,
                //'external_customer_id' => ['ecommerce' => "$user->shopify_id"],
                // 'shopify_customer_id' => $user->shopify_id,
                'first_name' => 'Test',
                'last_name' => 'Test',
                "billing_address1" => "3030 Nebraska Avenue",
                "billing_city" => "Los Angeles",
                "billing_country" => "United States",
                "billing_first_name" => "Mike",
                "billing_last_name" => "Flynn",
                "billing_phone" => "3103843698",
                "billing_province" => "California",
                "billing_zip" => "90404",
                "stripe_customer_token" => "Customer_payment_token"
            ],
            apiVersion: self::API_VERSION_2021_01
        );
        return $response->customer->id;
    }

    public function createTestAddress(User $user, int $customerId)
    {
        if (app()->isProduction()) {
            throw new \Exception("Not for production use");
        }
        $response = $this->call(
            'POST',
            "/addresses",
            [
                'customer_id' => $customerId,
                'address1' => '123 Test Street',
                'city' => 'Los Angeles',
                'first_name' => 'Test',
                'last_name' => 'Test',
                'phone' => '',
                'zip' => '90404',
                'province' => 'California',
                'country' => 'US'
            ],
            apiVersion: self::API_VERSION_2021_01
        );
        return $response->address->id;
    }

    public function createTestSubscription(User $user, Product $product, Carbon $nextChargeScheduledAt): void
    {
        if (app()->isProduction()) {
            throw new \Exception("Not for production use");
        }
        $customerId = $this->createTestCustomer($user);

        $addressId = $this->createTestAddress($user, $customerId);

        switch ($product->digital_access_time_interval_type) {
            case 'day':
                $unitFrequency = $product->digital_access_time_interval_length;
                $unitType = 'day';
                break;
            case 'month':
                $unitFrequency = $product->digital_access_time_interval_length;
                $unitType = 'month';
                break;
            case 'year':
                $unitFrequency = $product->digital_access_time_interval_length * 12;
                $unitType = 'month';
                break;
            default:
                throw new \Exception("Unsupported digital access interval type");
        }

        $result = $this->call(
            'POST',
            "/subscriptions",
            [
                'customer_id' => $customerId,
                'address_id' => $addressId,
                'next_charge_scheduled_at' => $nextChargeScheduledAt->isoFormat('YYYY-MM-DD'),
                'order_interval_frequency' => $unitFrequency,
                'order_interval_unit' => $unitType,
                'charge_interval_frequency' => $unitFrequency,
                'charge_interval_unit_type' => $unitType,
                //'external_variant_id' => $product->shopify_id,
                'shopify_variant_id' => $product->shopify_id,
                'quantity' => 1,
            ],
            apiVersion: self::API_VERSION_2021_01
        );
    }

    /**
     * Get all subscriptions with the given status that were
     * created within the date range between createdAtMin and createdAtMax.
     *
     * @param string $status
     * @param CarbonInterface $createdAtMin
     * @param CarbonInterface $createdAtMax
     * @param int $limit
     *
     * @return Collection
     * @throws Exception
     */
    public
    function getSubscriptionsByStatus(
        string $status,
        CarbonInterface $createdAtMin,
        CarbonInterface $createdAtMax,
        int $limit = 250
    ): Collection {
        // ensure that the status is one that Recharge supports. Refer to https://developer.rechargepayments.com/2021-11/subscriptions/subscriptions_object
        $validStatuses = ['active', 'cancelled', 'expired'];
        if (!in_array($status, $validStatuses)) {
            throw new Exception("Invalid status $status. Must be one of: " . implode(', ', $validStatuses));
        }

        $response = $this->call('GET', '/subscriptions', [
            'status' => $status,
            'created_at_min' => $createdAtMin->toDateString(),
            'created_at_max' => $createdAtMax->toDateString(),
            'limit' => $limit
        ], apiVersion: self::API_VERSION_2021_01);

        try {
            return collect(
                $response?->subscriptions
            )->map(function ($subscription) {
                return new Subscription($subscription);
            });
        } catch (Exception $e) {
            Log::error("RechargeGateway:getSubscriptionsByStatus: " . $e->getMessage());
            Log::error(print_r($response, true));
            throw $e;
        }
    }

    public
    function updateSubscriptionNextChargeDate(
        $subscription,
        Carbon $nextChargeDate
    ): void {
        $this->call(
            'POST',
            "/subscriptions/$subscription->id/set_next_charge_date",
            ['date' => $nextChargeDate->isoFormat('YYYY-MM-DD')]
        );
    }

    public function updateSubscriptionProduct($subscription, Product $product): void
    {
        if ($subscription->shopifyVariantId == $product->shopify_id) {
            return;
        }
        $result = $this->call(
            'PUT',
            "/subscriptions/$subscription->id",
            [
                'shopify_variant_id' => $product->shopify_id,
                'price' => $product->price,
            ],
            apiVersion: self::API_VERSION_2021_01
        );
    }

    /**
     * @throws Exception
     */
    public
    function createWebhook(
        array $data
    ): array {
        $response = $this->call(
            'POST',
            "/webhooks",
            $data
        );
        if (!$response->webhook) {
            throw new Exception("Error creating webhook: " . print_r($response, true));
        }
        return [
            'id' => $response->webhook->id,
            'address' => $response->webhook->address,
            'topic' => $response->webhook->topic
        ];
    }

    /**
     * @throws Exception
     */
    public
    function getWebhooks(): array
    {
        $response = $this->call(
            'GET',
            "/webhooks",
        );

        return $response->webhooks ?? [];
    }

    /**
     * @throws Exception
     */
    public
    function deleteWebhook(
        $id
    ): void {
        $this->call(
            'DELETE',
            "/webhooks/$id",
        );
    }
}
