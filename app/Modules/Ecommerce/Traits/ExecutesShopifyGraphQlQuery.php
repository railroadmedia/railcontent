<?php

namespace App\Modules\Ecommerce\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\Shopify;

trait ExecutesShopifyGraphQlQuery
{
    protected ?LastQueryCost $lastQueryCost = null;

    /**
     * Execute the query with Shopify
     *
     * @param  string  $gql
     * @return mixed
     * @throws Exception
     */
    public function executeQuery(string $gql): mixed
    {
        $shopify = $this->getShopifyConnection();
        $this->handleRateLimitBefore();
        $gqlUrl = $shopify->getBaseUrl()."/graphql.json";
        $pollResponse = $shopify->graphQl()->post($gqlUrl, ["query" => $gql]);
        if ($pollResponse->successful()) {
            $responseBody = json_decode($pollResponse->body());
            // check for any errors
            $responseErrors = $responseBody->errors ?? [];
            if (!empty($responseErrors)) {
                throw new Exception(
                    sprintf(
                        "%s: Error(s) returned: %s",
                        get_class(),
                        collect($responseErrors)->implode("message", " ")
                    )
                );
            }
            $this->lastQueryCost = new LastQueryCost($responseBody->extensions->cost) ?? null;
        } else {
            throw new Exception(
                sprintf(
                    "%s: Error(s) returned: %s",
                    get_class(),
                    $pollResponse->reason()
                )
            );
        }

        return $responseBody;
    }

    /**
     * Get the Shopify connection to use.
     *
     * @return Shopify
     */
    abstract protected function getShopifyConnection(): Shopify;

    /**
     * Check the GraphQL rate limit. If we're going to exceed the limit, log it and sleep.
     *
     * @return void
     */
    protected function handleRateLimitBefore(): void
    {
        $lastQueryCost = $this->lastQueryCost;
        if (!$lastQueryCost) {
            return;
        }
        $rateLimitThresholdPercentage = config('shopify.rate_limit_gql.threshold_percentage');
        $rateLimitSleepTime = config('shopify.rate_limit_gql.sleep_time');

        $current = $lastQueryCost->throttleStatus->currentlyAvailable;
        $max = $lastQueryCost->throttleStatus->maximumAvailable;
        $percentageUsed = round(($max - $current) / $max * 100, 1);

        if ($percentageUsed > $rateLimitThresholdPercentage) {
            Log::debug("Shopify Graph QL availability: $current/$max ($percentageUsed%)");
            Log::warning(
                sprintf(
                    "About to hit Shopify Graph QL API rate limit. Sleeping for %s %s...",
                    $rateLimitSleepTime,
                    Str::plural("second", $rateLimitSleepTime)
                )
            );
            sleep($rateLimitSleepTime);
        }
    }
}

class LastQueryCost
{
    public int $requestedQueryCost;
    public int $actualQueryCost;
    public ThrottleStatus $throttleStatus;

    public function __construct(\stdClass $data)
    {
        $this->requestedQueryCost = $data->requestedQueryCost;
        $this->actualQueryCost = $data->actualQueryCost;
        $this->throttleStatus = new ThrottleStatus(...get_object_vars($data->throttleStatus));
    }
}

class ThrottleStatus
{
    public function __construct(
        public float $maximumAvailable,
        public int $currentlyAvailable,
        public float $restoreRate
    ) {
    }
}
