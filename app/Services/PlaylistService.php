<?php

namespace App\Services;

use App\Collections\PackCollection;
use App\Decorators\Content\AddedToPrimaryPlaylistDecorator;
use App\Decorators\Content\ContentExperienceDecorator;
use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Decorators\Content\PackDecorator;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Services\UserProductService;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railtracker\Services\ContentLastEngagedService;

class PlaylistService
{
private ContentLastEngagedService $contentLastEngagedService;
private UserPlaylistsService $userPlaylistsService;

    /**
     * @param ContentLastEngagedService $contentLastEngagedService
     * @param UserPlaylistsService $userPlaylistsService
     */
    public function __construct(
        ContentLastEngagedService $contentLastEngagedService,
        UserPlaylistsService $userPlaylistsService
    ) {
        $this->contentLastEngagedService = $contentLastEngagedService;
        $this->userPlaylistsService = $userPlaylistsService;
    }

    /**
     * @param $playlistId
     * @return mixed|null
     */
    public function getPlaylistNextItem($playlistId){
        $userPlaylist = $this->userPlaylistsService->getPlaylist($playlistId);
        $lastEngagedContent =
            $this->contentLastEngagedService->getLastEngagedContentForPlaylistId(user()->id, $playlistId);

        $nextItem = null;
        if($lastEngagedContent){
            $nextItem = $lastEngagedContent->content_id;
        }elseif(isset($userPlaylist['user_playlist_item_id'])){
            $nextItem = $userPlaylist['user_playlist_item_id'];
        }
        return $nextItem;
    }
}
