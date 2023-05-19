<?php

namespace App\Modules\AddEventCalendars\Console\Commands;

use App\Modules\AddEventCalendars\Services\AddEventService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class AddEventCommand extends Command
{
    protected $signature = 'addevent:command {brandArgument?} {selection?}';
    protected $description = 'Multiple-function-having tool for interacting with AddEvent Subscription Calendars';

    private $brand;

    private static $ACTIONS = [
        'createAllCalendarsForBrand',
        'createBrandOverviewCalendar',
        'emptyCalendarsForBrand',
        'getCalendarIdsForMusora',
        'getCalendarIdsForBrandSite',
        'timezones',
        'getInfo',
        'listEventsInCalendar',
        'deleteAllCalendars',
        'overviewCurrent',
        'overviewLastMonth',
    ];

    private static $expectedLastFourDigitsOfSandboxApiToken = '9660';

    /** @var ContentService */
    private $contentService;

    /** @var AddEventService */
    private $addEventService;

    public function __construct(
        ContentService $contentService,
        AddEventService $addEventService
    ) {
        parent::__construct();
        $this->contentService = $contentService;
        $this->addEventService = $addEventService;
    }

    // =================================================================================================================
    // 1. SHOT CALLER ==================================================================================================
    // =================================================================================================================

    /**
     * @return bool
     * @uses createAllCalendarsForBrand
     * @uses createBrandOverviewCalendar
     * @uses emptyCalendarsForBrand
     * @uses getCalendarIdsForMusora
     * @uses getCalendarIdsForBrandSite
     * @uses timezones
     * @uses getInfo
     * @uses listEventsInCalendar
     * @uses deleteAllCalendars
     */
    public function handle(): bool
    {
        ContentRepository::$bypassPermissions = true;
        try {
            $this->confirmNotInSandbox();
            $this->setBrandAndContentType();
            $action = $this->getAction();
            $this->addEventService->init($this->brand);
            $this->$action();
        } catch (Exception $e) {
            $this->info('Exception occurred with message: "' . $e->getMessage() . '"');
            $this->info('At: ' . $e->getFile() . ':' . $e->getLine());
        }
        return true;
    }

    // =================================================================================================================
    // 2. ACTIONS ======================================================================================================
    // =================================================================================================================

    /**
     * @return void
     */
    private function createAllCalendarsForBrand(): void
    {
        $this->info('createAllCalendarsForBrand for ' . $this->brand);

        // create semester packs ---------------------------------------------------------------------------------------

        $this->info('--- semester-packs ---');
        $semesterPacksForCalendars = [];
        if (isset(config('addevent.semester-pack-calendars')[$this->brand])) {
            $semesterPacksForCalendars = config('addevent.semester-pack-calendars')[$this->brand];
        }
        foreach ($semesterPacksForCalendars as $semesterPack => $label) {
            try {
                $calendar = $this->addEventService->getCalendar($semesterPack);
                if (!$calendar) {
                    $calendar = $this->addEventService->getCalendar($semesterPack, true);
                    $this->info('calendar "' . $calendar->title . '" created');
                }
                {
                    $this->info('"' . $calendar->title . '" exists');
                }
            } catch (Exception $e) {
                $this->info('error (either get or create) failed for semesterPack: ' . $semesterPack);
                $this->info('$e->getMessage(): ' . $e->getMessage());
                $this->info('$e->getFile(): ' . $e->getFile());
                $this->info('$e->getLine(): ' . $e->getLine());
                $this->info('$e->getTraceAsString(): ' . $e->getTraceAsString());
                var_dump($e);
            }
        }

        // create others -----------------------------------------------------------------------------------------------

        $this->info('--- regular content ---');
        $brandCalendarsList = config(
            'addevent.type-specific-calendar-nice-names-by-type.' . $this->brand
        );
        foreach ($brandCalendarsList as $contentType => $calendarName) {
            try {
                $calendar = $this->addEventService->getCalendar($contentType);
                if (!$calendar) {
                    $calendar = $this->addEventService->getCalendar($contentType, true);
                    $this->info('calendar "' . $calendar->title . '" created');
                }
                {
                    $this->info('"' . $calendar->title . '" exists');
                }
            } catch (Exception $e) {
                $this->info('error (either get or create) failed for contentType: ' . $contentType);
                $this->info('$e->getMessage(): ' . $e->getMessage());
                $this->info('$e->getFile(): ' . $e->getFile());
                $this->info('$e->getLine(): ' . $e->getLine());
                $this->info('$e->getTraceAsString(): ' . $e->getTraceAsString());
                var_dump($e);
            }
        }

        $this->info('---------------------------- done ----------------------------');
    }

    /**
     * Create a brand-overview calendar for a brand
     *
     * @return void
     */
    private function createBrandOverviewCalendar(): void
    {
        $calendarName = $this->addEventService->generateBrandOverviewCalendarName($this->brand);
        $brandOverviewCal = $this->addEventService->getCalendarByNameIfExists($calendarName);
        if ($brandOverviewCal) {
            $this->info(
                'brand overview calendar already exists (unique key: ' . $brandOverviewCal->uniquekey .
                '). Exiting now.'
            );
            return;
        }

        try {
            $calendar = $this->addEventService->createCalendar($calendarName);
            $this->info('calendar created. uniquekey: ' . $calendar->uniquekey);
        } catch (Exception $exception) {
            $this->info('Calendar creation failed.');
            $this->info('Exception message: ' . $exception->getMessage());
            $this->info('Exception file: ' . $exception->getFile());
            $this->info('Exception line: ' . $exception->getLine());
            $this->info('Exception trace as string: ' . $exception->getTraceAsString());
        }
    }

    /**
     * Empties calendars for a brand
     *
     * @return void
     */
    private function emptyCalendarsForBrand(): void
    {
        dd('manually disabled for safety reasons');

        $this->confirmNotInSandbox('Same as before but again because this DELETES ALL EVENTS! ');

        try {
            $calendarsToEmpty = [];
            $eventsToDelete = [];
            $output = ['failed' => [], 'successes' => []];

            $brandOverviewCalendarName = ucwords($this->brand);

            foreach ($this->addEventService->calendars as $calendar) {
                $isCalendarForBrand = $this->doesCalendarTitleStartWithPassedString($calendar, ucwords($this->brand));
                if ($isCalendarForBrand) {
                    $calendarsToEmpty[] = $calendar;
                }
                $isTheBrandOverviewWeWant = $brandOverviewCalendarName === $calendar->title;
                if ($isTheBrandOverviewWeWant) { // this will add the overview twice though if the overview name is just the brand, ex: "Singeo"
                    $calendarsToEmpty[] = $calendar;
                }
            }

            foreach ($calendarsToEmpty as $calendarToEmpty) {
                $calendarId = $calendarToEmpty->id;
                // WARNING, THIS IS FLAWED; IT WILL NOT QUERY THE API ADD ANY JUST-CREATED EVENTS
                $this->addEventService->setEventsByCalendarForCalendar($calendarId);
                $eventsForCalendar = $this->addEventService->eventsByCalendarId[$calendarId] ?? [];
                foreach ($eventsForCalendar as $event) {
                    $eventsToDelete[] = $event;
                }
            }

            foreach ($eventsToDelete as $eventToDelete) {
                $eventId = $eventToDelete->id;
                try {
                    $this->addEventService->deleteEvent($eventId);
                    $output['successes'][$eventId] = $eventToDelete->title;
                } catch (Exception $exception) {
                    $output['failed'][$eventId] = $eventToDelete->title;
                }
            }
        } catch (Exception $exception) {
            $this->info('$exception->getMessage(): ' . $exception->getMessage());
            $this->info('$exception->getFile(): ' . $exception->getFile());
            $this->info('$exception->getLine(): ' . $exception->getLine());
        }
        foreach ($output ?? [] as $key => $value) {
            $this->info('---------------------- ' . $key . ' ----------------------');
            var_dump($value);
        }
        $this->info('---------------------- done ----------------------');
        $this->info('--------- REMEMBER TO TRUNCATE THE TABLE ---------');
    }

    /**
     * @return bool
     *
     * Why does this exist? AddEvent docs says to specify timezone as one of the options returned by this. The results
     * appear to be inline with the standard timezones, but this is just to double-check.
     */
    private function timezones(): bool
    {
        try {
            $result = $this->addEventService->listOfTimeZones();
        } catch (Exception $e) {
            error_log($e);
            return true;
        }

        foreach ($result->data as $timezone) {
            $this->info($timezone->label . '(' . $timezone->offset . ')');
        }

        return true;
    }

    /**
     * @return void
     */
    private function getInfo()
    {
        try {
            $calendars = $this->addEventService->getCalendars();
        } catch (Exception $e) {
            $this->info(
                'Exception with message: ' . $e->getMessage() . ' (file: ' . $e->getFile() . ', line: ' .
                $e->getLine() . ')'
            );
        }

        $this->info('--------------------------------------------------------------------------------------');
        $this->info('    Note that following output is csv.');
        $this->info('        You can use it to create markdown table at donatstudios.com/CsvToMarkdownTable');
        $this->info('        Then use jbt.github.io/markdown-editor to view nicely.');
        $this->info('--------------------------------------------------------------------------------------');
        $this->info('');
        $this->info('title,active followers,events,last modified,uniquekey,id');

        foreach ($calendars ?? [] as $calendar) {
            //  each calendar will look like this:
            //
            //  stdClass::__set_state(array(
            //      'id' => '1562358107218468',
            //      'uniquekey' => 'it218468',
            //      'title' => 'Drumeo - ',
            //      'description' => '',
            //      'followers_active' => '0',
            //      'followers_total' => '0',
            //      'events_total' => '2',
            //      'main_calendar' => 'false',
            //      'date_create' => 1562358107,
            //      'date_modified' => 1562677087,
            //  ))

            $titleWithoutCommas = str_replace(',', '—', $calendar->title);

            $followers = $calendar->followers_active;
            if ($calendar->followers_active !== $calendar->followers_total) {
                $followers = $calendar->followers_active . ' (' . $calendar->followers_total . ' total)';
            }

            $dateModified = Carbon::createFromTimestamp($calendar->date_modified)->timezone('UTC')->toRfc850String();
            $dateModifiedWithoutComma = str_replace(',', '', $dateModified);

            $output =
                $titleWithoutCommas . ',' .
                $followers . ',' .
                $calendar->events_total . ',' .
                $dateModifiedWithoutComma . ',' .
                $calendar->uniquekey . ',' .
                $calendar->id;

            $this->info($output);
        }
        $this->info('');
        $this->info('--------------------------------------------------------------------------------------');
    }

    /**
     * @return void
     */
    private function listEventsInCalendar()
    {
        $calendars = [];
        $events = [];

        try {
            $calendars = $this->addEventService->getCalendars();
        } catch (Exception $e) {
            $this->info(
                'Exception with message: ' . $e->getMessage() . ' (file: ' . $e->getFile() . ', line: ' .
                $e->getLine() . ')'
            );
        }

        for ($i = 0; $i < count($calendars); $i++) {
            $calendar = $calendars[$i];
            $this->info($i . '. ' . $calendar->title);
        }
        $choice = $this->ask("Calendar: ");

        $calendar = $calendars[$choice];

        $calendarId = $calendar->id;

        $this->info('Showing events for "' . $calendar->title . '"');

        try {
            $events = $this->addEventService->listEventsInCalendar($calendarId);
        } catch (Exception $e) {
            $this->info(
                'Exception with message: ' . $e->getMessage() . ' (file: ' . $e->getFile() . ', line: ' .
                $e->getLine() . ')'
            );
        }

        $this->info('--------------------------------------------------------------------------------------');
        $this->info('    Note that following output is csv.');
        $this->info('        You can use it to create markdown table at donatstudios.com/CsvToMarkdownTable');
        $this->info('        Then use jbt.github.io/markdown-editor to view nicely.');
        $this->info('--------------------------------------------------------------------------------------');
        $this->info('');
        $this->info(
            'id,unique,title,date_start,date_start_time,date_start_ampm,date_start_unix,date_end,date_end_time,' .
            'date_end_ampm,date_end_unix,timezone,date_create,date_modified, first line from description'
        );

        foreach ($events as $event) {
            //stdClass::__set_state(array(
            //    'id' => '3718745',
            //    'unique' => 'KC3718745',
            //    'title' => 'Song Forms & "Disappear"',
            //    'description' => 'https://www.drumeo.com/members/content/227822 (and may include some line breaks)',
            //    'location' => '',
            //    'organizer' => 'Drumeo',
            //    'organizer_email' => 'jonathan+drumeo_addEvent@drumeo.com',
            //    'date_start' => '08/12/2019',
            //    'date_start_time' => '00:00:00',
            //    'date_start_ampm' => 'AM',
            //    'date_start_unix' => 1565568000,
            //    'date_end' => '08/12/2019',
            //    'date_end_time' => '01:00:00',
            //    'date_end_ampm' => 'AM',
            //    'date_end_unix' => 1565571600,
            //    'all_day_event' => 'false',
            //    'date_format' => 'MM/DD/YYYY',
            //    'timezone' => 'America/Los_Angeles',
            //    'reminder' => '0',
            //    'date_create' => 1562693427,
            //    'date_modified' => 1562693427,
            //    'updated_times' => '0',
            //))

            try {
                $descriptionFirstLine = explode(PHP_EOL, $event->description)[0];
            } catch (Exception $exception) {
                $descriptionFirstLine = '[ERROR while parsing first line of description]';
            }

            $output =
                $event->id . ',' .
                $event->unique . ',' .
                $event->title . ',' .
                $event->date_start . ',' .
                $event->date_start_time . ',' .
                $event->date_start_ampm . ',' .
                $event->date_start_unix . ',' .
                $event->date_end . ',' .
                $event->date_end_time . ',' .
                $event->date_end_ampm . ',' .
                $event->date_end_unix . ',' .
                $event->timezone . ',' .
                $event->date_create . ',' .
                $event->date_modified . ',' .
                $descriptionFirstLine;

            $this->info($output);
        }

        $this->info('');
        $this->info('--------------------------------------------------------------------------------------');
    }

    /**
     * @return void
     */
    private function deleteAllCalendars()
    {
        dd('manually disabled for safety reasons');

        $calendars = [];

        $expectedLastFourDigitsOfSandboxApiToken = '9660';
        $found = substr(config('addevent.api-token'), -4);
        if ($expectedLastFourDigitsOfSandboxApiToken !== $found) {
            $this->hardNo('Addevent API token');
        }

        $answer = $this->ask('What are the last four digits of the sandbox api token?');

        if ($answer !== $expectedLastFourDigitsOfSandboxApiToken) {
            $this->hardNo('Your answer');
        }

        try {
            $calendars = $this->addEventService->getCalendars();
        } catch (Exception $e) {
            $this->info(
                'Exception with message: ' . $e->getMessage() . ' (file: ' . $e->getFile() . ', line: ' .
                $e->getLine() . ')'
            );
        }

        $this->info('Number of calendars for which to attempt deletion: ' . count($calendars));

        foreach ($calendars as $calendar) {
            if ($calendar->followers_total > 0) {
                $this->info(
                    'Cannot delete calendars (in this case "' . $calendar->title . '", id:' . $calendar->id .
                    ') with subscribers! Make damned sure you have the sandbox account specified!'
                );
                $this->info('Exiting now');
                die();
            }

            $isMainCalendar = filter_var($calendar->main_calendar, FILTER_VALIDATE_BOOLEAN);
            if ($isMainCalendar) {
                $this->info(
                    'Did not delete calendar "' . $calendar->title . '" (' . $calendar->id .
                    ') because it is the main calendar and cannot be deleted'
                );
                break;
            }

            try {
                $this->addEventService->deleteCalendar($calendar->id);
                $str = 'Deleted calendar ' . $calendar->id . ', "' . $calendar->title . '"';
                $this->info($str);
            } catch (Exception $e) {
                $this->info(
                    'Exception with message: ' . $e->getMessage() . ' (file: ' . $e->getFile() . ', line: ' .
                    $e->getLine() . ')'
                );
            }
        }
    }

    private function overviewCurrent()
    {
        try {
            $calendars = $this->addEventService->getCalendars();
        } catch (Exception $e) {
            $this->info(
                'Exception with message: ' . $e->getMessage() . ' (file: ' . $e->getFile() . ', line: ' .
                $e->getLine() . ')'
            );
        }

        $this->info('--------------------------------------------------------------------------------------');
        $this->info('    Note that following output is csv.');
        $this->info('        You can use it to create markdown table at donatstudios.com/CsvToMarkdownTable');
        $this->info('        Then use jbt.github.io/markdown-editor to view nicely.');
        $this->info('--------------------------------------------------------------------------------------');
        $this->info('');
        $this->info('calendar_title,calendar_uniquekey,id,unique_key,startTime,title,date_modified,content_id,cmsUrl,errorMsg');

        foreach ($calendars ?? [] as $calendar) {

            //  each calendar will look like this:
            //
            //  stdClass::__set_state(array(
            //      'id' => '1562358107218468',
            //      'uniquekey' => 'it218468',
            //      'title' => 'Drumeo - ',
            //      'description' => '',
            //      'followers_active' => '0',
            //      'followers_total' => '0',
            //      'events_total' => '2',
            //      'main_calendar' => 'false',
            //      'date_create' => 1562358107,
            //      'date_modified' => 1562677087,
            //  ))

            if ($calendar->events_total == '0') {
                continue;
            }

            try {
                $events = $this->addEventService->listEventsInCalendar($calendar->id);
            } catch (Exception $e) {
                $this->info(
                    'Exception with message: ' . $e->getMessage() . ' (file: ' . $e->getFile() . ', line: ' .
                    $e->getLine() . ')'
                );
            }

            foreach ($events as $event) {
                //stdClass::__set_state(array(
                //    'id' => '3718745',
                //    'unique' => 'KC3718745',
                //    'title' => 'Song Forms & "Disappear"',
                //    'description' => 'https://www.drumeo.com/members/content/227822 (and may include some line breaks)',
                //    'location' => '',
                //    'organizer' => 'Drumeo',
                //    'organizer_email' => 'jonathan+drumeo_addEvent@drumeo.com',
                //    'date_start' => '08/12/2019',
                //    'date_start_time' => '00:00:00',
                //    'date_start_ampm' => 'AM',
                //    'date_start_unix' => 1565568000,
                //    'date_end' => '08/12/2019',
                //    'date_end_time' => '01:00:00',
                //    'date_end_ampm' => 'AM',
                //    'date_end_unix' => 1565571600,
                //    'all_day_event' => 'false',
                //    'date_format' => 'MM/DD/YYYY',
                //    'timezone' => 'America/Los_Angeles',
                //    'reminder' => '0',
                //    'date_create' => 1562693427,
                //    'date_modified' => 1562693427,
                //    'updated_times' => '0',
                //))

                $startTimeCarbon = Carbon::createFromTimestamp($event->date_start_unix);
                $eventIsInFuture = $startTimeCarbon->gt(Carbon::now());

                if(!$eventIsInFuture){
                    continue;
                }

                try {
                    $str = str_replace(',', '&#44;', $event->description);
                    $str = explode('\n', $str)[0];
                    $str = str_replace(' ', '', $str);

                    $contentId = 'n/a';
                    $brand = 'n/a';
                    $cmsUrl = 'n/a';

                    if(str_contains($str, '/content/')){
                        $arr = explode('/content/', $str);
                        $contentId = $arr[1];
                        $arr = explode('/', $arr[0]);
                        $brand = end($arr);
                        $cmsUrl = 'https://admin.musora.com/admin#/content/' . $brand . '/' . $contentId;
                    }

                } catch (Exception $exception) {
                    $errorMsg = $exception->getMessage();
                    $contentId = 'ERROR';
                    $brand = 'ERROR';
                    $cmsUrl = 'ERROR';


                    $this->info('');
                    $this->info('$errorMsg: "' . $errorMsg . '"');
                    dump($arr);
                    $this->info('');
                    $this->info('');
                }

                $dateModified = Carbon::createFromTimestamp($event->date_modified)->toDateTimeString();

                $output =
                    $calendar->title . ',' . // calendar_title
                    $calendar->uniquekey . ',' . // calendar_uniquekey
                    $event->id . ',' . // id
                    $event->unique . ',' . // unique_key
                    $startTimeCarbon->toDateTimeString() . ',' . // startTime
                    $event->title . ',' . // title
                    $dateModified . ',' . // date_modified
                    $contentId . ',' . // content_id
                    $cmsUrl . ',' . // cmsUrl
                    ($errorMsg ?? ''); // errorMsg

                $this->info($output);
            }

        }
        $this->info('');
        $this->info('--------------------------------------------------------------------------------------');
    }

    private function overviewLastMonth()
    {

    }

    // =================================================================================================================
    // 3. CALENDAR-ID-GETTING ACTIONS AND THEIR HELPERS ================================================================
    // =================================================================================================================

    /**
     * @return void
     */
    private function getCalendarIdsForMusora(): void
    {
        $calendarsByNiceName = $this->getCalendarsKeyedByNiceNames();

        $this->info('copy and paste this into \'uniquekeys-by-brand\' array under relevant brand in config/addevent.php in Musora');
        $this->info('-----------------------------------------------------------------------------------------');
        $this->info('');
        $this->info('');

        // STANDARD (CONTENT-RELEASE AND LIVE-LESSONS) CALENDARS =======================================================

        $this->info("// $this->brand");
        $this->printTypeSpecific($calendarsByNiceName);

        $this->info('');
        $this->info('');
        $this->info('-----------------------------------------------------------------------------------------');
    }

    /**
     * @return void
     */
    private function getCalendarIdsForBrandSite(): void
    {
        $calendarsByNiceName = $this->getCalendarsKeyedByNiceNames();

        $this->info('copy and paste this into \'uniquekeys\' array in config/addevent.php in each brand site');
        $this->info('-----------------------------------------------------------------------------------------');
        $this->info('');
        $this->info('');

        $this->info("// $this->brand");

        // BRAND OVERVIEW CALENDAR =====================================================================================

        if (isset($calendarsByNiceName[''])) {
            $brandOverviewUniqueKey = $calendarsByNiceName['']->uniquekey;
            $this->info("'brand-overview' => '$brandOverviewUniqueKey',");
        } else {
            $this->info("//'brand-overview' => null, // No brand overview calendar found");
        }

        // STANDARD (CONTENT-RELEASE AND LIVE-LESSONS) CALENDARS =======================================================

        $this->printTypeSpecific($calendarsByNiceName);

        // COACHES CALENDARS ===========================================================================================

        ConfigService::$availableBrands = [$this->brand];
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        ContentRepository::$pullFutureContent = false;

        $coaches = $this->contentService->getFiltered(
            1,
            500,
            'slug',
            ['instructor'],
            [],
            [],
            ['is_coach,1'],
            [],
            [],
            [],
            true,
            false,
            true,
            false
        )['results'];

        foreach ($coaches as $coach) {
            $calendarName = ucfirst($this->brand) . ' - ' . $coach->fetch('fields.name');
            foreach ($calendarsByNiceName as $niceName => $calendar) {
                $expectedCalendarName = ucfirst($this->brand) . ' - ' . $niceName;
                $nameMatch = $calendarName === $expectedCalendarName;
                $syncIdMatch = false;
                $customData = json_decode($calendar->custom_data, true);
                if (!empty($customData[AddEventService::SYNC_ID_KEY])) {
                    $expectedSyncId = $coach->fetch('id') . '_' . $this->brand . '_' . $coach->fetch('type');
                    $syncIdMatch = $customData[AddEventService::SYNC_ID_KEY] == $expectedSyncId;
                }

                if ($syncIdMatch && $nameMatch) {
                    // if they both match, great
                    $outputForCoaches[$coach->fetch('slug')] = $calendar->uniquekey;
                } else {
                    // both don't match that's fine
                    if ($syncIdMatch || $nameMatch) {

                        /*
                         * calendars for the first set of coaches didn't have a sync-id set on them thus they fail
                         * that check here. A bit hacky, but until such time as you create a command to fix this issue
                         * by adding sync ids to these instructor calendars, this gets the job done.
                        */
                        $knowIssueArray = [
                            'Drumeo - Aric Improta',
                            'Drumeo - Domino Santantonio',
                            'Drumeo - Dorothea Taylor',
                            'Drumeo - Jared Falk',
                            'Drumeo - John Wooton',
                            'Drumeo - Kaz Rodriguez',
                            'Drumeo - Larnell Lewis',
                            'Drumeo - Michael Schack',
                            'Drumeo - Todd Sucherman',
                        ];

                        if(in_array($calendarName, $knowIssueArray)){
                            $outputForCoaches[$coach->fetch('slug')] = $calendar->uniquekey;
                            $this->info(
                                '// Special case, adding instructor' . $coach->fetch('slug') . ' for uniquekey: ' .
                                $calendar->uniquekey
                            );
                        } else {
                            // but if one matches and one does that should not happen
                            if ($syncIdMatch) {
                                $this->info('ERROR: sync_ids match but names do NOT');
                            }
                            if ($nameMatch) {
                                $this->info('ERROR: names match but sync_ids do NOT');
                            }
                        }

//                        $this->info('slug ' . $coach->fetch('slug'));
//                        $this->info('uniquekey ' . $calendar->uniquekey);
//                        $this->info('$customData[AddEventService::SYNC_ID_KEY] ' . $customData[AddEventService::SYNC_ID_KEY]);
//                        $this->info('$expectedSyncId ' . $expectedSyncId);
//                        $this->info('$calendarName ' . $calendarName);
//                        $this->info('$expectedCalendarName ' . $expectedCalendarName);
//                        $this->info('================================================');
//                        $this->info(
//                            'This should not be possible and could represent either a significant ' .
//                            'bug in our system, or just that this function needs an update to some general ' .
//                            'information schema change'
//                        );
//                        $this->info(
//                            'Exiting now because with this error the product of this command is unreliable'
//                        );
                    }
                }
            }
        }


        $this->info("'by-coach' => [");
        foreach ($outputForCoaches ?? [] as $key => $value) {
            $this->info("    '$key' => '$value',");
        }
        $this->info("],");

        $this->info('');
        $this->info('');
        $this->info('-----------------------------------------------------------------------------------------');
    }

    /**
     * @param $calendarsByNiceName
     * @return void
     */
    private function printTypeSpecific($calendarsByNiceName): void
    {
        $regularContent = config('addevent.type-specific-calendar-nice-names-by-type.' . $this->brand);

        foreach ($regularContent as $type => $title) {
            foreach ($calendarsByNiceName as $niceName => $calendar) {
                if ($title === $niceName) {
                    $outputForContentSpecific[$type] = $calendar->uniquekey;
                    break;
                }
            }
        }
        $this->info("'by-type' => [");
        foreach ($outputForContentSpecific ?? [] as $key => $value) {
            $this->info("    '$key' => '$value',");
        }
        $this->info("],");
    }

    /**
     * @return array
     */
    private function getCalendarsKeyedByNiceNames(): array
    {
        foreach ($this->addEventService->calendars as $calendar) {
            $brandForEval = strtolower(strtok($calendar->title, ' - '));
            $startOfTitle = ucwords($this->brand) . ' - ';
            $lengthToRemove = strlen($startOfTitle);

            if ($this->brand === $brandForEval) {
                $niceName = substr($calendar->title, $lengthToRemove);
                if (!$niceName) {
                    $niceName = '';
                }
                $calendarsByNiceName[$niceName] = $calendar;
            }
        }

        return $calendarsByNiceName ?? [];
    }

    // =================================================================================================================
    // 4. HELPER METHODS ===============================================================================================
    // =================================================================================================================

    /**
     * @param string $additionalMessage
     * @return void
     */
    private function confirmNotInSandbox(string $additionalMessage = ''): void
    {
        $lastFourCharOfToken = substr(config('addevent.api-token'), -4);

        if ($lastFourCharOfToken !== self::$expectedLastFourDigitsOfSandboxApiToken) {
            $confirmationPhrase = 'yes i want to proceed';
            $this->info('------------------------------ -------- ------------------------------');
            $this->info('------------------------------ WARNING! ------------------------------');
            $this->info('------------------------------ -------- ------------------------------');
            $this->info(
                $additionalMessage .
                'The currently available AddEvent API token does not match last known sandbox token ' .
                'hard-coded in AddEventCommand. If you really want to proceed—and potentially delete events or ' .
                'calendars in the production calendars that actual users have added to their personal schedules——' .
                'please confirm below. YOU HAVE BEEN WARNED. Otherwise enter any other text or just press "enter" exit.'
            );
            $enteredText = $this->ask('To proceed type "' . $confirmationPhrase . '" below:');
            if (strtolower($enteredText) !== $confirmationPhrase) {
                $this->info('Exiting now.');
                die();
            }
        }

        $this->info('Hold on to your butts.');
    }

    /**
     * @return void
     * @throws Exception
     */
    private function setBrandAndContentType(): void
    {
        $brandArgument = $this->argument('brandArgument');

        $brands = config('addevent.brands-enabled');

        if (empty($brands)) {
            throw new Exception('No brands in config.');
        };

        if (in_array($brandArgument, $brands)) {
            $brand = $brandArgument;
        }

        if (empty($brand)) {
            $this->info('Brand parameter missing. Try again, specifying one of the available brands:');
            foreach ($brands as $brandOption) {
                $this->info('    * ' . $brandOption);
            }
            die();
        }

        ConfigService::$brand = $brand;
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    private function getAction(): string
    {
        $options = self::$ACTIONS;

        $selectionAsParam = $this->argument('selection');

        $selection = $selectionAsParam;

        if (!$selection) {
            for ($i = 0; $i <= (count($options) - 1); $i++) {
                $listItemNumber = $i + 1;
                if ($listItemNumber < 10) {
                    $this->info(' ' . $listItemNumber . '. ' . $options[$i]);
                } else {
                    $this->info($listItemNumber . '. ' . $options[$i]);
                }
            }
            $selection = $this->ask('Enter the number corresponding to the command to run');
        }

        $validResponse = (int)$selection > 0 && $selection <= count($options);

        if (!$validResponse) {
            if ($selectionAsParam) {
                $this->info(
                    'You must enter a valid option. Run again but ' .
                    'with no arguments to see available options.'
                );
                die();
            }
            $this->info('You must enter one of the options presented. Exiting now. Please try again.');
            die();
        }

        $action = $options[$selection - 1];

        $this->info('You have selected "' . $action . '".');

        return $action;
    }

    /**
     * @param $calendar
     * @param $string
     * @return bool
     */
    private function doesCalendarTitleStartWithPassedString($calendar, $string): bool
    {
        $lengthOfNiceName = strlen($string);
        $firstXNumberOfCharactersFromCalendarName = substr($calendar->title, 0, $lengthOfNiceName);
        return $firstXNumberOfCharactersFromCalendarName === $string;
    }

    /**
     * @param $msgStart
     * @return void
     */
    private function hardNo($msgStart)
    {
        $this->info('');
        $this->info(
            'DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED'
        );
        $this->info('');
        $this->info(
            $msgStart . ' does not match hardcoded expectations. This is to protect the ' .
            'production calendars. Ensure you have the sandbox token not the production token. If this persists ' .
            'despite that, update this command\'s hardcoded expectation accordingly. Yes, this is in addition to ' .
            'earlier check. If you really want to delete ALL the prod calendars, you\'re gonna have to work for it.'
        );
        $this->info('');
        $this->info(
            'DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED DENIED'
        );
        $this->info('');
        $this->info('Exiting now.');
        die();
    }
}
