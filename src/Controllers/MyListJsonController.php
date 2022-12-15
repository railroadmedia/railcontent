<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Transformers\ArrayTransformer;
use Railroad\Railcontent\Transformers\DataTransformer;
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
     * @var UserPlaylistsService
     */
    private $userPlaylistsService;

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
        ContentRepository $contentRepository,
        UserPlaylistsService $userPlaylistsService
    ) {
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;
        $this->contentRepository = $contentRepository;
        $this->userPlaylistsService = $userPlaylistsService;

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

        $userPrimaryPlaylists =
            $this->userPlaylistsService->getUserPlaylist($userId, 'primary-playlist', $request->get('brand'));

        if (empty($userPrimaryPlaylists)) {
            $userPrimaryPlaylist = $this->userPlaylistsService->updateOrCeate([
                                                                                  'user_id' => $userId,
                                                                                  'type' => 'primary-playlist',
                                                                                  'brand' => $request->get('brand')
                                                                                      ??
                                                                                      config('railcontent.brand'),
                                                                              ], [
                                                                                  'user_id' => $userId,
                                                                                  'type' => 'primary-playlist',
                                                                                  'brand' => $request->get('brand')
                                                                                      ??
                                                                                      config('railcontent.brand'),
                                                                                  'created_at' => Carbon::now()
                                                                                      ->toDateTimeString(),
                                                                              ]);
        } else {
            $userPrimaryPlaylist = Arr::first($userPrimaryPlaylists);
        }

        $this->userPlaylistsService->addContentToUserPlaylist($userPrimaryPlaylist['id'], $request->get('content_id'));

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
            $this->userPlaylistsService->getUserPlaylist($userId, 'primary-playlist', $request->get('brand'));

        if (!empty($userPrimaryPlaylist)) {
            $userPrimaryPlaylistId = Arr::first($userPrimaryPlaylist)['id'];
            $this->userPlaylistsService->removeContentFromUserPlaylist(
                $userPrimaryPlaylistId,
                $request->get('content_id')
            );
        }

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
        $userId = auth()->id();

        $oldFieldOptions = ConfigService::$fieldOptionList;
        ConfigService::$fieldOptionList = array_merge(ConfigService::$fieldOptionList, ['video']);

        $contentTypes = array_merge(
            config('railcontent.appUserListContentTypes', []),
            array_values(config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [])
        );

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $contentTypes = $request->get('included_types', $contentTypes);
        $requiredFields = $request->get('required_fields', []);
        $includedFields = $request->get('included_fields', []);

        if (!$state) {
            $usersPrimaryPlaylist = $this->userPlaylistsService->updateOrCeate([
                                                                                   'user_id' => $userId,
                                                                                   'type' => 'primary-playlist',
                                                                                   'brand' => $request->get('brand')
                                                                                       ??
                                                                                       config('railcontent.brand'),
                                                                               ], [
                                                                                   'user_id' => $userId,
                                                                                   'type' => 'primary-playlist',
                                                                                   'brand' => $request->get('brand')
                                                                                       ??
                                                                                       config('railcontent.brand'),
                                                                                   'created_at' => Carbon::now()
                                                                                       ->toDateTimeString(),
                                                                               ]);

            if (empty($usersPrimaryPlaylist)) {
                return (new ContentFilterResultsEntity([
                                                           'results' => [],
                                                       ]))->toJsonResponse();
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
                array_values($contentTypes),
                [],
                [],
                $requiredFields,
                $includedFields,
                $request->get('required_user_states', [$state]),
                $request->get('included_user_states', [])
            );
        }

        ConfigService::$fieldOptionList = $oldFieldOptions;

        return (new ContentFilterResultsEntity([
                                                   'results' => $lessons->results(),
                                                   'total_results' => $lessons->totalResults(),
                                                   'filter_options' => $lessons->filterOptions(),
                                               ]))->toJsonResponse();
    }

    public function createPlaylist(Request $request)
    {
        $playlist = $this->userPlaylistsService->create([
                                                            'user_id' => auth()->id(),
                                                            'type' => 'user-playlist',
                                                            'brand' => $request->get('brand')
                                                                ??
                                                                config('railcontent.brand'),
                                                            'name' => $request->get('name'),
                                                            'description' => $request->get('description'),
                                                            'thumbnail_url' => $request->get('thumbnail_url'),
                                                            'category' => $request->get('category'),
                                                            'private' => $request->get('private', true),
                                                            'created_at' => Carbon::now()
                                                                ->toDateTimeString(),
                                                        ]);

        return $playlist;
    }

    public function getPlaylist(Request $request)
    {
        return $this->userPlaylistsService->getPlaylist($request->get('playlist_id'));
    }

    public function copyPlaylist(Request $request)
    {
        $playlist = $this->userPlaylistsService->getPlaylist($request->get('playlist_id'));

        $playlist = $this->userPlaylistsService->create([
                                                            'user_id' => auth()->id(),
                                                            'type' => 'user-playlist',
                                                            'brand' => $playlist['brand'],
                                                            'name' => $playlist['name'],
                                                            'description' => $playlist['description'],
                                                            'thumbnail_url' => $playlist['thumbnail_url'],
                                                            'category' => $playlist['category'],
                                                            'private' => $playlist['private'],
                                                            'created_at' => Carbon::now()
                                                                ->toDateTimeString(),
                                                        ]);

        return $playlist;
    }

    public function getUserPlaylists(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        return (new ContentFilterResultsEntity([
                                                   'results' => $this->userPlaylistsService->getUserPlaylist(
                                                       auth()->id(),
                                                       'user-playlist',
                                                       config('railcontent.brand'),
                                                       $limit,
                                                       $page
                                                   ),
                                                   'total_results' => $this->userPlaylistsService->countUserPlaylists(
                                                       auth()->id(),
                                                       'user-playlist',
                                                       config('railcontent.brand')
                                                   ),
                                               ]))->toJsonResponse();
    }

    public function getPublicPlaylists()
    {
        $playlists = $this->userPlaylistsService->getPublicPlaylists('user-playlist', config('railcontent.brand'));

        return $playlists;
    }

    public function addItemToPlaylist(Request $request)
    {
        $this->userPlaylistsService->addItemToPlaylist(
            $request->get('user_playlist_id'),
            $request->get('content_id'),
            $request->get('position')
        );

        return response()->json(['success']);
    }

    public function updatePlaylist(Request $request, $playlistId)
    {
        $playlist = $this->userPlaylistsService->update(
            $playlistId,
            array_intersect_key($request->all(), [
                'name' => '',
                'description' => '',
                'thumbnail_url' => '',
                'category' => '',
                'private' => '',
            ])
        );

        return reply()->json([$playlist], [
            'transformer' => DataTransformer::class,
            'code' => 201,
        ]);
    }


    public function pinPlaylist(Request $request)
    {
        $this->userPlaylistsService->pinPlaylist($request->get('user_playlist_id'));

        return response()->json(['success']);
    }

    public function getPinnedPlaylists()
    {
        $playlists = $this->userPlaylistsService->getPinnedPlaylists();

        return $playlists;
    }
}
