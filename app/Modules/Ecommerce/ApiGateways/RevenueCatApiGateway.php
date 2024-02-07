<?php

namespace App\Modules\Ecommerce\ApiGateways;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class RevenueCatApiGateway
{
    /**
     * @param $appUserId
     * @return mixed
     * @throws Exception
     */
    public function getSubscriber(
        $appUserId
    ) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.revenuecat.com/v1/subscribers/'.$appUserId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = [];
        $headers[] = 'Authorization: Bearer '.config('ecommerce.revenuecat.ios')['Musora'];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $apiResponse = curl_exec($ch);

        $result = json_decode($apiResponse);

        if (curl_errno($ch)) {
            throw new Exception('RevenueCat api call failed: '.curl_error($ch));
        }

        // empty result means success for some reason...
        if (!empty($result->errors) || empty($result->subscriber)) {
            throw new Exception(
                'RevenueCat api call failed: '.curl_error($ch).' - '.var_export($result, true), 404
            );
        }

        curl_close($ch);

        return $result->subscriber;
    }

    /**
     * @param $userId
     * @param $productIdentifier
     * @return mixed
     */
    public function revoke(
        $userId,
        $productIdentifier
    )
    {
        $ch = curl_init();

        curl_setopt(
            $ch,
            CURLOPT_URL,
            'https://api.revenuecat.com/v1/subscribers/'.$userId.'/subscriptions/'.$productIdentifier.'/revoke'
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

        $headers = [];
        $headers[] = 'Authorization: Bearer '.config('ecommerce.revenuecat_secret_key');
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $apiResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            Log::debug(
                'Error in revoke API '.
                $productIdentifier.
                ' for '.
                $userId.
                ' on Revenuecat(user access revoked from Google Play Console)   ::: '.curl_error($ch)
            );
        }

        Log::debug(
            'RevenueCat REVOKE API response: '.var_export($apiResponse, true)
        );

        $result = json_decode($apiResponse);

        // empty result means success for some reason...
        if (!empty($result->errors) || empty($result->subscriber)) {
            Log::debug(
                'RevenueCat REVOKE API call failed: '.curl_error($ch).' - '.var_export($result, true)
            );
        }

        curl_close($ch);

        return $result;
    }

    /**
     * @param $receipt
     * @param $user
     * @param $productId
     * @param $platform
     * @param null $localPrice
     * @param null $currency
     * @param string $app
     * @return string
     */
    public function sendRequest(
        $receipt,
        $user,
        $productId,
        $platform,
        $localPrice = null,
        $currency = null,
        $app = 'Musora'
    ) {
        $client = new \GuzzleHttp\Client();
        $userId = $user->getId();
        $bod = [
            'product_id' => $productId,
            'app_user_id' => "$userId",
            'fetch_token' => $receipt,
            'price' => $localPrice,
            'currency' => $currency,
            'observer_mode' => 'true',
            'attributes' => [
                'email' => [
                    'value' => $user->getEmail(),
                ],
            ],
        ];

        try {
            $response = $client->request('POST', 'https://api.revenuecat.com/v1/receipts', [
                'body' => json_encode($bod),
                'headers' => [
                    'X-Platform' => $platform,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer '.config('ecommerce.revenuecat.'.$platform)[$app],
                ],
            ]);
        } catch (GuzzleException $exception) {
            error_log($exception->getMessage());

            return $exception->getMessage();
        }

        return $response->getBody()
            ->getContents();
    }

    /**
     * @param $receipt
     * @param null $productId
     * @param $platform
     * @param null $localPrice
     * @param null $currency
     * @param string $app
     * @param null $userEmail
     * @param null $userId
     * @return string
     */
    public function purchase(
        $receipt,
        $productId = null,
        $platform,
        $localPrice = null,
        $currency = null,
        $app = 'Musora',
        $userEmail = null,
        $userId = null
    ) {
        $client = new \GuzzleHttp\Client();

        $bod = [
            'product_id' => $productId,
            'fetch_token' => $receipt,
            'price' => $localPrice,
            'currency' => $currency,
            'observer_mode' => 'true',
            'attributes' => [
                'email' => [
                    'value' => $userEmail,
                ],
            ],
        ];
        if ($userId) {
            $bod['app_user_id'] = "$userId";
        }

        try {
            $response = $client->request('POST', 'https://api.revenuecat.com/v1/receipts', [
                'body' => json_encode($bod),
                'headers' => [
                    'X-Platform' => $platform,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer '.config('ecommerce.revenuecat.'.$platform)[$app],
                ],
            ]);
        } catch (GuzzleException $exception) {
            error_log($exception->getMessage());

            return $exception->getMessage();
        }

        return $response->getBody()
            ->getContents();
    }

    /**
     * @param $userId
     * @param $attributes
     * @param $platform
     * @param string $app
     * @return string
     */
    public function updateSubscriberAttribute($userId, $attributes,  $platform, $app = 'Musora')
    {
        $client = new \GuzzleHttp\Client();
        $att = [];
        foreach ($attributes as $key => $value) {
            $att[$key] = [
                'value' => $value,
            ];
        }
        $bod = [
            'attributes' => $att,
        ];

        try {
            $response = $client->request('POST', 'https://api.revenuecat.com/v1/subscribers/'.$userId.'/attributes', [
                'body' => json_encode($bod),
                'headers' => [
                    'X-Platform' => $platform,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer '.config('ecommerce.revenuecat.'.$platform)[$app],
                ],
            ]);
        } catch (GuzzleException $exception) {
            error_log($exception->getMessage());

            return $exception->getMessage();
        }

        return $response->getBody()
            ->getContents();
    }

}
