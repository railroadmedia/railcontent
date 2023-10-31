<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Exception;
use Signifly\Shopify\Shopify;

trait StagesUploadToShopify
{
    // this would be a const, if we were on PHP 8.2
    // the keys of the response parameters that we'll need to return
    protected array $responseParameterKeys = [
        "Content-Type",
        "success_action_status",
        "acl",
        "key",
        "x-goog-date",
        "x-goog-credential",
        "x-goog-algorithm",
        "x-goog-signature",
        "policy"
    ];
    protected string $responseUrlKey = "url";

    /**
     * Create a staged upload with Shopify for the given file name.
     * Returns the applicable key/value pairs of data from the response, that can be used to push the file to the
     * expected staged area.
     *
     * @param string $filename
     * @return array
     * @throws Exception
     */
    protected function createStagedUpload(string $filename): array
    {
        $gql = <<<GQL
            mutation {
              stagedUploadsCreate(input:{
                resource: BULK_MUTATION_VARIABLES,
                filename: "$filename",
                mimeType: "text/jsonl",
                httpMethod: POST
              }){
                userErrors{
                  field,
                  message
                },
                stagedTargets{
                  url,
                  resourceUrl,
                  parameters {
                    name,
                    value
                  }
                }
              }
            }
            GQL;

        $gqlUrl = $this->getShopify()->getBaseUrl() . "/graphql.json";
        $response = $this->getShopify()->graphQl()->post($gqlUrl, ["query" => $gql]);

        if ($response->successful()) {
            $responseBody = json_decode($response->body());

            // check for any errors
            $responseErrors = $responseBody->errors ?? $responseBody->data->stagedUploadsCreate->userErrors ?? [];
            if (!empty($responseErrors)) {
                throw new Exception(sprintf("Error(s) found while attempting to call stagedUploadsCreate on Shopify for file %s: %s",
                    $filename, collect($responseErrors)->implode("message", " ")));
            }

            $parameterValues = [];
            // first insert the URL that we'll post the file to
            $parameterValues[$this->responseUrlKey] = $responseBody->data->stagedUploadsCreate->stagedTargets[0]->url;
            // grab the name/value pairs that we need from the parameters in the response
            $responseParameters = $responseBody->data->stagedUploadsCreate->stagedTargets[0]->parameters;
            foreach($responseParameters as $responseParameter) {
                if (in_array($responseParameter->name, $this->responseParameterKeys)) {
                    $parameterValues[$responseParameter->name] = $responseParameter->value;
                }
            }
            return $parameterValues;
        } else {
            throw new Exception(sprintf("Failed to call stagedUploadsCreate on Shopify for file %s", $filename));
        }
    }

    /**
     * The Shopify connection used to interact with Shopify
     * @return Shopify
     */
    abstract protected function getShopify(): Shopify;
}
