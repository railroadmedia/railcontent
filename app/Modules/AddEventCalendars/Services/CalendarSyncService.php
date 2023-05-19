<?php

namespace App\Modules\AddEventCalendars\Services;

use App\Modules\AddEventCalendars\Models\AddEventCalendar;
use App\Modules\AddEventCalendars\Models\AddEventCalendarEventVO;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Entities\ContentEntity;

class CalendarSyncService
{
    private AddEventService $addEventService;

    public function __construct(
        AddEventService $addEventService
    ) {
        $this->addEventService = $addEventService;
    }

    public function syncContentListToCalendar($contentList, AddEventCalendar $calendar): void
    {
        $existingEvents = $this->addEventService->getExistingEvents($calendar, now()->subMonth()->toDateTimeString());
        /** @var ContentEntity $contentEntity */
        foreach ($contentList as $contentEntity) {
            $this->syncContentToCalendar($contentEntity, $calendar, $existingEvents);
        }
        $this->deleteEvents($contentList, $existingEvents);
    }

    private function syncContentToCalendar(
        ContentEntity $contentEntity,
        AddEventCalendar $calendar,
        array $events,
    ): void {
        $brand = $contentEntity['brand'];
        $eventVO = new AddEventCalendarEventVO();
        $eventVO->setInternalData(
            $brand,
            $contentEntity->fetch('type'),
            $contentEntity->fetch('id'),
            $contentEntity->fetch('fields.title'),
            $contentEntity->fetch('published_on'),
            $contentEntity->fetch('fields.live_event_start_time', null),
            $contentEntity->fetch('fields.live_event_end_time', null),
            $contentEntity->fetch('fields.live_stream_feed_type', null),
            $contentEntity->fetch('data.description')
        );

        if (!empty($events)) {
            foreach ($events as $existingEvent) {
                $this->setExternalDataIfAvailable($existingEvent, $eventVO);
            }
        }

        if ($eventVO->apiCreateRequired()) {
            $this->createEvent($calendar, $eventVO);
        } elseif ($eventVO->apiUpdateRequired()) {
            $this->updateEvent($eventVO);
        } else {
            Log::info('No create or update required for ' . $eventVO->getInternalSyncId());
        }
    }

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


    private function createEvent(AddEventCalendar $calendar, AddEventCalendarEventVO $eventVO): void
    {
        try {
            $this->addEventService->createEvent(
                $calendar,
                $eventVO->getTitleToSync(),
                'UTC',
                $eventVO->getStartTimeToSync(),     // Carbon, nullable
                $eventVO->getEndTimeToSync(),       // Carbon nullable
                $eventVO->getDescriptionToSync(),   // nullable
                null,
                null,
                null,
                null,
                false,
                true,
                [AddEventService::SYNC_ID_KEY => $eventVO->getInternalSyncId()]
            );
            Log::info('Created event for ' . $eventVO->getInternalSyncId() . ' in calendar ' . $calendar->id);
        } catch (Exception $e) {
            Log::info('Create failed. Error message: "' . $e->getMessage() . '". See logs for more details');
        }
    }

    private function updateEvent(AddEventCalendarEventVO $eventVO): void
    {
        try {
            $this->addEventService->editEvent(
                $eventVO->getExternalId(),
                $eventVO->getTitleToSync(),
                'UTC',
                $eventVO->getStartTimeToSync(),
                $eventVO->getEndTimeToSync(),
                $eventVO->getDescriptionToSync(),
                null,
                null,
                false,
                null,
                null,
                $eventVO->getExternalCustomDataArray()
            );
            Log::info('Updated event ' . $eventVO->getExternalId());
        } catch (Exception $e) {
            Log::info(
                'Failed to update event ' . $eventVO->getExternalId() . '. Error message: "' . $e->getMessage() .
                '". See logs for full exception details'
            );
            error_log($e);
        }
    }


    public function deleteEvents($content, $events)
    {
        $calendarHasMoreEventsThanReturned = count($events) > count($content);

        if ($calendarHasMoreEventsThanReturned) {
            foreach ($events as $key => $event) {
                // if event is past, it is not a candidate for deletion, thus disregard it
                if (Carbon::createFromTimestamp($event->date_start_unix)->lt(Carbon::now())) {
                    unset($events[$key]);
                }

                // if event is in list content returned when querying for future releases, it is not a candidate for
                // deletion, thus disregard it
                /** @var ContentEntity $contentEntity */
                foreach ($content as $contentEntity) {
                    $brand = $contentEntity['brand'];
                    $internalSyncId = $contentEntity->fetch('id') . '_' . $brand . '_' . $contentEntity->fetch('type');
                    $externalSyncId = json_decode(
                        $event->custom_data,
                        true
                    )[AddEventService::SYNC_ID_KEY] ?? null;
                    if ($internalSyncId === $externalSyncId) {
                        unset($events[$key]);
                    }
                }
            }

            foreach ($events as $eventToDelete) {
                try {
                    $syncId = json_decode(
                        $eventToDelete->custom_data,
                        true
                    )[AddEventService::SYNC_ID_KEY] ?? null;
                    $this->addEventService->deleteEvent($eventToDelete->id);
                    Log::info(
                        'Deleted event "' . $eventToDelete->title . '"' . ($syncId ? ' (' . $syncId . ')' : '')
                    );
                } catch (Exception $e) {
                    Log::info(
                        'Failed to delete event ' . $eventToDelete->id . '. Error message: "' . $e->getMessage() .
                        '". Please see logs for full details'
                    );
                }
            }
        }
    }

    public function syncCalendarData(): void
    {
        AddEventCalendar::query()->delete();

        $calendars = $this->addEventService->getCalendars();

        foreach ($calendars as $calendar) {
            $data = new AddEventCalendar();
            $data->id = $calendar->id;
            $data->uniquekey = $calendar->uniquekey;
            $data->title = $calendar->title;
            $data->save();
        }
    }

}
