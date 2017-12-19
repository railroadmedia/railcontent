<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Responses\JsonPaginatedResponse;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\CommentAssignmentService;

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
    }

    /**
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
        $assignedComments = $this->commentAssignationService->getAssignedCommentsForUser(
            $request->get('user_id', $request->user()->id),
            $request->get('page', 1),
            $request->get('limit', 25),
            $request->get('sort', '-assigned_on')
        );

        $assignedCommentsCount = $this->commentAssignationService->countAssignedCommentsForUser(
            $request->get('user_id', $request->user()->id)
        );

        return new JsonPaginatedResponse($assignedComments, $assignedCommentsCount, [], 200);
    }

    /** Delete the link between comment and management user id, if the link exist.
     * Return an empty json response or NotFoundException
     *
     * @param Request $request
     * @param integer $commentId
     * @return JsonResponse
     */
    public function delete(Request $request, $commentId)
    {
        $deleted = $this->commentAssignationService->deleteCommentAssignations(
            $commentId
        );

        return new JsonResponse(null, 204);
    }

}