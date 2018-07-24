<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Transformers\DataTransformer;

class CommentAssignationJsonController extends Controller
{
    private $commentAssignationService;

    /**
     * CommentAssignationJsonController constructor.
     *
     * @param $commentAssignationService
     */
    public function __construct(CommentAssignmentService $commentAssignationService)
    {
        $this->commentAssignationService = $commentAssignationService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Get the comments assigned for user_id sort by assigned on date.
     * If the user_id it's not set on the request, all the comments are returned
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
        $assignedComments = $this->commentAssignationService->getAssignedCommentsForUser(
            $request->get('user_id', $request->user()->id ?? null),
            $request->get('page', 1),
            $request->get('limit', 25),
            $request->get('sort', '-assigned_on')
        );

        $assignedCommentsCount = $this->commentAssignationService->countAssignedCommentsForUser(
            $request->get('user_id', $request->user()->id ?? null)
        );

        return reply()->json(
            $assignedComments,
            [
                'totalResults' => $assignedCommentsCount,
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Delete the link between comment and management user id, if the link exist.
     * Return an empty json response or NotFoundException
     *
     * @param Request $request
     * @param integer $commentId
     * @return JsonResponse
     */
    public function delete(Request $request, $commentId)
    {
        $this->commentAssignationService->deleteCommentAssignations(
            $commentId
        );

        return reply()->json(null, ['code' => 204]);
    }

}