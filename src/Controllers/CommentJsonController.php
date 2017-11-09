<?php

namespace Railroad\Railcontent\Controllers;


use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\CommentCreateRequest;
use Railroad\Railcontent\Requests\CommentUpdateRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\CommentService;

class CommentJsonController extends Controller
{

    private $commentService;

    /**
     * CommentJsonController constructor.
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentCreateRequest $request)
    {
       $comment = $this->commentService->create(

            $request->get('comment'),
            $request->get('content_id'),
            $request->get('parent_id'),
            $request->user()->id
        );

        return new JsonResponse($comment, 200);
    }

    /** Update a comment based on id and return it in JSON format
     *
     * @param integer $commentId
     * @param CommentCreateRequest $request
     * @return JsonResponse
     */
    public function update(CommentUpdateRequest $request, $commentId)
    {
        //update comment with the data sent on the request
        $comment = $this->commentService->update(
            $commentId,
            array_intersect_key(
                $request->all(),
                [
                    'comment' => ''
                ]
            )
        );

        //if the update method response it's null the content not exist; we throw the proper exception
        throw_if(is_null($comment), new NotFoundException('Update failed, comment not found with id: ' . $commentId));

        return new JsonResponse($comment, 201);
    }


}