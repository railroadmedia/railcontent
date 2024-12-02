<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Models\UserPlaylist;
use App\Modules\RailTracker\Services\ContentLastEngagedService;
use App\Services\PlaylistService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Content\Services\PlaylistsService;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Events\PlaylistItemLoaded;
use Railroad\Railcontent\Repositories\UserPlaylistsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserPlaylistsController extends BaseController
{
    private ContentLastEngagedService $contentLastEngagedService;
    private PlaylistService $playlistService;
    private PlaylistsService $userPlaylistService;

    public function __construct(
        ContentLastEngagedService $contentLastEngagedService,
        PlaylistService $playlistService,
        PlaylistsService $userPlaylistService
    ) {
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
        $brand = Brand::from(brand());
        $sort             = $request->get('sortby_val', $request->get('sort', 'most_recent'));

        $playlists = $this->userPlaylistService->getPlaylists($sort, $brand, $term, $limit, $page);

        return view('account.playlists', [
            "playlists" => $playlists['data'],
            "playlistsNumber" => $playlists['meta']['totalResults'],
            "filterOptions" => $playlists['meta']['filterOptions'],
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

        $user = user();
        $playlist = UserPlaylist::find($playlistId);
        throw_if((!$playlist), new NotFoundHttpException());
        $playlist['is_liked_by_current_user'] = $playlist->likes()->where('user_id', $user->id)->exists();
        $formatedPlaylist = $this->userPlaylistService->formatPlaylists([$playlist]);
        $playlist = $formatedPlaylist[0];
        $playlist['has_access'] = ($playlist['user_id'] != $user->id && $playlist['private'] == true) ? 0 : 1;

        $playlistItems = $this->userPlaylistService->getPlaylistItems($playlist['brand'], $playlist['id']);

        $items = new ContentFilterResultsEntity([
                                                    'results' => $playlistItems,
                                                ]);

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
        $playlistItem['instructors'] = $playlistItem['instructors_details'] ?? $playlistItem['instructors'];

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
