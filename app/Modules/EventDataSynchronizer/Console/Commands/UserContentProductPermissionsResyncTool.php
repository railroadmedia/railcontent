<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use App\Modules\EventDataSynchronizer\Listeners\UserProductToUserContentPermissionListener;

class UserContentProductPermissionsResyncTool extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'UserContentProductPermissionsResyncTool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'UserContentProductPermissionsResyncTool';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UserContentProductPermissionsResyncTool {productId}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        DatabaseManager $databaseManager,
        UserProductToUserContentPermissionListener $userProductToUserContentPermissionListener
    ) {
        $productId = $this->argument('productId');
        $ecommerceConnection = $databaseManager->connection(config('ecommerce.database_connection_name'));

        $query = $ecommerceConnection->table('ecommerce_user_products')
            ->join('ecommerce_products', 'ecommerce_products.id', '=', 'ecommerce_user_products.product_id')
            ->where('ecommerce_user_products.product_id', '=', $productId)
            ->orderBy('ecommerce_user_products.id', 'desc');

        $done = 0;

        $query->chunk(250, function (Collection $userProductRows) use (
            $userProductToUserContentPermissionListener,
            &$done
        ) {
            foreach ($userProductRows as $userProductRow) {
                $userProductToUserContentPermissionListener->syncUserId($userProductRow->user_id);
                $done++;
            }
            $this->info('Done ' . $done);
        });
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
