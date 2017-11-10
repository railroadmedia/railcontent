<?php

namespace Railroad\Railcontent\Controllers;


use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotAllowedException;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\CommentCreateRequest;
use Railroad\Railcontent\Requests\CommentUpdateRequest;
use Railroad\Railcontent\Requests\ReplyRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\CommentService;

class CommentJsonController extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * CommentJsonController constructor.
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /** Call the method from service that create a new comment if the request data pass the validation
     * @param CommentCreateRequest $request
     * @return JsonResponse|NotAllowedException
     */
    public function store(CommentCreateRequest $request)
    {
       $comment = $this->commentService->create(

            $request->get('comment'),
            $request->get('content_id'),
            null,
            $request->user()->id
        );

       throw_if(is_null($comment), new NotAllowedException('The content type does not allow comments.'));

       return new JsonResponse($comment, 200);
    }

    /** Update a comment based on id and return it in JSON format
     * @param integer $commentId
     * @param CommentCreateRequest $request
     * @return JsonResponse|NotAllowedException|NotFoundException
     */
    public function update(CommentUpdateRequest $request, $commentId)
    {
        //update comment with the data sent on the request
        $comment = $this->commentService->update(
            $commentId,
            array_intersect_key(
                $request->all(),
                [
                    'comment' => '',
                    'content_id' => '',
                    'parent_id' => '',
                    'user_id' => ''
                ]
            )
        );

        //if the update response method = -1 => the user have not rights to update other user comment; we throw the exception
        throw_if(($comment == -1), new NotAllowedException('Update failed, you can update only your comments.'));

        //if the update method response it's null the comment not exist; we throw the proper exception
        throw_if(is_null($comment), new NotFoundException('Update failed, comment not found with id: ' . $commentId));

        return new JsonResponse($comment, 201);
    }

    /** Call the delete method if the comment exist and the user have rights to delete the comment
     * @param integer $contentId
     * @return JsonResponse|NotFoundException|NotAllowedException
     */
    public function delete($commentId)
    {
        //delete comment
        $deleted = $this->commentService->delete($commentId);

        //if the delete method response it's null the comment not exist; we throw the proper exception
        throw_if(is_null($deleted), new NotFoundException('Delete failed, comment not found with id: '. $commentId));

        //if the delete method response it's false the mysql delete method was failed; we throw the proper exception
        throw_if(($deleted == -1),  new NotAllowedException('Delete failed, you can delete only your comments.'));

        return new JsonResponse(null, 204);
    }

    /** Call the method from service that create a new comment if the request data pass the validation
     * @param ReplyRequest $request
     * @return JsonResponse|NotAllowedException
     */
    public function reply(ReplyRequest $request)
    {
        $reply = $this->commentService->create(

            $request->get('comment'),
            null,
            $request->get('parent_id'),
            $request->user()->id
        );

        throw_if(is_null($request), new NotAllowedException('The content type does not allow comments.'));

        return new JsonResponse($reply, 200);
    }
}