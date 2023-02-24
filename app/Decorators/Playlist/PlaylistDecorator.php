<?php

namespace App\Decorators\Playlist;

use Carbon\Carbon;
use Carbon\CarbonInterval;
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
        $pinnedPlaylistsd = array_combine(array_column($pinnedPlaylists, 'id'), $pinnedPlaylists);
        $userIds = [];

        foreach ($playlists as $index => $playlist) {
            $userIds[] = $playlist['user_id'];
            $playlists[$index]['url'] =
                url()->route('platform.user.playlist', ["id" => $playlist['id'], "brand" => brand()]);
            $playlists[$index]['pinned'] = array_key_exists($playlist['id'], $pinnedPlaylistsd);
            if (!$playlist['thumbnail_url']) {
                $playlists[$index]['uploaded_thumbnail'] = false;
                $lessons = $this->userPlaylistsService->getUserPlaylistContents($playlist['id'], [], 1);
                if ($lessons->isNotEmpty()) {
                    $firstItem = $lessons->first();
                    $playlists[$index]['square_thumbnail'] =
                        (($firstItem['type'] == 'assignment' &&
                                ($firstItem->fetch('parent')) &&
                                in_array($firstItem->fetch('parent')['type'], ['song', 'song-tutorial-children'])) ||
                            $firstItem['type'] == 'song-tutorial-children');
                    $playlists[$index]['thumbnail_url'] = $firstItem->fetch(
                        'data.thumbnail_url',
                        ($firstItem->fetch('parent')) ?
                            $firstItem->fetch('parent')
                                ->fetch('data.thumbnail_url') : ''
                    );
                }
            } else {
                $playlists[$index]['uploaded_thumbnail'] = true;
            }

            $playlists[$index]['duration_formated'] = gmdate('H:i:s', $playlists[$index]['duration'] ?? 0);

            if (isset($playlist['user_playlist_item_id'])) {
                $playlists[$index]['playback_url'] = url()->route('platform.user.playlist-item', [
                    'playlistId' => $playlist['id'],
                    'playlistItemId' => $playlist['user_playlist_item_id'],
                ]);
            }
        }

        $userIds = array_unique($userIds);

        /**
         * @var $users User[]
         */
        $users =
            User::query()
                ->whereIn('id', $userIds)
                ->get();

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
            $playlists[$index]['user']['id'] = $playlistAuthor['id'];
            $playlists[$index]['user']['display_name'] = $playlistAuthor['display_name'];
            $playlists[$index]['user']['fields.profile_picture_image_url'] = $playlistAuthor['profile_picture_url'];
        }

        return $playlists;
    }
}
