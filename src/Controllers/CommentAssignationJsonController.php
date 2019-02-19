<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Services\ResponseService;

class CommentAssignationJsonController extends Controller
{
    private $commentAssignationService;

    /**
     * @var PermissionService
     */
    private $permissionPackageService;

    /**
     * CommentAssignationJsonController constructor.
     *
     * @param CommentAssignmentService $commentAssignationService
     * @param PermissionService $permissionPackageService
     */
    public function __construct(
        CommentAssignmentService $commentAssignationService,
        PermissionService $permissionPackageService
    ) {
        $this->commentAssignationService = $commentAssignationService;
        $this->permissionPackageService = $permissionPackageService;

        $this->middleware(config('railcontent.controller_middleware'));
    }

    /**
     * Get the comments assigned for user_id sort by assigned on date.
     * If the user_id it's not set on the request, all the comments are returned
     *
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.comments.assignation');

        $assignedComments = $this->commentAssignationService->getAssignedCommentsForUser(
            $request->get('user_id', auth()->id() ?? null),
            $request->get('page', 1),
            $request->get('limit', 25),
            $request->get('sort', '-assigned_on')
        );

        $qb = $this->commentAssignationService->getQb(
            $request->get('user_id', auth()->id() ?? null),
            $request->get('page', 1),
            $request->get('limit', 25),
            $request->get('sort', '-assigned_on')
        );

        return ResponseService::commentAssigment($assignedComments, $qb);
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
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.comment.assignation');

        $this->commentAssignationService->deleteCommentAssignations(
            $commentId
        );

        return ResponseService::empty(204);
    }

}