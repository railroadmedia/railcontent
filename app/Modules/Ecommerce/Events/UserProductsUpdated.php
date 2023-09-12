<?php

namespace App\Modules\Ecommerce\Events;

class UserProductsUpdated
{

    private int $userId;
    private $userProducts;

    public function __construct(int $userId, $userProducts)
    {
        $this->userId = $userId;
        $this->userProducts = $userProducts;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserProducts()
    {
        return $this->userProducts;
    }

}
