<?php

namespace App\Modules\Crux;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Railroad\Ecommerce\Repositories\ProductRepository;

class ProductAccessMap
{

    public static $internalProductsBySkuCache = false;

    /**
     * @return array|bool|mixed
     */
    public static function getProductIdsKeyedBySku()
    {
        if (self::$internalProductsBySkuCache === false) {
            $cached = Cache::get('drumeo_getProductIdsKeyedBySku');

            if (!empty($cached)) {
                self::$internalProductsBySkuCache = $cached;
            } else {
                self::$internalProductsBySkuCache =
                    DB::connection(config('ecommerce.database_connection_name'))
                        ->table('ecommerce_products')
                        ->get(['id', 'sku'])
                        ->keyBy('sku')
                        ->toArray();

                Cache::add('drumeo_getProductIdsKeyedBySku', self::$internalProductsBySkuCache, 15);
            }
        }

        if (self::$internalProductsBySkuCache === false) {
            self::$internalProductsBySkuCache = [];
        }

        return self::$internalProductsBySkuCache;
    }

    public static function foo()
    {
        DB::connection(config('ecommerce.database_connection_name'))
            ->table('ecommerce_products')
            ->get(['id', 'sku'])
            ->keyBy('sku')
            ->toArray();
    }
}
