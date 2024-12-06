<?php

namespace App\Services;

use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserTimezoneService
{
    private static ?string $mockedTimezone = null;

    /**
     * @return string
     */
    public static function getUsersCurrentTimezone()
    {
        // Use mocked timezone if set (for testing purposes).
        if (self::$mockedTimezone !== null) {
            return self::$mockedTimezone;
        }

        /**
         * @var $request Request
         */
        $request = request();
        $currentTimezone = null;

        if ($request->has('timezone') && self::isValidTimezoneString($request->get('timezone'))) {
            $currentTimezone = $request->get('timezone');
        }

        if ($request->hasHeader('M-Client-Timezone') &&
            self::isValidTimezoneString($request->header('M-Client-Timezone'))) {
            $currentTimezone = $request->header('M-Client-Timezone');
        }

        if (empty($currentTimezone) &&
            !empty(user()) &&
            !empty(user()->timezone) &&
            self::isValidTimezoneString(user()->timezone)) {
            $currentTimezone = user()->timezone;
        }

        // Update the users timezone to be the current one if the one stored in the database doesn't match.
        if (!empty(user()) && !empty($currentTimezone) && $currentTimezone != user()->timezone) {
            user()->timezone = $currentTimezone;
            user()->save();
        }

        if (empty($currentTimezone)) {
            $currentTimezone = 'America/Vancouver';
        }

        return $currentTimezone;
    }

    private static function isValidTimezoneString($timezone): bool
    {
        if (empty($timezone)) {
            return false;
        }

        try {
            new DateTimeZone($timezone);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Set a mocked timezone for testing purposes.
     *
     * @param string|null $timezone
     */
    public static function mockUsersTimezone(?string $timezone): void
    {
        self::$mockedTimezone = $timezone;
    }
}
