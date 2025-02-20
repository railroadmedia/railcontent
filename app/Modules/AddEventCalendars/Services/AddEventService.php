<?php

namespace App\Modules\AddEventCalendars\Services;

use App\Modules\AddEventCalendars\Models\AddEventCalendar;
use Carbon\Carbon;
use Exception;
use Railroad\Railcontent\Services\ConfigService;
use stdClass;

/*
 * "Event" means an AddEvent event, and "Content" means a Musora lesson content, which may be an event of sorts—say a
 * live-lesson or content-release—but it is not an "Event" in this the context integrating AddEvent into Musora.
 */

class AddEventService
{
    public static $timezone = 'America/Vancouver';

    public $calendars;
    public $eventsByCalendarId;

    private $brand;

    public const SYNC_ID_KEY = 'sync_id';

    public function __construct()
    {
    }

    /**
     * @param $brand
     * @throws Exception
     */
    public function init($brand = null)
    {
        $this->brand = $brand ?? ConfigService::$brand;

        $this->calendars = $this->getCalendars();
        foreach ($this->calendars as $calendar) {
            $this->eventsByCalendarId[$calendar->id] = null;
        }
    }

    // =================================================================================================================
    // part ? of ? — HELPER METHODS ====================================================================================
    // =================================================================================================================

    /**
     * @param $contentType
     * @throws Exception
     */
    public function getCalendarName($contentType): string
    {
        $semesterPacksForBrand = [];

        // is content type a semester pack?
        $semesterPacks = config('addevent.semester-pack-calendars');
        if (isset($semesterPacks[$this->brand])) {
            $semesterPacksForBrand = $semesterPacks[$this->brand];
        }

        foreach ($semesterPacksForBrand as $slug => $name) {
            if ($slug === $contentType) {
                return ucfirst($this->brand) . ' - ' . $name;
            }
        }

        $valueFromConfig = config(
            'addevent.type-specific-calendar-nice-names-by-type.' . $this->brand . '.' . $contentType
        );
        return ucfirst($this->brand) . ' - ' . $valueFromConfig;
    }

    /**
     * @param $type
     * @throws Exception
     */
    public function getCalendar($type, bool $createIfDoesNotExist = false): ?stdClass
    {
        $calendarName = $this->getCalendarName($type);

        foreach ($this->calendars as $calendarCandidate) {
            if ($calendarCandidate->title === $calendarName) {
                $calendar = $calendarCandidate;
            }
        }

        if (empty($calendar)) {
            if (!$createIfDoesNotExist) {
                return null;
            }

            $calendar = $this->createCalendar($calendarName);
        }

        $this->setEventsByCalendarForCalendar($calendar->id);

        return $calendar;
    }

    /**
     * @param $calendarId
     * @throws Exception
     *
     * WARNING, THIS IS BAD DESIGN. IF THERE ARE ALREADY EVENTS IN $this->eventsByCalendarId, THIS METHOD WILL NOT
     * QUERY THE API ADD ANY JUST-CREATED EVENTS. THIS NEEDS TO BE REPLACED WITH THE ENTITY
     * SYSTEM IN THE railroad/addevent-sdk package
     */
    public function setEventsByCalendarForCalendar($calendarId, string $upcoming = null): void
    {
        $events = $this->eventsByCalendarId[$calendarId] ?? null;

        if ($events === null) {
            $events = $this->listEventsInCalendar($calendarId, null, null, null, $upcoming);

            foreach ($events as $event) {
                $eventsInCalendarKeyedByEventId[$event->id] = $event;
            }

            $this->eventsByCalendarId[$calendarId] = $eventsInCalendarKeyedByEventId ?? [];
        }
    }

    public function getExistingEvents(AddEventCalendar $calendar, string $upcoming)
    {
        $events = $this->eventsByCalendarId[$calendar->id] ?? null;
        if ($events) {
            return $events;
        }
        $events = $this->listEventsInCalendar($calendar->id, null, null, null, $upcoming);
        $eventLookup = [];
        foreach ($events as $event) {
            $eventLookup[$event->id] = $event;
        }
        $this->eventsByCalendarId[$calendar->id] = $eventLookup ?? [];
        return $eventLookup;
    }


    /**
     * @param $event
     * @throws Exception
     */
    private function getTimeFromEvent($event, bool $getEnd = false): Carbon
    {
        $tz = empty($event->timezone) ? 'UTC' : $event->timezone;
        if ($getEnd) {
            return Carbon::parse($event->datetime_end, $tz);
        }
        return Carbon::parse($event->datetime_start, $tz);
    }


    public function getCalendarByNameIfExists($name): ?AddEventCalendar
    {
        return AddEventCalendar::query()->where('title', '=', $name)->first() ?? null;
    }

    public function generateBrandOverviewCalendarName($brand): string
    {
        return ucwords($brand);
    }

    // =================================================================================================================
    // part ? of ? — HELPER METHODS of SDK METHODS =====================================================================
    // =================================================================================================================

    /**
     * @param $url
     * @return array|bool|mixed|object
     * @throws Exception
     */
    public function curl($url)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // Set the Authorization Bearer token
        $headers = [
            'Authorization: Bearer ' . config('addevent.api-token'),
        ];
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        $buffer = curl_exec($curl_handle);

        // Check for curl errors
        if ($error = curl_error($curl_handle)) {
            curl_close($curl_handle);
            throw new Exception('CURL error: ' . $error);
        }

        // Get the HTTP status code
        $status = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

        curl_close($curl_handle);

        // If the response is empty, return false
        if (empty($buffer)) {
            return false;
        }

        // Decode the JSON response
        $result = json_decode($buffer);

        if ($status !== 200 && $status !== 204 && $status !== 201) {
            throw new Exception(
                'AddEvent API request failed with status ' . $status . ': ' . var_export($result, true)
            );
        }

        return $result;
    }

    /**
     * @param $params
     */
    public function arrayToQueryString($params): string
    {
        $culledParams = [];

        foreach ($params as $key => $value) {
            if (!empty($value)) {
                $culledParams[$key] = $value;
            }
        }

        $queryString = '';

        foreach ($culledParams as $key => $value) {
            // remove double quotation marks because even if url-encoded AddEvent API doesn't play nice with them
            $isTitleAndHasQuotationMarks = ($key === 'title') && (strpos($value, '"') !== false);

            if ($isTitleAndHasQuotationMarks) {
                $value = str_replace('"', '', $value);
            }

            $queryString .= '&' . $key . '=' . urlencode($value);
        }

        return $queryString;
    }

    /**
     * @param $result
     * @param $property
     * @throws Exception
     */
    public function ensureProperty($result, $property)
    {
        if (gettype($result) !== 'object') {
            error_log(var_export($result, true));
            throw new Exception(
                'CURL response is not an object as expected and thus cannot contain the expected property \'' .
                $property .
                '\'. This should be taken as an indication of failure to perform the requested operation. See results ' .
                'variable value above as output of var_export($result)'
            );
        }
        if (!property_exists($result, $property)) {
            error_log(var_export($result, true));
            throw new Exception(
                'CURL response did not contain expected property \'' .
                $property .
                '\'. This should be ' .
                'taken as an indication of failure to perform the requested operation. See results ' .
                'variable value above as output of var_export($result)'
            );
        }
    }

    /**
     * @param $strOne
     * @param $strTwo
     */
    public function stringsSameIfFormattingRemoved($strOne, $strTwo): bool
    {
        $clean = function ($str) {
            return preg_replace(
                '/[^a-zA-Z0-9]/',
                '',
                str_replace(["&nbsp;", "\r", "\n", "\t", '\n', '\r', '\t'], '', $str)
            );
        };

        $cleanStrOne = $clean($strOne);
        $cleanStrTwo = $clean($strTwo);

        return $cleanStrOne === $cleanStrTwo;
    }

    /**
     * @param $event
     * @param $startDate
     * @param null $endDate
     * @throws Exception
     */
    public function timesMatch($event, $startDate, $endDate = null): bool
    {
        // clear trailing seconds from time (ex: '2022-01-12 10:00:13' to '2022-01-12 10:00') but validate first
        if (!is_string($startDate)) {
            if (preg_match('(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})', $startDate) !== 1) {
                throw new \Exception('timesMatch was passed $startDate that does not match dateTime pattern');
            }
        }
        $startDate = substr($startDate, 0, -3);

        $tz = empty($event->timezone) ? 'UTC' : $event->timezone;

        $startFromEvent = $this->getTimeFromEvent($event);
        $startFromEventTimestamp = $startFromEvent->timestamp;

        $expected = Carbon::parse($startDate, $tz);
        if ($event->all_day_event === 'true') {
            $expected->hour = 0;
            $expected->minute = 0;
            $expected->second = 0;
        }
        $expectedTimestamp = $expected->timestamp;

        if ($endDate) {
            // clear trailing seconds from time (ex: '2022-01-12 10:00:13' to '2022-01-12 10:00') but validate first
            if (!is_string($endDate)) {
                if (preg_match('(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})', $endDate) !== 1) {
                    throw new \Exception('timesMatch was passed $endDate that does not match dateTime pattern');
                }
            }
            $endDate = substr($endDate, 0, -3);

            $endFromEvent = $this->getTimeFromEvent($event, true);
            $endFromEventTimestamp = $endFromEvent->timestamp;
            $expectedEnd = Carbon::parse($endDate, $tz);
            if ($event->all_day_event === 'true') {
                $expectedEnd->hour = 0;
                $expectedEnd->minute = 0;
                $expectedEnd->second = 0;
            }
            $expectedEndTimestamp = $expectedEnd->timestamp;

            return $startFromEventTimestamp === $expectedTimestamp && $endFromEventTimestamp === $expectedEndTimestamp;
        }

        return $startFromEventTimestamp === $expectedTimestamp;
    }

    public function onProduction(): bool
    {
        return config('app.env') === 'production';
    }

    // =================================================================================================================
    // part ? of ? — ADDEVENT SDK ================================== // todo: replace with railroad/addevent-sdk package
    // =================================================================================================================

    /**
     * @throws Exception
     */
    public function getCalendars(): array
    {
        $calendars = [];
        $allRetrieved = false;
        $pagingNext = null;

        while (!$allRetrieved) {
            $params = [
                'token' => config('addevent.api-token'),
            ];

            $url = 'https://api.addevent.com/calevent/v2/calendars?' . $this->arrayToQueryString($params);

            // If paging is available, update the URL
            if (!empty($pagingNext)) {
                $url = $pagingNext;
            }

            // Fetch the result using the updated curl method
            $result = $this->curl($url);

            $this->ensureProperty($result, 'calendars');  // Ensure 'calendars' exists in the response

            // Handle pagination
            if (isset($result->pagination->next_page)) {
                $pagingNext = $result->links->next_page_url;
                if($result->pagination->current_page == $result->pagination->total_pages){
                    $allRetrieved = true;
                }
            } else {
                $allRetrieved = true;  // No paging info, exit the loop
            }

            // Merge new calendars into the existing list
            $calendars = array_merge($calendars, $result->calendars);
        }

        return $calendars;
    }

    /**
     * @param $title
     * @param null $description
     * @throws Exception
     */
    public function createCalendar($title, $description = null, array $customDataArray = []): stdClass
    {
        $params = [ // https://www.addevent.com/api/subscription-calendar#anchor-calendar-create
            'token' => config('addevent.api-token'), // required
            'title' => $title, // required
            'description' => $description,
            'custom_data' => json_encode($customDataArray),
        ];

        $queryString = $this->arrayToQueryString($params);

        $url = 'https://api.addevent.com/calevent/v2/calendars?' . $queryString;

        $result = $this->curl($url);

        return $result;
    }

    /**
     * @param $calendarId
     * @param $title
     * @param $description
     * @return mixed
     * @throws Exception
     */
    public function saveCalendar($calendarId, $title, $description, array $customDataArray = [])
    {
        $params = [ // https://www.addevent.com/api/subscription-calendar#anchor-calendar-save
            'token' => config('addevent.api-token'), // required
            'calendar_id' => $calendarId, // required
            'title' => $title, // required
            'description' => $description,
            'custom_data' => json_encode($customDataArray),
        ];

        $queryString = $this->arrayToQueryString($params);

        $url = 'https://api.addevent.com/calevent/v2/calendars/'.$calendarId.'?' . $queryString;

        $result = $this->curl($url);

        return $result;
    }

    /**
     * @param $calendarId
     * @throws Exception
     */
    public function deleteCalendar($calendarId, bool $ensureDeletedWithSecondRequest = true): bool
    {
        $params = [ // https://www.addevent.com/api/subscription-calendar#anchor-calendar-delete
            'token' => config('addevent.api-token'), // required
            'calendar_id' => $calendarId,
        ];

        $queryString = $this->arrayToQueryString($params);

        $url = 'https://api.addevent.com/calevent/v2/calendars/'.$calendarId.'?' . $queryString;

        $result = $this->curl($url);

        $deleted = true;
        if ($ensureDeletedWithSecondRequest) {
            foreach ($this->getCalendars() as $calendar) {
                $existentCalendarId = (int)$calendar->id;
                $targetCalendarId = (int)$calendarId;
                if ($existentCalendarId === $targetCalendarId) {
                    $deleted = false;
                }
            }
        }

        if (!$deleted) {
            throw new Exception(
                'deleteCalendar failed for calendar id ' .
                $calendarId .
                '. CURL response: "' .
                var_export($result, true) .
                '"'
            );
        }

        return true;
    }

    /**
     * @param $calendarId
     * @param null $orderBy
     * @param null $month
     * @param null $year
     * @param null $upcoming
     * @throws Exception
     */
    public function listEventsInCalendar(
        $calendarId,
        $orderBy = null,
        $month = null,
        $year = null,
        $upcoming = null
    ): array {
        $results = [];
        $allRetrieved = false;
        $page = 0;

        while (!$allRetrieved) {
            $page++;
            $params = [ // https://www.addevent.com/api/subscription-calendar#anchor-calendar-events
                'token' => config('addevent.api-token'), // required
                'calendar_ids' => $calendarId, // required
                'order_by' => $orderBy,
                'month' => $month,
                'year' => $year,
                'datetime_min' => $upcoming,
                'page' => $page,
            ];
            $url = 'https://api.addevent.com/calevent/v2/events?' . $this->arrayToQueryString($params);

            $result = $this->curl($url);
            $this->ensureProperty($result, 'events');
            if (gettype($result->events) !== 'array') {
                throw new Exception('listEventsInCalendar CURL response data "events" is not an array as expected.');
            }

            $pagingNext = $result->pagination->next_page;
            if (empty($pagingNext) || $result->pagination->next_page == $result->pagination->current_page) {
                $allRetrieved = true;
            }
            $results = array_merge($results, $result->events);
        }

        return $results;
    }

    /**
     * @param $calendarId
     * @param $title
     * @param null $organizer
     * @param null $organizerEmail
     * @param null $location
     * @param null $reminder
     * @return mixed
     * @throws Exception
     */
    public function createEvent(
        AddEventCalendar $calendar,
        $title,
        string $timezone,
        Carbon $startDate,
        Carbon $endDate = null,
        string $description = null,
        $organizer = null,
        $organizerEmail = null,
        $location = null,
        $reminder = null,
        bool $allDayEvent = false,
        bool $throwExceptionOnFailure = true, // todo: remove this?
        array $customData = []
    ) {
        $startDate = $startDate->toDateTimeString();
        if ($endDate) {
            $endDate = $endDate->toDateTimeString();
        }

        $customData = json_encode($customData);

        $params = [ // https://www.addevent.com/api/subscription-calendar#anchor-calendar-event-create
            'token' => config('addevent.api-token'),      // required
            'calendar_id' => $calendar->id,   // required
            'title' => $title,              // required
            'timezone' => $timezone,        // required
            'datetime_start' => $startDate,     // required
            'description' => $description,
            'datetime_end' => $endDate,
            'organizer_name' => $organizer,
            'organizer_email' => $organizerEmail,
            'location' => $location,
            'reminder' => $reminder,
            'all_day_event' => $allDayEvent,
            'custom_data' => $customData
        ];

        $queryString = $this->arrayToQueryString($params);
        $url = 'https://api.addevent.com/calevent/v2/events?' . $queryString;
        $result = $this->curl($url);
        $event = $result;
        if ($throwExceptionOnFailure) {
            $calendarIdsMatch = $event->calendar == $calendar->id;
            $descriptionsMatch = $this->stringsSameIfFormattingRemoved($description, $event->description);
            $titlesMatch = $this->stringsSameIfFormattingRemoved($title, $event->title);
            $eventWasSetAsAllDayEvent = $event->all_day_event === 'true';
            $allDayEventSettingsMatch = $eventWasSetAsAllDayEvent === $allDayEvent;
            $timesMatch = $this->timesMatch($event, $startDate, $endDate);

            $enoughInfoCorrectToConsiderSuccess =
                $calendarIdsMatch && $descriptionsMatch && $titlesMatch && $allDayEventSettingsMatch && $timesMatch;

            if (!$enoughInfoCorrectToConsiderSuccess) {
                throw new Exception(
                    'Event created, but discrepancy between expected and actual values. ' . 'expected: ' . var_export(
                        [$event->calendar, $title, $description, $event->all_day_event],
                        true
                    ) . 'actual: ' . var_export([$calendar->id, $event->title, $event->description, $allDayEvent], true)
                );
            }
        }

        return $event;
    }

    /**
     * @param $eventId
     * @param $title
     * @param $timezone
     * @param null $description
     * @param null $organizer
     * @param null $organizerEmail
     * @param null $location
     * @param null $reminder
     * @return array|bool|mixed|object
     * @throws Exception
     */
    public function editEvent(
        $eventId,
        $title,
        $timezone,
        Carbon $startDate,
        Carbon $endDate = null,
        $description = null,
        $organizer = null,
        $organizerEmail = null,
        bool $allDayEvent = false,
        $location = null,
        $reminder = null,
        array $customData = []
    ) {
        $startDate = $startDate->toDateTimeString();
        if ($endDate) {
            $endDate = $endDate->toDateTimeString();
        }

        $params = [ // https://www.addevent.com/api/subscription-calendar#anchor-calendar-event-save
            'token' => config('addevent.api-token'), // required
            'event_id' => $eventId, // required
            'title' => $title, // required
            'description' => $description,
            'location' => $location,
            'organizer_name' => $organizer,
            'organizer_email' => $organizerEmail,
            'timezone' => $timezone, // required
            'reminder' => $reminder,
            'datetime_start' => $startDate, // required
            'datetime_end' => $endDate,
            'all_day_event' => $allDayEvent,
            'custom_data' => json_encode($customData)
        ];

        $queryString = $this->arrayToQueryString($params);

        $url = 'https://api.addevent.com/calevent/v2/events/'.$eventId.'?' . $queryString;

        $result = $this->curl($url);

        $event = $result;

        $resultAllDayEvent = $event->all_day_event === 'true';

        $match_a = (int)$event->id === (int)$eventId;
        $match_b = $this->stringsSameIfFormattingRemoved($description, $event->description);
        $match_c = $this->stringsSameIfFormattingRemoved($title, $event->title);
        $match_d = $resultAllDayEvent === $allDayEvent;
        $match_e = $this->timesMatch($event, $startDate, $endDate);

        $enoughInfoCorrectToConsiderSuccess = $match_a && $match_b && $match_c && $match_d && $match_e;

        if (!$enoughInfoCorrectToConsiderSuccess) {
            throw new Exception(
                'Event created, but discrepancy between expected and actual values. ' . 'expected: ' . var_export(
                    [$eventId, $title, $description, $allDayEvent],
                    true
                ) . 'actual: ' . var_export([$event->id, $event->title, $event->description, $resultAllDayEvent], true)
            );
        }

        return $result;
    }

    /**
     * @param $eventId
     * @return array|bool|mixed|object
     * @throws Exception
     */
    public function deleteEvent($eventId)
    {
        if (is_null($eventId)) {
            return true;
        }

        $params = [ // https://www.addevent.com/api/subscription-calendar#
            'token' => config('addevent.api-token'), // required
            'event_id' => $eventId, // required
        ];

        $queryString = $this->arrayToQueryString($params);

        $url = 'https://api.addevent.com/calevent/v2/events/'.$eventId.'?' . $queryString;

        $result = $this->curl($url);

        return $result;
    }

    /**
     * @return array|bool|mixed|object
     * @throws Exception
     *
     * https://www.addevent.com/api/subscription-calendar#anchor-timezones
     */
    public function listOfTimeZones()
    {
        $queryString = 'https://api.addevent.com/calevent/v2/timezones';

        $result = $this->curl($queryString);

        return $result;
    }
}
