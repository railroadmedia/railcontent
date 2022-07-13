<?php

namespace App\Services;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class CalendarService
{
    /**
     * @param  Request  $request
     * @return mixed|string|null
     */
    public function getTimezone(Request $request)
    {
        $currentUser = user();

        if (empty($currentUser)) {
            return 'America/Vancouver';
        }

        if ($request->has('timezone')) {
            $timezone = $request->get('timezone');

            if (strpos($timezone, ' - ') !== false) {
                $timezone = substr($timezone, 0, strpos($timezone, ' - '));
            }

            $currentUser->timezone = $timezone;

            $currentUser->save();
        }

        if (in_array($currentUser->timezone, timezone_identifiers_list())) {
            return $currentUser->timezone;
        } else {
            return 'America/Vancouver';
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function getTimezoneList()
    {
        $formattedTimeZones = [];
        $allZones = DateTimeZone::listIdentifiers();

        foreach ($allZones as $timezone) {
            $dateTimeZone = new DateTimeZone($timezone);
            $time = new DateTime(null, $dateTimeZone);

            $ampm = $time->format('g:i a');

            $formattedTimeZones[] = $timezone . ' - ' . $ampm;
        }

        return $formattedTimeZones;
    }
}
