<?php

namespace App\Listeners\Content;

use App\Maps\ContentTypes;
use Carbon\Carbon;
use Railroad\Points\Events\UserPointsUpdated;
use Railroad\Points\Services\UserPointsService;
use Railroad\Railcontent\Events\PlaylistItemDeleted;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Events\UserContentProgressStarted;
use Railroad\Railcontent\Events\UserContentsProgressReset;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railtracker\Events\EngageContent;
use Railroad\Railtracker\Events\MediaPlaybackTracked;
use Railroad\Railtracker\Repositories\MediaPlaybackRepository;
use Railroad\Railtracker\Services\ContentLastEngagedService;
use Throwable;

class EngageContentEventListener
{
    private ContentLastEngagedService $contentLastEngagedService;

    /**
     * @param ContentLastEngagedService $contentLastEngagedService
     */
    public function __construct(ContentLastEngagedService $contentLastEngagedService)
    {
        $this->contentLastEngagedService = $contentLastEngagedService;
    }

    public function handleEngageContent(EngageContent $event)
    {
        $this->contentLastEngagedService->engageContent($event->userId, $event->contentId, $event->parentPlaylistId, $event->parentContentId);
    }

    public function handleRemoveEngageContent(PlaylistItemDeleted $event)
    {
        $this->contentLastEngagedService->deleteEngagedContent(user()->id, $event->playlistId, null);
    }
}
