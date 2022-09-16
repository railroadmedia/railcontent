<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
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
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * MyListJsonController constructor.
     *
     * @param ContentService $contentService
     * @param ContentHierarchyService $contentHierarchyService
     * @param ContentRepository $contentRepository
     */
    public function __construct(
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService,
        ContentRepository $contentRepository
    ) {
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;
        $this->contentRepository = $contentRepository;

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
        $content = new Collection($this->contentRepository->getById($request->get('content_id')));

        if ($content->isEmpty()) {
            return response()->json(['error' => 'Incorrect content']);
        }

        $userPrimaryPlaylist =
            $this->contentService->getByUserIdTypeSlug($userId, 'user-playlist', 'primary-playlist')
                ->first();

        if (empty($userPrimaryPlaylist)) {
            $userPrimaryPlaylistId = DB::connection(config('railcontent.database_connection_name'))
                ->table('railcontent_user_playlists')
                ->insertGetId([
                    'brand' => config('railcontent.brand'),
                    'type' => 'primary-playlist',
                    'user_id' => $userId,
                    'created_at' => Carbon::now()->toDateTimeString()
                ]);
        } else {
            $userPrimaryPlaylistId = $userPrimaryPlaylist['id'];
        }

        DB::connection(config('railcontent.database_connection_name'))
            ->table('railcontent_user_playlist_content')
            ->insert([
                'content_id' => $request->get('content_id'),
                'user_playlist_id' => $userPrimaryPlaylistId,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

        return response()->json(['success']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromPrimaryPlaylist(Request $request)
    {
        $content = new Collection($this->contentRepository->getById($request->get('content_id')));

        if ($content->isEmpty()) {
            return response()->json(['error' => 'Incorrect content']);
        }

        $userId = auth()->id();

        $userPrimaryPlaylist =
            $this->contentService->getByUserIdTypeSlug($userId, 'user-playlist', 'primary-playlist')
                ->first();

        if (empty($userPrimaryPlaylist)) {
            $userPrimaryPlaylistId = DB::connection(config('railcontent.database_connection_name'))
                ->table('railcontent_user_playlists')
                ->insertGetId([
                    'brand' => config('railcontent.brand'),
                    'type' => 'primary-playlist',
                    'user_id' => $userId,
                    'created_at' => Carbon::now()->toDateTimeString()
                ]);
        } else {
            $userPrimaryPlaylistId = $userPrimaryPlaylist['id'];
        }

        DB::connection(config('railcontent.database_connection_name'))
            ->table('railcontent_user_playlist_content')
            ->where([
                'content_id' => $request->get('content_id'),
                'user_playlist_id' => $userPrimaryPlaylistId
            ])
            ->delete();

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

        $oldFieldOptions = ConfigService::$fieldOptionList;
        ConfigService::$fieldOptionList = array_merge(ConfigService::$fieldOptionList, ['video']);

        $contentTypes = array_merge(
            config('railcontent.appUserListContentTypes', []),
            array_values(config('railcontent.showTypes', []))
        );

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $contentTypes = $request->get('included_types', $contentTypes);
        $requiredFields = $request->get('required_fields', []);
        $includedFields = $request->get('included_fields', []);

        if (!$state) {

            $usersPrimaryPlaylist = array_first(
                $this->contentRepository->getByUserIdTypeSlug(auth()->id(), 'user-playlist', 'primary-playlist')
            );

            if (empty($usersPrimaryPlaylist)) {
                return (new ContentFilterResultsEntity(
                    [
                        'results' => [],
                    ]
                ))->toJsonResponse();
            }

            $lessons = $this->contentService->getFiltered(
                $page,
                $limit,
                $request->get('sort', '-published_on'),
                $contentTypes,
                [],
                [$usersPrimaryPlaylist['id']],
                $requiredFields,
                $includedFields,
                $request->get('required_user_states', []),
                $request->get('included_user_states', [])
            );
        } else {
            $contentTypes = array_diff($contentTypes, ['course-part']);

            $lessons = $this->contentService->getFiltered(
                $page,
                $limit,
                $request->get('sort', '-progress'),
                $contentTypes,
                [],
                [],
                $requiredFields,
                $includedFields,
                $request->get('required_user_states', [$state]),
                $request->get('included_user_states', [])
            );
        }

        ConfigService::$fieldOptionList = $oldFieldOptions;

        return (new ContentFilterResultsEntity(
            [
                'results' => $lessons->results(),
                'total_results' => $lessons->totalResults(),
                'filter_options' => $lessons->filterOptions(),
            ]
        ))->toJsonResponse();
    }
}
