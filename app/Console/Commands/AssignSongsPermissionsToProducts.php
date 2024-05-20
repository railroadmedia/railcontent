<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;

class AssignSongsPermissionsToProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AssignSongsPermissionsToProducts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AssignSongsPermissionsToProducts';


    /**
     * Create a new command instance.
     *
     * @param DatabaseManager $databaseManager
     * @param ContentRepository $contentRepository
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting AssignSongsPermissionsToProducts...');

        $allBrandsLegacyMembershipPermissionNames = [
            'Drumeo Edge',
            'Pianote Membership',
            'Guitareo Membership',
            'Singeo Membership',
            'Recordeo Membership',
            'Musora Membership',
        ];

        $musoraBasicMembershipPermissionName = 'Musora Basic Membership';
        $musoraPlusMembershipPermissionName = 'Musora Plus Membership';

        $allProductRowsToConsider = $this->musoraDB()
            ->from('ecommerce_products')
            ->where('is_physical', false)
            ->where(function (Builder $builder) {
                return $builder->where('digital_access_type', 'all content access')
                    ->orWhere('digital_access_type', 'basic content access');
            })
            ->orderBy('id', 'asc')
            ->get();

        foreach ($allProductRowsToConsider as $productRow) {
            $productsExistingPermissionNames = json_decode($productRow->digital_access_permission_names);

            // for all products with a membership permission and all content access and not lifetime access
            if (count(
                array_intersect($allBrandsLegacyMembershipPermissionNames, $productsExistingPermissionNames)
            ) > 0 &&
                $productRow->digital_access_type == 'all content access' &&
                $productRow->digital_access_time_type != 'lifetime') {

                $productsExistingPermissionNames[] = $musoraPlusMembershipPermissionName;

                if (($musoraMembershipArrayKey = array_search('Musora Membership', $productsExistingPermissionNames)) !== false) {
                    unset($productsExistingPermissionNames[$musoraMembershipArrayKey]);
                }
            } elseif ($productRow->digital_access_type == 'basic content access') {
                // basic content products should only give permissions
                // to content with the basic permission added (not songs)
                $productsExistingPermissionNames = [$musoraBasicMembershipPermissionName];
            }

            // list
            $this->info('');
            $this->info('Final permissions for product SKU: ' . $productRow->name);

            foreach ($productsExistingPermissionNames as $productsExistingPermissionName) {
                $this->info(' - ' . $productsExistingPermissionName);
            }

            // update
            $this->musoraDB()
                ->from('ecommerce_products')
                ->where('id', $productRow->id)
                ->update(['digital_access_permission_names' => json_encode(array_values($productsExistingPermissionNames))]);
        }


        return 0;
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
