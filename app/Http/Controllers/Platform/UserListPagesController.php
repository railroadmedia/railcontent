<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Maps\ContentTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Services\UserPlaylistsService;

class UserListPagesController extends BaseController
{
    private UserPlaylistsService $userPlaylistsService;
    private ContentService $contentService;
    private UserContentProgressRepository $userContentRepository;

    public function __construct(
        UserPlaylistsService $userPlaylistsService,
        ContentService $contentService,
        UserContentProgressRepository $userContentProgressRepository
    ) {
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
        $this->userContentRepository = $userContentProgressRepository;
    }

    public function myList(Request $request, $domain, $brand)
    {
        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED, ContentService::STATUS_SCHEDULED];

        ContentRepository::$pullFutureContent = true;

        $request->attributes->set('state', 'in-primary-playlist');

        if (!empty($request->get('type'))) {
            $contentTypes = [$request->get('type')];
        } else {
            $contentTypes = ContentTypes::userListContentTypes();
        }

        $noResultsMessage =
            'You haven\'t added any lessons of that type yet, once you add a lesson of this type it will show up here for you to access later.';

        if (empty($request->get('type'))) {
            $contentTypes[] = 'course-part';
        }
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;

        $usersPrimaryPlaylist = $this->userPlaylistsService->getUserPlaylist(auth()->id(), 'primary-playlist', brand());

        if (empty($usersPrimaryPlaylist)) {
            $lessons = [];
            $totalResults = 0;
        } else {
            $userPrimaryPlaylistId = $usersPrimaryPlaylist[0]['id'];
            $lessons = $this->userPlaylistsService->getUserPlaylistContents(
                $userPrimaryPlaylistId,
                $contentTypes,
                $request->get('limit', 20),
                $request->get('page', 1)
            );

            $totalResults =
                $this->userPlaylistsService->countUserPlaylistContents($userPrimaryPlaylistId, $contentTypes);
        }

        $listLessons =
            (new ContentFilterResultsEntity(
                ['results' => $lessons, 'total_results' => $totalResults]
            ))->toResponseRawJson();

        $initialPage = $request->get('page', 1);

        $allowedTypes = ContentTypes::userListContentTypes();

        usort($allowedTypes, function ($a, $b) {
            return strcmp($a, $b);
        });

        $currentUser = [
            "avatar" => user()->profile_picture_url,
            "xp" => user()->totalXp(),
            "access_level" => user()->access_level,
            "xp_rank" => user()->getXpRank(),
        ];

        return view('account.lesson-history', [
            "listLessons" => $listLessons,
            "allowedTypes" => $allowedTypes,
            "resetProgress" => false,
            "initialPage" => $initialPage,
            'currentUser' => $currentUser,
            "noResultsMessage" => $noResultsMessage,
        ]);
    }

    public function inProgress(Request $request, $domain, $brand)
    {
        return view('account.lesson-history');
    }

    public function completed(Request $request, $domain, $brand)
    {
        return view('account.lesson-history');
    }
}
