<?php

namespace App\Modules\Ecommerce\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\Shopify;

class ShopifyCustomerService
{
    private Shopify $shopify;
    private CustomerRepository $customerRepository;

    public function __construct(
        Shopify $shopify,
        CustomerRepository $customerRepository,
    ) {
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
    }

    public function createShopifyCustomer(User $user)
    : int {
        $customers = $this->getCustomersForUser($user);

        $alreadySyncedUserCustomers = $customers->filter(fn(Customer $customer) => !is_null($customer->getShopifyId()));
        $isCreating = is_null($user->shopify_id) && $alreadySyncedUserCustomers->isEmpty();

        $postData = $this->createCustomerDataForUser($user, $isCreating);

        try {
            if ($isCreating) {
                $customerResource = $this->shopify->createCustomer($postData);
            } else {
                $existingCustomerShopifyId =
                    $user->shopify_id
                    ??
                    $alreadySyncedUserCustomers->first()
                        ->getShopifyId();
                $customerResource = $this->shopify->updateCustomer($existingCustomerShopifyId, $postData);
            }
        } catch (ValidationException $exception) {
            Log::error(
                sprintf("Validation failed when sending customer data to Shopify: %s", $exception->getMessage())
            );
            Log::error(
                sprintf(
                    "Please investigate for user or customers with email address %s. Attempted customer data: %s",
                    $user->getEmail(),
                    json_encode($postData)
                )
            );

            return 0;
        }

        $user->shopify_id = $customerResource->id;
        $user->save();

        return $user->shopify_id;
    }

    /**
     * Get all customers with the same email address as the given user
     *
     * @param User $user
     * @return Collection
     */
    private function getCustomersForUser(User $user)
    : Collection {
        $qb = $this->customerRepository->createQueryBuilder('customer');
        $qb->where(
            $qb->expr()
                ->eq("customer.email", ":email")
        )
            ->setParameter("email", $user->getEmail());

        $q = $qb->getQuery();

        return collect($q->getResult());
    }

    /**
     * Create the data to post to Shopify to create a Customer from our User
     *
     * DEV NOTE: we don't bother looking at the user's customers because our system doesn't allow for
     * new Customers to be made after a User already exists with the same email address.
     *
     * @param User $user
     * @param bool $withMetafields
     * @return array
     */
    private function createCustomerDataForUser(User $user, bool $withMetafields)
    : array {
        $customerData = [
            "currency" => "USD",
            "email" => $user->getEmail(),
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "note" => $user->support_note,
            // "tags" => "",
        ];

        if ($withMetafields) {
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our user id, etc
            $customerData["metafields"] = [
                [
                    "key" => "_id",
                    "value" => $user->id,
                    "type" => "number_integer",
                    "namespace" => "users",
                ],
            ];
        }

        return $customerData;
    }
}
