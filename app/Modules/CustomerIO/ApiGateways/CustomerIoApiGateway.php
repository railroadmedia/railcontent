<?php

namespace App\Modules\CustomerIO\ApiGateways;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerIoApiGateway
{
    /**
     * If the email is passed, the customers with the given ID will have their email updated to the passed value.
     * Attributes are set and unset using a value or empty value. If you pass an empty array no attributes will be added
     * or removed. If you want to unset an existing attribute it must be passed with a null value.
     *
     * @param string $customerIoSiteId
     * @param string $customerIoTrackApiKey
     * @param string $emailAddress
     * @param string|null $customerId
     * @param array|null $attributes
     * @param int|null $createdAtTimestamp
     * @throws Exception
     */
    public function addOrUpdateCustomer(
        string $customerIoSiteId,
        string $customerIoTrackApiKey,
        string $emailAddress,
        ?string $customerId,
        ?array $attributes = [],
        ?int $createdAtTimestamp = null
    ): void {
        $url = 'https://track.customer.io/api/v1/customers/' . $emailAddress;
        $method = 'PUT';

        $dataArray = $attributes;

        if (!empty($customerId)) {
            $dataArray['id'] = $customerId;
        }

        if (!empty($createdAtTimestamp)) {
            $dataArray['created_at'] = $createdAtTimestamp;
        }

        $authHeaderKey = base64_encode($customerIoSiteId . ':' . $customerIoTrackApiKey);

        try {
            $this->executeRequest($url, $method, $authHeaderKey, 'Basic', [], $dataArray);
        } catch (Exception $e) {
            Log::error('CustomerIoApiGateway::addOrUpdateCustomer() failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * @param string $customerIoAppApiKey
     * @param string $customerEmail
     * @return mixed
     * @throws Exception
     */
    public function getCustomer(
        string $customerIoAppApiKey,
        string $customerEmail
    ): array {
        $url = 'https://beta-api.customer.io/v1/api/customers/' . $customerEmail . '/attributes?id_type=email';
        $method = 'GET';

        try {
            $result = $this->executeRequest($url, $method, $customerIoAppApiKey, 'Bearer', []);
            if (!empty($result['errors']) || !isset($result['customer'])) {
                throw new Exception('CustomerIoApiGateway::getCustomer() failed: ' . var_export($result, true), 404);
            }
            return $result['customer'];
        } catch (Exception $e) {
            Log::error('CustomerIoApiGateway::getCustomer() failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * @param string $customerIoSiteId
     * @param string $customerIoTrackApiKey
     * @param string $customerEmail
     * @param string $eventName
     * @param array|null $eventData // key value pairs
     * @param string|null $eventType
     * @param int|null $createdAtTimestamp
     * @return bool
     * @throws Exception
     */
    public function createEvent(
        string $customerIoSiteId,
        string $customerIoTrackApiKey,
        string $customerEmail,
        string $eventName,
        ?array $eventData = [],
        ?string $eventType = null,
        ?int $createdAtTimestamp = null
    ): bool {
        $url = 'https://track.customer.io/api/v1/customers/' . $customerEmail . '/events';
        $method = 'POST';

        $dataArray = [
            'name' => $eventName,
        ];

        if (!empty($eventData)) {
            $dataArray['data'] = $eventData;
        }

        if (!empty($eventType)) {
            $dataArray['type'] = $eventType;
        }

        if (!empty($createdAtTimestamp)) {
            $dataArray['timestamp'] = $createdAtTimestamp;
        }

        $authHeaderKey = base64_encode($customerIoSiteId . ':' . $customerIoTrackApiKey);

        $result = $this->executeRequest($url, $method, $authHeaderKey, 'Basic', [], $dataArray);

        // empty result means success for some reason...
        if ($result !== []) {
            throw new Exception('CustomerIoApiGateway::createEvent() api call failed: ' . var_export($result, true));
        }

        return true;
    }

    /**
     * https://customer.io/docs/api/#operation/getPersonActivities
     *
     * @param string $customerIoAppApiKey
     * @param string $customerEmail
     * @param string|null $type
     * @param string|null $name
     * @param int|null $limit
     * @param string|null $startToken
     * @return mixed
     * @throws Exception
     */
    public function getCustomerActivities(
        string $customerIoAppApiKey,
        string $customerEmail,
        ?string $type = null,
        ?string $name = null,
        ?int $limit = 10,
        ?string $startToken = null
    ): array {
        $params = $this->createActivitiesQueryParams($type, $name, $limit, $startToken);

        $params['id_type'] = 'email';

        $paramsString = http_build_query($params);

        $url = 'https://beta-api.customer.io/v1/api/customers/' . $customerEmail . '/activities?' . $paramsString;
        $method = 'GET';

        $result = $this->executeRequest($url, $method, $customerIoAppApiKey, 'Bearer', []);

        // empty result means success for some reason...
        if (!empty($result['errors'])) {
            throw new Exception(
                'CustomerIoApiGateway::getCustomerActivities() api call failed: ' . var_export($result, true),
                404
            );
        }

        return $result['activities'];
    }

    /**
     * @param string $customerIoAppApiKey ,
     * @param string $customerIoTransactionalMessageId
     * @param string $customerEmail
     * @param array|null $messageDataArray
     * @return bool
     * @throws Exception
     */
    public function sendTransactionalEmail(
        string $customerIoAppApiKey,
        string $customerIoTransactionalMessageId,
        string $customerEmail,
        ?array $messageDataArray = []
    ): bool {
        $url = 'https://api.customer.io/v1/send/email';
        $method = 'POST';

        $dataArray = [
            'to' => $customerEmail,
            'transactional_message_id' => $customerIoTransactionalMessageId,
            'message_data' => $messageDataArray,
            'identifiers' => [
                'email' => $customerEmail,
            ],
        ];

        $result = $this->executeRequest($url, $method, $customerIoAppApiKey, 'Bearer', [], $dataArray);

        if (!empty($result['delivery_id'])) {
            throw new Exception(
                'CustomerIoApiGateway::sendTransactionalEmail() api call failed: ' . var_export($result, true)
            );
        }

        return true;
    }

    /**
     * Customers can have more than one device.
     * This method adds iOS and Android devices, or updates devices for, a customer profile.
     *
     * @param string $customerIoSiteId
     * @param string $customerIoTrackApiKey
     * @param string $customerEmail
     * @param array $deviceData
     * @param int|null $createdAtTimestamp
     * @throws Exception
     */
    public function addOrUpdateCustomerDevice(
        string $customerIoSiteId,
        string $customerIoTrackApiKey,
        string $customerEmail,
        array $deviceData,
        ?int $createdAtTimestamp = null
    ): void {
        $url = 'https://track.customer.io/api/v1/customers/' . $customerEmail . '/devices';
        $method = 'PUT';

        $dataArray['device'] = $deviceData;

        if (!empty($createdAtTimestamp)) {
            $dataArray['device']['last_used'] = $createdAtTimestamp;
        }


        $authHeaderKey = base64_encode($customerIoSiteId . ':' . $customerIoTrackApiKey);

        $result = $this->executeRequest($url, $method, $authHeaderKey, 'Basic', [], $dataArray);

        // empty result means success for some reason...
        if ($result !== []) {
            throw new Exception(
                'CustomerIoApiGateway::addOrUpdateCustomerDevice() api call failed: ' . var_export($result, true)
            );
        }
    }

    /**
     * https://customer.io/docs/merge-people/
     *
     * @param string $customerIoSiteId
     * @param string $customerIoTrackApiKey
     * @param string $primaryCustomerEmail
     * @param string $secondaryCustomerEmail
     * @return bool
     * @throws Exception
     */
    public function mergeCustomers(
        string $customerIoSiteId,
        string $customerIoTrackApiKey,
        string $primaryCustomerEmail,
        string $secondaryCustomerEmail
    ): bool {
        $url = 'https://track.customer.io/api/v1/merge_customers';
        $method = 'POST';

        $dataArray = [
            'primary' => ['email' => $primaryCustomerEmail],
            'secondary' => ['email' => $secondaryCustomerEmail],
        ];

        $authHeaderKey = base64_encode($customerIoSiteId . ':' . $customerIoTrackApiKey);

        $result = $this->executeRequest($url, $method, $authHeaderKey, 'Basic', [], $dataArray);

        if ($result !== []) {
            throw new Exception('CustomerIoApiGateway::mergeCustomers() api call failed: ' . var_export($result, true));
        }

        return true;
    }


    /**
     * @param string $customerIoSiteId
     * @param string $customerIoTrackApiKey
     * @param string $customerEmail
     * @return void
     * @throws Exception
     */
    public function deleteCustomer(
        string $customerIoSiteId,
        string $customerIoTrackApiKey,
        string $customerEmail
    ): void {
        $url = 'https://track.customer.io/api/v1/customers/' . $customerEmail;
        $method = 'DELETE';

        $authHeaderKey = base64_encode($customerIoSiteId . ':' . $customerIoTrackApiKey);

        $headers = [];
        $headers[] = 'Authorization: Basic ' . $authHeaderKey;
        $headers[] = 'Content-Type: application/json';

        $result = $this->executeRequest($url, $method, $authHeaderKey, 'Basic', $headers);

        if ($result !== []) {
            throw new Exception('CustomerIoApiGateway::deleteCustomer() api call failed: ' . var_export($result, true));
        }
    }

    /**
     * @param string $customerIoAppApiKey
     * @param string|null $type
     * @param string|null $name
     * @param int|null $limit
     * @param string|null $startToken
     * @return array
     * @throws Exception
     */
    public function getActivities(
        string $customerIoAppApiKey,
        ?string $type = null,
        ?string $name = null,
        ?int $limit = 10,
        ?string $startToken = null
    ): array {
        $params = $this->createActivitiesQueryParams($type, $name, $limit, $startToken);

        $paramsString = http_build_query($params);

        $url = 'https://beta-api.customer.io/v1/api/activities?' . $paramsString;
        $method = 'GET';

        $result = $this->executeRequest($url, $method, $customerIoAppApiKey, 'Bearer', []);

        if (!$result['errors']) {
            throw new Exception(
                'CustomerIoApiGateway::getActivities() api call failed: ' . var_export($result, true),
                404
            );
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function addProfilesToSegment(
        string $customerIoSiteId,
        string $customerIoTrackApiKey,
        int $segmentId,
        array $customerIds,
    ): void {
        $url = 'https://track.customer.io/api/v1/segments/' . $segmentId . '/add_customers?id_type=id';
        $method = 'POST';

        $dataArray = [
            'ids' => array_values($customerIds),
        ];

        $authHeaderKey = base64_encode($customerIoSiteId . ':' . $customerIoTrackApiKey);

        $result = $this->executeRequest($url, $method, $authHeaderKey, 'Basic', [], $dataArray);

        if ($result !== []) {
            throw new Exception(
                'CustomerIoApiGateway::addProfilesToSegment() api call failed: ' . var_export($result, true)
            );
        }
    }

    /**
     * @param string $url
     * @param string $method
     * @param string $authToken
     * @param string $authStrategy
     * @param array|null $headers
     * @param array|null $dataArray
     * @return array
     * @throws Exception
     */
    public function executeRequest(
        string $url,
        string $method,
        string $authToken,
        string $authStrategy,
        ?array $headers = [],
        ?array $dataArray = []
    ): array {
        $result = null;

        $body = json_encode($dataArray);
        try {
            $request = Http::withHeaders($headers)->withToken($authToken, $authStrategy);

            $result = match ($method) {
                'GET' => $request->accept('application/json')->get($url),
                'PUT' => $request->withBody($body, 'application/json')->put($url),
                'POST' => $request->withBody($body, 'application/json')->post($url),
                'DELETE' => $request->delete($url)
            };
        } catch (Exception $e) {
            Log::error(
                'CustomerIoApiGateway::executeRequest: exception while reaching: ' . $url
                    . ' - ' . $e->getMessage()
                    . ' - Request payload: ' . $body
            );
            Log::debug(print_r($e->getTrace(), true));
            throw $e;
        }

        $response = $result->json();

        if (!$result->ok()) {
            Log::error(
                'CustomerIoApiGateway::executeRequest() api call failed: ' . $url
                    . ' - ' . $result->reason()
                    . ' - Result: ' . var_export($result->json(), true)
                    . ' - Request data: ' . $body,
            );
            throw new Exception(
                'CustomerIoApiGateway::executeRequest() api call failed: ' . $url
                    . ' - ' . $result->reason()
                    . ' - Result: ' . var_export($result->json(), true)
                    . ' - Request data: ' . $body,
                $result->status()
            );
        }

        if ($method !== 'GET' && $response !== []) {
            throw new Exception('CustomerIoApiGateway::executeRequest() api call failed: ' . var_export($response, true));
        }


        return $response;
    }

    /**
     * @param string|null $type
     * @param string|null $name
     * @param int|null $limit
     * @param string|null $startToken
     * @return array
     */
    public function createActivitiesQueryParams(?string $type, ?string $name, ?int $limit, ?string $startToken): array
    {
        $params = [];

        if (!empty($type)) {
            $params['type'] = $type;
        }
        if (!empty($name)) {
            $params['name'] = $name;
        }
        if (!empty($limit)) {
            $params['limit'] = $limit;
        }
        if (!empty($startToken)) {
            $params['start'] = $startToken;
        }
        return $params;
    }
}
