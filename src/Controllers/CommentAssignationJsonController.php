<?php

namespace Railroad\Railcontent\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\CommentAssignmentService;

class CommentAssignationJsonController extends Controller
{
    private $commentAssignationService;

    /**
     * CommentAssignationJsonController constructor.
     * @param $commentAssignationService
     */
    public function __construct(CommentAssignmentService $commentAssignationService)
    {
        $this->commentAssignationService = $commentAssignationService;
    }


    public function index(Request $request)
    {
        CommentAssignmentRepository::$availableAssociatedManagerId = $request->user()->id ?? null;
        $assignedComments = $this->commentAssignationService->getAssignedComments();

        return new JsonResponse($assignedComments, 200);
    }

    public function delete(Request $request, $commentId)
    {
        $this->commentAssignationService->deleteCommentAssignation($commentId, $request->user()->id);

        return new JsonResponse(null, 204);

    }

}