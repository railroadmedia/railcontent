<?php

namespace App\Modules\EventTracking\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\CustomerIO\Models\Customer;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Services\EventTrackingService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class SyncUserPaymentMethodsToCioJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    protected array $ids;
    private string $workspaceName;
    private RechargeGateway $rechargeGateway;
    private EventTrackingService $eventTrackingService;

    public function __construct(int $skip, int $take, string $workspaceName)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->workspaceName = $workspaceName;
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    /**
     * @throws Exception
     */
    public function getQuery(): Builder
    {
        return UserAccessPermission::query()
            ->join('usora_users', 'usora_users.id', '=', 'user_access_permissions.user_id')
            ->join(
                'railcontent_permissions',
                'railcontent_permissions.id',
                '=',
                'user_access_permissions.permission_id'
            )
            ->where([
                'status' => 'active',
                'railcontent_permissions.brand' => $this->workspaceName,
            ])
            ->where('usora_users.membership_expiration_date', '>', now())
            ->selectRaw('DISTINCT user_access_permissions.user_id');
    }

    public function handleItem($item): void
    {
        try {
            /** @var Customer $item */
            /** @var User $user */
            $user = User::find($item->user_id);
            if ($user && $user->shopify_id) {
                $rechargeCustomer = $this->rechargeGateway
                    ->getCustomer($user->shopify_id)
                    ->get('customers')[0];

                if ($rechargeCustomer) {
                    $paymentMethod = $this->rechargeGateway->getCustomerDefaultPaymentMethod($rechargeCustomer->id);
                    $this->eventTrackingService->trackPaymentMethodExpiryDate($user, $paymentMethod);
                }
            }
        } catch (Throwable $ex) {
            Log::error("Error migrating profile for email " . $item->email);
            Log::error($ex);
        }
    }

    public function handleAllItems($items): bool
    {
        $this->rechargeGateway = app(RechargeGateway::class);
        $this->eventTrackingService = app(EventTrackingService::class);
        foreach ($items as $item) {
            $this->handleItem($item);
        }
        return true;
    }
}
