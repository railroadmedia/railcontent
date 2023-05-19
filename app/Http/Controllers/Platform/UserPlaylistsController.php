<?php

namespace App\Http\Controllers\Platform;

use App\Decorators\Content\AddedToPrimaryPlaylistDecorator;
use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Decorators\Content\VimeoVideoSourcesDecorator;
use App\Decorators\Playlist\RoutingDecorator;
use App\Http\Controllers\BaseController;
use App\Services\PlaylistService;
use Illuminate\Http\Request;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Events\PlaylistItemLoaded;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PinnedPlaylistsRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railtracker\Events\EngageContent;
use Railroad\Railtracker\Services\ContentLastEngagedService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserPlaylistsController extends BaseController
{
    private UserPlaylistsService $userPlaylistsService;
    private ContentService $contentService;
    private ContentPermissionRepository $contentPermissionRepository;
    private UserPermissionsRepository $userPermissionsRepository;
    private VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator;
    private LessonAssignmentDecorator $lessonAssignmentDecorator;
    private RoutingDecorator $routingDecorator;
    private PinnedPlaylistsRepository $pinnedPlaylistsRepository;
    private ContentLastEngagedService $contentLastEngagedService;
    private PlaylistService $playlistService;

    /**
     * @param UserPlaylistsService $userPlaylistsService
     * @param ContentService $contentService
     * @param ContentPermissionRepository $contentPermissionRepository
     * @param UserPermissionsRepository $userPermissionsRepository
     * @param VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator
     * @param LessonAssignmentDecorator $lessonAssignmentDecorator
     * @param RoutingDecorator $routingDecorator
     * @param PinnedPlaylistsRepository $pinnedPlaylistsRepository
     * @param ContentLastEngagedService $contentLastEngagedService
     * @param PlaylistService $playlistService
     */
    public function __construct(
        UserPlaylistsService $userPlaylistsService,
        ContentService $contentService,
        ContentPermissionRepository $contentPermissionRepository,
        UserPermissionsRepository $userPermissionsRepository,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator,
        LessonAssignmentDecorator $lessonAssignmentDecorator,
        RoutingDecorator $routingDecorator,
        PinnedPlaylistsRepository $pinnedPlaylistsRepository,
        ContentLastEngagedService $contentLastEngagedService,
        PlaylistService $playlistService
    ) {
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->userPermissionsRepository = $userPermissionsRepository;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
        $this->lessonAssignmentDecorator = $lessonAssignmentDecorator;
        $this->routingDecorator = $routingDecorator;
        $this->pinnedPlaylistsRepository = $pinnedPlaylistsRepository;
        $this->contentLastEngagedService = $contentLastEngagedService;
        $this->playlistService = $playlistService;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 12);
        $term = $request->get('search');

        $lessons = $this->userPlaylistsService->getUserPlaylist(
            user()->id,
            'user-playlist',
            brand(),
            $limit,
            $page,
            $term,
            $request->get('sortby_val', $request->get('sort', 'most_recent'))
        );

        $playlistsNumber = $this->userPlaylistsService->countUserPlaylists(
            user()->id,
            'user-playlist',
            brand(),
            $term
        );

        $currentUser = [
            "avatar" => user()->profile_picture_url,
            "xp" => user()->totalXp(),
            "access_level" => user()->access_level,
            "xp_rank" => user()->getXpRank(),
        ];
        $initialPage = $request->get('page', 1);
        $listLessons =
            (new ContentFilterResultsEntity(['results' => $lessons, 'total_results' => $playlistsNumber]
            ))->toResponseRawJson();

        return view('account.playlists', [
            "listLessons" => $listLessons,
            "playlists" => $lessons,
            "allowedTypes" => [],
            "resetProgress" => false,
            "initialPage" => $initialPage,
            'currentUser' => $currentUser,
            "noResultsMessage" => 'no results',
            "playlistsNumber" => $playlistsNumber,
            "searchTerm" => $term,
        ]);
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $playlistId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function playlist(Request $request, $domain, $brand, $playlistId)
    {
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

        $user = user();

        $playlist = $this->userPlaylistsService->getUserPlaylistById($playlistId, false);
        throw_if(empty($playlist), new NotFoundHttpException());

        $playlist['has_access'] = ($playlist['private'] == false || $playlist['is_my_playlist'] == true) ? 1 : 0;

        $page = $request->get('page', 1);
        $limit = $request->get('limit');

        $contentTypes = array_merge(config('railcontent.appUserListContentTypes', []), array_values(
                                                                                         config(
                                                                                             'railcontent.showTypes',
                                                                                             []
                                                                                         )[config(
                                                                                             'railcontent.brand'
                                                                                         )] ?? []
                                                                                     ), ['routine']);

        $playlistItems = [];
        if ($playlist['has_access'] == 1) {
            ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
            ContentRepository::$bypassPermissions = true;
            $items = $this->userPlaylistsService->getUserPlaylistContents($playlistId, $contentTypes, $limit, $page);
            ContentRepository::$bypassPermissions = false;

            foreach ($items as $index => $item) {
                $playlistItems[$index]['id'] = $item['id'];
                $playlistItems[$index]['type'] = $item['type'];
                $playlistItems[$index]['title'] = $item['title'];
                $playlistItems[$index]['artist'] = $item['artist'];
                $playlistItems[$index]['status'] = $item['status'];
                $playlistItems[$index]['published_on'] = $item['published_on'];
                $playlistItems[$index]['published_on_in_timezone'] = $item['published_on_in_timezone'] ?? null;
                $playlistItems[$index]['need_access'] = $item['need_access'];
                $playlistItems[$index]['need_access_message'] = $item['need_access_message'] ?? '';

                $playlistItems[$index]['duration'] = $item->fetch('fields.video.fields.length_in_seconds', 0);
                $playlistItems[$index]['url'] = url()->route('platform.user.playlist-item', [
                    'playlistId' => $playlistId,
                    'playlistItemId' => $item['user_playlist_item_id'],
                ]);
                $playlistItems[$index]['route'] = $item['route'] ?? '';
                $playlistItems[$index]['instructors'] = $item['instructors'] ?? null;
                $playlistItems[$index]['user_playlist_item_id'] = $item['user_playlist_item_id'] ?? null;
                $playlistItems[$index]['user_playlist_item_extra_data'] =
                    $item['user_playlist_item_extra_data'] ?? null;
                $playlistItems[$index]['user_playlist_item_position'] = $item['user_playlist_item_position'] ?? null;
                $playlistItems[$index]['set_start_end_time'] = $item['set_start_end_time'] ?? null;
                $playlistItems[$index]['start_second'] = $item['start_second'] ?? null;
                $playlistItems[$index]['end_second'] = $item['end_second'] ?? null;
                $playlistItems[$index]['started'] = $item['started'] ?? false;
                $playlistItems[$index]['completed'] = $item['completed'] ?? false;
                $playlistItems[$index]['thumbnail_url'] = $item->fetch(
                    'data.original_thumbnail_url',
                    $item->fetch('data.thumbnail_url', $item['thumbnail_url'] ?? '')
                );
                $playlistItems[$index]['user_progress'] = $item['user_progress'] ?? '';
                $playlistItems[$index]['parent_title'] = $item['parent_title'] ?? '';
                $playlistItems[$index]['is_high_routine'] = $item['is_high_routine'] ?? false;
                $playlistItems[$index]['is_low_routine'] = $item['is_low_routine'] ?? false;
            }

            $playlist['completed_items'] = $items->where('completed',true)->count();
        }
        $totalItems = $this->userPlaylistsService->countUserPlaylistContents(
            $playlistId
        );
        $playlist['total_items'] = $totalItems;

        $items = new ContentFilterResultsEntity([
                                                    'results' => $playlistItems,
                                                ]);
        $pinnedPlaylists = $this->pinnedPlaylistsRepository->getMyPinnedPlaylists();
        $playlist['pinned'] = in_array($playlist['id'], \Arr::pluck($pinnedPlaylists, 'id'));

        return view('account.playlist', [
            "listLessons" => $items->toResponseRawJson(),
            "playlist" => $playlist,
            'currentUser' => user(),
            "noResultsMessage" => 'Nothing here yet! Start adding videos',
            "brand" => brand(),
            'totalItems' => $totalItems
        ]);
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $playlistId
     * @param $playlistItemId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function playlistItem(Request $request, $domain, $brand, $playlistId, $playlistItemId)
    {
        $oldStatuses = ContentRepository::$availableContentStatues;
        $oldFutureContent = ContentRepository::$pullFutureContent;

        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];
        ContentRepository::$pullFutureContent = true;

        $playlist = $this->userPlaylistsService->getPlaylist($playlistId, false);
        throw_if((empty($playlist) || ($playlist == -1)), new NotFoundHttpException());

        $playlist['has_access'] = ($playlist['private'] == false || $playlist['is_my_playlist'] == true);
        if (!$playlist['has_access']) {
            $items = new ContentFilterResultsEntity([
                                                        'results' => [],
                                                    ]);

            return view('account.playlist', [
                "listLessons" => $items->toResponseRawJson(),
                "playlist" => $playlist,
            ]);
        }

        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;
        AddedToPrimaryPlaylistDecorator::$skip = true;

        $playlistItem = $this->userPlaylistsService->getPlaylistItemById($playlistItemId);
        throw_if((!($playlistItem)), new NotFoundHttpException());

        $position = $playlistItem['position'];
        $page = ($playlistItem['position'] <= 20) ? 1 : (ceil(($playlistItem['position']) / 20));
        $request->merge(['page' => $page]);
        $request->merge(['limit' => 20]);

        ContentRepository::$bypassPermissions = true;
        $content = $this->contentService->getById($playlistItem['content_id']);
        $playlistItems = $this->userPlaylistsService->getUserPlaylistContents($playlist['id'], [], 20, $page);
        ContentRepository::$bypassPermissions = false;

        $playlistItem =
            $playlistItems->where('user_playlist_item_id', '=', $playlistItemId)
                ->first();
        $nextPlaylistItem = $playlistItems->getMatchOffset($playlistItem, 1);
        $previousPlaylistItem = $playlistItems->getMatchOffset($playlistItem, -1);
        $content['user_playlist_item_position'] = $position;

        $otherItems = [];
        foreach ($playlistItems as $index => $item) {
            $otherItems[$index]['url'] = $item['url'] ?? '';
            $otherItems[$index]['id'] = $item['id'];
            $otherItems[$index]['type'] = $item['type'];
            $otherItems[$index]['title'] = $item->fetch('title');
            $otherItems[$index]['artist'] = $item->fetch('artist');
            $otherItems[$index]['status'] = $item['status'];
            $otherItems[$index]['fields'] = $item['fields'];
            $otherItems[$index]['data'] = $item['data'];
            $otherItems[$index]['published_on'] = $item['published_on'];
            $otherItems[$index]['published_on_in_timezone'] = $item['published_on_in_timezone'] ?? null;
            $otherItems[$index]['need_access'] = $item['need_access'];
            $otherItems[$index]['need_access_message'] = $item['need_access_message'] ?? '';
            $otherItems[$index]['duration'] = $item->fetch('fields.video.fields.length_in_seconds', 0);
            $otherItems[$index]['route'] = $item['route'] ?? '';
            $otherItems[$index]['instructors'] = $item['instructors'] ?? null;
            $otherItems[$index]['user_playlist_item_id'] = $item['user_playlist_item_id'] ?? null;
            $otherItems[$index]['user_playlist_item_extra_data'] = $item['user_playlist_item_extra_data'] ?? null;
            $otherItems[$index]['user_playlist_item_position'] = $item['user_playlist_item_position'] ?? null;
            $otherItems[$index]['set_start_end_time'] = $item['set_start_end_time'] ?? null;
            $otherItems[$index]['start_second'] = $item['start_second'] ?? null;
            $otherItems[$index]['end_second'] = $item['end_second'] ?? null;
            $otherItems[$index]['started'] = $item['started'] ?? false;
            $otherItems[$index]['completed'] = $item['completed'] ?? false;
            $otherItems[$index]['thumbnail_url'] = $item->fetch(
                'thumbnail_url',
                $item->fetch('data.original_thumbnail_url', $item->fetch('data.thumbnail_url', ''))
            );
            $otherItems[$index]['user_progress'] = $item['user_progress'] ?? '';
            $otherItems[$index]['parent_title'] = $item['parent_title'] ?? '';
            $otherItems[$index]['is_high_routine'] = $item['is_high_routine'] ?? false;
            $otherItems[$index]['is_low_routine'] = $item['is_low_routine'] ?? false;
        }

        if (!empty($content['parent_content_data'] ?? [])) {
            $content['parent'] =
                $this->contentService->getByChildId($content['id'])
                    ->first();
        }
        ContentRepository::$availableContentStatues = $oldStatuses;
        ContentRepository::$pullFutureContent = $oldFutureContent;

        $startSecond = $playlistItem['start_second'] ?? null;
        $endSecond = $playlistItem['end_second'] ?? null;
        $initialItem = clone $playlistItem;

        $playlistItem =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$content]))
                ->first();
        $playlistItem['start_second'] = $startSecond;
        $playlistItem['end_second'] = $endSecond;
        $playlistItem['is_high_routine'] = $initialItem['is_high_routine'] ?? false;
        $playlistItem['is_low_routine'] = $initialItem['is_low_routine'] ?? false;
        $playlistItem['need_access'] = $initialItem['need_access'] ?? false;
        $playlistItem['need_access_message'] = $initialItem['need_access_message'] ?? false;

        $userPlaylists = collect($this->userPlaylistsService->getUserPlaylist(user()->id, 'user-playlist'));
        $playlists = $userPlaylists->whereNotIn('id', $playlistId);

        $playlistLessons = (new ContentFilterResultsEntity([
                                                               'results' => $otherItems,
                                                               'total_results' => $this->userPlaylistsService->countUserPlaylistContents(
                                                                   $playlistId
                                                               ),
                                                           ]))->toResponseRawJson();

        $relatedPlaylists = (new ContentFilterResultsEntity(['results' => $playlists]))->toResponseRawJson();
        if (empty($playlistItem['assignments'] ?? [])) {
            LessonAssignmentDecorator::$decorationMode = LessonAssignmentDecorator::DECORATION_MODE_MAXIMUM;
            $this->lessonAssignmentDecorator->decorate(new Collection([$playlistItem]))
                ->first();
        }

        $lessonAssignments = $playlistItem['assignments'] ?? [];

        $playlistItem['assignments'] = $lessonAssignments;

        if ($playlistItem['type'] == 'song') {
            $playlistItem['soundslice_slug'] =
                (isset($lessonAssignments[0])) ? $lessonAssignments[0]->fetch('fields.soundslice_slug') :
                    $playlistItem['soundslice_slug'];
        }

        if ($playlistItem['type'] == 'routine' && $playlistItem['is_high_routine']) {
            $playlistItem['soundslice_slug'] = $playlistItem['high_soundslice_slug'];
        }

        if ($playlistItem['type'] == 'routine' && $playlistItem['is_low_routine']) {
            $playlistItem['soundslice_slug'] = $playlistItem['low_soundslice_slug'];
        }

        if ($playlistItem['type'] == 'assignment') {
            $playlistItem['soundslice_slug'] = $playlistItem->fetch('fields.soundslice_slug');
        }

        if (!empty($playlistItem['parent'] ?? []) && (!empty($playlistItem['parent']['parent_content_data']))) {
            $this->routingDecorator->decorate([$playlistItem['parent']]);
            $playlistItem['parent']['thumbnail_url'] = $playlistItem['parent']->fetch(
                'data.original_thumbnail_url',
                $playlistItem['parent']->fetch('data.thumbnail_url')
            );
            if (empty($playlistItem['parent']['thumbnail_url']) && isset($playlistItem['parent']['parent'])) {
                $playlistItem['parent']['thumbnail_url'] = $playlistItem['parent']['parent']->fetch(
                    'data.original_thumbnail_url',
                    $playlistItem['parent']['parent']->fetch('data.thumbnail_url')
                );
            }
        }

        $relatedLesson =
            (new ContentFilterResultsEntity(['results' => $playlistItem['parent'] ?? []]))->toResponseRawJson();

        event(new PlaylistItemLoaded($playlistId, $playlistItemId, $position));

        return view('account.playlist-item', [
            "lessonContent" => $playlistItem,
            "playlist" => $playlist,
            "playlistItem" => $playlistItem,
            "lessonType" => $playlistItem['type'],
            "relatedPlaylists" => $relatedPlaylists,
            "playlistItems" => $playlistLessons,
            "relatedLesson" => $relatedLesson,
            "relatedLessons" => $relatedLesson,
            'positionInPlaylist' => $position,
            "nextPlaylistItemUrl" => $nextPlaylistItem['url'] ?? '',
            "previousPlaylistItemUrl" => $previousPlaylistItem['url'] ?? '',
            "brand" => brand(),
        ]);
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $playlistId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function playback(Request $request, $domain, $brand, $playlistId)
    {
       $item = $this->playlistService->getPlaylistNextItem($playlistId);

        if (isset($item)) {
            return redirect(
                url()->route('platform.user.playlist-item', [
                    'playlistId' => $playlistId,
                    'playlistItemId' => $item,
                ])
            );
        } else {
            return redirect(
                url()->route('platform.user.playlist', [
                    'id' => $playlistId
                ])
            );
        }
    }



}
