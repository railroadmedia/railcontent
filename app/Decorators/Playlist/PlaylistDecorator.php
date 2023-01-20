<?php

namespace App\Decorators\Playlist;

use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
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
    public function __construct(
        PinnedPlaylistsRepository $pinnedPlaylistsRepository,
        UserPlaylistsService $userPlaylistsService
    ) {
        $this->pinnedPlaylistsRepository = $pinnedPlaylistsRepository;
        $this->userPlaylistsService = $userPlaylistsService;
    }

    public function decorate($playlists)
    {
        $playlists = $playlists->toArray();
        $pinnedPlaylists = $this->pinnedPlaylistsRepository->getMyPinnedPlaylists();
        $pinnedPlaylists = array_combine(array_column($pinnedPlaylists, 'playlist_id'), $pinnedPlaylists);
        $userIds = [];

        foreach ($playlists as $index => $playlist) {
            $userIds[] = $playlist['user_id'];
            $playlists[$index]['url'] =
                url()->route('platform.user.playlist', ["id" => $playlist['id'], "brand" => brand()]);
            $playlists[$index]['pinned'] = array_key_exists($playlist['id'], $pinnedPlaylists);
            if (!$playlist['thumbnail_url']) {
                $lessons = $this->userPlaylistsService->getUserPlaylistContents($playlist['id'], [], 1);
                if ($lessons->isNotEmpty()) {
                    $playlists[$index]['thumbnail_url'] =
                        $lessons->first()
                            ->fetch('data.thumbnail_url');
                }
            }

            //TODO: Delete next line when the event/listener that sync playlist duration is functional
            $playlists[$index]['duration'] = 47;
        }

        $userIds = array_unique($userIds);

        /**
         * @var $users User[]
         */
        $users = User::query()->whereIn('id', $userIds)->get();

        $keyedUsers = [];

        foreach ($users as $userIndex => $user) {
            $keyedUsers[$user->id] = $user;
        }

        foreach ($playlists as $index => $playlist) {
            if (!isset($keyedUsers[$playlist['user_id']])) {
                unset($playlists[$index]);

                continue;
            }

            /**
             * @var $user User
             */
            $playlistAuthor = $keyedUsers[$playlist['user_id']];

            $playlists[$index]['user'] = [];
            $playlists[$index]['user']['display_name'] = $playlistAuthor['display_name'];
            $playlists[$index]['user']['fields.profile_picture_image_url'] =
                $playlistAuthor['profile_picture_url'];
        }

        return $playlists;
    }
}
