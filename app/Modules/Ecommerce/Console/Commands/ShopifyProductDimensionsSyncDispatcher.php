<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldOwnerTypeEnum;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\CreateMissingMetafieldDefinition;
use App\Modules\Ecommerce\Jobs\Shopify\SyncProductDimensionMetafieldsToShopify;
use App\Modules\Ecommerce\Models\Shopify\MetaFieldDefinition;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ShopifyProductDimensionsSyncDispatcher extends Command
{
    protected $signature = 'shopify:product-dimensions
                            {--execute : Execute this operation to Shopify. Without this flag, it will be simulated.}';

    protected $description = 'Dispatch jobs to sync dimensions for product variants in Shopify';

    private bool $simulate;
    private const SKU = 'SKU';
    private const LENGTH = 'Length';
    private const WIDTH = 'Width';
    private const HEIGHT = 'Height';

    /**
     * @throws Throwable
     */
    public function handle(): int
    {
        $this->simulate = $this->option("execute") == false;
        try {
            $this->groupProducts();
        } catch (Exception $e) {
            return self::FAILURE;
        }

        // first, add the jobs to ensure the metafields exist in Shopify
        $jobs = $this->createMetafieldJobs();

        // next, add a job for each entry
        $this->groupProducts()->each(function ($group) use (&$jobs) {
            // we know that all entries have the same dimensions, so just grab the first one
            $jobs[] = new SyncProductDimensionMetafieldsToShopify(
                skus: $group->pluck(self::SKU)->toArray(),
                length: $group->first()[self::LENGTH],
                width: $group->first()[self::WIDTH],
                height: $group->first()[self::HEIGHT],
                simulate: $this->simulate
            );
        });

        $startAt = Carbon::now();
        Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("ProductDimensionsSync: Completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();
        return self::SUCCESS;
    }

    /**
     * Group the product dimensions so that product variants are together
     *
     * @return Collection
     * @throws Exception
     */
    private function groupProducts(): Collection
    {
        $allDimensions = collect($this->dimensions);

        // group all entries, so that those that are (probably) variants of the same product
        // (i.e. clothing with sizes) are together
        // DEV NOTE: we can't group other, less consistent things (like colour), because matching off the last '-'
        // is too unreliable
        $groupedDimensions = $allDimensions->groupBy(function ($item) {
            $sku = Str::of($item[self::SKU]);
            if ($sku->lower()->endsWith(['-xxs', '-xs', '-s', '-m', '-xl', '-xxl'])) {
                return $sku->beforeLast('-');
            }
            return $sku;
        });

        $isValid = true;
        // check each grouping to ensure the dimensions all match
        $groupedDimensions->each(function ($entries, $sku) use (&$isValid) {
            if ($entries->count() > 1) {
                $firstItem = $entries->first();
                $allSame = $entries->every(function ($dimensions) use ($firstItem) {
                    return $dimensions[self::LENGTH] === $firstItem[self::LENGTH] &&
                        $dimensions[self::WIDTH] === $firstItem[self::WIDTH] &&
                        $dimensions[self::HEIGHT] === $firstItem[self::HEIGHT];
                });
                if (!$allSame) {
                    $isValid = false;
                    $this->error("$sku has an inconsistency");
                }
            }
        });

        if (!$isValid) {
            throw new Exception("Grouped dimensions were not consistent");
        }

        return $groupedDimensions;
    }

    /**
     * Get the list of jobs to create missing Metafields
     *
     * @return array<CreateMissingMetafieldDefinition>
     */
    private function createMetafieldJobs(): array
    {
        return [
            new CreateMissingMetafieldDefinition(
                new MetaFieldDefinition(
                    "Length",
                    null,
                    ShopifyMetafieldKey::ProductLength,
                    ShopifyMetafieldTypes::decimal,
                    ShopifyMetafieldNamespace::Model_Products,
                    ShopifyMetafieldOwnerTypeEnum::ProductVariant
                ),
                $this->simulate
            ),
            new CreateMissingMetafieldDefinition(
                new MetaFieldDefinition(
                    "Width",
                    null,
                    ShopifyMetafieldKey::ProductWidth,
                    ShopifyMetafieldTypes::decimal,
                    ShopifyMetafieldNamespace::Model_Products,
                    ShopifyMetafieldOwnerTypeEnum::ProductVariant
                ),
                $this->simulate
            ),
            new CreateMissingMetafieldDefinition(
                new MetaFieldDefinition(
                    "Height",
                    null,
                    ShopifyMetafieldKey::ProductHeight,
                    ShopifyMetafieldTypes::decimal,
                    ShopifyMetafieldNamespace::Model_Products,
                    ShopifyMetafieldOwnerTypeEnum::ProductVariant
                ),
                $this->simulate
            ),
            new CreateMissingMetafieldDefinition(
                new MetaFieldDefinition(
                    "Length",
                    null,
                    ShopifyMetafieldKey::ProductLength,
                    ShopifyMetafieldTypes::decimal,
                    ShopifyMetafieldNamespace::Model_Products,
                    ShopifyMetafieldOwnerTypeEnum::Product
                ),
                $this->simulate
            ),
            new CreateMissingMetafieldDefinition(
                new MetaFieldDefinition(
                    "Width",
                    null,
                    ShopifyMetafieldKey::ProductWidth,
                    ShopifyMetafieldTypes::decimal,
                    ShopifyMetafieldNamespace::Model_Products,
                    ShopifyMetafieldOwnerTypeEnum::Product
                ),
                $this->simulate
            ),
            new CreateMissingMetafieldDefinition(
                new MetaFieldDefinition(
                    "Height",
                    null,
                    ShopifyMetafieldKey::ProductHeight,
                    ShopifyMetafieldTypes::decimal,
                    ShopifyMetafieldNamespace::Model_Products,
                    ShopifyMetafieldOwnerTypeEnum::Product
                ),
                $this->simulate
            )
        ];
    }

    // dimensions provided by Pushp - stored within this command rather than needing to store and read a CSV
    private array $dimensions = [
        [
            self::SKU => '100-days-of-practice-poster',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => '102130368',
            self::LENGTH => 15.0,
            self::WIDTH => 15.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => '102140127',
            self::LENGTH => 18.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 10.0,
        ],
        [
            self::SKU => '1021701010',
            self::LENGTH => 16.0,
            self::WIDTH => 6.0,
            self::HEIGHT => 6.0,
        ],
        [
            self::SKU => '30-day-drummer-black-tshirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => '30-day-drummer-black-tshirt-xl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => '30-day-drummer-black-tshirt-xxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => '30-day-drummer-ponytail-hat',
            self::LENGTH => 8.0,
            self::WIDTH => 8.0,
            self::HEIGHT => 8.0,
        ],
        [
            self::SKU => '30-day-drummer-silhouette-tshirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => '3604-nl-jersey-ringer-tee-vintage-shirt-M',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => '3939-full-zip-minimalist-hoodie-M',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => '628130152',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => '8885-hooded-vintage-pullover-hoodie-M',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'accented-rhythm-shirt-s',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'accented-rhythm-shirt-xxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'alesis-ekit',
            self::LENGTH => 21.5,
            self::WIDTH => 37.6,
            self::HEIGHT => 12.8,
        ],
        [
            self::SKU => 'BBDB_Hardcover',
            self::LENGTH => 12.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'chords-scales-poster',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'christmas-songbook',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'christmas-song-book',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'classical-book',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'classical-piano-pieces',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'doremi-hoodie-l',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'doremi-hoodie-m',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'doremi-hoodie-s',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'doremi-hoodie-xl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'doremi-hoodie-xxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Drumeo 30DDs3 Black Pullover Hoodie M',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Drumeo 30DDs3 Black Standard Tee S',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Drumeo 30DDs3 Grey Silhoutte Tee M',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Drumeo 30DDs3 Plaid Shirt M',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Drumeo 30DDs3 Ponytail Hat',
            self::LENGTH => 8.0,
            self::WIDTH => 8.0,
            self::HEIGHT => 8.0,
        ],
        [
            self::SKU => 'Drumeo 30DDs3 Satin Baseball Jacket M',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Drumeo EarDRUM In-Ear Monitors',
            self::LENGTH => 7.0,
            self::WIDTH => 5.0,
            self::HEIGHT => 5.0,
        ],
        [
            self::SKU => 'drumeo-badge-hat',
            self::LENGTH => 8.0,
            self::WIDTH => 8.0,
            self::HEIGHT => 8.0,
        ],
        [
            self::SKU => 'Drumeo-Beanie',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-cozy-line-art-crewneck-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-cozy-line-art-crewneck-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-cozy-line-art-crewneck-s',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-cozy-line-art-crewneck-xl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-eardrums',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-eardrums-black',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Drumeo-Hat',
            self::LENGTH => 8.0,
            self::WIDTH => 8.0,
            self::HEIGHT => 8.0,
        ],
        [
            self::SKU => 'Drumeo-Mug',
            self::LENGTH => 5.0,
            self::WIDTH => 5.0,
            self::HEIGHT => 5.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-hoodie-l',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-hoodie-m',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-hoodie-s',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-hoodie-xl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-hoodie-xs',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-hoodie-xxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-hoodie-xxxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-shirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-shirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-shirt-s',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-shirt-xl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-shirt-xs',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-shirt-xxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-pop-art-shirt-xxxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-the-foiled-water-bottle',
            self::LENGTH => 16.0,
            self::WIDTH => 4.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'Drumeo-VaterSticks',
            self::LENGTH => 12.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Drumeo-Water-Bottle',
            self::LENGTH => 16.0,
            self::WIDTH => 4.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-shirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-shirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-shirt-s',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-shirt-xl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-shirt-xxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-shirt-xxxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-socks',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-sweater-l',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-sweater-m',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-sweater-s',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-sweater-xl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-sweater-xs',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-sweater-xxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'drumeo-yuletide-knit-sweater-xxxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'eardrums-warranty',
            self::LENGTH => 7.0,
            self::WIDTH => 5.0,
            self::HEIGHT => 5.0,
        ],
        [
            self::SKU => 'easy-rudiments-book',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Estapario Sticks',
            self::LENGTH => 12.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'floral-mug',
            self::LENGTH => 5.0,
            self::WIDTH => 5.0,
            self::HEIGHT => 5.0,
        ],
        [
            self::SKU => 'floral-mug-2',
            self::LENGTH => 5.0,
            self::WIDTH => 5.0,
            self::HEIGHT => 5.0,
        ],
        [
            self::SKU => 'guitareo-the-foiled-water-bottle',
            self::LENGTH => 16.0,
            self::WIDTH => 4.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'guitarists-survival-kit',
            self::LENGTH => 12.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'hoodie-grand-piano-red-s',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'ind4000-retro-hoodie-L',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'ind4000-retro-hoodie-M',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'ind4000-retro-hoodie-S',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'ind4000-retro-hoodie-XL',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'ind4000-retro-hoodie-XXL',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'ind4000-retro-hoodie-XXXL',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'JW-4T4I-JU1Y',
            self::LENGTH => 12.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'little-book-arpeggios',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'little-book-chord',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'little-book-hanon',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'maelzel-metronome',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'mouth-mug',
            self::LENGTH => 5.0,
            self::WIDTH => 5.0,
            self::HEIGHT => 5.0,
        ],
        [
            self::SKU => 'mr-piano-tshirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'mr-piano-tshirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'mr-piano-tshirt-s',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'mr-piano-tshirt-xl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'music-theory-posters',
            self::LENGTH => 15.0,
            self::WIDTH => 15.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'padstand',
            self::LENGTH => 16.0,
            self::WIDTH => 6.0,
            self::HEIGHT => 6.0,
        ],
        [
            self::SKU => 'piano-chords-and-scales-guide',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Pianote Bench Shirt Next Level- Black Triblend L',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Pianote Bench Shirt Next Level- Black Triblend M',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Pianote Bench Shirt Next Level- Black Triblend S',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'Pianote Bench Shirt Next Level- Black Triblend XS',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-badge-hat',
            self::LENGTH => 8.0,
            self::WIDTH => 8.0,
            self::HEIGHT => 8.0,
        ],
        [
            self::SKU => 'pianote-book-bag',
            self::LENGTH => 18.0,
            self::WIDTH => 16.0,
            self::HEIGHT => 6.0,
        ],
        [
            self::SKU => 'pianote-cozy-line-art-crewneck-l',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-cozy-line-art-crewneck-m',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-cozy-line-art-crewneck-s',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-cozy-line-art-crewneck-xl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-cozy-line-art-crewneck-xs',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-hat-l',
            self::LENGTH => 8.0,
            self::WIDTH => 8.0,
            self::HEIGHT => 8.0,
        ],
        [
            self::SKU => 'pianote-hat-s',
            self::LENGTH => 8.0,
            self::WIDTH => 8.0,
            self::HEIGHT => 8.0,
        ],
        [
            self::SKU => 'pianote-headphones',
            self::LENGTH => 14.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 6.0,
        ],
        [
            self::SKU => 'pianote-pop-art-hoodie-l',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-hoodie-m',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-hoodie-s',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-hoodie-xl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-hoodie-xxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-shirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-shirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-shirt-s',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-shirt-xl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-shirt-xs',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-shirt-xxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-pop-art-shirt-xxxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-practice-planner',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-practice-planner-signed',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-sketchy-mug',
            self::LENGTH => 5.0,
            self::WIDTH => 5.0,
            self::HEIGHT => 5.0,
        ],
        [
            self::SKU => 'pianote-the-foiled-water-bottle',
            self::LENGTH => 16.0,
            self::WIDTH => 4.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-shirt-l',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-shirt-m',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-shirt-s',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-shirt-xl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-shirt-xxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-shirt-xxxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-socks',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-sweater-l',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-sweater-m',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-sweater-s',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-sweater-xl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-sweater-xs',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-sweater-xxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'pianote-yuletide-knit-sweater-xxxl',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'poster-chords',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'poster-scales',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'practicepad',
            self::LENGTH => 12.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'quietkick',
            self::LENGTH => 12.0,
            self::WIDTH => 6.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'quietkick-beater',
            self::LENGTH => 12.0,
            self::WIDTH => 6.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'quietkick-double-bass',
            self::LENGTH => 12.0,
            self::WIDTH => 6.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'quietkick-hard-pad',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'quietkick-soft-pad',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'quietpad',
            self::LENGTH => 15.0,
            self::WIDTH => 15.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'quietpad-color-burst-green',
            self::LENGTH => 15.0,
            self::WIDTH => 15.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'quietpad-color-burst-orange',
            self::LENGTH => 15.0,
            self::WIDTH => 15.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'quietpad-color-burst-purple',
            self::LENGTH => 15.0,
            self::WIDTH => 15.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'quietpad-color-burst-turquoise',
            self::LENGTH => 15.0,
            self::WIDTH => 15.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'quietpad-estepario',
            self::LENGTH => 15.0,
            self::WIDTH => 15.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'read-music-in-30-days-workbook',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-hoodie-L',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-hoodie-M',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-hoodie-S',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-hoodie-XL',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-hoodie-XXL',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-shirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-shirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-shirt-s',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-shirt-xl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'retro-shirt-xxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'singeo-the-foiled-water-bottle',
            self::LENGTH => 16.0,
            self::WIDTH => 4.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'singing-straw',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sketchy-drums-2-shirt-L',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sketchy-drums-2-shirt-M',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sketchy-drums-2-shirt-S',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sketchy-drums-2-shirt-XL',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sketchy-drums-2-shirt-XXL',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sketchy-drums-2-shirt-XXXL',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'stickbag',
            self::LENGTH => 24.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'stickbag-ltd',
            self::LENGTH => 24.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'student-of-the-month-tumbler',
            self::LENGTH => 12.0,
            self::WIDTH => 6.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'studio-box',
            self::LENGTH => 18.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 8.0,
        ],
        [
            self::SKU => 'sunrise-shirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sunrise-shirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sunrise-shirt-s',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sunrise-shirt-xxxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sunset-shirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sunset-shirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sunset-shirt-xl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sunset-shirt-xxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'sunset-shirt-xxxl',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'survival-guide',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'taktell-piccolo-metronome',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'the-bench-shirt-l',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'the-bench-shirt-m',
            self::LENGTH => 9.0,
            self::WIDTH => 7.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'the-drummers-toolbox-book',
            self::LENGTH => 12.0,
            self::WIDTH => 12.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'tone-control-kit',
            self::LENGTH => 12.0,
            self::WIDTH => 6.0,
            self::HEIGHT => 4.0,
        ],
        [
            self::SKU => 'vowel-sounds-poster',
            self::LENGTH => 12.0,
            self::WIDTH => 9.0,
            self::HEIGHT => 3.0,
        ],
        [
            self::SKU => 'wallflower-tumbler',
            self::LENGTH => 16.0,
            self::WIDTH => 4.0,
            self::HEIGHT => 4.0,
        ],
    ];
}
