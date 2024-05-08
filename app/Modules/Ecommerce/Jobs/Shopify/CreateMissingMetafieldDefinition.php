<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Models\Shopify\MetaFieldDefinition;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateMissingMetafieldDefinition implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected MetaFieldDefinition $metaFieldDefinition,
        protected bool $simulate
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @param  ShopifyGateway  $shopifyGateway
     * @return void
     * @throws Exception
     */
    public function handle(
        ShopifyGateway $shopifyGateway
    ): void {
        if ($shopifyGateway->doesMetaFieldDefinitionExist($this->metaFieldDefinition)) {
            Log::debug(
                sprintf(
                    "%s: Metafield Definition exists in Shopify for %s in %s namespace",
                    get_class($this),
                    $this->metaFieldDefinition->key,
                    $this->metaFieldDefinition->namespace
                )
            );
        } else {
            Log::debug(
                sprintf(
                    "%s: No Metafield Definition found in Shopify for %s in %s namespace.",
                    get_class($this),
                    $this->metaFieldDefinition->key,
                    $this->metaFieldDefinition->namespace
                )
            );
            if ($this->simulate) {
                Log::info(
                    sprintf(
                        "%s: (simulated) Created Metafield Definition in Shopify for %s in %s namespace.",
                        get_class($this),
                        $this->metaFieldDefinition->key,
                        $this->metaFieldDefinition->namespace
                    )
                );
            } else {
                $createResponse = $shopifyGateway->createMetaFieldDefinition($this->metaFieldDefinition);
                $createdMetafieldData = $createResponse->data->metafieldDefinitionCreate->createdDefinition;
                Log::info(
                    sprintf(
                        "%s: Created Metafield Definition in Shopify for %s in %s namespace.",
                        get_class($this),
                        $createdMetafieldData->key,
                        $createdMetafieldData->namespace
                    )
                );
            }
        }
    }
}
