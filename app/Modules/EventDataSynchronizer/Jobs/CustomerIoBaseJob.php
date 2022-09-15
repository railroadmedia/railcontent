<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;

class CustomerIoBaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     */
    public function failed(Exception $exception)
    {
        error_log($exception);

        $this->fail($exception);
    }

    public function reconnectToMySQLDatabases()
    {
//        /**
//         * @var $databaseManager DatabaseManager
//         */
//        $databaseManager = app(DatabaseManager::class);
//
//        $databaseManager->reconnect(config('customer-io.database_connection_name'));
//        $databaseManager->reconnect(config('railcontent.database_connection_name'));
//
//        $ecommerceEntityManager = app(EcommerceEntityManager::class);
//        $ecommerceEntityManager->getConnection()->close();
//        $ecommerceEntityManager->getConnection()->connect();
    }
}
