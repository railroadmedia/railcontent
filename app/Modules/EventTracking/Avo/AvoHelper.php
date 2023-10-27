<?php

namespace App\Modules\EventTracking\Avo;

use App\Modules\EventTracking\Services\CustomerIoService;

class AvoHelper
{
    /**
     * @return string
     */
    public static function getRequestPlatform(): string
    {
        $userAgent = strtolower(request()?->userAgent()) ?? '';

        if (str_contains($userAgent, 'drumeo')) {
            return 'drumeo-app';
        } elseif (str_contains($userAgent, 'pianote')) {
            return 'pianote-app';
        } elseif (str_contains($userAgent, 'musora')) {
            return 'musora-app';
        }

        return 'web';
    }

    /**
     * @return string
     */
    public static function getRequestOS(): string
    {
        $userAgent = strtolower(request()?->userAgent()) ?? '';

        if (str_contains($userAgent, 'ios') || str_contains($userAgent, 'iphone') || str_contains($userAgent, 'ipad')) {
            return 'ios';
        } elseif (str_contains(strtolower($userAgent), 'android')) {
            return 'android';
        }

        return 'web';
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
