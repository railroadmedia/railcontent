<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Repositories\PlaylistLikeRepository;
use Railroad\Railcontent\Repositories\UserPlaylistContentRepository;
use Railroad\Railcontent\Repositories\UserPlaylistsRepository;
use Railroad\Railcontent\Repositories\PinnedPlaylistsRepository;

class UserPlaylistsService
{
    /**
     * @var UserPlaylistsRepository
     */
    private $userPlaylistsRepository;
    /**
     * @var UserPlaylistContentRepository
     */
    private $userPlaylistContentRepository;

    private PinnedPlaylistsRepository $pinnedPlaylistsRepository;
    private PlaylistLikeRepository $playlistLikeRepository;

    /**
     * @param UserPlaylistsRepository $userPlaylistRepository
     * @param UserPlaylistContentRepository $userPlaylistContentRepository
     */
    public function __construct(
        UserPlaylistsRepository $userPlaylistRepository,
        UserPlaylistContentRepository $userPlaylistContentRepository,
        PinnedPlaylistsRepository $pinnedPlaylistsRepository,
        PlaylistLikeRepository $playlistLikeRepository
    ) {
        $this->userPlaylistsRepository = $userPlaylistRepository;
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
        $this->pinnedPlaylistsRepository = $pinnedPlaylistsRepository;
        $this->playlistLikeRepository = $playlistLikeRepository;
    }

    /**
     * Save user playlist record in database
     *
     * @param integer $userId
     * @param integer $permissionId
     * @param date $startDate
     * @param date|null $expirationDate
     * @return array
     */
    public function updateOrCeate($attributes, $values)
    {
        $userPlaylist = $this->userPlaylistsRepository->updateOrCreate($attributes, $values);

        return $this->userPlaylistsRepository->getById($userPlaylist);
    }

    /**
     * Call the method that delete the user playlist, if the user playlist exists in the database
     *
     * @param int $id
     * @return array|bool
     */
    public function delete($id)
    {
        $userPlaylist = $this->userPlaylistsRepository->getById($id);
        if (is_null($userPlaylist)) {
            return $userPlaylist;
        }

        return $this->userPlaylistsRepository->delete($id);
    }

    /**
     * @param $userId
     * @param $playlistType
     * @param null $brand
     * @return array|mixed[]
     */
    public function getUserPlaylist($userId, $playlistType, $brand = null, $limit, $page)
    {
        return $this->userPlaylistsRepository->getUserPlaylist($userId, $playlistType, $brand, $limit, $page);
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @return int|null
     */
    public function addContentToUserPlaylist($userPlaylistId, $contentId)
    {
        return $this->userPlaylistContentRepository->updateOrCreate([
                                                                        'user_playlist_id' => $userPlaylistId,
                                                                        'content_id' => $contentId,
                                                                    ], [
                                                                        'user_playlist_id' => $userPlaylistId,
                                                                        'content_id' => $contentId,
                                                                        'created_at' => Carbon::now()
                                                                            ->toDateTimeString(),
                                                                        'updated_at' => Carbon::now()
                                                                            ->toDateTimeString(),
                                                                    ]);
    }

    /**
     * @param $playlistId
     * @param array $contentType
     * @param null $limit
     * @param int $page
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUserPlaylistContents($playlistId, $contentType = [], $limit = null, $page = 1)
    {
        $results = $this->userPlaylistContentRepository->getUserPlaylistContents(
            $playlistId,
            $contentType,
            $limit,
            $page
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param $playlistId
     * @param array $contentType
     * @return int
     */
    public function countUserPlaylistContents($playlistId, $contentType = [])
    {
        $results = $this->userPlaylistContentRepository->countUserPlaylistContents($playlistId, $contentType);

        return $results;
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @return bool
     */
    public function removeContentFromUserPlaylist($userPlaylistId, $contentId)
    {
        $userPlaylistContent =
            $this->userPlaylistContentRepository->getByPlaylistIdAndContentId($userPlaylistId, $contentId);

        if (empty($userPlaylistContent)) {
            return true;
        }

        return $this->userPlaylistContentRepository->delete($userPlaylistContent[0]['id']);
    }

    public function create($attributes)
    {
        $userPlaylist = $this->userPlaylistsRepository->create($attributes);

        return $this->userPlaylistsRepository->getById($userPlaylist);
    }

    public function getPublicPlaylists($type = 'user-playlist', $brand)
    {
        return $this->userPlaylistsRepository->getPublicPlaylists($type, $brand);
    }

    public function addItemToPlaylist($userPlaylistId, $contentId, $position = null)
    {
        //TODO
        return $this->userPlaylistContentRepository->updateOrCreate([
                                                                        'user_playlist_id' => $userPlaylistId,
                                                                        'content_id' => $contentId,
                                                                    ], [
                                                                        'user_playlist_id' => $userPlaylistId,
                                                                        'content_id' => $contentId,
                                                                        'position' => $position ?? 1,
                                                                        'created_at' => Carbon::now()
                                                                            ->toDateTimeString(),
                                                                        'updated_at' => Carbon::now()
                                                                            ->toDateTimeString(),
                                                                    ]);
    }

    /**
     * @param $userId
     * @param $type
     * @param $brand
     * @return int
     */
    public function countUserPlaylists($userId, $type, $brand)
    {
        return $this->userPlaylistsRepository->countUserPlaylists($userId, $type, $brand);
    }

    /**
     * @param $playlistId
     * @return array
     */
    public function getPlaylist($playlistId)
    {
        $playlist = $this->userPlaylistsRepository->getById($playlistId);
        $playlist['like_count'] = $this->playlistLikeRepository->query()->where('playlist_id', $playlistId)->count();
        $playlist['is_liked_by_current_user'] = $this->playlistLikeRepository->query()->where('playlist_id', $playlistId)->where('user_id', auth()->id())->count() > 0;
        $playlist['pinned'] = $this->pinnedPlaylistsRepository->query()->where('playlist_id', $playlistId)->count() > 0;

        return $playlist;
    }

    /**
     * @param $id
     * @param $attributes
     * @return array
     */
    public function update($id, $attributes)
    {
        $userPlaylist = $this->userPlaylistsRepository->update($id, $attributes);

        return $this->userPlaylistsRepository->getById($userPlaylist);
    }

    /**
     * @param $playlistId
     * @return bool
     */
    public function pinPlaylist($playlistId)
    {
        $stored =
            $this->pinnedPlaylistsRepository->query()
                ->updateOrInsert(
                    [
                        'user_id' => auth()->id(),
                        'playlist_id' => $playlistId,
                    ],
                    [
                        'created_at' => Carbon::now()
                            ->toDateTimeString(),
                    ]
                );

        return $this->pinnedPlaylistsRepository->query()
            ->where(
                [
                    'user_id' => auth()->id(),
                    'playlist_id' => $playlistId,
                ]
            )
            ->first();
    }

    /**
     * @param $playlistId
     * @return bool
     */
    public function unpinPlaylist($playlistId)
    {
        return $this->pinnedPlaylistsRepository->query()
            ->where(
                [
                    'playlist_id' => $playlistId,
                    'user_id' => auth()->id(),
                ]
            )
            ->delete();
    }

    /**
     * @return array|mixed[]
     */
    public function getPinnedPlaylists()
    {
        return $this->pinnedPlaylistsRepository->getMyPinnedPlaylists();
    }

    public function getByPlaylistId($playlistId)
    {
        return $this->userPlaylistContentRepository->getByPlaylistId($playlistId);
    }

}
