<?php

namespace App\Modules\Ecommerce\Gateways;

use App\Modules\Ecommerce\Enums\RechargeSubscriptionStatusEnum;
use App\Modules\Ecommerce\Models\Recharge\Customer;
use App\Modules\Ecommerce\Models\Recharge\Subscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Log;

class RechargeGateway
{
    private const API_VERSION_2021_11 = '2021-11';
    private const API_VERSION_2021_01 = '2021-01';
    private $access_token = '';

    private $ch;

    public function __construct()
    {
        $this->access_token = config('shopify.recharge.access_token');
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
                Log::warning('[Recharge\API] Sleeping for 1 seconds (429 Too Many Requests / Method 1)');
                sleep(1);
                $retry = true;
                continue;
            }

            if (isset($result->warning) && $result->warning == "too many requests") {
                Log::warning('[Recharge\API] Sleeping for 1 seconds (Too Many Requests / Method 2)');
                sleep(1);
                $retry = true;
                continue;
            }

            if (isset($returnInfo['HTTP_CODE']) && strpos($returnInfo['HTTP_CODE'], 'HTTP/1.1 409 CONFLICT') > -1) {
                Log::warning('[Recharge\API] Sleeping for 1 seconds (409 Conflict)');
                sleep(1);
                $retry = true;
                continue;
            }

            if (isset($returnInfo['HTTP_CODE']) && strpos($returnInfo['HTTP_CODE'], 'HTTP/1.1 400 BAD REQUEST') > -1) {
                if (isset($result->errors) && isset($result->errors->UNEXPECTED_VARIANT_ERROR_TYPE)) {
                    if (strpos(
                            $result->errors->UNEXPECTED_VARIANT_ERROR_TYPE,
                            'Shopify returned 429 rate limit regarding this call'
                        ) > -1) {
                        Log::info('[Recharge\API] Sleeping for 1 seconds (Shopify 429)');
                        sleep(1);
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
                    Log::warning('[Recharge\API] Sleeping for 1 seconds (429 Too Many Requests / Method 2)');
                    sleep(1);
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
     * Get the customer from Recharge, for the given Shopify ID
     *
     * @param  int  $shopifyCustomerId
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
            Log::error($e->getMessage());
            return null;
        }

        if ($customers->isEmpty()) {
            return null;
        }

        // transform into our model
        $customers->transform(fn ($customerData) => new Customer($customerData));

        // in case there are multiple customers with that shopify id, we should log it for investigation
        if ($customers->count() > 1) {
            Log::error("[Recharge\API] {$customers->count()} customers found for $shopifyCustomerId");
            // sort them so we can grab the latest entry
            $customers = $customers->sortByDesc("createdAt");
        }

        return $customers->first();
    }

    /**
     * Update the customer in Recharge, identified by the given Shopify ID, with the given array of values
     *
     * @param  int  $shopifyCustomerId
     * @param  array  $updateValues the key-value array of data to update. e.g. ["email" => "foo@bar.baz", "first_name" => "Foo"]
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
        foreach($updateValues as $key => $value) {
          if ($customerData->$key != $value) {
              Log::error("[Recharge\API] Customer data for $key was not updated for customer with Shopify ID $shopifyCustomerId");
              $allUpdated = false;
          }
        }
        return $allUpdated;
    }

    public function getSubscriptions($shopifyCustomerId) : Collection
    {
        $response = $this->call('GET', '/subscriptions', [
            'shopify_customer_id' => $shopifyCustomerId,
            'limit' => 250
        ], apiVersion: self::API_VERSION_2021_01);
        try {
            return collect(
                $response?->subscriptions
            )->map(function($subscription) {
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

    public function updateSubscriptionNextChargeDate($subscription, Carbon $nextChargeDate): void
    {
        $this->call(
            'POST',
            "/subscriptions/$subscription->id/set_next_charge_date",
            ['date' => $nextChargeDate->isoFormat('YYYY-MM-DD')]
        );
    }
}
