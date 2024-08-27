<?php

namespace App\Modules\CustomerIO\Events;

use App\Modules\CustomerIO\Models\Customer;

class CustomerUpdated
{
    /**
     * @var Customer
     */
    public $oldCustomer;

    /**
     * @var Customer
     */
    public $newCustomer;

    /**
     * CustomerUpdated constructor.
     */
    public function __construct(Customer $oldCustomer, Customer $newCustomer)
    {
        $this->oldCustomer = $oldCustomer;
        $this->newCustomer = $newCustomer;
    }
}
