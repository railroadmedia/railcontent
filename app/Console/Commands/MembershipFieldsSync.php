<?php

namespace App\Console\Commands;

use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class MembershipFieldsSync extends Command
{
    protected $name = 'MembershipFieldsSync';

    protected $signature = 'MembershipFieldsSync {productId} {skip?} {chunkSize?}';

    protected $description = 'run UserMembershipFieldsSync->sync() for all users owning a product';

    private $connection;

    public function handle(
        DatabaseManager $databaseManager,
        UserMembershipFieldsService $userMembershipFieldsService
    ) {
        // ----------------------------------------------------------------
        // this matters
        // ----------------------------------------------------------------

        $connection = $databaseManager->connection('musora_laravel_mysql');
        $this->connection = $connection;

        $productId = $this->argument('productId');

        // ----------------------------------------------------------------
        // this is basically fluff
        // ----------------------------------------------------------------

        $product = $this->connection->table('ecommerce_products')
            ->where('id', $productId)
            ->get()
            ->first();

        $skip = $this->argument('skip');
        $chunkSize = $this->argument('chunkSize');

        $this->info('product id ' . $productId . ' is "' . $product->name . '" (sku: "' . $product->sku . '")');

        if (!empty($skip)) {
            $this->info('"skip" argument supplied: ' . $skip);
        } else {
            $skip = 0;
            $this->info('"skip" is default value of ' . $skip);
        }

        if (!empty($chunkSize)) {
            $this->info('"chunkSize" argument supplied: ' . $chunkSize);
        } else {
            $chunkSize = 100;
            $this->info('"chunkSize" is default value of ' . $chunkSize);
        }

        // ----------------------------------------------------------------
        // this matters
        // ----------------------------------------------------------------

        $userIds = $this->connection->table('ecommerce_user_products')
            ->where('product_id', $productId)
            ->pluck('user_id');

        $this->info('Number of users to process here: ' . count($userIds));

        $chunkCounter = 0;

        foreach($userIds->chunk($chunkSize) as $chunk) {
            $chunkCounter++;
            if($skip) {
                if($chunkCounter < $skip) {
                    continue;
                }
            }
            $this->info('starting chunk ' . $chunkCounter . ' of ' . (ceil($userIds->count() / $chunkSize)));
            foreach($chunk as $userId) {
                $result = $userMembershipFieldsService->sync($userId);
                if(!$result) {
                    $this->info('$userMembershipFieldsService->sync for user id ' . $userId . ' returned a non true value');
                }
            }
        }

        return true;
    }
}
