<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Repositories\PinnedPlaylistsRepository;
use Railroad\Railcontent\Repositories\PlaylistLikeRepository;
use Railroad\Railcontent\Repositories\UserPlaylistContentRepository;
use Railroad\Railcontent\Repositories\UserPlaylistsRepository;

class UserPlaylistsService
{

    private UserPlaylistsRepository $userPlaylistsRepository;
    private UserPlaylistContentRepository $userPlaylistContentRepository;
    private PinnedPlaylistsRepository $pinnedPlaylistsRepository;
    private PlaylistLikeRepository $playlistLikeRepository;
    private ContentService $contentService;

    /**
     * @param UserPlaylistsRepository $userPlaylistRepository
     * @param UserPlaylistContentRepository $userPlaylistContentRepository
     * @param PinnedPlaylistsRepository $pinnedPlaylistsRepository
     * @param PlaylistLikeRepository $playlistLikeRepository
     * @param ContentService $contentService
     */
    public function __construct(
        UserPlaylistsRepository $userPlaylistRepository,
        UserPlaylistContentRepository $userPlaylistContentRepository,
        PinnedPlaylistsRepository $pinnedPlaylistsRepository,
        PlaylistLikeRepository $playlistLikeRepository,
        ContentService $contentService
    ) {
        $this->userPlaylistsRepository = $userPlaylistRepository;
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
        $this->pinnedPlaylistsRepository = $pinnedPlaylistsRepository;
        $this->playlistLikeRepository = $playlistLikeRepository;
        $this->contentService = $contentService;
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
    public function getUserPlaylist($userId, $playlistType, $brand = null, $limit, $page, $term = null)
    {
        $playlists =
            $this->userPlaylistsRepository->getUserPlaylist($userId, $playlistType, $brand, $limit, $page, $term);

        return Decorator::decorate($playlists, 'playlist');
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

    /**
     * @param $attributes
     * @return array
     */
    public function create($attributes)
    {
        $userPlaylist = $this->userPlaylistsRepository->create($attributes);

        return $this->userPlaylistsRepository->getById($userPlaylist);
    }

    /**
     * @param string $type
     * @param $brand
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function getPublicPlaylists($type = 'user-playlist', $brand, $page = 1, $limit = null)
    {
        $playlists = $this->userPlaylistsRepository->getPublicPlaylists($type, $brand, $page, $limit);

        return Decorator::decorate($playlists, 'playlist');
    }

    /**
     * @param string $type
     * @param $brand
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function countPublicPlaylists($type = 'user-playlist', $brand)
    {
        return $this->userPlaylistsRepository->countPublicPlaylists($type, $brand);
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @param null $position
     * @param array $extraData
     * @param null $startSecond
     * @param null $endSecond
     * @param false $importAllAssignments
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function addItemToPlaylist(
        $userPlaylistId,
        $contentId,
        $position = null,
        $extraData = [],
        $startSecond = null,
        $endSecond = null,
        $importAllAssignments = false,
        $importFullSoundsliceAssignment = false,
        $importInstrumentlessSoundsliceAssignment = false
    ) {
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        $content = $this->contentService->getById($contentId);

        $singularContentTypes = array_diff(
            array_merge(
                config('railcontent.showTypes')[config('railcontent.brand')] ?? [],
                config('railcontent.singularContentTypes')
            ),
            ['song']
        );

        $assignments = $this->contentService->countLessonsAndAssignments($contentId);

        if (in_array($content['type'], $singularContentTypes)) {
            $input = [
                'content_id' => $contentId,
                'user_playlist_id' => $userPlaylistId,
                'position' => $position,
                'extra_data' => $extraData,
                'start_second' => $startSecond,
                'end_second' => $endSecond,
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ];

            $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(null, $input);

            if ($importAllAssignments) {
                $this->addSounsliceAssignments(
                    $assignments['soundslice_assignments'][$contentId] ?? [],
                    $userPlaylistId
                );
            }
        }

        if (!empty($assignments['lessons'])) {
            foreach ($assignments['lessons'] ?? [] as $lesson) {
                $input = [
                    'content_id' => $lesson['id'],
                    'user_playlist_id' => $userPlaylistId,
                    'position' => $position,
                    'extra_data' => $extraData,
                    'start_second' => $startSecond,
                    'end_second' => $endSecond,
                    'created_at' => Carbon::now()
                        ->toDateTimeString(),
                ];

                $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(null, $input);
                if ($importAllAssignments) {
                    $this->addSounsliceAssignments(
                        $assignments['soundslice_assignments'][$lesson['id']] ?? [],
                        $userPlaylistId
                    );
                }
            }
        }

        if ($importFullSoundsliceAssignment) {
            foreach ($assignments['soundslice_assignments'] ?? [] as $assignment) {
                $assignmentInput = [
                    'content_id' => $assignment['id'],
                    'user_playlist_id' => $userPlaylistId,
                    'created_at' => Carbon::now()
                        ->toDateTimeString(),
                    'extra_data' => json_encode(['is_full_track' => true]),
                ];
                $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
                    null,
                    $assignmentInput
                );
            }
        }

        if ($importInstrumentlessSoundsliceAssignment) {
            foreach ($assignments['soundslice_assignments'] ?? [] as $assignment) {
                $assignmentInput = [
                    'content_id' => $assignment['id'],
                    'user_playlist_id' => $userPlaylistId,
                    'created_at' => Carbon::now()
                        ->toDateTimeString(),
                    'extra_data' => json_encode(['is_instrumentless_track' => true]),
                ];
                $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
                    null,
                    $assignmentInput
                );
            }
        }

        return true;
    }

    /**
     * @param $userId
     * @param $type
     * @param $brand
     * @return int
     */
    public function countUserPlaylists($userId, $type, $brand, $term = null)
    {
        return $this->userPlaylistsRepository->countUserPlaylists($userId, $type, $brand, $term);
    }

    /**
     * @param $playlistId
     * @return array
     */
    public function getPlaylist($playlistId)
    {
        $playlist = $this->userPlaylistsRepository->getById($playlistId);
        $playlist['like_count'] =
            $this->playlistLikeRepository->query()
                ->where('playlist_id', $playlistId)
                ->count();
        $playlist['is_liked_by_current_user'] =
            $this->playlistLikeRepository->query()
                ->where('playlist_id', $playlistId)
                ->where('user_id', auth()->id())
                ->count() > 0;
        $playlist['pinned'] =
            $this->pinnedPlaylistsRepository->query()
                ->where('playlist_id', $playlistId)
                ->count() > 0;

        return \Arr::first(Decorator::decorate([$playlist], 'playlist'));
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
     * @param $brand
     * @return array|mixed[]
     */
    public function pinPlaylist($playlistId, $brand)
    {
        $stored =
            $this->pinnedPlaylistsRepository->query()
                ->updateOrInsert([
                                     'user_id' => auth()->id(),
                                     'playlist_id' => $playlistId,
                                     'brand' => $brand,
                                 ], [
                                     'created_at' => Carbon::now()
                                         ->toDateTimeString(),
                                 ]);

        return $this->pinnedPlaylistsRepository->getMyPinnedPlaylists();
    }

    /**
     * @param $playlistId
     * @return int
     */
    public function unpinPlaylist($playlistId)
    {
        return $this->pinnedPlaylistsRepository->query()
            ->where([
                        'playlist_id' => $playlistId,
                        'user_id' => auth()->id(),
                    ])
            ->delete();
    }

    /**
     * @return array|mixed[]
     */
    public function getPinnedPlaylists()
    {
        return $this->pinnedPlaylistsRepository->getMyPinnedPlaylists();
    }

    /**
     * @param $playlistId
     * @return array|mixed[]
     */
    public function getByPlaylistId($playlistId)
    {
        return $this->userPlaylistContentRepository->getByPlaylistId($playlistId);
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @param null $position
     * @param array $extraData
     * @param null $startSecond
     * @param null $endSecond
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function changePlaylistContent(
        $playlistItemId,
        $position = null,
        $extraData = [],
        $startSecond = null,
        $endSecond = null
    ) {
        $playlistContent = $this->getPlaylistItemById($playlistItemId);

        $input = [
            'content_id' => $playlistContent['content_id'],
            'user_playlist_id' => $playlistContent['user_playlist_id'],
            'position' => $position,
            'extra_data' => $extraData,
            'start_second' => $startSecond,
            'end_second' => $endSecond,
            'updated_at' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
            $playlistItemId,
            $input
        );

        return $this->getUserPlaylistContents($playlistContent['user_playlist_id']);
    }

    /**
     * @param $userPlaylistId
     * @return int
     */
    public function deletePlaylist($userPlaylistId)
    {
        //delete items from playlists
        $this->userPlaylistContentRepository->query()
            ->where([
                        'user_playlist_id' => $userPlaylistId,
                    ])
            ->delete();

        //delete playlists from pinned playlists
        $this->pinnedPlaylistsRepository->query()
            ->where([
                        'playlist_id' => $userPlaylistId,
                    ])
            ->delete();

        //delete playlist
        return $this->userPlaylistsRepository->query()
            ->where([
                        'id' => $userPlaylistId,
                        'user_id' => auth()->id(),
                    ])
            ->delete();
    }

    /**
     * @param $term
     * @param $page
     * @param null $limit
     * @return array|mixed[]
     */
    public function searchPlaylist($term, $page, $limit = null)
    {
        return $this->userPlaylistsRepository->searchPlaylist($term, $page, $limit);
    }

    /**
     * @param $term
     * @return int
     */
    public function countTotalSearchResults($term)
    {
        return $this->userPlaylistsRepository->countTotalSearchResults($term);
    }

    /**
     * @param $itemPlaylistId
     * @return bool|null
     */
    public function removeItemFromPlaylist($itemPlaylistId)
    {
        $itemPlaylist = $this->userPlaylistContentRepository->getById($itemPlaylistId);

        if (is_null($itemPlaylist)) {
            return $itemPlaylist;
        }

        return $this->userPlaylistContentRepository->deletePlaylistItemAndReposition($itemPlaylist);
    }

    /**
     * @param $playlistId
     * @param $contentId
     * @return bool
     */
    public function existsContentIdInPlaylist($playlistId, $contentId)
    {
        return $this->userPlaylistContentRepository->getByPlaylistIdAndContentId($playlistId, $contentId);
    }

    /**
     * @param $itemPlaylistId
     * @return array
     */
    public function getPlaylistItemById($itemPlaylistId)
    {
        return $this->userPlaylistContentRepository->getById($itemPlaylistId);
    }

    /**
     * @param $playlistId
     * @param $brand
     * @return array|mixed[]
     */
    public function likePlaylist($playlistId, $brand)
    {
        $stored =
            $this->playlistLikeRepository->query()
                ->updateOrInsert([
                                     'user_id' => auth()->id(),
                                     'playlist_id' => $playlistId,
                                     'brand' => $brand,
                                 ], [
                                     'created_at' => Carbon::now()
                                         ->toDateTimeString(),
                                 ]);

        return $this->pinnedPlaylistsRepository->getMyPinnedPlaylists();
    }

    /**
     * @param $playlistId
     * @return int
     */
    public function deletePlaylistLike($playlistId)
    {
        return $this->playlistLikeRepository->query()
            ->where([
                        'playlist_id' => $playlistId,
                        'user_id' => auth()->id(),
                    ])
            ->delete();
    }

    /**
     * @param null $brand
     * @param null $limit
     * @param int $page
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function getLikedPlaylists($brand = null, $limit = null, $page = 1)
    {
        $playlists = $this->playlistLikeRepository->getLikedPlaylist(auth()->id(), $brand, $limit, $page);

        return Decorator::decorate($playlists, 'playlist');
    }

    /**
     * @param null $brand
     * @return int
     */
    public function countLikedPlaylist($brand = null)
    {
        return $this->playlistLikeRepository->countLikedPlaylist(auth()->id(), $brand);
    }

    /**
     * @param $assignments
     * @param $userPlaylistId
     * @return array
     */
    private function addSounsliceAssignments($assignments, $userPlaylistId)
    : array {
        foreach ($assignments ?? [] as $assignment) {
            $assignmentInput = [
                'content_id' => $assignment['id'],
                'user_playlist_id' => $userPlaylistId,
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ];
            $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
                null,
                $assignmentInput
            );
        }

        return $assignments;
    }
}
