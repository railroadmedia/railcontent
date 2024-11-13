<?php

namespace App\Http\Controllers\Platform;

use App\Modules\Content\Models\UserPlaylist;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

use App\Decorators\Content\AddedToPrimaryPlaylistDecorator;
use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Decorators\Content\VimeoVideoSourcesDecorator;
use App\Decorators\Playlist\PlaylistDecorator;
use App\Decorators\Playlist\RoutingDecorator;
use App\Decorators\Content\ResourceDecorator;
use App\Http\Controllers\BaseController;
use App\Services\PlaylistService;
use Illuminate\Http\Request;
use Modules\Content\Services\PlaylistsService;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Events\PlaylistItemLoaded;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PinnedPlaylistsRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Repositories\UserPlaylistsRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection;
use App\Modules\RailTracker\Events\EngageContent;
use App\Modules\RailTracker\Services\ContentLastEngagedService;
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

    private ResourceDecorator $resourceDecorator;
    private PinnedPlaylistsRepository $pinnedPlaylistsRepository;
    private ContentLastEngagedService $contentLastEngagedService;
    private PlaylistService $playlistService;
    private PlaylistsService $userPlaylistService;

    public function __construct(
        UserPlaylistsService $userPlaylistsService,
        ContentService $contentService,
        ContentPermissionRepository $contentPermissionRepository,
        UserPermissionsRepository $userPermissionsRepository,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator,
        LessonAssignmentDecorator $lessonAssignmentDecorator,
        RoutingDecorator $routingDecorator,
        ResourceDecorator $resourceDecorator,
        PinnedPlaylistsRepository $pinnedPlaylistsRepository,
        ContentLastEngagedService $contentLastEngagedService,
        PlaylistService $playlistService,
        PlaylistsService $userPlaylistService
    ) {
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->userPermissionsRepository = $userPermissionsRepository;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
        $this->lessonAssignmentDecorator = $lessonAssignmentDecorator;
        $this->routingDecorator = $routingDecorator;
        $this->resourceDecorator = $resourceDecorator;
        $this->pinnedPlaylistsRepository = $pinnedPlaylistsRepository;
        $this->contentLastEngagedService = $contentLastEngagedService;
        $this->playlistService = $playlistService;
        $this->userPlaylistService = $userPlaylistService;
    }

    public function index(Request $request): View
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 12);
        $term = $request->get('search');
        UserPlaylistsRepository::$availableCategories = $request->get('categories', false);

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
        UserPlaylistsRepository::$availableCategories = false;
        $currentUser = [
            "avatar" => user()->profile_picture_url,
            "xp" => user()->totalXp(),
            "access_level" => user()->access_level,
            "xp_rank" => user()->getXpRank(),
        ];
        $initialPage = $request->get('page', 1);
        $filterOptions = $this->userPlaylistsService->getFilterOptions(
            user()->id,
            'user-playlist',
            brand(),
            $term
        );

        $listLessons =
            (new ContentFilterResultsEntity(
                ['results' => $lessons, 'total_results' => $playlistsNumber, 'filter_options' => $filterOptions]
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
            "filterOptions" => $filterOptions,
        ]);
    }

    /**
     * @param $domain
     * @param $brand
     * @param $playlistId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function playlist(Request $request, $domain, $brand, $playlistId): View
    {
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

        $user = user();
        $playlist = UserPlaylist::find($playlistId);
        throw_if((!$playlist), new NotFoundHttpException());

        $playlist['has_access'] = ($playlist->user_id != $user->id && $playlist->private == true) ? 0 : 1;
        $playlist['is_my_playlist'] = $playlist->user_id == $user->id;
        $playlist['description'] = $playlist['description'] ?? '';
        $playlist['playback_url'] = url()->route('platform.play.playlist', [
            'playlistId' => $playlist['id'],
        ]);

        $playlistItems = $this->userPlaylistService->getPlaylistItems($playlist->brand, $playlist->id);
     
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
        ]);
    }

    /**
     * @param $domain
     * @param $brand
     * @param $playlistId
     * @param $playlistItemId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function playlistItem(Request $request, $domain, $brand, $playlistId, $playlistItemId): View
    {
        $user = user();
        $playlist = UserPlaylist::find($playlistId);
        throw_if((!$playlist), new NotFoundHttpException());

        $playlist['has_access'] = ($playlist->user_id != $user->id && $playlist->private == true) ? 0 : 1;
        if (!$playlist['has_access']) {
            $items = new ContentFilterResultsEntity([
                                                        'results' => [],
                                                    ]);

            return view('account.playlist', [
                "listLessons" => $items->toResponseRawJson(),
                "playlist" => $playlist,
            ]);
        }

        $otherItems = $this->userPlaylistService->getPlaylistItems($playlist['brand'], $playlistId);
        $playlistLessons = (new ContentFilterResultsEntity([
                                                               'results' => $otherItems,
                                                               'total_results' => count($otherItems),
                                                           ]))->toResponseRawJson();
        $playlistItem = $otherItems->where('user_playlist_item_id', '=', $playlistItemId)->first();
        $position = $otherItems->search(function ($item) use ($playlistItemId) {
            return $item['user_playlist_item_id'] == $playlistItemId;
        });
        $position++;
        $previousPlaylistItem = $otherItems->get($position - 1);
        $nextPlaylistItem = $otherItems->get($position + 1);
        $givenDate = Carbon::parse($playlistItem['published_on']);
        $today = Carbon::now();
        if ($givenDate->lt($today)) {
            $playlistItem['released'] = true;
        } else {
            $playlistItem['released'] = false;
        }
        $playlistItem['parent'] = $playlistItem['parents'][0] ?? [];
        $relatedLesson =
            (new ContentFilterResultsEntity(['results' => $playlistItem['parents'] ?? []]))->toResponseRawJson();
        event(new PlaylistItemLoaded($playlistId, $playlistItemId, $position));

        return view('account.playlist-item', [
            "lessonContent" => $playlistItem,
            "playlist" => $playlist,
            "playlistItem" => $playlistItem,
            "lessonType" => $playlistItem['type'],
            "playlistItems" => $playlistLessons,
            "relatedLesson" => $relatedLesson,
            'positionInPlaylist' => $position,
            "nextPlaylistItemUrl" => $nextPlaylistItem['url'] ?? '',
            "previousPlaylistItemUrl" => $previousPlaylistItem['url'] ?? '',
            "brand" => brand(),
        ]);
    }

    /**
     * @param $domain
     * @param $brand
     * @param $playlistId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function playback(Request $request, $domain, $brand, $playlistId): RedirectResponse
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
