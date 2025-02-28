<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;

class CustomerIoDeleteUserFromMusoraWorkspace extends BatchQueryJob
{
    public $timeout = 840;
    private int $skip;
    private int $take;
    protected array $ids;
    private CustomerIoService $customerIoService;

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    public function getQuery(): Builder
    {
        return User::query()->where('email', 'like', '%musora+deleted%');
    }

    public function handleItem(
        $item
    ): void {
        $data = $this->customerIoService->getCustomerEmailByIdFromCustomerIo($item->id, $item->email, 'musora');
        foreach ($data as $identifiers) {
            if (isset($identifiers['email'])) {
                $this->customerIoService->deleteCustomerByEmail($identifiers['email'], 'musora');
            }
        }
    }

    public function handleAllItems($items): bool
    {
        $this->customerIoService = app(CustomerIoService::class);
        foreach ($items as $item) {
            $this->handleItem($item);
        }
        return true;
    }
}
