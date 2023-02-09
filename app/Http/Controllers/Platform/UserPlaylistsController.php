<?php

namespace App\Http\Controllers\Platform;

use App\Decorators\Content\VimeoVideoSourcesDecorator;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection;

class UserPlaylistsController extends BaseController
{
    private UserPlaylistsService $userPlaylistsService;
    private ContentService $contentService;
    private UserContentProgressRepository $userContentRepository;
    private VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator;

    /**
     * @param UserPlaylistsService $userPlaylistsService
     * @param ContentService $contentService
     * @param UserContentProgressRepository $userContentProgressRepository
     */
    public function __construct(
        UserPlaylistsService $userPlaylistsService,
        ContentService $contentService,
        UserContentProgressRepository $userContentProgressRepository,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator
    ) {
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
        $this->userContentRepository = $userContentProgressRepository;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        $lessons = $this->userPlaylistsService->getUserPlaylist(
            user()->id,
            'user-playlist',
            brand(),
            $limit,
            $page
        );
        $playlistsNumber = $this->userPlaylistsService->countUserPlaylists(
            user()->id,
            'user-playlist',
            brand()
        );

        $likedPlaylists = $this->userPlaylistsService->getLikedPlaylists(brand(), 5, 1);

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
            "likedPlaylists" => $likedPlaylists,
            "allowedTypes" => [],
            "resetProgress" => false,
            "initialPage" => $initialPage,
            'currentUser' => $currentUser,
            "noResultsMessage" => 'no results',
        ]);
    }

    public function playlist(Request $request, $domain, $brand, $playlistId){
        $playlist = $this->userPlaylistsService->getPlaylist($playlistId);

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 20);

        $contentTypes = array_merge(
            config('railcontent.appUserListContentTypes', []),
            array_values(config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [])
        );

        $items = $this->userPlaylistsService->getUserPlaylistContents($playlistId, $contentTypes,$limit, $page);
        foreach($items as $index=>$item){
            $items[$index]['url'] = url()->route('platform.user.playlist-item',['playlistId' => $playlistId,
                'playlistItemId' => $item['user_playlist_item_id']]);
        }
        $items = new ContentFilterResultsEntity([
                                                      'results' => $items,
                                                      'total_results' => $this->userPlaylistsService->countUserPlaylistContents($playlistId),
                                                  ]);

        return view('account.playlist', [
            "listLessons" => $items->toResponseRawJson(),
            "playlist" => $playlist,
            'currentUser' => user(),
            "noResultsMessage" => 'Nothing here yet! Start adding videos',
            "brand" => brand()
        ]);

    }

    public function playlistItem(Request $request, $domain, $brand, $playlistId, $playlistItemId){
        $playlist = $this->userPlaylistsService->getPlaylist($playlistId);
        $playlistItem = $this->userPlaylistsService->getPlaylistItemById($playlistItemId);
        $contentToRenderAsLesson = $this->contentService->getById($playlistItem['content_id']);

        $contentToRenderAsLesson =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$contentToRenderAsLesson]))
                ->first();

        $relatedLessons = (new ContentFilterResultsEntity(['results' => []]))->toResponseRawJson();

        return view('account.playlist-item', [
            "lessonContent" => $contentToRenderAsLesson,
            "playlist" => $playlist,
            "playlistItem" => $playlistItem,
            "lessonType" => $contentToRenderAsLesson['type'],
            "relatedLessons" => $relatedLessons,
            'currentUser' => user(),
            "brand" => brand()
        ]);

    }
}
