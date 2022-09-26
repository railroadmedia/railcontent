<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Maps\ContentTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Services\UserPlaylistsService;

class UserListPagesController extends BaseController
{
    /**
     * @var UserPlaylistsService
     */
    private $userPlaylistsService;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param UserPlaylistsService $userPlaylistsService
     * @param ContentService $contentService
     */
    public function __construct(UserPlaylistsService $userPlaylistsService, ContentService $contentService)
    {
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
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
            (new ContentFilterResultsEntity(['results' => $lessons, 'total_results' => $totalResults]
            ))->toResponseRawJson();

        $initialPage = $request->get('page', 1);

        $allowedTypes = ContentTypes::userListContentTypes();

        usort($allowedTypes, function ($a, $b) {
            return strcmp($a, $b);
        });

        return view('account.playlists', [
            "listLessons" => $listLessons,
            "allowedTypes" => $allowedTypes,
            "resetProgress" => false,
            "initialPage" => $initialPage,
            "noResultsMessage" => $noResultsMessage,
        ]);
    }

    public function inProgress(Request $request, $domain, $brand)
    {
        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED, ContentService::STATUS_SCHEDULED];

        ContentRepository::$pullFutureContent = true;

        if (!empty($request->get('type'))) {
            $contentTypes = [$request->get('type')];
        } else {
            $contentTypes = ContentTypes::userListContentTypes();
        }

        $noResultsMessage =
            'You haven\'t started any lessons of that type yet, once you start a lesson of this type it will show up here for you to access later.';

        $lessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
            $contentTypes,
            auth()->id(),
            UserContentProgressService::STATE_STARTED,
            $request->get('limit', 20),
            ($request->get('page', 1) - 1) * $request->get('limit', 20)
        );

        $totalResults = $this->contentService->countByTypesUserProgressState(
            $contentTypes,
            auth()->id(),
            UserContentProgressService::STATE_STARTED,
        );

        $listLessons =
            (new ContentFilterResultsEntity(['results' => $lessons, 'total_results' => $totalResults]
            ))->toResponseRawJson();

        $initialPage = $request->get('page', 1);

        $allowedTypes = ContentTypes::userListContentTypes();

        usort($allowedTypes, function ($a, $b) {
            return strcmp($a, $b);
        });

        return view('account.playlists', [
            "listLessons" => $listLessons,
            "allowedTypes" => $allowedTypes,
            "resetProgress" => true,
            "initialPage" => $initialPage,
            "noResultsMessage" => $noResultsMessage,
        ]);
    }

    public function completed(Request $request, $domain, $brand)
    {
        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED, ContentService::STATUS_SCHEDULED];

        ContentRepository::$pullFutureContent = true;

        if (!empty($request->get('type'))) {
                $contentTypes = [$request->get('type')];
        } else {
            $contentTypes = ContentTypes::userListContentTypes();
        }

        $noResultsMessage =
            'You haven\'t completed any lessons of that type yet, once you complete a lesson of this type it will show up here for you to access later.';

        $lessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
            $contentTypes,
            auth()->id(),
            UserContentProgressService::STATE_COMPLETED,
            $request->get('limit', 20),
            ($request->get('page', 1) - 1) * $request->get('limit', 20)
        );

        $totalResults = $this->contentService->countByTypesUserProgressState(
            $contentTypes,
            auth()->id(),
            UserContentProgressService::STATE_COMPLETED,
        );

        $listLessons =
            (new ContentFilterResultsEntity(['results' => $lessons, 'total_results' => $totalResults]
            ))->toResponseRawJson();

        $initialPage = $request->get('page', 1);

        $allowedTypes = ContentTypes::userListContentTypes();

        usort($allowedTypes, function ($a, $b) {
            return strcmp($a, $b);
        });

        return view('account.playlists', [
            "listLessons" => $listLessons,
            "allowedTypes" => $allowedTypes,
            "resetProgress" => true,
            "initialPage" => $initialPage,
            "noResultsMessage" => $noResultsMessage,
        ]);
    }
}
