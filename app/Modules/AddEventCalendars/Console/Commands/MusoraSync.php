<?php

namespace App\Modules\AddEventCalendars\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Maps\ContentTypes;
use App\Modules\AddEventCalendars\Services\AddEventService;
use App\Modules\AddEventCalendars\Services\CalendarSyncService;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class MusoraSync extends Command
{

    protected $signature = 'addevent:syncMusora {--live}';
    protected $description = 'AddEventMusoraCalendarSync';
    private AddEventService $addEventService;
    private ContentService $contentService;
    private CalendarSyncService $calendarSyncService;

    private bool $isLiveEvents;

    public function handle(
        AddEventService $addEventService,
        ContentService $contentService,
        CalendarSyncService $calendarSyncService,
    ) {
        $this->addEventService = $addEventService;
        $this->contentService = $contentService;
        $this->calendarSyncService = $calendarSyncService;
        $this->isLiveEvents = $this->option('live');
        $this->withExecutionTime(function () {
            $this->syncMusoraCalendar();
        });
    }

    private function syncMusoraCalendar()
    {
        $calendar = $this->addEventService->getCalendarByNameIfExists($this->isLiveEvents ? 'Musora Live' : 'Musora');
        $allContent = $this->getAllContent();
        $this->calendarSyncService->syncContentListToCalendar($allContent, $calendar);
    }

    public function getAllContent()
    : array
    {
        $this->info('Loading all content');

        $allContent = [];

        $brands = config('addevent.brands-enabled');

        foreach ($brands as $brand) {
            $typeUniquekeyMap = $this->filterContentTypes(config("addevent.uniquekeys-by-brand.$brand.by-type", []));
            foreach ($typeUniquekeyMap as $typeOrSlug => $calendarUniqueId) {
                $content = $this->getContentByContentType($brand, $typeOrSlug);
                $allContent = array_merge($allContent, $content); // needed for brand-overview calendar
            }
        }
        return $allContent;
    }

    private function filterContentTypes($contentTypes): array {
        return $this->isLiveEvents ? array_filter($contentTypes, function ($k) {
            return in_array($k, ContentTypes::liveContentTypes());
        }, ARRAY_FILTER_USE_KEY) : $contentTypes;
    }

    private function getContentByContentType($brand, $type)
    : array {
        $page = 1;
        $content = [];

        ConfigService::$availableBrands = [$brand];
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
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

            $contentThisLoop =
                $contentQuery->results()
                    ->all();

            if (count($contentThisLoop) > 0) {
                $content = array_merge($content, $contentThisLoop);
            }

            $page++;
        } while (count($contentThisLoop) > 0);

        return $content ?? [];
    }

}
