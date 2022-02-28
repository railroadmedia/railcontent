<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Requests\ContentFollowRequest;
use Railroad\Railcontent\Requests\UserContentRequest;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContentFollowsJsonController extends Controller
{
    /**
     * @var UserContentProgressService
     */
    private $userContentService;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var ContentFollowsService
     */
    private $contentFollowsService;

    /**
     * @param UserContentProgressService $userContentService
     * @param UserProviderInterface $userProvider
     * @param ContentFollowsService $contentFollowsService
     */
    public function __construct(
        UserContentProgressService $userContentService,
        UserProviderInterface $userProvider,
        ContentFollowsService $contentFollowsService
    ) {
        $this->userContentService = $userContentService;
        $this->userProvider = $userProvider;
        $this->contentFollowsService = $contentFollowsService;
    }

    /**
     * @param ContentFollowRequest $request
     * @return \Spatie\Fractal\Fractal
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function followContent(ContentFollowRequest $request)
    {
        $contentFollow = $this->contentFollowsService->followContent(
            $request->input('data.relationships.content.data.id'),
            auth()->id()
        );

        return ResponseService::contentFollow($contentFollow);
    }

    /** Set content as complete for the authenticated user
     *
     * @param UserContentRequest $request
     * @return \Illuminate\Http\JsonResponse|JsonResponse
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @permission Must be logged in
     */
    public function unfollowContent(ContentFollowRequest $request)
    {
        $this->contentFollowsService->unfollowContent(
            $request->input('data.relationships.content.data.id'),
            auth()->id()
        );

        return ResponseService::empty(204);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowedContent(Request $request)
    {
        $response = $this->contentFollowsService->getUserFollowedContent(
            auth()->id(),
            $request->get('brand', config('railcontent.brand')),
            $request->get('content_type'),
            $request->get('page', 1),
            $request->get('limit', 10)
        );

        return ResponseService::content(
            $response->results(),
            $response->qb()
        )
            ->respond();
    }
}