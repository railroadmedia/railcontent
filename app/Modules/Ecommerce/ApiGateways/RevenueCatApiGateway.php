<?php

namespace App\Modules\Ecommerce\ApiGateways;

use Exception;

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
        curl_close($ch);

        $result = json_decode($apiResponse);

        return $result;
    }
}
