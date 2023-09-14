<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Repositories\CustomerRepository;

trait FindsCustomersForUsers
{
    /**
     * Get all customers with the same email address as the given user
     *
     * @param User $user
     * @return Collection
     */
    protected function getCustomersForUser(User|string $userOrEmail): Collection
    {
        $email = $userOrEmail instanceof User ? $userOrEmail->email : $userOrEmail;
        $qb = $this->getCustomerRepository()->createQueryBuilder('customer');
        $qb->where(
            $qb->expr()
                ->eq("customer.email", ":email")
        )->setParameter("email", $email);

        $q = $qb->getQuery();

        return collect($q->getResult());
    }

    /**
     * Get this class's instance of the Customer Repository
     *
     * @return CustomerRepository
     */
    protected abstract function getCustomerRepository(): CustomerRepository;
}
