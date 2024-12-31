<?php

namespace App\Modules\AddEventCalendars\Console\Commands;

use App\Modules\AddEventCalendars\Models\AddEventCalendarEventVO;
use App\Modules\AddEventCalendars\Services\AddEventService;
use App\Modules\AddEventCalendars\Services\CalendarSyncService;
use App\Modules\Content\ApiGateways\SanityGateway;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class AddEventCalendarContentSync extends Command
{
    protected $signature = 'addevent:syncBrand {brand}';
    protected $description = 'AddEventCalendarContentSync';

    private AddEventService $addEventService;
    private SanityGateway $sanityGateway;
    private CalendarSyncService $calendarSyncService;

    private $brandOverviewCalendar;

    private static $expectedLastFourDigitsOfSandboxApiToken = '9660';

    public function handle(
        AddEventService $addEventService,
        SanityGateway $sanityGateway,
        CalendarSyncService $calendarSyncService,
    ) {
        $this->addEventService = $addEventService;
        $this->sanityGateway = $sanityGateway;
        $this->calendarSyncService = $calendarSyncService;

        //$this->environmentSafetyCheck();

        $brands = $this->determineBrands();

        $timeTotalStart = time();

        $this->info('Starting AddEventCalendarContentSync.');

        foreach ($brands as $brand) {
            // fetch addevent data
//            $this->addEventService->init($brand);
//            $this->initBrandOverviewCalendar($brand);

            /*
             * synchronize brand overview and content-specific calendars
             * May need to run addevent:syncCalendarData to sync local database calendars
$scheduledEvents$scheduledEvents
             */
            $this->info("Finding $brand scheduled content");
            $scheduledEvents = $this->sanityGateway->getScheduledContent($brand);
            $count = count($scheduledEvents);
            $this->info("$count scheduled events found.");
            $calendarName = $this->addEventService->generateBrandOverviewCalendarName($brand);
            $calendar = $this->addEventService->getCalendarByNameIfExists($calendarName);
            $this->calendarSyncService->syncContentListToCalendar($scheduledEvents, $calendar);
        }

        $timeTotalDurationSeconds = (time() - $timeTotalStart);
        $timeTotalDurationMinutes = floor($timeTotalDurationSeconds / 60);

        $this->info(
            '========== AddEventCalendarContentSync finished in ' . $timeTotalDurationMinutes . ' minutes and ' .
            ($timeTotalDurationSeconds - ($timeTotalDurationMinutes * 60)) . ' seconds =========='
        );


        return true;
    }

    // =================================================================================================================
    // AddEvent related methods
    // =================================================================================================================


    /**
     * @param $existingEvent
     * @param AddEventCalendarEventVO $eventVO
     * @return void
     */
    private function setExternalDataIfAvailable($existingEvent, AddEventCalendarEventVO &$eventVO)
    {
        $customData = json_decode($existingEvent->custom_data, true);

        if ($eventVO->getInternalSyncId() == ($customData[AddEventService::SYNC_ID_KEY] ?? null)) {
            $eventVO->setExternalData(
                $existingEvent->id,
                null,
                $existingEvent->unique,
                $existingEvent->title,
                null,
                $existingEvent->description,
                $existingEvent->location,
                $existingEvent->organizer,
                $existingEvent->organizer_email,
                $existingEvent->date_start,
                $existingEvent->date_start_time,
                $existingEvent->date_start_ampm,
                $existingEvent->date_start_unix,
                $existingEvent->date_end,
                $existingEvent->date_end_time,
                $existingEvent->date_end_ampm,
                $existingEvent->date_end_unix,
                $existingEvent->all_day_event ?? null,
                $existingEvent->date_format,
                $existingEvent->timezone,
                $existingEvent->reminder,
                $existingEvent->rrule,
                $existingEvent->template_id,
                $existingEvent->color,
                $existingEvent->updated_times,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                $existingEvent->custom_data,
                $existingEvent->link_short,
                $existingEvent->link_long,
                $existingEvent->date_create,
                $existingEvent->date_modified
            );
        }
    }



    /**
     * @param string $additionalMessage
     * @return void
     */
    private function environmentSafetyCheck(): void
    {
        if (App::environment() === 'local') {
            $lastFourCharOfToken = substr(config('addevent.api-token'), -4);

            if ($lastFourCharOfToken !== self::$expectedLastFourDigitsOfSandboxApiToken) {
                $confirmationPhrase = 'yes i want to proceed';
                $this->info('------------------------------ -------- ------------------------------');
                $this->info('------------------------------ WARNING! ------------------------------');
                $this->info('------------------------------ -------- ------------------------------');
                $this->info(
                    'The currently available AddEvent API token does not match last known sandbox token ' .
                    'hard-coded in this command. If you really want to proceed—and potentially delete events or ' .
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
    }

    private function determineBrands()
    {
        $brands = config('addevent.brands-enabled');

        $brand = $this->argument('brand');

        if ($brand) {
            if (!in_array($brand, $brands)) {
                $this->info(
                    'Argument "' . $brand . '" specified for \'brand\' does not match any options in list of ' .
                    'configured brands (in \'addevent.brands-enabled\'). Exiting now.'
                );
                exit;
            }
            $brands = [$brand];
        }

        return $brands;
    }
}
