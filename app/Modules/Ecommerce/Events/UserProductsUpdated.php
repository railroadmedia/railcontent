<?php

namespace App\Modules\Ecommerce\Events;

class UserProductsUpdated
{

    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

}
