<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Ecommerce\Events\UserProducts\UserProductCreated;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\UserProductRepository;


class RepairUserProductsFromReferral extends Command
{
    protected $signature = 'RepairUserProductsFromReferral';

    protected $description = 'Repart the product ids from ecommerce_user_products created from referral registrations on guitareo, pianote, singeo';

    public function handle(
        DatabaseManager $databaseManager,
        UserProductRepository $userProductRepository,
        ProductRepository $productRepository
    )
    {
        print_r("##### RepairUserProductsFromReferral command starts now ######\n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $correctProductIds = [];

        $correctProductIds['pianote'] = $dbConn->table('ecommerce_products')
            ->where('sku', 'pianote_access_30-days')
            ->value('id');

        $correctProductIds['guitareo'] = $dbConn->table('ecommerce_products')
            ->where('sku', 'guitareo_access_30-days')
            ->value('id');

        $correctProductIds['singeo'] = $dbConn->table('ecommerce_products')
            ->where('sku', 'singeo_access_30-days')
            ->value('id');

        $correctProductIds['drumeo'] = $dbConn->table('ecommerce_products')
            ->where('sku', 'drumeo_access_30-days')
            ->value('id');

        $referralReferrers = $dbConn->table('referral_referrers')
            ->select('claimed_user_ids', 'brand')
            ->where('brand', '!=', 'drumeo')
            ->where('referral_program_id', '!=', 'pianote-referral-30-day')  // old program id from legacy brand
            ->where('referrals_performed', '!=', 0)
            ->get();

        $userIds = [];
        $claimedIdsAndBrands = [];
        foreach($referralReferrers as $referralReferrer) {
            $claimedUserIds = explode(",", substr($referralReferrer->claimed_user_ids, 1, -1));
            foreach ($claimedUserIds as $claimUserId) {
                $claimedIdsAndBrands[$claimUserId] = $referralReferrer->brand;
            }
            $userIds = array_merge($userIds, $claimedUserIds);
        }

        $userProducts = $userProductRepository->findByUsersAndProduct($userIds, $correctProductIds['drumeo']);
        $correctProduct['pianote'] = $productRepository->findProduct($correctProductIds['pianote']);
        $correctProduct['guitareo'] = $productRepository->findProduct($correctProductIds['guitareo']);
        $correctProduct['singeo'] = $productRepository->findProduct($correctProductIds['singeo']);

        foreach ($userProducts as $userProduct) {
            $userProduct->setProduct($correctProduct[$claimedIdsAndBrands[$userProduct->getUser()->getId()]]);
            $userProductRepository->persist($userProduct);
            event(new UserProductCreated($userProduct));
        }

        print_r("##### RepairUserProductsFromReferral command has finished; " . count($userProducts) .
            " records have been updated in ecommerce_user_products table. ####\n");
    }

}
