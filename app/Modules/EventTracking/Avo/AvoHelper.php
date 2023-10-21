<?php

namespace App\Modules\EventTracking\Avo;

use App\Modules\EventTracking\Services\CustomerIoService;
use Jenssegers\Agent\Agent;

class AvoHelper
{
    /**
     * @return string
     */
    public static function getRequestPlatform(): string
    {
        $userAgent = request()?->userAgent() ?? '';

        if (str_contains(strtolower($userAgent), 'drumeo')) {
            return 'drumeo-app';
        } elseif (str_contains(strtolower($userAgent), 'pianote')) {
            return 'pianote-app';
        } elseif (str_contains(strtolower($userAgent), 'musoraapp')) {
            return 'musora-app';
        } else {
            return 'web';
        }
    }

    /**
     * @return string
     */
    public static function getRequestOS(): string
    {
        $userAgent = request()?->userAgent() ?? '';

        $agent = new Agent();

        return match (strtolower($agent->platform($userAgent))) {
            'ios' => 'ios',
            'androidos' => 'android',
            default => 'web'
        };
    }

    /**
     * @param array $properties
     * @return array
     */
    public static function defaultEventProperties(array $properties = []): array
    {

        $defaultProperties = [
            'user_id_' => userIdString(),
            'platform' => self::getRequestPlatform(),
            'os' => self::getRequestOS()
        ];

        $customerIoService = new CustomerIoService();
        $customerIoIds = $customerIoService->getCioIdsForUser(user());

        return array_merge($defaultProperties, $properties, $customerIoIds);
    }

}
