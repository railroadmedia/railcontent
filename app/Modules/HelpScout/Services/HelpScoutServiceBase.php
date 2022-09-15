<?php

namespace App\Modules\HelpScout\Services;

use App\Modules\HelpScout\Factories\ClientFactory;
use HelpScout\Api\ApiClient;

abstract class HelpScoutServiceBase
{
    protected ApiClient $client;

    public function __construct(ClientFactory $clientFactory)
    {
        $this->client = $clientFactory::build();
    }
}
