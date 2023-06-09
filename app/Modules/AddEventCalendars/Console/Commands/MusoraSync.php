<?php

namespace App\Modules\AddEventCalendars\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\AddEventCalendars\Services\AddEventService;
use App\Modules\AddEventCalendars\Services\CalendarSyncService;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class MusoraSync extends Command
{

    protected $signature = 'addevent:syncMusora';
    protected $description = 'AddEventMusoraCalendarSync';
    private AddEventService $addEventService;
    private ContentService $contentService;
    private CalendarSyncService $calendarSyncService;

    public function handle(
        AddEventService $addEventService,
        ContentService $contentService,
        CalendarSyncService $calendarSyncService,
    ) {
        $this->addEventService = $addEventService;
        $this->contentService = $contentService;
        $this->calendarSyncService = $calendarSyncService;
        $this->withExecutionTime(function () {
            $this->syncMusoraCalendar();
        });
    }

    private function syncMusoraCalendar()
    {
        $calendar = $this->addEventService->getCalendarByNameIfExists('Musora');
        $allContent = $this->getAllContent();
        $this->calendarSyncService->syncContentListToCalendar($allContent, $calendar);
    }

    public function getAllContent(): array
    {
        $this->info('Loading all content');

        $allContent = [];

        $brands = config('addevent.brands-enabled');

        foreach ($brands as $brand) {
            $typeUniquekeyMap = config("addevent.uniquekeys-by-brand.$brand.by-type", []);
            foreach ($typeUniquekeyMap as $typeOrSlug => $calendarUniqueId) {
                $content = $this->getContentByContentType($brand, $typeOrSlug);
                $allContent = array_merge($allContent, $content); // needed for brand-overview calendar
            }
        }
        return $allContent;
    }

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


}
