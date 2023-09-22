<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Repositories\CustomerRepository;

trait FindsCustomers
{
    /**
     * Get all customers with the same email address as the given user
     *
     * @param User $user
     * @return Collection
     */
    protected function getCustomersForUser(User $user): Collection
    {
        return $this->getCustomersForUserOrEmail($user);
    }

    /**
     * Get all customers with the given email address
     *
     * @param string $email
     * @return Collection
     */
    protected function getCustomersForEmail(string $email): Collection
    {
        return $this->getCustomersForUserOrEmail($email);
    }

    /**
     * Get all customers with the same email address as the given user or email address
     *
     * @param User|string $userOrEmail
     * @return Collection
     */
    private function getCustomersForUserOrEmail(User|string $userOrEmail): Collection
    {
        $email = $userOrEmail instanceof User ? $userOrEmail->email : $userOrEmail;
        if ($this->classUsesMaskedEmail()) {
            $email = $this->getEmailFromShopify($email);
        }

        $qb = $this->getCustomerRepository()->createQueryBuilder('customer');
        $qb->where(
            $qb->expr()
                ->eq("customer.email", ":email")
        )->setParameter("email", $email);

        $q = $qb->getQuery();

        return collect($q->getResult());
    }

    /**
     * Check if this class uses masked email addresses
     *
     * @return bool
     */
    private function classUsesMaskedEmail(): bool
    {
        return in_array(HandlesMaskedEmailAddress::class, array_keys(class_uses_recursive($this)));
    }

    /**
     * Get this class's instance of the Customer Repository
     *
     * @return CustomerRepository
     */
    protected abstract function getCustomerRepository(): CustomerRepository;
}
