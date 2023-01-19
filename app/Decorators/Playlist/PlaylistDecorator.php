<?php

namespace App\Decorators\Playlist;

use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Repositories\PinnedPlaylistsRepository;
use Railroad\Railcontent\Services\UserPlaylistsService;

class PlaylistDecorator extends ModeDecoratorBase
{

    private PinnedPlaylistsRepository $pinnedPlaylistsRepository;
    private UserPlaylistsService $userPlaylistsService;

    /**
     * ContentLikesDecorator constructor.
     */
    public function __construct(PinnedPlaylistsRepository $pinnedPlaylistsRepository, UserPlaylistsService $userPlaylistsService)
    {
        $this->pinnedPlaylistsRepository = $pinnedPlaylistsRepository;
        $this->userPlaylistsService = $userPlaylistsService;
    }

    public function decorate($playlists)
    {
        $playlists = $playlists->toArray();
        $pinnedPlaylists = $this->pinnedPlaylistsRepository->getMyPinnedPlaylists();
        $pinnedPlaylists = array_combine(array_column($pinnedPlaylists, 'playlist_id'), $pinnedPlaylists);

        foreach ($playlists as $index => $playlist) {
            //todo: Update with playlist route when it exists
            $playlists[$index]['url'] = url()->route('platform.user.playlists');
            $playlists[$index]['pinned'] = array_key_exists($playlist['id'], $pinnedPlaylists);
            if(!$playlist['thumbnail_url']){
                $lessons = $this->userPlaylistsService->getUserPlaylistContents($playlist['id'],[],1);
                if($lessons->isNotEmpty()){
                    $playlists[$index]['thumbnail_url'] = $lessons->first()->fetch('data.thumbnail_url');
                }
            }
        }

        return $playlists;
    }
}
