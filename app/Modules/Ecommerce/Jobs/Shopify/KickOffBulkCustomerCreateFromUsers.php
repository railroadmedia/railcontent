<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\FindsCustomersForUsers;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\StagesUploadToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsShopifyCustomer;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Signifly\Shopify\Shopify;

/**
 * KickOffBulkCustomerCreateFromUsers kicks off the process to perform a bulk operation in Shopify to create new
 * customers, using data from our users that have not yet been synced. This is done through a job so that we can offload
 * the process and free up the calling command.
 */
class KickOffBulkCustomerCreateFromUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable, LogsShopify;

    //TODO DELETEME TEST
    public $timeout = 30;
    protected CustomerRepository $customerRepository;
    protected AddressRepository $addressRepository;
    protected Shopify $shopify;

    /**
     * @param bool $execute are we executing this process, or simulating?
     */
    public function __construct(protected bool $execute)
    {
    }

    public function handle(CustomerRepository $customerRepository, AddressRepository $addressRepository, Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->shopify = $shopify;

        //TODO DELETEME TEST
        $i = 0;
        $this->batch()->add(Collection::times(100, function () use (&$i) {
            return new TestJob(++$i);
        }));


        // $usersToCreate = $this->getUsersToCreateQuery();
        //
        // $batchSize = 500;
        // $this->logInfo(sprintf("Found %s users to be created in Shopify.", $usersToCreate->count()));
        // $this->logInfo("Dispatching jobs to sync users ...");
        //
        // $usersToCreate->chunk($batchSize, function (Collection $users) {
        //     $this->batch()->add(new BulkCustomerCreateFromUsers($users, $this->execute));
        // });
    }

    /**
     * Get the query builder that we'll use to get all users to create in Shopify
     *
     * @return Builder
     */
    private function getUsersToCreateQuery(): Builder
    {
        return User::query()
            ->whereNull("shopify_id")
            //TODO TESTING ONLY
            ->limit(24)
            ;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncBulkCustomersToShopify";
    }
}
