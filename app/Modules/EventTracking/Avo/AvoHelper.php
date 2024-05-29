<?php

namespace App\Modules\EventTracking\Avo;

use Modules\UserManagementSystem\Models\User;

class AvoHelper
{
    /**
     * @return string
     */
    public static function getRequestPlatform(?string $userAgent = ''): string
    {
        $userAgent = strtolower($userAgent);

        if (str_contains($userAgent, 'musora/2')) {
            return 'musora-app';
        } elseif (str_contains($userAgent, 'pianote')) {
            return 'pianote-app-legacy';
        } elseif (str_contains($userAgent, 'musora')) {
            return 'musora-app-legacy';
        }

        return 'web';
    }

    /**
     * @return string
     */
    public static function getRequestOS(?string $userAgent = ''): string
    {
        $userAgent = strtolower($userAgent);

        if (
            str_contains($userAgent, 'ios')
            || str_contains($userAgent, 'iphone')
            || str_contains($userAgent, 'ipad')
            || str_contains($userAgent, 'cfnetwork')
        ) {
            return 'ios';
        } elseif (str_contains($userAgent, 'android')) {
            return 'android';
        }

        return 'web';
    }

    /**
     * @param array $properties
     * @return array
     */
    public static function defaultEventProperties(array $properties = [], User $user = null): array
    {
        $userAgent = request()?->userAgent();
        $defaultProperties = [
            'user_id_' => $user ? strval($user->id) : userIdString(),
            'platform' => self::getRequestPlatform($userAgent),
            'os' => self::getRequestOS($userAgent)
        ];

        return array_merge($defaultProperties, $properties);
    }
}
