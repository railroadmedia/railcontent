<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class PopulateLegacyExpirationDate extends Command
{
    protected $signature = 'ecommerce:PopulateLegacyExpirationDate {--limit=1000000}';

    public function handle()
    {
        $limit = $this->option('limit');
        $this->withExecutionTime(function () use ($limit) {
            $total = $users = User::query()
                ->whereNull('membership_expiration_date')
                ->whereNull('legacy_expiration_date')->count();

            $this->info("Found $total users");
            $i = 0;
            $users = User::query()
                ->whereNull('membership_expiration_date')
                ->whereNull('legacy_expiration_date')
                ->limit($limit)->chunk(10000, function ($users) use ($total, &$i) {
                    foreach ($users as $user) {
                        $user->legacy_expiration_date = $this->getLegacyExpirationDate($user->id);
                        $user->save();
                        $i++;
                        Timer::afterSeconds(5, function () use ($total, $i) {
                            $this->info("Users processed ($i/$total)");
                        });
                    }
                });
        });
    }

    private function getLegacyExpirationDate(int $userId): ?Carbon
    {
        $userProducts = UserProduct::where('user_id', $userId)->get();
        $representingUserProduct = $this->getUserProductThatRepresentsUsersMembership($userId, $userProducts);
        if (!empty($representingUserProduct)) {
            $membershipExpirationDate = !empty($representingUserProduct->expiration_date)
                ? Carbon::parse($representingUserProduct->expiration_date)
                : null;
            return $membershipExpirationDate;
        }
        return null;
    }


    public function getUserProductThatRepresentsUsersMembership($userId, $usersProducts): ?UserProduct
    {
        $eligibleUserProducts = [];

        foreach ($usersProducts as $userProductIndex => $userProduct) {
            /** @var UserProduct $userProduct */
            // make sure the product is a membership product
            if (($userProduct->product->digital_access_type !==
                    Product::DIGITAL_ACCESS_TYPE_ALL_CONTENT_ACCESS &&
                    $userProduct->product->digital_access_type !==
                    'basic content access') ||
                $userProduct->user_id !== $userId) {
                continue;
            }

            $eligibleUserProducts[] = $userProduct;
        }

        // get attributes related to the latest user membership product
        $latestMembershipUserProductToSync = null;

        foreach ($eligibleUserProducts as $eligibleUserProductIndex => $eligibleUserProduct) {
            /** @var UserProduct $eligibleUserProduct */
            // if its lifetime, use it
            if (empty($eligibleUserProduct->expiration_date) &&
                $eligibleUserProduct->product->digital_access_time_type ==
                Product::DIGITAL_ACCESS_TIME_TYPE_LIFETIME &&
                (empty($latestMembershipUserProductToSync)
                    || $latestMembershipUserProductToSync->product->brand != "drumeo")
            ) {
                //prioritize drumeo over other lifetimes because they get some songs access
                $latestMembershipUserProductToSync = $eligibleUserProduct;
            }
        }

        if (!empty($latestMembershipUserProductToSync)) {
            return $latestMembershipUserProductToSync;
        }

        foreach ($eligibleUserProducts as $eligibleUserProductIndex => $eligibleUserProduct) {
            if (empty($latestMembershipUserProductToSync)) {
                $latestMembershipUserProductToSync = $eligibleUserProduct;
                continue;
            }

            // if this product expiration date is further in the past than whatever is currently set, skip it
            if (!empty($latestMembershipUserProductToSync) &&
                ($latestMembershipUserProductToSync->expiration_date <
                    $eligibleUserProduct->expiration_date)) {
                $latestMembershipUserProductToSync = $eligibleUserProduct;
            }
        }

        if (!empty($latestMembershipUserProductToSync)) {
            return $latestMembershipUserProductToSync;
        }

        return null;
    }
}
