<?php

namespace App\Http\Controllers\Platform;

use App\Decorators\Content\VimeoVideoSourcesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserPlaylistsController extends BaseController
{
    private UserPlaylistsService $userPlaylistsService;
    private ContentService $contentService;
    private UserContentProgressRepository $userContentRepository;
    private VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator;
    private LessonAssignmentDecorator $lessonAssignmentDecorator;

    /**
     * @param UserPlaylistsService $userPlaylistsService
     * @param ContentService $contentService
     * @param UserContentProgressRepository $userContentProgressRepository
     * @param VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator
     * @param LessonAssignmentDecorator $lessonAssignmentDecorator
     */
    public function __construct(
        UserPlaylistsService $userPlaylistsService,
        ContentService $contentService,
        UserContentProgressRepository $userContentProgressRepository,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator,
        LessonAssignmentDecorator $lessonAssignmentDecorator
    ) {
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
        $this->userContentRepository = $userContentProgressRepository;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
        $this->lessonAssignmentDecorator = $lessonAssignmentDecorator;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $term = $request->get('search');

        $lessons = $this->userPlaylistsService->getUserPlaylist(
            user()->id,
            'user-playlist',
            brand(),
            $limit,
            $page,
            $term,
            $request->get('sortby_val', $request->get('sort', '-created_at'))
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
            "searchTerm" => $term
        ]);
    }

    public function playlist(Request $request, $domain, $brand, $playlistId)
    {
        $playlist = $this->userPlaylistsService->getPlaylist($playlistId);
        throw_if(empty($playlist), new NotFoundHttpException());

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 20);

        $contentTypes = array_merge(
            config('railcontent.appUserListContentTypes', []),
            array_values(config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [])
        );

        $items = $this->userPlaylistsService->getUserPlaylistContents($playlistId, $contentTypes, $limit, $page);
        foreach ($items as $index => $item) {
            $items[$index]['duration'] = $item->fetch('fields.video.fields.length_in_seconds', 0);
            $items[$index]['url'] = url()->route('platform.user.playlist-item', [
                'playlistId' => $playlistId,
                'playlistItemId' => $item['user_playlist_item_id'],
            ]);
        }
        $items = new ContentFilterResultsEntity([
                                                    'results' => $items,
                                                    'total_results' => $this->userPlaylistsService->countUserPlaylistContents(
                                                        $playlistId
                                                    ),
                                                ]);

        return view('account.playlist', [
            "listLessons" => $items->toResponseRawJson(),
            "playlist" => $playlist,
            'currentUser' => user(),
            "noResultsMessage" => 'Nothing here yet! Start adding videos',
            "brand" => brand(),
            'totalItems' => $items->totalResults()
        ]);
    }

    public function playlistItem(Request $request, $domain, $brand, $playlistId, $playlistItemId)
    {
        $oldStatuses = ContentRepository::$availableContentStatues;
        $oldFutureContent = ContentRepository::$pullFutureContent;

        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];

        ContentRepository::$pullFutureContent = true;

        $playlist = $this->userPlaylistsService->getPlaylist($playlistId);
        throw_if(empty($playlist), new NotFoundHttpException());

        $playlistItems = $this->userPlaylistsService->getUserPlaylistContents($playlist['id']);
        foreach($playlistItems as $item){
            $item['url'] = url()->route('platform.user.playlist-item', [
                'playlistId' => $playlistId,
                'playlistItemId' => $playlistItemId
            ]);
        }
        $playlistItem =
            $playlistItems->where('user_playlist_item_id', $playlistItemId)
                ->first();
        $content = $this->contentService->getById($playlistItem['id']);
        throw_if(empty($playlistItem), new NotFoundHttpException());

        ContentRepository::$availableContentStatues = $oldStatuses;
        ContentRepository::$pullFutureContent = $oldFutureContent;

        if(empty($content)){
            // TODO: Replace with Upgrade to View page
            return view('pages.no-access', [
                "brand" => brand(),
            ]);
        }

        $playlistItem =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$playlistItem]))
                ->first();
        $parent = \Arr::last($playlistItem->getParentContentData());

//        if($playlistItem['type'] == 'assignment'){
//            $assignment = $playlistItem;
//            $playlistItem = $this->contentService->getById($parent->id);
//            $playlistItem['assignments'] = [$assignment];
//        }

        if ($parent) {
            $parentChildren = $this->contentService->getByParentId($parent->id);
        } else {
            $sort = $playlistItem['published_on'] ? 'published_on' : 'sort';

            if ($playlistItem['type'] == 'rhythmic-adventures-of-captain-carson' ||
                $playlistItem['type'] == 'diy-drum-experiments' ||
                $playlistItem['type'] == 'in-rhythm') {
                $sort = 'sort';
            }

            $parentChildren =
                $this->contentService->getFiltered($request->get('page', 1),
                                                   $request->get('limit', 10),
                                                   '-'.$sort,
                                                   [$playlistItem['type']])['results'];
        }

        $parentChildrenTrimmed = [];
        $matched = false;

        foreach ($parentChildren as $parentChildIndex => $parentChild) {
            if ((count($parentChildren) - $parentChildIndex) <= 10 && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            } elseif ($matched && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            }

            if ($parentChild['id'] == $playlistItem['id']) {
                $matched = true;
            }
        }

        $relatedLessons = (new ContentFilterResultsEntity(['results' => $parentChildren]))->toResponseRawJson();
        $playlistLessons = (new ContentFilterResultsEntity(['results' => $playlistItems]))->toResponseRawJson();

        if (empty($playlistItem['assignments'] ?? [])) {
            LessonAssignmentDecorator::$decorationMode = LessonAssignmentDecorator::DECORATION_MODE_MAXIMUM;
            $this->lessonAssignmentDecorator->decorate(new Collection([$playlistItem]))
                ->first();
        }

        $lessonAssignments = $playlistItem['assignments'] ?? [];

        $playlistItem['assignments'] = $lessonAssignments;

        return view('account.playlist-item', [
            "lessonContent" => $playlistItem,
            "playlist" => $playlist,
            "playlistItem" => $playlistItem,
            "lessonType" => $playlistItem['type'],
            "relatedLessons" => $relatedLessons,
            "playlistItems" => $playlistLessons,
            //            'currentUser' => user(),
            "brand" => brand(),
        ]);
    }
}
