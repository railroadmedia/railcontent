<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentDeleted;
use Railroad\Railcontent\Helpers\CacheHelper;
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
     *
     * @var bool
     */
    public static $canManageOtherComments = false;

    /**
     * CommentService constructor.
     *
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
     *
     * @param integer $id
     * @return array|null
     */
    public function get($id)
    {
        return Decorator::decorate($this->commentRepository->getById($id), 'comment');
    }

    /** Call the create method from repository that save a comment or a comment reply (based on the parent_id: if the parent_id it's null the method save a comment;
     * otherwise save a reply for the comment with given id)
     * Return the comment or null if the content it's not commentable
     *
     * @param string $comment
     * @param integer|null $contentId
     * @param integer|null $parentId
     * @param integer $userId
     * @param string $temporaryUserDisplayName
     * @return array|null
     */
    public function create($comment, $contentId, $parentId, $userId, $temporaryUserDisplayName = '')
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

        if (!$userId) {
            return -1;
        }

        $commentId = $this->commentRepository->create(
            [
                'comment' => $comment,
                'content_id' => $contentId,
                'parent_id' => $parentId,
                'user_id' => $userId,
                'temporary_display_name' => $temporaryUserDisplayName,
                'created_on' => Carbon::now()->toDateTimeString()
            ]
        );

        CacheHelper::deleteCache('content_' . $contentId);

        $createdComment = $this->get($commentId);

        event(new CommentCreated($commentId, $userId, $parentId, $comment));

        return $createdComment;
    }

    /** Call the update method from repository if the comment exist and the user have rights to update the comment
     * Return the updated comment; null if the comment it's inexistent or -1 if the user have not rights to update the comment
     *
     * @param integer $id
     * @param array $data
     * @return array|int|null
     */
    public function update($id, array $data)
    {
        //check if comment exist
        $comment = $this->commentRepository->getById($id);

        if (empty($comment)) {
            return null;
        }

        if (!(request()->user()->id)) {
            return 0;
        }
        request()->attributes->set('user_id', request()->user()->id ?? null);
        //check if user can update the comment
        if (!$this->userCanManageComment($comment)) {
            return -1;
        }

        if (count($data) == 0) {
            return $comment;
        }
        CacheHelper::deleteCache('content_' . $comment['content_id']);

        $this->commentRepository->update($id, $data);

        return $this->get($id);
    }

    /** Call the delete method from repository if the comment exist and the user have rights to delete the comment
     * Return null if the comment not exist in database, -1 if the user have not rights to delete the comment or bool
     *
     * @param integer $id
     * @return bool|int|null|array
     */
    public function delete($id)
    {

        //check if comment exist
        $comment = $this->commentRepository->getById($id);

        if (empty($comment)) {
            return null;
        }

        request()->attributes->set('user_id', request()->get('user_id') ?? null);

        //check if user can delete the comment
        if (!$this->userCanManageComment($comment)) {
            return -1;
        }

        $isSoftDelete = $this->commentRepository->getSoftDelete();

        //trigger an event that delete the corresponding comment assignments if the deletion it's not soft
        event(new CommentDeleted($id));

        if ($isSoftDelete) {
            $this->commentRepository->update($id, ['deleted_at' => Carbon::now()->toDateTimeString()]);
        } else {
            $this->commentRepository->delete($id);
        }
        CacheHelper::deleteCache('content_' . $comment['content_id']);

        return true;
    }

    /** Administrator can edit/delete any comment; other users can edit/delete only their comments
     * Return true if the user have rights to edit/update the comment and false otherwise
     *
     * You **may** have to set a 'user_id' attribute in the Request before you can call this method.
     * Ex (w/ param: Illuminate\Http\Request $request):
     *      ```$request->attributes->set('user_id', current_member()->getId());```
     *
     * @param array $comment
     * @return boolean
     */
    private function userCanManageComment($comment)
    {
        if (is_null($comment['user_id'])) { // Very unlikely, but better safe than sorry.
            return false;
        }

        return self::$canManageOtherComments || ($comment['user_id'] == auth()->id());
    }

    /**
     *  Set the data necessary for the pagination ($page, $limit, $orderByDirection and $orderByColumn),
     * call the method from the repository to pull the paginated comments that meet the criteria and call a method that return the total number of comments.
     * Return an array with the paginated results and the total number of results
     *
     * @param int $page
     * @param int $limit
     * @param string $orderByAndDirection
     * @return array
     */
    public function getComments($page = 1, $limit = 25, $orderByAndDirection = '-created_on', $currentUserId = null)
    {
        if ($limit == 'null') {
            $limit = -1;
        }

        $orderByDirection = substr($orderByAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';

        $orderByColumn = trim($orderByAndDirection, '-');

        $hash = 'get_comments_'
            . (CommentRepository::$availableContentId ?? '')
            .'_'.(CommentRepository::$assignedToUserId ??'')
            .'_'.(CommentRepository::$availableContentType ??'')
            .'_'.(CommentRepository::$availableUserId ??'')
            .'_'. CacheHelper::getKey($page, $limit, $orderByDirection, $orderByColumn);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            if ($orderByColumn == 'mine') {
                $this->commentRepository->setData(
                    $page,
                    $limit,
                    $orderByDirection,
                    'created_on'
                );
                CommentRepository::$availableUserId = $currentUserId;
                $orderByColumn = 'created_on';
                $results = [
                    'results' => $this->commentRepository
                        ->getCurrentUserComments(),
                    'total_results' => $this->commentRepository
                        ->countCurrentUserComments(),
                    'total_comments_and_results' => $this->commentRepository
                        ->countCommentsAndReplies()
                ];
            } else {
                $this->commentRepository->setData(
                    $page,
                    $limit,
                    $orderByDirection,
                    $orderByColumn
                );
                $results = [
                    'results' => $this->commentRepository->getComments(),
                    'total_results' => $this->commentRepository->countComments(),
                    'total_comments_and_results' => $this->commentRepository
                        ->countCommentsAndReplies()
                ];
            }

            if($results['total_results'] > 0){
                $contentIds = array_pluck(array_values($results['results']), 'content_id');
            } else {
                $contentIds = null;
            }
            $results = CacheHelper::saveUserCache($hash, $results, $contentIds);
        }

        return Decorator::decorate($results, 'comment');
    }

    /**
     * @param array $contentOrContents
     * @return array
     */
    public function attachCommentsToContents($contentOrContents)
    {
        /*
         * Remember comments *are* arrays, so here have to distinguish between a single comment
         * *not* nested in another array and an array containing any number of "comment-arrays".
         */
        $arrayOfCommentsPassedIn = !isset($contentOrContents['id']);

        if (!$arrayOfCommentsPassedIn) {
            $contentOrContents = [$contentOrContents];
        }

        foreach ($contentOrContents as $index => $content) {
            CommentRepository::$availableContentId = $content['id'];

            $comments = $this->getComments(1, null);

            $contentOrContents[$index]['comments'] = [];

            foreach ($comments['results'] as $comment) {
                $contentOrContents[$index]['comments'][] = $comment;
            }
        }

        if ($arrayOfCommentsPassedIn) {
            return $contentOrContents;
        } else {
            return reset($contentOrContents);
        }
    }

    /** Count the comments that have been created after the comment
     * @param $commentId
     * @return int
     */
    public function countLatestComments($commentId)
    {
        $comment = $this->get($commentId);
        CommentRepository::$availableContentId = $comment['content_id'];

        return $this->commentRepository->countLatestComments($comment['created_on']);
    }

    /** Calculate the page that should be current page to display the comment
     * @param int $commentId
     * @param int $limit
     * @return float|int
     */
    public function getCommentPage($commentId, $limit)
    {
        $countLatestComments = $this->countLatestComments($commentId);

        return floor($countLatestComments / $limit) + 1;
    }

}