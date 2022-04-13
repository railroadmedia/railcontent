<?php

namespace App\Modules\Brand\Listeners;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Cache;
use Modules\UserManagementSystem\Models\User;

class BrandEventListener
{
    /**
     * @var BrandService
     */
    private $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * @param User $user
     * @param $brand
     * @return void
     */
    public function handleAuthenticated(Authenticated $authenticated)
    {
        if (!empty($authenticated->user->last_used_brand)) {
            $this->brandService->setLastUsedBrand($authenticated->user, Brand::from($authenticated->user->last_used_brand));
        }
    }
}
