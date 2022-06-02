<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Maps\ContentTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
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

        $noResultsMessage = '';

        $resetProgress = true;
        if (!$request->has('state')) {
            $request->attributes->set('state', 'in-primary-playlist');
            $resetProgress = false;
        }

        if (!empty($request->get('type'))) {
            if ($request->get('type') == 'shows') {
                $contentTypes = config('railcontent.showTypes');
            } else {
                $contentTypes = [$request->get('type')];
            }
        } else {
            $contentTypes = ContentTypes::userListContentTypes();
        }

        if ($request->get('state') == 'in-primary-playlist') {
            $noResultsMessage =
                'You haven\'t added any lessons of that type yet, once you add a lesson of this type it will show up here for you to access later.';

            if (empty($request->get('type'))) {
                $contentTypes[] = 'course-part';
            }

            $usersPrimaryPlaylist = $this->userPlaylistsService->updateOrCeate(['user_id' => auth()->id()], [
                'user_id' => auth()->id(),
                'type' => 'primary-playlist',
                'brand' => $brand ?? config('railcontent.brand'),
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ]);

            if (empty($usersPrimaryPlaylist)) {
                $lessons = [];
                $totalResults = 0;
            } else {
                $lessons = $this->userPlaylistsService->getUserPlaylistContents(
                    $usersPrimaryPlaylist['id'],
                    $contentTypes,
                    $request->get('limit', 20),
                    ($request->get('page', 1) - 1) * $request->get('limit', 20)
                );

                $totalResults =
                    $this->userPlaylistsService->countUserPlaylistContents($usersPrimaryPlaylist['id'], $contentTypes);
            }
        } else {
            $noResultsMessage =
                $request->get('state') === 'started' ?
                    'You haven\'t started any lessons of that type yet, once you start a lesson of this type it will show up here for you to access later.' : 'You haven\'t completed any lessons of that type yet, once you complete a lesson of this type it will show up here for you to access later.
';

            $lessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
                $contentTypes,
                auth()->id(),
                $request->get('state', 'started'),
                $request->get('limit', 20),
                ($request->get('page', 1) - 1) * $request->get('limit', 20)
            );

            $totalResults = $this->contentService->countByTypesUserProgressState(
                $contentTypes,
                auth()->id(),
                $request->get('state', 'started')
            );
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
            "resetProgress" => $resetProgress,
            "initialPage" => $initialPage,
            "noResultsMessage" => $noResultsMessage,
        ]);
    }
}
