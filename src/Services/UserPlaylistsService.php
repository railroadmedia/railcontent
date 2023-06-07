<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Events\PlaylistDeleted;
use Railroad\Railcontent\Events\PlaylistItemCreated;
use Railroad\Railcontent\Events\PlaylistItemDeleted;
use Railroad\Railcontent\Events\PlaylistItemsUpdated;
use Railroad\Railcontent\Repositories\ContentRepository;
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
     * @param null $limit
     * @param int $page
     * @param null $term
     * @param string $sort
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function getUserPlaylist(
        $userId,
        $playlistType,
        $brand = null,
        $limit = null,
        $page = 1,
        $term = null,
        $sort = '-created_at'
    ) {
        $playlists = $this->userPlaylistsRepository->getUserPlaylist(
            $userId,
            $playlistType,
            $brand,
            $limit,
            $page,
            $term,
            $sort
        );

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
     * @param string $sort
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUserPlaylistContents(
        $playlistId,
        $contentType = [],
        $limit = null,
        $page = 1,
        $sort = "position"
    ) {
        $results = $this->userPlaylistContentRepository->getUserPlaylistContents(
            $playlistId,
            $contentType,
            $limit,
            $page,
            $sort
        );

        return Decorator::decorate($results, 'playlist-item');
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

        return $this->removeItemFromPlaylist($userPlaylistContent[0]['id']);
    }

    /**
     * @param $attributes
     * @return array
     */
    public function create($attributes)
    {
        $userPlaylist = $this->userPlaylistsRepository->create($attributes);

        return $this->getPlaylist($userPlaylist);
    }

    /**
     * @param string $type
     * @param $brand
     * @param int $page
     * @param null $limit
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
     * @return int
     */
    public function countPublicPlaylists($type = 'user-playlist', $brand)
    {
        return $this->userPlaylistsRepository->countPublicPlaylists($type, $brand);
    }

    /**
     * @param $userPlaylistIds
     * @param $contentId
     * @param null $position
     * @param array $extraData
     * @param null $startSecond
     * @param null $endSecond
     * @param false $importAllAssignments
     * @param false $importFullSoundsliceAssignment
     * @param false $importInstrumentlessSoundsliceAssignment
     * @param false $importHighRoutine
     * @param false $importLowRoutine
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function addItemToPlaylist(
        $userPlaylistIds,
        $contentId,
        $position = null,
        $extraData = null,
        $startSecond = null,
        $endSecond = null,
        $importAllAssignments = false,
        $importFullSoundsliceAssignment = false,
        $importInstrumentlessSoundsliceAssignment = false,
        $importHighRoutine = false,
        $importLowRoutine = false
    ) {
        $oldStatuses = ContentRepository::$availableContentStatues;
        $oldFutureContent = ContentRepository::$pullFutureContent;

        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];

        ContentRepository::$pullFutureContent = true;

        $results = [];
        $added = [];
        Decorator::$typeDecoratorsEnabled = false;
        \Railroad\Railcontent\Decorators\Entity\AddedToPrimaryPlaylistDecorator::$skip = true;

        $content = $this->contentService->getById($contentId);
        Decorator::$typeDecoratorsEnabled = true;
        if (!$content) {
            return $results;
        }

        $singularContentTypes = array_merge(config('railcontent.showTypes')[config('railcontent.brand')] ?? [],
                                            config('railcontent.singularContentTypes'),
                                            ['assignment']);

        $assignments = $this->contentService->countLessonsAndAssignments($contentId);
        $itemsThatShouldBeAdd = $assignments['lessons_count'] ?? 0;
        if ($importInstrumentlessSoundsliceAssignment) {
            $itemsThatShouldBeAdd++;
        }
        if ($importFullSoundsliceAssignment) {
            $itemsThatShouldBeAdd++;
        }
        if ($importAllAssignments) {
            $itemsThatShouldBeAdd = $itemsThatShouldBeAdd + ($assignments['soundslice_assignments_count'] ?? 0);
        }
        if ($content && (in_array($content['type'], $singularContentTypes))) {
            $itemsThatShouldBeAdd++;
        }
        if($importHighRoutine){
            $itemsThatShouldBeAdd++;
        }
        if($importLowRoutine){
            $itemsThatShouldBeAdd++;
        }

        foreach ($userPlaylistIds as $userPlaylistId) {
            $playlistItems = $this->countUserPlaylistContents($userPlaylistId);
            if ($playlistItems + $itemsThatShouldBeAdd > config('railcontent.playlist_items_limit', 300)) {
                $playlist = $this->getPlaylist($userPlaylistId);
                $limitExcedeed[] = $playlist;
                continue;
            }
            if ($content && (in_array($content['type'], $singularContentTypes))) {
                if ($importFullSoundsliceAssignment) {
                    $assignmentInput = [
                        'content_id' => $contentId,
                        'user_playlist_id' => $userPlaylistId,
                        'created_at' => Carbon::now()
                            ->toDateTimeString(),
                        'extra_data' => json_encode(['is_full_track' => true]),
                    ];
                    $itemId = $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
                        null,
                        $assignmentInput
                    );
                    $added[$userPlaylistId][] = $itemId;
                }

                if ($importInstrumentlessSoundsliceAssignment) {
                    $assignmentInput = [
                        'content_id' => $contentId,
                        'user_playlist_id' => $userPlaylistId,
                        'created_at' => Carbon::now()
                            ->toDateTimeString(),
                        'extra_data' => json_encode(['is_instrumentless_track' => true]),
                    ];
                    $itemId = $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
                        null,
                        $assignmentInput
                    );
                    $added[$userPlaylistId][] = $itemId;
                }

                if ($content['type'] != 'song') {
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

                    $itemId =
                        $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(null, $input);

                    event(new PlaylistItemCreated($userPlaylistId, $itemId));

                    $added[$userPlaylistId][] = $itemId;

                    if ($importAllAssignments) {
                        $itemIds = $this->addSounsliceAssignments(
                            $assignments['soundslice_assignments'][$contentId] ?? [],
                            $userPlaylistId
                        );
                        $added[$userPlaylistId] = array_merge($added[$userPlaylistId] ?? [], $itemIds);
                    }
                }
            }

            if ($importHighRoutine) {
                $assignmentInput = [
                    'content_id' => $contentId,
                    'user_playlist_id' => $userPlaylistId,
                    'created_at' => Carbon::now()
                        ->toDateTimeString(),
                    'extra_data' => json_encode(['is_high_routine' => true]),
                ];
                $itemId = $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
                    null,
                    $assignmentInput
                );
                event(new PlaylistItemCreated($userPlaylistId, $itemId));
                $added[$userPlaylistId][] = $itemId;
            }

            if ($importLowRoutine) {
                $assignmentInput = [
                    'content_id' => $contentId,
                    'user_playlist_id' => $userPlaylistId,
                    'created_at' => Carbon::now()
                        ->toDateTimeString(),
                    'extra_data' => json_encode(['is_low_routine' => true]),
                ];
                $itemId = $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
                    null,
                    $assignmentInput
                );
                event(new PlaylistItemCreated($userPlaylistId, $itemId));
                $added[$userPlaylistId][] = $itemId;
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

                    $itemId =
                        $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(null, $input);
                    $added[$userPlaylistId][] = $itemId;
                    event(new PlaylistItemCreated($userPlaylistId, $itemId));

                    if ($importAllAssignments) {
                        $itemIds = $this->addSounsliceAssignments(
                            $assignments['soundslice_assignments'][$lesson['id']] ?? [],
                            $userPlaylistId
                        );
                        $added[$userPlaylistId] = array_merge($added[$userPlaylistId] ?? [], $itemIds);
                    }
                }
            }

            event(new PlaylistItemsUpdated($userPlaylistId));
        }

        ContentRepository::$availableContentStatues = $oldStatuses;
        ContentRepository::$pullFutureContent = $oldFutureContent;

        if (isset($limitExcedeed)) {
            $results['limit_excedeed'] = $limitExcedeed;
        }

        $results['successful'] = $added;

        return $results;
    }

    /**
     * @param $userId
     * @param $type
     * @param $brand
     * @param null $term
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
    public function getPlaylist($playlistId, $checkPermission = true)
    {
        $playlist = $this->userPlaylistsRepository->getById($playlistId);
        if (!$playlist) {
            return null;
        }
        if ($checkPermission && $playlist['user_id'] != auth()->id() && $playlist['private'] == 1) {
            return -1;
        }

        //        $playlist['like_count'] =
        //            $this->playlistLikeRepository->query()
        //                ->where('playlist_id', $playlistId)
        //                ->count();
        $playlist['is_liked_by_current_user'] =
            $this->playlistLikeRepository->query()
                ->where('playlist_id', $playlistId)
                ->where('user_id', auth()->id())
                ->count() > 0;
        $playlist['pinned'] =
            $this->pinnedPlaylistsRepository->query()
                ->where('playlist_id', $playlistId)
                ->count() > 0;

        $playlist['user_playlist_item_id'] =
            $this->userPlaylistContentRepository->getFirstContentByPlaylistId($playlistId)['id'] ?? null;

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
        $playlists = $this->pinnedPlaylistsRepository->getMyPinnedPlaylists();

        return Decorator::decorate($playlists, 'playlist');
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
     * @param $playlistItemId
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
            'extra_data' => !empty($extraData) ? $extraData : $playlistContent['extra_data'],
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
        $delete =  $this->userPlaylistsRepository->query()
            ->where([
                        'id' => $userPlaylistId,
                        'user_id' => auth()->id(),
                    ])
            ->delete();

        event(new PlaylistDeleted($userPlaylistId));

        return $delete;
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

        $deleted = $this->userPlaylistContentRepository->deletePlaylistItemAndReposition(['id' => $itemPlaylist['id']]);

        event(new PlaylistItemDeleted($itemPlaylist['user_playlist_id'], $itemPlaylistId, $itemPlaylist['position']));
        event(new PlaylistItemsUpdated($itemPlaylist['user_playlist_id']));

        return $deleted;
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
     * @return bool
     */
    public function likePlaylist($playlistId, $brand)
    {
        return $this->playlistLikeRepository->query()
            ->updateOrInsert([
                                 'user_id' => auth()->id(),
                                 'playlist_id' => $playlistId,
                                 'brand' => $brand,
                             ], [
                                 'created_at' => Carbon::now()
                                     ->toDateTimeString(),
                             ]);
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
        $results = [];
        foreach ($assignments ?? [] as $assignment) {
            $assignmentInput = [
                'content_id' => $assignment['id'],
                'user_playlist_id' => $userPlaylistId,
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ];
            $itemId = $this->userPlaylistContentRepository->createOrUpdatePlaylistContentAndReposition(
                null,
                $assignmentInput
            );
            $results[] = $itemId;
        }

        return $results;
    }

    /**
     * @param $playlistId
     * @param $data
     * @return int
     */
    public function duplicatePlaylistItem($playlistId, $data)
    {
        $input = [
            'content_id' => $data['content_id'],
            'user_playlist_id' => $playlistId,
            'position' => $data['position'],
            'extra_data' => $data['extra_data'],
            'start_second' => $data['start_second'],
            'end_second' => $data['end_second'],
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];

        return $this->userPlaylistContentRepository->create($input);
    }

    /**
     * @param $contentId
     * @param $brand
     * @return bool
     */
    public function updatePlaylistsLastProgress($contentId, $brand)
    {
        $playlists =
            $this->userPlaylistsRepository->query()
                ->select('user_playlist_id')
                ->join(
                    'railcontent_user_playlist_content',
                    'railcontent_user_playlists.id',
                    '=',
                    'railcontent_user_playlist_content.user_playlist_id'
                )
                ->where('user_id', '=', auth()->id())
                ->where('type', 'user-playlist')
                ->where('railcontent_user_playlist_content.content_id', '=', $contentId)
                ->where('railcontent_user_playlists.brand', '=', $brand)
                ->get();
        $playlistIds = $playlists->pluck('user_playlist_id');
        if (!empty($playlistIds)) {
            $this->userPlaylistsRepository->query()
                ->whereIn('id', $playlistIds)
                ->update([
                             'last_progress' => Carbon::now()
                                 ->toDateTimeString(),
                         ]);
        }

        return true;
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public function getUserPlaylistById($id, $checkPermission = true)
    {
        $playlist = $this->userPlaylistsRepository->getUserPlaylistById($id);
        if (!$playlist) {
            return null;
        }
        if ($checkPermission && $playlist['user_id'] != auth()->id() && $playlist['private'] == 1) {
            return -1;
        }
        $playlist['is_liked_by_current_user'] =
            $this->playlistLikeRepository->query()
                ->where('playlist_id', $id)
                ->where('user_id', auth()->id())
                ->count() > 0;

        return Decorator::decorate([$playlist], 'playlist')[0];
    }

    /**
     * @param $playlistId
     * @return array|mixed[]
     */
    public function getItemWithPositionInPlaylist($playlistId, $position)
    {
        return $this->userPlaylistContentRepository->getItemWithPositionInPlaylist($playlistId, $position);
    }

    /**
     * @param $playlistId
     * @return int
     */
    public function countCompletedUserPlaylistContents($playlistIds)
    {
        $results = $this->userPlaylistContentRepository->countCompletedUserPlaylistContents($playlistIds);

        return $results;
    }

    /**
     * @param $playlistId
     * @return int
     */
    public function countStartedUserPlaylistContents($playlistIds)
    {
        $results = $this->userPlaylistContentRepository->countStartedUserPlaylistContents($playlistIds);

        return $results;
    }

    public function countUserPlaylistItems($playlistIds)
    {
        return $this->userPlaylistContentRepository->countUserPlaylistItems($playlistIds);
    }
}
