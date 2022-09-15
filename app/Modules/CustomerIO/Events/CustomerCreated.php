<?php

namespace App\Modules\CustomerIO\Events;

use App\Modules\CustomerIO\Models\Customer;

class CustomerCreated
{
    /**
     * @var Customer
     */
    public $customer;

    /**
     * CustomerCreated constructor.
     * @param  Customer  $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
}
