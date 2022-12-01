<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AddMissingQuietPadsForBFOrders2022 extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'AddMissingQuietPadsForBFOrders2022';

    protected $signature = 'AddMissingQuietPadsForBFOrders2022';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AddMissingQuietPadsForBFOrders2022';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $connection = $databaseManager->connection(config('railcontent.database_connection_name'));

//        dd($connection->table('ecommerce_order_items')
//            ->whereBetween('created_at', ['2022-11-22 00:00:00', '2022-11-30 23:00:00'])
//            ->where('brand', 'drumeo')
//            ->where('final_price', 150)
//            ->count());

        $countWithoutQuietPad = 0;
        $rowDataForPadlessOrders = [];

        $orderItems = $connection->table('ecommerce_order_items')
            ->whereBetween('created_at', ['2022-11-23 00:00:00', '2022-11-30 00:00:00'])
            ->where('final_price', 150)
            ->where('product_id', 125)
            ->get(['id', 'order_id']);

        foreach ($orderItems as $orderItem) {
            $allOrdersItems = $connection->table('ecommerce_order_items')
                ->where('order_id', $orderItem->order_id)
                ->get();

            $hasQuietPad = false;

            // must also have sticks in the order
            $hasSticks = false;

            foreach ($allOrdersItems as $allOrdersItem) {
                if ($allOrdersItem->product_id == 278) {
                    $hasQuietPad = true;
                }
                if ($allOrdersItem->product_id == 320) {
                    $hasSticks = true;
                }
            }

            if (!$hasQuietPad && $hasSticks) {
                $countWithoutQuietPad++;

                $order = $allOrdersItems = $connection->table('ecommerce_orders')
                    ->find($orderItem->order_id);
                $user = $connection->table('usora_users')
                    ->find($order->user_id);

                $rowDataForPadlessOrders[] = [$user->email, $allOrdersItem->order_id];
            }
        }

        $fp = fopen('missing_pad_orders_bf_2022.csv', 'w');

        foreach ($rowDataForPadlessOrders as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);

        return true;
    }
}
