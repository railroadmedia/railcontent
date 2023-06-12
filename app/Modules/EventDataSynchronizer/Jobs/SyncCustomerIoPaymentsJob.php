<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Events\PaymentEvent;
use Railroad\Ecommerce\Repositories\PaymentRepository;

class SyncCustomerIoPaymentsJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private ?Carbon $purchasedAfter;

    public function __construct(int $skip, int $take, ?string $purchasedAfter)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->purchasedAfter = !empty($purchasedAfter) ? new Carbon($purchasedAfter) : null;
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getQuery(): Builder
    {
        $query = Payment::query()->where('created_at', '>', $this->purchasedAfter);
        return $query;
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        $paymentRepository = app()->make(PaymentRepository::class);
        foreach ($items as $item) {
            $payment = $paymentRepository->find($item->id);
            event(new PaymentEvent($payment));
        }

        return true;
    }
}
