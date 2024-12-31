<?php

namespace App\Modules\AddEventCalendars\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\AddEventCalendars\Services\AddEventService;
use App\Modules\AddEventCalendars\Services\CalendarSyncService;
use App\Modules\Content\ApiGateways\SanityGateway;
use Illuminate\Support\Facades\App;

class AddEventCalendarContentSync extends Command
{
    protected $signature = 'addevent:syncBrand {brand}';
    protected $description = 'AddEventCalendarContentSync';

    private AddEventService $addEventService;
    private SanityGateway $sanityGateway;
    private CalendarSyncService $calendarSyncService;

    private static $expectedLastFourDigitsOfSandboxApiToken = '9660';

    public function handle(
        AddEventService $addEventService,
        SanityGateway $sanityGateway,
        CalendarSyncService $calendarSyncService,
    ) {
        $this->addEventService = $addEventService;
        $this->sanityGateway = $sanityGateway;
        $this->calendarSyncService = $calendarSyncService;

        $this->environmentSafetyCheck();

        $this->withExecutionTime(function () {
            $brands = $this->determineBrands();
            foreach ($brands as $brand) {
                /*
                 * synchronize brand overview and content-specific calendars
                 * May need to run addevent:syncCalendarData to sync local database calendars
    $scheduledEvents$scheduledEvents
                 */
                $this->info("Finding $brand scheduled content");
                $typeUniquekeyMap = config("addevent.uniquekeys-by-brand.$brand.by-type", []);
                $scheduledEvents = $this->sanityGateway->getScheduledContent($brand, array_keys($typeUniquekeyMap));
                $count = count($scheduledEvents);
                $this->info("$count scheduled events found.");
                $calendarName = $this->addEventService->generateBrandOverviewCalendarName($brand);
                $calendar = $this->addEventService->getCalendarByNameIfExists($calendarName);
                $this->calendarSyncService->syncContentListToCalendar($scheduledEvents, $calendar);
            }
        });
        return self::SUCCESS;
    }

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
