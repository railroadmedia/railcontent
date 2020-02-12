<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\DoctrineArrayHydrator\JsonApiHydrator;
use Railroad\Railcontent\Exceptions\NotAllowedException;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Requests\CommentCreateRequest;
use Railroad\Railcontent\Requests\CommentUpdateRequest;
use Railroad\Railcontent\Requests\ReplyRequest;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ResponseService;
use ReflectionException;
use Spatie\Fractal\Fractal;
use Throwable;

/**
 * Class CommentJsonController
 *
 * @group Comments API
 *
 * @package Railroad\Railcontent\Controllers
 */
class CommentJsonController extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * CommentJsonController constructor.
     *
     * @param CommentService $commentService
     * @param JsonApiHydrator $jsonApiHydrator
     */
    public function __construct(CommentService $commentService, JsonApiHydrator $jsonApiHydrator)
    {
        $this->commentService = $commentService;
        $this->jsonApiHidrator = $jsonApiHydrator;
    }

    /** List comments
     *
     * @param Request $request
     * @return Fractal
     * @throws NonUniqueResultException
     *
     * @bodyParam content_id  pull the comments for given content id Example:
     * @bodyParam user_id  pull user's comments Example:
     * @bodyParam content_type  string pull for the contents with given type Example:
     * @bodyParam page integer  Which page to load, will be {limit} long.By default:1. Example:1
     * @bodyParam limit integer  How many to load per page. By default:10. Example:10
     * @bodyParam sort string Default:'-created_on'. Example:-created_on
     *
     */
    public function index(Request $request)
    {
        CommentRepository::$availableContentId = $request->get('content_id') ?? null;
        CommentRepository::$availableUserId = $request->get('user_id') ?? null;
        CommentRepository::$availableContentType = $request->get('content_type') ?? null;

        $comments = $this->commentService->getComments(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', $request->get('sort', '-created_on')),
            auth()->id() ?? null
        );

        return ResponseService::comment($comments['results'], $comments['qb'])
            ->addMeta(['totalCommentsAndReplies' => $this->commentService->countCommentsAndReplies()]);
    }

    /** Create a new comment
     *
     * @param CommentCreateRequest $request
     *
     * @return Fractal
     * @throws Throwable
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @permission Must be logged in
     * @permission The content type should allow comments
     * @bodyParam data.type string required  Must be 'comment'. Example: comment
     * @bodyParam data.attributes.comment string required  The text of the comment. Example: Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.
     * @bodyParam data.attributes.temporary_display_name string Temporary display name for user.  Example: in
     * @bodyParam data.relationships.content.data.type string required  Must be 'content'. Example: content
     * @bodyParam data.relationships.content.data.id integer required  Must exists in contents. Example:1
     */
    public function store(CommentCreateRequest $request)
    {

        $comment = $this->commentService->create(
            $request->input('data.attributes.comment'),
            $request->input('data.relationships.content.data.id'),
            null,
            auth()->id() ?? null,
            $request->input('data.attributes.temporary_display_name') ?? ''
        );

        throw_if(
            is_null($comment),
            new NotAllowedException('The content type does not allow comments.')
        );

        throw_if(
            ($comment === -1),
            new NotAllowedException('Only registered user can add comment. Please sign in.')
        );

        return ResponseService::comment([$comment]);
    }

    /** Update a comment
     *
     * @param CommentUpdateRequest $request
     * @param $commentId
     * @return JsonResponse
     * @throws Throwable
     * @throws DBALException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     * @permission Must be logged in to modify own comments
     * @permission Must be logged in with an administrator account to modify other user comments
     */
    public function update(CommentUpdateRequest $request, $commentId)
    {
        //update comment with the data sent on the request
        $comment = $this->commentService->update(
            $commentId,
            $request->onlyAllowed()
        );

        //if the user it's not logged in into the application
        throw_if(
            ($comment === 0),
            new NotAllowedException('Only registered user can modify own comments. Please sign in.')
        );

        //if the update response method = -1 => the user have not rights to update other user comment; we throw the exception
        throw_if(
            ($comment === -1),
            new NotAllowedException('Update failed, you can update only your comments.')
        );

        //if the update method response it's null the comment not exist; we throw the proper exception
        throw_if(
            is_null($comment),
            new NotFoundException('Update failed, comment not found with id: ' . $commentId)
        );

        return ResponseService::comment($comment)
            ->respond(201);
    }

    /** Delete an existing comment
     *
     * @param $commentId
     * @return JsonResponse
     * @throws Throwable
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @queryParam comment_id required
//     * @response 204 { }
//     * @response 403 { "message": "Delete failed, you can delete only your comments." }
//     * @response 404 { "message": "Delete failed, comment not found with id: 1" }
     * @permission authenticated users can delete their own comments
     */
    public function delete($commentId)
    {
        //delete comment
        $deleted = $this->commentService->delete($commentId);

        //if the delete method response it's null the comment not exist; we throw the proper exception
        throw_if(
            is_null($deleted),
            new NotFoundException('Delete failed, comment not found with id: ' . $commentId)
        );

        //if the delete method response it's false the mysql delete method was failed; we throw the proper exception
        throw_if(
            ($deleted === -1),
            new NotAllowedException('Delete failed, you can delete only your comments.')
        );

        return ResponseService::empty(204);
    }

    /** Create a reply
     *
     * @param ReplyRequest $request
     * @return JsonResponse
     * @throws Throwable
     * @throws ORMException
     * @throws OptimisticLockException
     * @permission authenticated user
     */
    public function reply(ReplyRequest $request)
    {
        $reply = $this->commentService->create(
            $request->input('data.attributes.comment'),
            $request->input('data.relationships.content.data.id'),
            $request->input('data.relationships.parent.data.id'),
            auth()->id() ?? null
        );

        throw_if(
            is_null($reply),
            new NotAllowedException('The content type does not allow comments.')
        );

        throw_if(
            ($reply === -1),
            new NotAllowedException('Only registered user can reply to comment. Please sign in.')
        );

        return ResponseService::comment([$reply])
            ->respond(200);
    }

    /** List linked comments, the current page it's the page with the comment
     *
     * @param $commentId
     * @param Request $request
     * @return Fractal
     * @throws NonUniqueResultException
     *
     * @queryParam comment_id integer required Example:1
     * @bodyParam limit integer How many to load per page. By default:10 Example:10
     */
    public function getLinkedComment($commentId, Request $request)
    {
        $limitOnPage = $request->get('limit', 10);

        $activePage = $this->commentService->getCommentPage($commentId, $limitOnPage);

        $commentData = $this->commentService->getComments(
            $activePage,
            $limitOnPage,
            '-createdOn'
        );

        $qb = $this->commentService->getQb(
            $activePage,
            $limitOnPage,
            '-createdOn'
        );

        return ResponseService::comment($commentData, $qb);
    }
}