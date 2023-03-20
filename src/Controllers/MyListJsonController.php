<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\AddItemToPlaylistRequest;
use Railroad\Railcontent\Requests\PlaylistCreateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Transformers\DataTransformer;
use Symfony\Component\HttpFoundation\Request;

class MyListJsonController extends Controller
{
    private ContentService $contentService;
    private ContentRepository $contentRepository;
    private ContentHierarchyService $contentHierarchyService;
    private UserPlaylistsService $userPlaylistsService;
    private ImageManager $imageManager;

    /**
     * @param ContentService $contentService
     * @param ContentHierarchyService $contentHierarchyService
     * @param ContentRepository $contentRepository
     * @param UserPlaylistsService $userPlaylistsService
     * @param ImageManager $imageManager
     */
    public function __construct(
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService,
        ContentRepository $contentRepository,
        UserPlaylistsService $userPlaylistsService,
        ImageManager $imageManager
    ) {
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;
        $this->contentRepository = $contentRepository;
        $this->userPlaylistsService = $userPlaylistsService;
        $this->imageManager = $imageManager;

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
     * @throws \Doctrine\ORM\NonUniqueResultException
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

    /**
     * @param PlaylistCreateRequest $request
     * @return mixed
     */
    public function createPlaylist(PlaylistCreateRequest $request)
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

        return reply()->json([$playlist], [
            'transformer' => DataTransformer::class,
            'code' => 201,
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function getPlaylist(Request $request)
    {
        $playlist = $this->userPlaylistsService->getPlaylist($request->get('playlist_id'));
        throw_if(($playlist == -1), new NotFoundException("You don’t have access to this playlist", 'Private Playlist'));
        throw_if(!$playlist, new NotFoundException("Playlist not exists."));

        return reply()->json([$playlist], [
            'transformer' => DataTransformer::class,
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function copyPlaylist(Request $request)
    {
        $playlist = $this->userPlaylistsService->getPlaylist($request->get('playlist_id'));
        throw_if(!$playlist, new NotFoundException('Playlist not exists.'));

        $playlist = $this->userPlaylistsService->create([
                                                            'user_id' => auth()->id(),
                                                            'type' => 'user-playlist',
                                                            'brand' => $playlist['brand'],
                                                            'name' => $request->get('name', $playlist['name']),
                                                            'description' => $request->get(
                                                                'description',
                                                                $playlist['description']
                                                            ),
                                                            'thumbnail_url' => $request->get(
                                                                'thumbnail_url',
                                                                $playlist['thumbnail_url']
                                                            ),
                                                            'category' => $request->get(
                                                                'category',
                                                                $playlist['category']
                                                            ),
                                                            'private' => $playlist['private'],
                                                            'duration' => $playlist['duration'],
                                                            'created_at' => Carbon::now()
                                                                ->toDateTimeString(),
                                                        ]);

        $playlistLessons = $this->userPlaylistsService->getByPlaylistId($request->get('playlist_id'));

        foreach ($playlistLessons as $playlistLesson) {
            $this->userPlaylistsService->duplicatePlaylistItem(
                $playlist['id'],
                $playlistLesson
            );
        }

        return reply()->json([$playlist], [
            'transformer' => DataTransformer::class,
            'code' => 201,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserPlaylists(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $sort = $request->get('sort', '-created_at');

        $playlists = $this->userPlaylistsService->getUserPlaylist(
            auth()->id(),
            'user-playlist',
            config('railcontent.brand'),
            $limit,
            $page,
            $request->get('term'),
            $sort
        );

        $itemId = $request->get('content_id');
        if ($itemId) {
            foreach ($playlists as $index => $playlist) {
                $playlistItem = $this->userPlaylistsService->existsContentIdInPlaylist($playlist['id'], $itemId);
                $playlists[$index]['is_added_to_playlist'] = !empty($playlistItem);
                $playlists[$index]['user_playlist_item_id'] = $playlistItem[0]['id'] ?? null;
            }
        }

        return (new ContentFilterResultsEntity([
                                                   'results' => $playlists,
                                                   'total_results' => $this->userPlaylistsService->countUserPlaylists(
                                                       auth()->id(),
                                                       'user-playlist',
                                                       config('railcontent.brand'),
                                                       $request->get('term')
                                                   ),
                                               ]))->toJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPublicPlaylists(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $brand = $request->get('brand', config('railcontent.brand'));

        $playlists = $this->userPlaylistsService->getPublicPlaylists('user-playlist', $brand, $page, $limit);

        return (new ContentFilterResultsEntity([
                                                   'results' => $playlists,
                                                   'total_results' => $this->userPlaylistsService->countPublicPlaylists(
                                                       'user-playlist',
                                                       $brand
                                                   ),
                                               ]))->toJsonResponse();
    }

    /**
     * @param AddItemToPlaylistRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function addItemToPlaylist(AddItemToPlaylistRequest $request)
    {
        $playlist = $this->userPlaylistsService->getPlaylist($request->get('playlist_id'));
        throw_if(!$playlist, new NotFoundException('Playlist not exists.'));

        $added = $this->userPlaylistsService->addItemToPlaylist(
            $request->get('playlist_id'),
            $request->get('content_id'),
            $request->get('position'),
            $request->get('extra_data'),
            $request->get('start_second'),
            $request->get('end_second'),
            $request->get('import_all_assignments', false),
            $request->get('import_full_soundslice_assignment', false),
            $request->get('import_instrumentless_soundslice_assignment', false)
        );

        return response()->json($added);
    }

    /**
     * @param Request $request
     * @param $playlistId
     * @return mixed
     * @throws \Throwable
     */
    public function updatePlaylist(Request $request, $playlistId)
    {
        $playlist = $this->userPlaylistsService->getPlaylist($playlistId);
        throw_if(!$playlist, new NotFoundException('Playlist not exists.'));

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pinPlaylist(Request $request)
    {
        $playlist = $this->userPlaylistsService->getPlaylist($request->get('playlist_id'));
        throw_if(!$playlist, new NotFoundException('Playlist not exists.'));

        $allowedPinNumber = config('railcontent.pinned_playlists_nr', 5);
        $myPinnedPlaylists = $this->userPlaylistsService->getPinnedPlaylists();

        if (count($myPinnedPlaylists) < $allowedPinNumber) {
            $pin = $this->userPlaylistsService->pinPlaylist(
                $request->get('playlist_id'),
                $request->get('brand', config('railcontent.brand'))
            );

            return reply()->json([$pin], [
                'code' => $pin ? 200 : 500,
                'transformer' => DataTransformer::class,
            ]);
        }

        return response()->json(
            [
                'success' => false,
                'errors' => [
                    [
                        'detail' => 'You can only pin five playlists to the menu. To add or remove a playlist, toggle 
the pin icon on or off.',
                    ],
                ],
            ],
            422
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function unpinPlaylist(Request $request)
    {
        $deleted = $this->userPlaylistsService->unpinPlaylist($request->get('playlist_id'));

        return reply()->json([[$deleted > 0]], [
            'code' => $deleted ? 200 : 500,
            'transformer' => DataTransformer::class,
        ]);
    }

    /**
     * @return array|mixed[]
     */
    public function getPinnedPlaylists()
    {
        $playlists = $this->userPlaylistsService->getPinnedPlaylists();

        return $playlists;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function likePlaylist(Request $request)
    {
        $like = $this->userPlaylistsService->likePlaylist(
            $request->get('playlist_id'),
            $request->get('brand', config('railcontent.brand'))
        );

        return reply()->json([[$like > 0]], [
            'code' => $like ? 200 : 500,
            'transformer' => DataTransformer::class,
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function deletePlaylistLike(Request $request)
    {
        $like = $this->userPlaylistsService->deletePlaylistLike($request->get('playlist_id'));

        return reply()->json([[$like > 0]], [
            'code' => $like ? 200 : 500,
            'transformer' => DataTransformer::class,
        ]);
    }

    /**
     * @param Request $request
     * @return ContentFilterResultsEntity
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getPlaylistLessons(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', null);
        $sort = $request->get('sort', 'position');
        $contentTypes = array_merge(
            config('railcontent.appUserListContentTypes', []),
            array_values(config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [])
        );

        $lessons = new ContentFilterResultsEntity([
                                                      'results' => $this->userPlaylistsService->getUserPlaylistContents(
                                                          $request->get('playlist_id'),
                                                          $contentTypes,
                                                          $limit,
                                                          $page,
                                                          $sort
                                                      ),
                                                      'total_results' => $this->userPlaylistsService->countUserPlaylistContents(
                                                          $request->get('playlist_id')
                                                      ),
                                                  ]);

        return $lessons;
    }

    /**
     * @param Request $request
     * @return mixed|Collection|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function changePlaylistContent(Request $request)
    {
        $playlistContent = $this->userPlaylistsService->getPlaylistItemById($request->get('user_playlist_item_id'));
        throw_if(!$playlistContent, new NotFoundException('Playlist item not exists.'));

        return $this->userPlaylistsService->changePlaylistContent(
            $request->get('user_playlist_item_id'),
            $request->get('position'),
            $request->get('extra_data'),
            $request->get('start_second'),
            $request->get('end_second')
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function deletePlaylist(Request $request)
    {
        $deleted = $this->userPlaylistsService->deletePlaylist($request->get('playlist_id'));

        return reply()->json([[$deleted > 0]], [
            'code' => $deleted ? 200 : 500,
            'transformer' => DataTransformer::class,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPlaylist(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', null);
        $term = $request->get('term', '');

        return (new ContentFilterResultsEntity([
                                                   'results' => $this->userPlaylistsService->searchPlaylist(
                                                       $term,
                                                       $page,
                                                       $limit
                                                   ),
                                                   'total_results' => $this->userPlaylistsService->countTotalSearchResults(
                                                       $term
                                                   ),
                                               ]))->toJsonResponse();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function removeItemFromPlaylist(Request $request)
    {
        $deleted = $this->userPlaylistsService->removeItemFromPlaylist($request->get('user_playlist_item_id'));

        return reply()->json([[$deleted > 0]], [
            'code' => $deleted ? 200 : 500,
            'transformer' => DataTransformer::class,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function uploadPlaylistThumbnail(\Illuminate\Http\Request $request)
    {
        if ($request->has('fieldKey')) {
            $request->validate(['fieldKey' => 'in:playlist_thumbnail']);

            $target = $request->get('fieldKey')."/".'playlists_thumbnails-'.time().'-'.auth()->id().'.jpg';

            $success =
                Storage::disk('musora_web_platform_s3')
                    ->copy($request->get('s3_bucket_path'), $target);

            if ($success) {
                return response()->json(
                    [
                        'thumbnail_url' => config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url').
                            $target,
                    ],
                    201
                );
            }
        }

        throw_if(!$request->file('file'), new \Railroad\Railcontent\Exceptions\NotFoundException('File not found.'));

        $image = $this->imageManager->make($request->file('file'));

        $image->interlace()
            ->encode('jpg', 75)
            ->save();

        $target = 'playlist_thumbnail/'.'playlists_thumbnails-'.time().'-'.auth()->id().'.jpg';

        $success =
            Storage::disk('musora_web_platform_s3')
                ->put(
                    $target,
                    $request->file('file')
                        ->getContent()
                );

        if ($success) {
            return response()->json(
                ['thumbnail_url' => config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url').$target],
                200
            );
        }

        return response()->json(['error' => 'Failed to upload playlist thumbnail.'], 400);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLikedPlaylists(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $playlists = $this->userPlaylistsService->getLikedPlaylists(
            $request->get('brand', config('railcontent.brand')),
            $limit,
            $page
        );

        return (new ContentFilterResultsEntity([
                                                   'results' => $playlists,
                                                   'total_results' => $this->userPlaylistsService->countLikedPlaylist(
                                                       $request->get('brand', config('railcontent.brand'))
                                                   ),
                                               ]))->toJsonResponse();
    }
}
