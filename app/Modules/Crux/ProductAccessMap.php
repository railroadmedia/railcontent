<?php

namespace App\Modules\Crux;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\MembershipAction;
use Railroad\Ecommerce\Repositories\MembershipActionRepository;
use Railroad\Ecommerce\Repositories\ProductRepository;

class ProductAccessMap
{
    public static $internalProductsBySkuCache = false;
    private static $hasClaimedRetentionOfferWithinCache = [];

    public static function productsGrantingAllContentAccess()
    {
        // todo: implement cache

        $results = DB::connection(config('ecommerce.database_connection_name'))
            ->table('ecommerce_products')
            ->whereIn('digital_access_type', ['all content access', 'basic content access'])
            ->get(['id', 'sku'])
        ;//->toArray();

        return $results;
    }

    public static function productsGrantingAllContentAccessIdsOnly()
    {
        // todo: implement cache

        $results = self::productsGrantingAllContentAccess();

        foreach ($results as $result) {
            $ids[] = $result->id;
        }

        return $ids;
    }

    public static function productsGrantingSpecificContentAccess()
    {
        // todo: implement cache

        $results = DB::connection(config('ecommerce.database_connection_name'))
            ->table('ecommerce_products')
            ->where('digital_access_type', 'specific content access')
            ->get(['id', 'sku'])
        ;//->toArray();

        return $results;
    }

    public static function annualSubscriptionPrice()
    {
        // todo: implement cache

        $result = DB::connection(config('ecommerce.database_connection_name'))
            ->table('ecommerce_products')
            ->where('sku', 'PIANOTE-MEMBERSHIP-1-YEAR')
            ->get(['price'])
            ->first();

        if ($result && !empty($result->price)) {
            return $result->price;
        }

        return null;
    }

    /**
     * @return array
     */
    public static function trialMembershipProductIds()
    {

        return self::getProductIdsBySku(
            array_merge(
                [ // SELECT CONCAT(`id`, ', // ', `sku`) FROM `ecommerce_products` WHERE `brand` LIKE 'drumeo' AND (`type` LIKE 'digital subscription' OR `sku` LIKE '%edge%')
                    'DLM-Trial-Annual-30-Day',
                    'DLM-Trial-Annual-7-Day',
                    'DLM-Trial-1-month',
                    'DLM-Trial-Best-Book-1-month',
                    'DLM-Trial-Drummers-Toolbox-1-month',
                    'DLM-Trial-30-Day',
                ],
                [
                    'PIANOTE-MEMBERSHIP-TRIAL',
                    'PIANOTE-MEMBERSHIP-TRIAL-30-DAY',
                    'PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL',
                    'PIANOTE-MEMBERSHIP-TRIAL-30-DAY-ANNUAL',
                ],
                [ // select id, sku from ecommerce_products where brand = 'guitareo' and `name` like '%trial%'
                    'GUITAREO-7-DAY-TRIAL-ONE-TIME', # 23
                    'guitareo-annual-recurring-7-day-trial-membership', # 429
                    'guitareo-monthly-recurring-30-day-trial-membership', # 430
                    'guitareo-annual-recurring-30-day-trial-membership', # 431
                ],
                [ // select id, sku from ecommerce_products where brand = 'singeo' and `name` like '%trial%'
                    'singeo-monthly-recurring-30-day-trial-membership', # 413
                    'singeo-annual-recurring-30-day-trial-membership', # 414
                    'singeo-monthly-recurring-7-day-trial-membership', # 423
                    'singeo-annual-recurring-7-day-trial-membership', # 424
                ]
            )
        );
    }


    /**
     * If the user has claimed a retention offer in the last X months, return true, otherwise return false.
     * We use this to prevent people from abusing claiming a free month over and over.
     *
     * @param int $numberOfMonthsAgo
     * @return boolean
     */
    public static function hasClaimedRetentionOfferWithin(User $user, $numberOfMonthsAgo = 6)
    {
        if (isset(self::$hasClaimedRetentionOfferWithinCache[$numberOfMonthsAgo])) {
            return self::$hasClaimedRetentionOfferWithinCache[$numberOfMonthsAgo];
        }

        /**
         * @var $membershipActionRepository MembershipActionRepository
         */
        $membershipActionRepository = app(MembershipActionRepository::class);

        /*
         * note that this *should* accept a second parameter but doing so returns a QueryException "Too many parameters:
         * the query defines 1 parameters and you bound 2"
         */
        $membershipActions = $membershipActionRepository->getAllUsersMembershipActions($user->id);

        $actionIsWithinThreshold = false;

        foreach ($membershipActions as $membershipAction) {
            $matchAction = in_array($membershipAction->getAction(), [
                MembershipAction::ACTION_EXTEND_FOR_AMOUNT_OF_DAYS,
                MembershipAction::ACTION_EXTEND_FOR_AMOUNT_OF_DAYS_GRATIS_FOR_RETENTION,
                MembershipAction::ACTION_EXTEND_FOR_AMOUNT_OF_MONTHS,
                MembershipAction::ACTION_EXTEND_FOR_AMOUNT_OF_MONTH_GRATIS_FOR_RETENTION,
                MembershipAction::ACTION_SWITCH_TO_NEW_PRICE,
                MembershipAction::ACTION_SWITCH_TO_NEW_PRICE_IN_CENTS,
                MembershipAction::ACTION_SWITCH_BILLING_INTERVAL_TO_MONTHLY,
            ]);

            if ($matchAction) {
                $actionCreated = Carbon::parse($membershipAction->getCreatedAt());
                $threshold = Carbon::now()->subMonths($numberOfMonthsAgo);
                $actionIsWithinThreshold = $actionCreated > $threshold;
            }
        }

        self::$hasClaimedRetentionOfferWithinCache[$numberOfMonthsAgo] = $actionIsWithinThreshold;

        return $actionIsWithinThreshold;
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    /**
     * @return array|bool|mixed
     */
    public static function getAllProductIdsKeyedBySku()
    {
        if (self::$internalProductsBySkuCache === false) {
            $cached = Cache::get('getProductIdsKeyedBySku');

            if (!empty($cached)) {
                self::$internalProductsBySkuCache = $cached;
            } else {
                self::$internalProductsBySkuCache =
                    DB::connection(config('ecommerce.database_connection_name'))
                        ->table('ecommerce_products')
                        ->get(['id', 'sku'])
                        ->keyBy('sku')
                        ->toArray();

                Cache::add('getProductIdsKeyedBySku', self::$internalProductsBySkuCache, 15);
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
        $products = self::getAllProductIdsKeyedBySku();

        $ids = [];

        foreach ($skus as $sku) {
            if (!empty($products[$sku])) {
                $ids[] = $products[$sku]->id;
            }
        }

        return $ids;
    }
}
