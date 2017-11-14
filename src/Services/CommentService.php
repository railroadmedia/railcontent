<?php

namespace Railroad\Railcontent\Services;


use Carbon\Carbon;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentRepository;

class CommentService
{

    /**
     * @var CommentRepository
     */
    protected $commentRepository;

    /**
     * @var ContentRepository
     */
    protected $contentRepository;

    /** The value it's set in ContentPermissionMiddleware;
     * if the user it's an administrator the value it's true and the administrator can update/delete any comment;
     * otherwise the value it's false and the user can update/delete only his own comments
     * @var bool
     */
    public static $canManageOtherComments = false;

    /**
     * CommentService constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(
        CommentRepository $commentRepository,
        ContentRepository $contentRepository
    ) {
        $this->commentRepository = $commentRepository;
        $this->contentRepository = $contentRepository;
    }

    /** Call the getById method from repository and return the comment if exist and null otherwise
     * @param integer $id
     * @return array|null
     */
    public function get($id)
    {
        return $this->commentRepository->getById($id);
    }

    /** Call the create method from repository that save a comment or a comment reply (based on the parent_id: if the parent_id it's null the method save a comment;
     * otherwise save a reply for the comment with given id)
     * Return the comment or null if the content it's not commentable
     * @param string $comment
     * @param integer|null $contentId
     * @param integer|null $parentId
     * @param integer $userId
     * @return array|null
     */
    public function create($comment, $contentId, $parentId, $userId)
    {
        //if we have defined parentId we have a comment reply
        if ($parentId) {
            $parentComment = $this->get($parentId);
            //set for the reply the comment content_id
            $contentId = $parentComment['content_id'];
        }

        //check if the content type allow comments
        $content = $this->contentRepository->getById($contentId);

        //return null if the content type it's not predefined in config file
        if (!in_array($content['type'], ConfigService::$commentableContentTypes)) {
            return null;
        }

        $commentId = $this->commentRepository->create(
            [
                'comment' => $comment,
                'content_id' => $contentId,
                'parent_id' => $parentId,
                'user_id' => $userId,
                'created_on' => Carbon::now()->toDateTimeString()
            ]
        );

        event(new CommentCreated($commentId, $content['type']));

        return $this->get($commentId);
    }

    /** Call the update method from repository if the comment exist and the user have rights to update the comment
     * Return the updated comment; null if the comment it's inexistent or -1 if the user have not rights to update the comment
     * @param integer $id
     * @param array $data
     * @return array|int|null
     */
    public function update($id, array $data)
    {
        //check if comment exist
        $comment = $this->get($id);
        if (is_null($comment)) {
            return $comment;
        }

        //check if user can update the comment
        if (!$this->userCanManageComment($comment)) {
            return -1;
        }

        $this->commentRepository->update($id, $data);

        return $this->get($id);
    }

    /** Call the delete method from repository if the comment exist and the user have rights to delete the comment
     * Return null if the comment not exist in database, -1 if the user have not rights to delete the comment or bool
     * @param integer $id
     * @return bool|int|null
     */
    public function delete($id)
    {
        //check if comment exist
        $comment = $this->get($id);
        if (is_null($comment)) {
            return $comment;
        }

        //check if user can delete the comment
        if (!$this->userCanManageComment($comment)) {
            return -1;
        }

        return $this->commentRepository->delete($id);
    }

    /** Administrator can edit/delete any comment; other users can edit/delete only their comments
     * Return true if the user have rights to edit/update the comment and false otherwise
     * @param array $comment
     * @return boolean
     */
    private function userCanManageComment($comment)
    {
        $canManage = true;

        //if the user it's not an administrator check if it is the comment owner
        if ((self::$canManageOtherComments === false) && ($comment['user_id'] != request()->user()->id)) {
            $canManage = false;
        }

        return $canManage;
    }

    /**
     *  Set the data necessary for the pagination ($page, $limit, $orderByDirection and $orderByColumn),
     * call the method from the repository to pull the paginated comments that meet the criteria and call a method that return the total number of comments.
     * Return an array with the paginated results and the total number of results
     *@param int $page
     *@param int $limit
     *@param string $orderByAndDirection
     *@return array
     */
    public function getComments($page, $limit, $orderByAndDirection)
    {
        if ($limit == 'null') {
            $limit = -1;
        }

        $orderByDirection = substr($orderByAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';

        $orderByColumn = trim($orderByAndDirection, '-');

        $this->commentRepository->setData($page, $limit, $orderByDirection, $orderByColumn);

        return [
            'results' => $this->commentRepository->getComments(),
            'total_results' => $this->commentRepository->countComments()
        ];
    }
}