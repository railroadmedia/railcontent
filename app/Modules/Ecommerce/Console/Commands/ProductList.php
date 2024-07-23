<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\UserManagementSystem\Models\User;

class ProductList extends Command
{
    protected $name = 'ProductList';
    protected $signature = 'product:list {--search=} {--brand=} {--recurring}';

    protected $description = 'List ecommerce products';

    public function handle(
        ShopifySyncService $shopifySyncService
    ): void {
        $query = Product::query();
        $search = $this->option('search');
        if ($search) {
            $query->whereRaw("name LIKE '%$search%'");
        }

        if ($this->option('recurring')) {
            $query->where("digital_access_time_type", Product::DIGITAL_ACCESS_TIME_TYPE_RECURRING);
        }

        $brand = $this->option('brand');
        if ($brand) {
            $query->where("brand", $brand);
        }

        $this->table(['id', 'name'], $query->select(['id', 'name'])->get()->toArray());
    }
}
