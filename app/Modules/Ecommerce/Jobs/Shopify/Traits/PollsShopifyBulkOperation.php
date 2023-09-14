<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use App\Models\ShopifySync;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Signifly\Shopify\Shopify;

trait PollsShopifyBulkOperation
{

    protected Shopify $shopify;

    public function __construct(protected string $bulkOperationId,
                                protected ?ShopifySync $shopifySync,
                                protected string $sourceFileName,
                                protected int $secondsPassed = 0)
    {
    }

    /**
     * Poll Shopify for our bulk operation and return the applicable data in the form of a ShopifyPollResponse
     *
     * @return ShopifyPollResponse
     * @throws Exception
     */
    protected function pollShopify(): ShopifyPollResponse
    {
        // build up the GraphQL query string
        $gql = <<<GQL
            query {
                node(id: "$this->bulkOperationId") {
                    ... on BulkOperation {
                        id
                        status
                        errorCode
                        createdAt
                        completedAt
                        objectCount
                        fileSize
                        url
                        partialDataUrl
                    }
                }
            }
            GQL;

        $gqlUrl = $this->shopify->getBaseUrl() . "/graphql.json";
        $pollResponse = $this->shopify->graphQl()->post($gqlUrl, ["query" => $gql]);

        if ($pollResponse->successful()) {
            $responseBody = json_decode($pollResponse->body());

            // check for any errors
            $responseErrors = $responseBody->errors ?? $responseBody->data->customerCreate->userErrors ?? [];
            if (!empty($responseErrors)) {
                throw new Exception(sprintf("%s: Error(s) returned while attempting to poll status of BulkOperation %s: %s",
                    $this->getClassName(), $this->bulkOperationId, collect($responseErrors)->implode("message", " ")));
            }

            $values = $responseBody->data->node;
            return
                new ShopifyPollResponse($values->status,
                    new Carbon($values->createdAt),
                    $values->completedAt ? new Carbon($values->completedAt) : null,
                    $values->url
                );
        } else {
            throw new Exception(sprintf("%s: BulkOperation status poll failed for %s: %s",
                $this->getClassName(), $this->bulkOperationId, $pollResponse->reason()));
        }
    }

    /** Cancel this bulk operation in Shopify
     * @see https://shopify.dev/docs/api/usage/bulk-operations/imports#cancel-an-operation
     *
     * @return bool
     */
    protected function cancelShopifyOperation(): bool
    {
        // build up the GraphQL query string
        $gql = <<<GQL
            mutation {
              bulkOperationCancel(id: "$this->bulkOperationId") {
                bulkOperation {
                  status
                }
                userErrors {
                  field
                  message
                }
              }
            }
            GQL;

        $gqlUrl = $this->shopify->getBaseUrl() . "/graphql.json";
        $cancelResponse = $this->shopify->graphQl()->post($gqlUrl, ["query" => $gql]);
        return $cancelResponse->successful();
    }

    /**
     * Download the file from Shopify at the given url, and save it in our storage
     *
     * @param string $saveAs
     * @param string $url
     * @return bool
     */
    protected function downloadFile(string $saveAs, string $url): bool
    {
        if (app()->environment("local", "development")){
            $storageResult = Storage::put($saveAs, file_get_contents($url));
        } else {
            $storageResult = Storage::disk('musora_web_platform_s3')->put($saveAs, file_get_contents($url));
        }
        return $storageResult;
    }

    /**
     * Get the name of the class that called this job - useful for logging and exception messages
     *
     * @return string
     */
    abstract protected function getClassName(): string;
}
class ShopifyPollResponse {
    public function __construct(public string $status, public Carbon $createdAt, public ?Carbon $completedAt, public ?string $url)
    {
    }

    /**
     * Get the time in seconds for how long the bulk operation took to complete
     *
     * @return float|int|null
     */
    public function getRuntime(): float|int|null
    {
        if (is_null($this->completedAt)) {
            return null;
        }
        return $this->completedAt->diffInSeconds($this->createdAt);
    }
}
