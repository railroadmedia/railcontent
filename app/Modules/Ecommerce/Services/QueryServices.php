<?php

namespace App\Modules\Ecommerce\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;

class QueryServices
{
    public static function getCustomUserQuery(
        ?string $customQuery,
        ?string $customQueryParameters,
        ?int $startId = null,
        ?int $endId = null
    ) {
        $query = User::query();

        switch ($customQuery) {
            case "noPermissionProductId":
                $query->whereExists(function ($query) use ($customQueryParameters) {
                    $query->select(DB::raw(1))
                        ->from('user_access_permissions')
                        ->whereRaw('usora_users.id = user_access_permissions.user_id')
                        ->where('source', 'web')
                        ->whereNull('product_id');
                });
                break;
            case "hasLegacyExpirationDate":
                $query->whereNotNull('legacy_expiration_date');
                break;
            case "hasUserPermissionProduct":
                if (!$customQueryParameters) {
                    throw new \Exception("expected customqueryparamater permissionId");
                }
                $query->whereExists(function ($query) use ($customQueryParameters) {
                    $query->select(DB::raw(1))
                        ->from('user_access_permissions')
                        ->whereRaw('usora_users.id = user_access_permissions.user_id')
                        ->where('product_id', '=', intval($customQueryParameters));
                });
                break;
            case "hasUserPermission":
                if (!$customQueryParameters) {
                    throw new \Exception("expected customqueryparamater permissionId");
                }
                $query->whereExists(function ($query) use ($customQueryParameters) {
                    $query->select(DB::raw(1))
                        ->from('user_access_permissions')
                        ->whereRaw('usora_users.id = user_access_permissions.user_id')
                        ->where('permission_id', '=', intval($customQueryParameters));
                });
                break;
            case "hasOldActiveSubscription":
                $query->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('ecommerce_subscriptions')
                        ->whereRaw('ecommerce_subscriptions.user_id = usora_users.id')
                        ->where('ecommerce_subscriptions.is_active', '1')
                        ->where('ecommerce_subscriptions.paid_until', '>', '2023-12-07');
                });
                break;
            case "hasRechargeSubscription":
                $query->where('has_recharge_subscription', true);
                break;
            case "futureMembershipIssue":
                $query->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('railcontent_user_permissions')
                        ->whereRaw('railcontent_user_permissions.user_id = usora_users.id')
                        ->whereIn('railcontent_user_permissions.permission_id', [91, 92])
                        ->where('railcontent_user_permissions.start_date', '>', Carbon::now()->addDays(1));
                });
                break;
            case "hasMigrationDays":
                $query->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('user_access_permissions')
                        ->whereRaw('user_access_permissions.user_id = usora_users.id')
                        ->whereNull('user_access_permissions.time_fixed')
                        ->where('user_access_permissions.source', 'migration')
                        ->where('user_access_permissions.time_lifetime', false);
                });
                break;
            case "createdWithinLastDay":
                $query->where('created_at', '>', Carbon::now()->subDay());
                break;
            case "isAdmin":
                $query->where('permission_level', User::PERMISSION_LEVEL_ADMIN);
                break;
            case "requiresRechargeSync":
                $query->whereRaw(
                    'recharge_renewal_date is not null and recharge_renewal_date > now() and DATEDIFF(membership_expiration_date, recharge_renewal_date) - 7 > 7'
                );
                break;
            case "":
            case null:
                break;
            default:
                throw new \Exception("Invalid custom query: $customQuery");
        }
        if ($startId) {
            $query->where('id', '>=', $startId);
        }
        if ($endId) {
            $query->where('id', '<=', $endId);
        }
        //$sql = $query->toSql();
        //\Log::debug("QueryServices::getcustomUserQuery $sql");
        return $query;
    }
}
