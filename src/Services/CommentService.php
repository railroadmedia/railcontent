<?php

namespace Railroad\Railcontent\Services;


use Carbon\Carbon;
use Railroad\Railcontent\Repositories\CommentRepository;

class CommentService
{

    protected $commentRepository;

    /**
     * CommentService constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }


    public function get($id)
    {
        return $this->commentRepository->getById($id);
    }

    public function create($comment, $contentId, $parentId, $userId)
    {
        $commentId = $this->commentRepository->create(
            [
                'comment' => $comment,
                'content_id' => $contentId,
                'parent_id' => $parentId,
                'user_id' => $userId,
                'created_on' => Carbon::now()->toDateTimeString()
            ]
        );

        return $this->get($commentId);
    }

    public function update($id, array $data)
    {
        //check if comment exist
        $comment = $this->get($id);
        if(is_null($comment))
        {
            return $comment;
        }

        $this->commentRepository->update($id, $data);

        return $this->get($id);
    }

    public function delete($id)
    {
        //check if comment exist
        $comment = $this->get($id);
        if(is_null($comment))
        {
            return $comment;
        }

        return $this->commentRepository->delete($id);
    }
}