<?php

namespace App\Modules\AddEventCalendars\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\AddEventCalendars\Models\AddEventCalendarVO;
use App\Modules\AddEventCalendars\Services\AddEventService;
use App\Modules\AddEventCalendars\Services\CalendarSyncService;
use Exception;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class BrandCalendarSync extends Command
{
    protected $signature = 'addevent:syncBrandCalendar {brand}';

    private AddEventService $addEventService;
    private ContentService $contentService;

    private CalendarSyncService $calendarSyncService;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        AddEventService $addEventService,
        ContentService $contentService,
        CalendarSyncService $calendarSyncService
    ) {
        parent::__construct();
        $this->addEventService = $addEventService;
        $this->contentService = $contentService;
        $this->calendarSyncService = $calendarSyncService;
    }

    public function handle()
    {
        $this->withExecutionTime(function () {
            $brand = $this->determineBrand();

            $this->syncInstructors($brand);

            /*
             * synchronize brand overview and content-specific calendars
             *
             * NOTE: the following only synchronizes calendars configured in config/addevent.php, You must run
             * "createAllCalendarsForBrand" and then "getCalendarIdsForMusora" and paste the output of that to
             * config/addevent.php
             */
            $this->syncTypeSpecificAndOverview($brand);
        });
    }

    // =================================================================================================================
    // coaches calendars sync and immediate helper methods
    // =================================================================================================================

    /**
     * @return void
     * @throws Exception
     */
    private function syncInstructors($brand)
    {
        // Next we can pull all events for all calendars scheduled in the future (past a specified date).
        // https://www.addevent.com/documentation/calendar-api#anchor-calendar-all-events
        // Must pull using pagination. This will prevent us having to make an api call for each event.
        // Once we have this array we can use it to determine if an event should be updated, created, or deleted.

        $this->info('starting syncInstructors()');
        $timeStartMs = microtime(true);

        $coaches = $this->coaches($brand);

        $this->info(
            'fetched ' . $coaches->count() . ' coaches in ' . round((microtime(true) - $timeStartMs) * 1000) . 'ms'
        );

        $createdCalendars = $this->syncCoachCalendars($coaches);

        if ($createdCalendars) {
            $this->addEventService->init($brand);
        }
        $this->syncCoachCalendarEvents($brand, $coaches);
    }

    /**
     * @param $brand
     * @return Collection
     */
    private function coaches($brand): Collection
    {
        ConfigService::$availableBrands = [$brand];
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        ContentRepository::$pullFutureContent = false;

        $coaches = $this->contentService->getFiltered(
            1,
            500,
            '-published_on',
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

//        if (app()->environment() == 'local') {
//            $this->constrainCoachesToOnlyThoseWithContentReleasesComingUp($coaches, $brand);
//        } else {
//            $this->info('Syncronizing for the ' . count($coaches) . ' ' . $brand . ' coaches retrieved');
//        }

        return $coaches;
    }

    /**
     * @param Collection $coaches
     * @return bool
     */
    private function syncCoachCalendars(Collection $coaches): bool
    {
        $calendarVOs = [];
        $createdACalendar = false;

        $this->info('');
        $this->info('# Synchronizing coach calendars (only calendars themselves, not events yet)');

        foreach ($coaches as $coach) {
            $calendarVO = new AddEventCalendarVO();

            $calendarVO->setInternalData(
                $coach['id'],
                $coach['brand'],
                $coach['type'],
                $coach->fetch('fields.name'),
                $coach->fetch('fields.short_bio')
            );

            // if the sync ids match, populate VOs with external data from the API data
            //foreach ($this->calendarsApiData as $calendarApiData) {
            foreach ($this->addEventService->calendars as $calendarApiData) {
                $calendarExternalCustomDataArray = json_decode($calendarApiData->custom_data, true);
                $externalSyncId = $calendarExternalCustomDataArray[AddEventService::SYNC_ID_KEY] ?? null;

                if ($externalSyncId == $calendarVO->getInternalSyncId()) {
                    $calendarVO->setExternalData(
                        $calendarApiData->id,
                        $calendarApiData->uniquekey,
                        $calendarApiData->title,
                        $calendarApiData->description,
                        $calendarApiData->followers_active,
                        $calendarApiData->followers_total,
                        $calendarApiData->events_total,
                        $calendarApiData->main_calendar,
                        $calendarApiData->custom_data,
                        $calendarApiData->template_id,
                        $calendarApiData->link_short,
                        $calendarApiData->link_long,
                        $calendarApiData->date_create,
                        $calendarApiData->date_modified
                    );
                    $syncedCoachesCalendars[] = $calendarApiData->uniquekey;
                } else {
                    $isMainCal = filter_var($calendarApiData->main_calendar ?? false, FILTER_VALIDATE_BOOLEAN);
                    $calendarCustomDataContentType = $calendarExternalCustomDataArray['content_type'] ?? null;
                    $calendarCustomDataContentBrand = $calendarExternalCustomDataArray['content_brand'] ?? null;
                    $isACoachesCalendar = $calendarCustomDataContentType == 'instructor';
                    $brandMatch = $calendarCustomDataContentBrand == $coach['brand'];
                    if (!$isMainCal && $isACoachesCalendar && $brandMatch) {
                        $allCoachesCalendars[] = $calendarApiData->uniquekey;
                    }
                }
            }

            $calendarVOs[] = $calendarVO;
        }

        // for all VOs make necessary API calls for create/update
        foreach ($calendarVOs as $calendarVO) {
            if ($calendarVO->apiCreateRequired()) {
                // create using the API
                $msg = 'coach calendar "' . $calendarVO->getTitleToSync(
                    ) . '" for sync id ' . $calendarVO->getInternalSyncId();
                try {
                    $createdApiCalendarData = $this->addEventService->createCalendar(
                        $calendarVO->getTitleToSync(),
                        $calendarVO->getDescriptionToSync(),
                        $calendarVO->getCustomDataArrayToSync()
                    );

                    $createdACalendar = true;

                    $this->info('Created new ' . $msg);

                    // main_calendar this is strangely missing from return update data
                    $calendarVO->setExternalData(
                        $createdApiCalendarData->id,
                        $createdApiCalendarData->uniquekey,
                        $createdApiCalendarData->title,
                        $createdApiCalendarData->description,
                        $createdApiCalendarData->followers_active,
                        $createdApiCalendarData->followers_total,
                        $createdApiCalendarData->events_total,
                        $createdApiCalendarData->main_calendar ?? false,
                        $createdApiCalendarData->custom_data,
                        $createdApiCalendarData->template_id,
                        $createdApiCalendarData->link_short,
                        $createdApiCalendarData->link_long,
                        $createdApiCalendarData->date_create,
                        $createdApiCalendarData->date_modified
                    );
                } catch (Exception $e) {
                    error_log($e);
                    $this->info(
                        'Failed to create ' . $msg . '. Exception message: "' . $e->getMessage() .
                        '". See logs for full exception details'
                    );
                }
            } elseif ($calendarVO->apiUpdateRequired()) {
                $this->info('Updating new AddEvent calendar for sync ID: ' . $calendarVO->getInternalSyncId());
                // update using the API

                $msg = 'coach calendar "' . $calendarVO->getTitleToSync(
                    ) . '" for sync id ' . $calendarVO->getInternalSyncId();
                try {
                    $updatedCalendar = $this->addEventService->saveCalendar(
                        $calendarVO->getExternalId(),
                        $calendarVO->getTitleToSync(),
                        $calendarVO->getDescriptionToSync(),
                        $calendarVO->getCustomDataArrayToSync()
                    );

                    $this->info('Updated ' . $msg);

                    // main_calendar this is strangely missing from return update data
                    $calendarVO->setExternalData(
                        $updatedCalendar->id,
                        $updatedCalendar->uniquekey,
                        $updatedCalendar->title,
                        $updatedCalendar->description,
                        $updatedCalendar->followers_active,
                        $updatedCalendar->followers_total,
                        $updatedCalendar->events_total,
                        $updatedCalendar->main_calendar ?? false,
                        $updatedCalendar->custom_data,
                        $updatedCalendar->template_id,
                        $updatedCalendar->link_short,
                        $updatedCalendar->link_long,
                        $updatedCalendar->date_create,
                        $updatedCalendar->date_modified
                    );
                } catch (Exception $e) {
                    error_log($e);
                    $this->info(
                        'Failed to create ' . $msg . '. Exception message: "' . $e->getMessage() .
                        '". See logs for full exception details'
                    );
                }
            } else {
                $this->info('No API call required for calendar sync ID: ' . $calendarVO->getInternalSyncId());
                // no API call required
            }
        }

        // rather than delete calendars, just print their ids

        $syncedCoachesCalendars = array_unique($syncedCoachesCalendars ?? []);
        $allCoachesCalendars = array_unique($allCoachesCalendars ?? []);

        $delCandidates = array_diff($allCoachesCalendars, $syncedCoachesCalendars);

        if (!empty($delCandidates)) {
            $this->info(
                'The following ' . count($delCandidates) . ' calendar(s) are candidates for deletion: ' .
                implode(', ', $delCandidates) .
                '. They did not have coaches to sync with, but are instructor calendars.'
            );
        }

        // return this so that we know whether we need to re-populate the array fetched calendars so that the event
        // sync has the updated totality of available calendars
        return $createdACalendar;
    }

    /**
     * @param $brand
     * @param $coaches
     * @return void
     * @throws Exception
     */
    private function syncCoachCalendarEvents($brand, $coaches)
    {
        $this->info('');
        $this->info('# Synchronizing events in coach calendars');

        /** @var ContentEntity $coach */
        foreach ($coaches as $coach) {
            $this->info('Synchronizing events in ' . $coach->fetch('fields.name') . ' coach calendar');

            // redundant, but better to have here unnecessarily than to copy past the section below somewhere and
            // forget that these settings are an important part of the query
            ConfigService::$availableBrands = [$brand];
            ContentRepository::$bypassPermissions = true;
            ContentRepository::$availableContentStatues = [
                ContentService::STATUS_PUBLISHED,
                ContentService::STATUS_SCHEDULED
            ];
            ContentRepository::$pullFutureContent = true;

            /** @var ContentEntity[] $contentForCoach */
            $contentForCoach = $this->contentService->getFiltered(
                1,
                -1,
                '-published_on',
                [],
                [],
                [],
                ['instructor,' . $coach['id']],
                [],
                [],
                [],
                true,
                true,
                true
            )['results'];

            $name = $coach->fetch('fields.name');
            $title = ucwords($coach['brand']) . ' - ' . $name;

            $calendar = $this->addEventService->getCalendarByNameIfExists($title);

            $this->calendarSyncService->syncContentListToCalendar($contentForCoach, $calendar);
        }
    }

    // =================================================================================================================
    // other calendars sync method
    // =================================================================================================================

    /**
     * @param $brand
     * @return void
     * @throws Exception
     */
    private function syncTypeSpecificAndOverview($brand)
    {
        $allContent = [];

        $this->info('# Synchronizing events in ' . $brand . ' type-specific calendars');
        $typeUniquekeyMap = config("addevent.uniquekeys-by-brand.$brand.by-type", []);

        foreach ($typeUniquekeyMap as $typeOrSlug => $calendarUniqueId) {
            $content = $this->getContentByContentType($brand, $typeOrSlug);

            $allContent = array_merge($allContent, $content); // needed for brand-overview calendar

            $calendar = $this->addEventService->getCalendarByNameIfExists($typeUniquekeyMap);
            $this->info('Content type ' . $typeOrSlug . ' has ' . count($content) . ' lesson(s)');

            if ($calendar) {
                $this->calendarSyncService->syncContentListToCalendar($content, $calendar);
            } else {
                $this->info("No $brand $typeOrSlug calendar found");
            }
        }

        $this->info('Synchronizing ' . $brand . ' brand-overview calendar');

        $calendar = $this->addEventService->getCalendarByNameIfExists(ucwords($brand));
        $this->calendarSyncService->syncContentListToCalendar($allContent, $calendar);
    }

    // =================================================================================================================
    // helper methods
    // =================================================================================================================

    /**
     * @param $brand
     * @param $type
     * @param $futureOnly
     * @return array
     */
    private function getContentByContentType($brand, $type): array
    {
        $page = 1;
        $content = [];

        ConfigService::$availableBrands = [$brand];
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED
        ];
        ContentRepository::$pullFutureContent = true;

        do {
            $contentQuery = $this->contentService->getFiltered(
                $page,
                200,
                '-published_on',
                [$type],
                [],
                [],
                [],
                [],
                [],
                [],
                true,
                true
            );

            $contentThisLoop = $contentQuery->results()->all();

            if (count($contentThisLoop) > 0) {
                $content = array_merge($content, $contentThisLoop);
            }

            $page++;
        } while (count($contentThisLoop) > 0);

        return $content ?? [];
    }

    /**
     * @param $coaches
     * @param $brand
     * @return void
     *
     * Only for development
     */
    private function constrainCoachesToOnlyThoseWithContentReleasesComingUp(&$coaches, $brand)
    {
        if (app()->environment() != 'local') {
            return;
        }

        //$overRide = ['mike-sleath'];                                  // dev and debugging aide. pick ONE
        //$overRide = ['mike-sleath', 'john-wooton', 'brandon-toews'];  // dev and debugging aide. pick ONE
        //$overRide = ['mike-sleath', 'john-wooton'];                   // dev and debugging aide. pick ONE
        $overRide = false;                                              // dev and debugging aide. pick ONE

        /** @var Collection $coaches */

        $lilHaystack = [];

        foreach ($coaches as $coach) {
            /** @var ContentEntity $coach */
            $instructorId = $coach->fetch('id');
            // redundant, but better to have here unnecessarily than to copy past the section below somewhere and
            // forget that these settings are an important part of the query
            ConfigService::$availableBrands = [$brand];
            ContentRepository::$bypassPermissions = true;
            ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
            ContentRepository::$pullFutureContent = true;

            $contentForCoach = $this->contentService->getFiltered(
                1,
                500,
                '-published_on',
                [], // $includedTypes
                [], // $slugHierarchy
                [], // $requiredParentIds
                ['instructor,' . $instructorId], // $requiredFields
                [], // $includedFields
                [], // $requiredUserStates
                [], // $includedUserStates
                true,
                true,
                true
            )['results'];

            if ($contentForCoach->isNotEmpty()) {
                $lilHaystack[] = $coach->fetch('slug');
            }
        }

        if ($overRide) {
            $lilHaystack = $overRide;
        }

        if (!empty($lilHaystack)) {
            $keep = new Collection();
            foreach ($coaches as $coach) {
                if (in_array($coach->fetch('slug'), $lilHaystack)) {
                    $keep->push($coach);
                }
            }
            $coaches = $keep;

            $lilHaystackImploded = implode(', ', $lilHaystack);
            $msg = 'That is currently the following coaches: ' . $lilHaystackImploded;
        } else {
            $coaches = $coaches->slice(0, 5);
            $msg = 'Buuuut... apparently no coaches meet that criteria, so instead here\'s just the first five instead';
        }

        $this->info(
            'NOTICE: Constraining coaches to only those with content scheduled for release for the sake of' .
            ' succinctness because you\'re apparently not on a production environment. ' . $msg
        );
    }

    private function determineBrand()
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
        }

        return $brand;
    }
}
