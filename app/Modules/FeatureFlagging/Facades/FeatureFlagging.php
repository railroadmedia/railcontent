<?php

namespace App\Modules\FeatureFlagging\Facades;

use Illuminate\Support\Facades\Facade;
use App\Modules\FeatureFlagging\Contracts\FeatureFlagsContract;
use Modules\UserManagementSystem\Models\User;

/**
 * @method static bool accessible(string $feature, User $user=null)
 * @method static bool branch(string $experiment, User $user=null)
 * @method static array allBranches(User $user)
 * @method static array allowedFeatures(User $user)
 */

class FeatureFlagging extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FeatureFlagsContract::class;
    }

}
