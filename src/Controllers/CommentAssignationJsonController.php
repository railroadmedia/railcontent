<?php

namespace Railroad\Railcontent\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
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

    /** Pull all the links between comment and management account users id
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        CommentAssignmentRepository::$availableAssociatedManagerId = $request->user()->id ?? null;
        $assignedComments = $this->commentAssignationService->getAssignedComments();

        return new JsonResponse($assignedComments, 200);
    }

    /** Delete the link between comment and management user id, if the link exist.
     * Return an empty json response or NotFoundException
     * @param Request $request
     * @param integer $commentId
     * @return JsonResponse
     */
    public function delete(Request $request, $commentId)
    {
        $deleted = $this->commentAssignationService->deleteCommentAssignation($commentId, $request->user()->id);

        //if the delete method response it's null the assignation not exist; we throw the proper exception
        throw_if(is_null($deleted), new NotFoundException("Delete failed, the comment it's not assigned to your account."));

        return new JsonResponse(null, 204);
    }

}