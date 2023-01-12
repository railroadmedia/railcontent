<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;

class UserPlaylistsController extends BaseController
{
    private UserPlaylistsService $userPlaylistsService;
    private ContentService $contentService;
    private UserContentProgressRepository $userContentRepository;

    /**
     * @param UserPlaylistsService $userPlaylistsService
     * @param ContentService $contentService
     * @param UserContentProgressRepository $userContentProgressRepository
     */
    public function __construct(
        UserPlaylistsService $userPlaylistsService,
        ContentService $contentService,
        UserContentProgressRepository $userContentProgressRepository
    ) {
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
        $this->userContentRepository = $userContentProgressRepository;
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
        ]);
    }
}
