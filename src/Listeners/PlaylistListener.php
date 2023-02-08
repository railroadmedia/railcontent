<?php

namespace Railroad\Railcontent\Listeners;

use App\User;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\HierarchyUpdated;
use Railroad\Railcontent\Events\PlaylistItemsUpdated;
use Railroad\Railcontent\Repositories\UserPlaylistContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;

class PlaylistListener
{

    private UserPlaylistContentRepository $userPlaylistContentRepository;
    private ContentService $contentService;
    private UserPlaylistsService $userPlaylistsService;


    public function __construct(UserPlaylistContentRepository $userPlaylistContentRepository, ContentService $contentService, UserPlaylistsService $userPlaylistsService)
    {
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
        $this->contentService = $contentService;
        $this->userPlaylistsService = $userPlaylistsService;
    }


    public function handlePlaylistItemsUpdated(PlaylistItemsUpdated $playlistItemsUpdated)
    {
        $items = $this->userPlaylistContentRepository->getUserPlaylistContents(
            $playlistItemsUpdated->playlistId
        );

        $ids = (\Arr::pluck($items, 'id'));
        $contents = $this->contentService->getByIds($ids);

        $duration = ($contents->sumFetched('fields.video.fields.length_in_seconds'));

        $this->userPlaylistsService->update($playlistItemsUpdated->playlistId,['duration' => $duration]);
    }


}