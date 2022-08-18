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

    /**
     * @param $skus
     * @return array
     */
    public static function getProductIdsBySku($skus)
    {
        $products = self::getProductIdsKeyedBySku();

        $ids = [];

        foreach ($skus as $sku) {
            if (!empty($products[$sku])) {
                $ids[] = $products[$sku]->id;
            }
        }

        return $ids;
    }

    public static function membershipProductIds()
    {
        return [
            'drumeo' => self::getProductIdsBySku([
                'DLM-1-month',
                'DLM-1-year',
                'DLM-Trial-1-month',
                'DLM-Trial-Annual-30-Day',
                'DLM-Trial-Annual-7-Day',
                'DLM-6-month',
                'DLM-teachers-1-year',
                'DLM-teachers-upgrade-1-month',
                'DLM-teachers-upgrade-1-year',
                'DLM-3-month',
                'DLM-UPSELL-2-month',
                'DLM-Trial-Best-Book-1-month',
                'edge-membership-6-months',
                'DLM-Trial-Drummers-Toolbox-1-month',
                'DLM-Lifetime',
                'drumeo_edge_30_days_access',
                'drumeo_access_30-days',
                'DLM-Trial-30-Day',
                'drumeo_edge_1_year_access',
            ]),
            'pianote' => self::getProductIdsBySku([
                'PIANOTE-MEMBERSHIP-1-MONTH',
                'PIANOTE-MEMBERSHIP-1-YEAR',
                'PIANOTE-MEMBERSHIP-LIFETIME',
                'PIANOTE-MEMBERSHIP-LIFETIME-EXISTING-MEMBERS',
                '1-DOLLAR',
                'PIANOTE-MEMBERSHIP-6-MONTH',
                'PIANOTE-MEMBERSHIP-TRIAL',
                'PIANOTE-MEMBERSHIP-TRIAL-30-DAY',
                'PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL',
                'PIANOTE-MEMBERSHIP-TRIAL-30-DAY-ANNUAL',
                'pianote_membership_90_days_access',
                'PIANOTE-1-YEAR-MEMBERSHIP-ACCESS',
                'pianote_access_30-days',
            ]),
            'guitareo' => self::getProductIdsBySku([
                'GUITAREO-1-MONTH-MEMBERSHIP',
                'GUITAREO-1-YEAR-MEMBERSHIP',
                'GUITAREO-6-MONTH-MEMBERSHIP',
                'GUITAREO-6-MONTH-ACCESS',
                'GUITAREO-1-DOLLAR-1-MONTH-ACCESS',
                'GUITAREO-LIFETIME-MEMBERSHIP',
                'GUITAREO-7-DAY-TRIAL-ONE-TIME',
                'GUITAREO-1-YEAR-MEMBERSHIP-ACCESS',
                'guitareo_access_30-days',
                'guitareo-annual-recurring-30-day-trial-membership',
                'guitareo-monthly-recurring-30-day-trial-membership',
                'guitareo-annual-recurring-7-day-trial-membership',
            ]),
            'singeo' => self::getProductIdsBySku([
                'singeo-monthly-recurring-membership',
                'singeo-annual-recurring-membership',
                'singeo-1-year-membership-access',
                'singeo-lifetime-membership-access',
                'singeo-monthly-recurring-30-day-trial-membership',
                'singeo-annual-recurring-30-day-trial-membership',
                'singeo-monthly-recurring-7-day-trial-membership',
                'singeo-annual-recurring-7-day-trial-membership',
                'singeo_access_30-days',
                'singeo_access_90-days',
                'singeo-6-month-recurring-membership',
            ]),
        ];
    }
}
