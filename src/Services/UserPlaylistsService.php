<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Repositories\UserPlaylistContentRepository;
use Railroad\Railcontent\Repositories\UserPlaylistsRepository;

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

    /**
     * @param UserPlaylistsRepository $userPlaylistRepository
     * @param UserPlaylistContentRepository $userPlaylistContentRepository
     */
    public function __construct(
        UserPlaylistsRepository $userPlaylistRepository,
        UserPlaylistContentRepository $userPlaylistContentRepository
    ) {
        $this->userPlaylistsRepository = $userPlaylistRepository;
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
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
    public function getUserPlaylist($userId, $playlistType, $brand = null)
    {
        return $this->userPlaylistsRepository->getUserPlaylist($userId, $playlistType, $brand);
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
        $results =
            $this->userPlaylistContentRepository->getUserPlaylistContents(
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
        $results =
            $this->userPlaylistContentRepository->countUserPlaylistContents($playlistId, $contentType);

        return $results;
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @return bool
     */
    public function removeContentFromUserPlaylist($userPlaylistId, $contentId)
    {
        $userPlaylistContent = $this->userPlaylistContentRepository->getByPlaylistIdAndContentId($userPlaylistId, $contentId);

        if (empty($userPlaylistContent)) {
            return true;
        }

        return $this->userPlaylistContentRepository->delete($userPlaylistContent[0]['id']);
    }
}