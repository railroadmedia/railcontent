<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\OrderPayment;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Listeners\CustomerIo\CustomerIoSyncEventListener;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Events\PaymentEvent;
use Railroad\Ecommerce\Repositories\OrderPaymentRepository;
use Railroad\Ecommerce\Repositories\OrderRepository;
use Railroad\Ecommerce\Repositories\PaymentRepository;

class SyncCustomerIoOrdersJob extends BatchQueryJob
{
    private int $skip;
    private int $take;

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
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
        $query = Order::query()
            ->where('created_at', '>', '2023-01-01')
            ->where('created_at', '<', '2023-06-29');
        return $query;
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        $orderRepository = app()->make(OrderRepository::class);
        $paymentRepository = app()->make(PaymentRepository::class);
        /** @var CustomerIoSyncEventListener $listener */
        $listener = app()->make(CustomerIoSyncEventListener::class);
        /** @var OrderPayment $item */
        foreach ($items as $item) {
            $orderPayment = OrderPayment::query()->where('order_id', $item->id)->first();
            if ($orderPayment == null) {
                $order = $orderRepository->find($item->id);
                if ($order) {
                    $listener->syncOrder($order, null, true);
                } else {
                    Log::warning("Issue with order $item->order_id payment $item->payment_id");
                }
            }
        }
        return true;
    }
}
