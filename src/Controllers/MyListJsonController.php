<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;
use Symfony\Component\HttpFoundation\Request;

class MyListJsonController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * MyListJsonController constructor.
     *
     * @param ContentService $contentService
     * @param ContentHierarchyService $contentHierarchyService
     */
    public function __construct(
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService
    ) {
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \ReflectionException
     */
    public function addToPrimaryPlaylist(Request $request)
    {
        $userId = auth()->id();
        $content = new Collection($this->contentService->getById($request->get('content_id')));

        if ($content->isEmpty()) {
            return response()->json(['error' => 'Incorrect content']);
        }

        $userPrimaryPlaylist =
            $this->contentService->getByUserIdTypeSlug($userId, 'user-playlist', 'primary-playlist')
                ->first();

        if (!$userPrimaryPlaylist) {
            $userPrimaryPlaylist = $this->contentService->create(
                'primary-playlist',
                'user-playlist',
                ContentService::STATUS_PUBLISHED,
                null,
                config('railcontent.brand'),
                $userId,
                Carbon::now()
                    ->toDateTimeString()
            );
        }

        $this->contentHierarchyService->create($userPrimaryPlaylist['id'], $request->get('content_id'), 1);

        return response()->json(['success']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromPrimaryPlaylist(Request $request)
    {
        $content = new Collection($this->contentService->getById($request->get('content_id')));

        if ($content->isEmpty()) {
            return response()->json(['error' => 'Incorrect content']);
        }

        $userId = auth()->id();

        $userPrimaryPlaylist =
            $this->contentService->getByUserIdTypeSlug($userId, 'user-playlist', 'primary-playlist')
                ->first();

        $this->contentHierarchyService->delete($userPrimaryPlaylist['id'], $request->get('content_id'));

        return response()->json(['success']);
    }

    /** Pull my list content
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyLists(Request $request)
    {
        $state = $request->get('state');

        $contentTypes = array_merge(
            [
                'course',
                'course-part',
                'play-along',
                'song',
            ],
            array_keys(config('railcontent.shows'))
        );

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $contentTypes = $request->get('included_types', $contentTypes);
        $requiredFields = $request->get('required_fields', []);

        if (!$state) {

            $usersPrimaryPlaylists = $this->contentService->getByUserIdTypeSlug(
                auth()->id(),
                'user-playlist',
                'primary-playlist'
            );

            $usersPrimaryPlaylist = reset($usersPrimaryPlaylists);

            if (empty($usersPrimaryPlaylist)) {
                return response()->json([]);
            }

            $lessons = $this->contentService->getFiltered(
                $page,
                $limit,
                '-published_on',
                $contentTypes,
                [],
                array_values(array_pluck($usersPrimaryPlaylist, 'id')),
                $requiredFields,
                [],
                [],
                []
            );
        } else {
            $contentTypes = array_diff($contentTypes, ['course-part']);

            $lessons = $this->contentService->getFiltered(
                $page,
                $limit,
                '-published_on',
                $contentTypes,
                [],
                [],
                $requiredFields,
                [],
                [$state],
                []
            );
        }

        $filterOptions = array_merge(
            [
                'content_type' => $lessons->results()
                    ->pluck('type')
                    ->unique()
                    ->values()
                    ->toArray(),
            ],
            $lessons->filterOptions()
        );

        return (new ContentFilterResultsEntity(
            [
                'results' => $lessons->results(),
                'total_results' => $lessons->totalResults(),
                'filter_options' => $filterOptions,
            ]
        ))->toJsonResponse();
    }
}
