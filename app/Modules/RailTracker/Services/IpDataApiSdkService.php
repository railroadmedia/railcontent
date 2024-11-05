<?php

namespace App\Modules\RailTracker\Services;

/*
 * SDK for ipdata.co
 *
 * See their docs:
 * https://docs.ipdata.co/api-reference/bulk-lookup
 */

use Http;

class IpDataApiSdkService
{
    public static $apiBulkLimit = 100;

    /**
     * @param array $ips
     * @return array|bool
     */
    public function bulkRequest($ips)
    {
        if(empty($ips)){
            return [];
        }

        $chunksOfIps = array_chunk($ips, self::$apiBulkLimit);

        foreach($chunksOfIps as $chunkOfIps){
            $ipsInCurrentChunk = array_values($chunkOfIps);

            try{
                $response = $this->send(json_encode($ipsInCurrentChunk));
            }catch(\Exception $exception){
                error_log($exception);
                return false;
            }

            $response = json_decode($response);

            if (is_array($response)) {
                foreach($response as $r){
                    $responseAllArrays[] = (array) $r;
                }
            }
        }

        return $responseAllArrays ?? [];
    }

    // internally-used helper functions --------------------------------------------------------------------------------

    /**
     * @throws ConnectionException
     */
    private function send($postFields)
    {
        $apiKey = config('railtracker.ip_data_api_key');
        $url = 'https://api.ipdata.co/bulk?api-key=' . $apiKey;

        $response = Http::timeout(5)
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->post($url, $postFields);

        return $response->body();
    }
}
