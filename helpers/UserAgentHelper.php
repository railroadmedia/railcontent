<?php

use Jenssegers\Agent\Agent;

class UserAgentHelper
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

}
