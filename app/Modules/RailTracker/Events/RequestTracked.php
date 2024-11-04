<?php

namespace App\Modules\RailTracker\Events;

class RequestTracked
{
    public function __construct(
        public int $requestId,
        public ?int $userId,
        public string $clientIp,
        public string $userAgent,
        public string $requestedAtDateTime,
        public ?string $usersPreviousRequestedAtDateTime = null
    ) {
    }
}
