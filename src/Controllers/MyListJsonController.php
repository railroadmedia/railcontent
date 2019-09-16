<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Services\UserPlaylistService;
use ReflectionException;

/**
 * Class MyListJsonController
 *
 * @package Railroad\Railcontent\Controllers
 */
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

    private $userPlaylistService;

    /**
     * MyListJsonController constructor.
     *
     * @param ContentService $contentService
     * @param ContentHierarchyService $contentHierarchyService
     * @param UserPlaylistService $userPlaylistService
     */
    public function __construct(
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService,
        UserPlaylistService $userPlaylistService
    ) {
        $this->contentService = $contentService;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->userPlaylistService = $userPlaylistService;
    }

    /**
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addToPrimaryPlaylist(Request $request)
    {
        $userId = auth()->id();

        $content = $this->contentService->getById($request->get('content_id'));
        if (!$content) {
            return ResponseService::empty(200)
                ->setData(['error' => 'Incorrect content']);
        }

        $userPrimaryPlaylist =
            $this->userPlaylistService->updateOrCeate($userId, 'primary-playlist', config('railcontent.brand'));

        $this->userPlaylistService->addContentToUserPlaylist(
            $userPrimaryPlaylist->getId(),
            $request->get('content_id')
        );

        return ResponseService::empty(200)
            ->setData(['data' => 'success']);
    }

    /**
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function removeFromPrimaryPlaylist(Request $request)
    {
        $content = $this->contentService->getById($request->get('content_id'));

        if (!$content) {
            return ResponseService::empty(200)
                ->setData(['error' => 'Incorrect content']);
        }

        $userId = auth()->id();
        $userPrimaryPlaylist =
            $this->userPlaylistService->updateOrCeate($userId, 'primary-playlist', config('railcontent.brand'));

        $this->userPlaylistService->removeContentFromUserPlaylist(
            $userPrimaryPlaylist->getId(),
            $request->get('content_id')
        );

        return ResponseService::empty(200)
            ->setData(['data' => 'success']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
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
            array_keys(config('railcontent.shows', []))
        );

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $contentTypes = $request->get('included_types', $contentTypes);
        $requiredFields = $request->get('required_fields', []);

        if (!$state) {

            $usersPrimaryPlaylists = $this->userPlaylistService->userPlaylist(auth()->id(), 'primary-playlist');
            if (empty($usersPrimaryPlaylists)) {
                return ResponseService::empty(200);
            }

            $lessons = $this->contentService->getFiltered(
                $page,
                $limit,
                '-published_on',
                $contentTypes,
                [],
                [],
                $requiredFields,
                [],
                [],
                [],
                true,
                [$usersPrimaryPlaylists->getId()]
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

        if (!empty($lessons->results())) {
            $contentTypes = array_map(
                function ($res) {
                    return $res->getType();
                },
                $lessons->results()
            );

            $filterTypes = ['content_type' => array_unique($contentTypes)];
        }

        return ResponseService::content(
            $lessons->results(),
            $lessons->qb(),
            [],
            array_merge($lessons->filterOptions(), $filterTypes ?? [])
        )
            ->respond();
    }
}
