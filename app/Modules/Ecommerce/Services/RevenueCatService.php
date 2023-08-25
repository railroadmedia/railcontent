<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\ApiGateways\RevenueCatApiGateway;


class RevenueCatService
{
    public RevenueCatApiGateway $revenueCatApiGateway;

    /**
     * @param RevenueCatApiGateway $revenueCatApiGateway
     */
    public function __construct(RevenueCatApiGateway $revenueCatApiGateway)
    {
        $this->revenueCatApiGateway = $revenueCatApiGateway;
    }

    /**
     * @param $appUserId
     * @return mixed
     * @throws \Exception
     */
    public function getSubscriber($appUserId)
    {
       return $this->revenueCatApiGateway->getSubscriber($appUserId);
    }
}
