<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Railroad\Railcontent\Hydrators\CustomRailcontentHydrator;
use Railroad\Railcontent\Services\JsonApiHydrator;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentDeleted;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\CommentRepository;
use ReflectionException;

class CommentService
{
    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    protected $commentRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    protected $contentRepository;

    /**
     * @var \Railroad\Railcontent\Services\JsonApiHydrator
     */
    private $jsonApiHidrator;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var CustomRailcontentHydrator
     */
    private $resultsHydrator;

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
     * @param RailcontentEntityManager $entityManager
     * @param JsonApiHydrator $jsonApiHydrator
     * @param UserProviderInterface $userProvider
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        JsonApiHydrator $jsonApiHydrator,
        UserProviderInterface $userProvider,
        CustomRailcontentHydrator $resultsHydrator
    ) {
        $this->entityManager = $entityManager;
        $this->jsonApiHidrator = $jsonApiHydrator;
        $this->userProvider = $userProvider;
        $this->resultsHydrator = $resultsHydrator;

        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->contentRepository = $this->entityManager->getRepository(Content::class);
    }

    /** Call the doctrine find method and return the comment entity if exist and null otherwise
     *
     * @param $id
     * @return object|null
     */
    public function get($id)
    {
        return $this->commentRepository->find($id);
    }

    /** Call the create method from repository that save a comment or a comment reply (based on the parent_id: if the
     * parent_id it's null the method save a comment; otherwise save a reply for the comment with given id) Return the
     * comment or null if the content it's not commentable
     *
     * @param $commentText
     * @param $contentId
     * @param $parentId
     * @param $userId
     * @param string $temporaryUserDisplayName
     * @return int|Comment|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create($commentText, $contentId, $parentId, $userId, $temporaryUserDisplayName = '')
    {
        //if we have defined parentId we have a comment reply
        if ($parentId) {
            $parentComment = $this->get($parentId);

            //get for the reply the comment content_id
            $contentId =
                $parentComment->getContent()
                    ->getId();
        }

        $content = $this->contentRepository->find($contentId);

        //check if the content type allow comments : return null if the content type it's not predefined in config file
        if (!in_array($content->getType(), config('railcontent.commentable_content_types'))) {
            return null;
        }

        if (!$userId) {
            return -1;
        }

        $user = $this->userProvider->getUserById($userId);

        $comment = new Comment();
        $comment->setComment($commentText);
        $comment->setTemporaryDisplayName($temporaryUserDisplayName);
        $comment->setUser($user);
        $comment->setContent($content);
        $comment->setParent($parentComment ?? null);
        $comment->setCreatedOn(Carbon::now());

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntity(Content::class, $contentId);

        $this->entityManager->getCache()
            ->evictEntityRegion(Comment::class);

        event(new CommentCreated($comment, $content, $user));

        return $comment;
    }

    /** Call the update method from repository if the comment exist and the user have rights to update the comment
     * Return the updated comment; null if the comment it's inexistent or -1 if the user have not rights to update the
     * comment
     *
     * @param $id
     * @param array $data
     * @return int|object|null
     * @throws DBALException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function update($id, array $data)
    {
        //check if comment exist
        $comment = $this->commentRepository->find($id);

        if (empty($comment)) {
            return null;
        }

        if (!(auth()->id())) {
            return 0;
        }
        request()->attributes->set('user_id', auth()->id() ?? null);

        //check if user can update the comment
        if (!$this->userCanManageComment($comment)) {
            return -1;
        }

        if (count($data) == 0) {
            return $comment;
        }

        $this->entityManager->getCache()
            ->evictEntity(
                Content::class,
                $comment->getContent()
                    ->getId()
            );

        $this->jsonApiHidrator->hydrate($comment, $data);

        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntity(Comment::class, $id);

        return $comment;
    }

    /**  Call the delete method from repository if the comment exist and the user have rights to delete the comment
     * Return null if the comment not exist in database, -1 if the user have not rights to delete the comment or bool
     *
     * @param $id
     * @return bool|int|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($id)
    {
        //check if comment exist
        $comment = $this->commentRepository->find($id);

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
        event(new CommentDeleted($comment));

        $this->commentRepository->deleteCommentReplies($id);

        $this->entityManager->getCache()
            ->evictEntity(
                Content::class,
                $comment->getContent()
                    ->getId()
            );

        if ($isSoftDelete) {
            $comment->setDeletedAt(Carbon::now());
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
        } else {
            $this->entityManager->remove($comment);
            $this->entityManager->flush();
        }

        $this->entityManager->getCache()
            ->evictEntityRegion(Comment::class);

        return true;
    }

    /**
     * Administrator can edit/delete any comment; other users can edit/delete only their comments
     * Return true if the user have rights to edit/update the comment and false otherwise
     *
     * @param array $comment
     * @return boolean
     */
    private function userCanManageComment($comment)
    {
        if (is_null($comment->getUser())) { // Very unlikely, but better safe than sorry.
            return false;
        }

        return self::$canManageOtherComments ||
            ($comment->getUser()
                    ->getId() == auth()->id());
    }

    /** Set the data necessary for the pagination ($page, $limit, $orderByDirection and $orderByColumn),
     * call the method from the repository to pull the paginated comments that meet the criteria and call a method that
     * return the total number of comments. Return an array with the paginated results and the total number of results
     *
     * @param int $page
     * @param int $limit
     * @param string $orderByAndDirection
     * @param null $currentUserId
     * @return mixed
     */
    public function getComments($page = 1, $limit = 25, $orderByAndDirection = '-created_on', $currentUserId = null)
    {
        $qb = $this->getQb($page, $limit, $orderByAndDirection, $currentUserId);

        $results =
            $qb->getQuery()
                ->getResult();

        $hydratedResults =  $this->resultsHydrator->hydrate($results, $this->entityManager);

        $results = [
                'qb' => $qb,
                'results' => $hydratedResults
            ];


        return $results;
    }

    /** Count the comments that have been created after the comment
     *
     * @param $commentId
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function countLatestComments($commentId)
    {
        $comment = $this->get($commentId);
        CommentRepository::$availableContentId =
            $comment->getContent()
                ->getId();

        $alias = 'c';
        $aliasContent = 'content';

        $qb = $this->commentRepository->createQueryBuilder('c');

        $qb->select('count(c)')
            ->join($alias . '.content', $aliasContent)
            ->where('c.createdOn >= :createdOn')
            ->andWhere(
                $qb->expr()
                    ->isNull('c.deletedAt')
            )
            ->andWhere(
                $qb->expr()
                    ->isNull('c.parent')
            )
            ->setParameter('createdOn', $comment->getCreatedOn())
            ->andWhere(
                $qb->expr()
                    ->in($aliasContent . '.brand', ':availableBrands')
            )
            ->setParameter('availableBrands', array_values(array_wrap(config('railcontent.available_brands'))));

        if (CommentRepository::$availableUserId) {
            $qb->andWhere($alias . '.userId = :availableUserId')
                ->setParameter('availableUserId', CommentRepository::$availableUserId);
        }

        if (CommentRepository::$availableContentType) {
            $qb->andWhere($aliasContent . '.type = :availableContentType')
                ->setParameter('availableContentType', CommentRepository::$availableContentType);
        }

        if (CommentRepository::$availableContentId) {
            $qb->andWhere($alias . '.content = :availableContentId')
                ->setParameter('availableContentId', CommentRepository::$availableContentId);
        }

        if (CommentRepository::$conversationStatus) {
            $qb->andWhere($alias . '.conversationStatus = :conversationStatus')
                ->setParameter('conversationStatus', CommentRepository::$conversationStatus);
        }

        return $qb->getQuery()
            ->getSingleScalarResult('Railcontent');
    }

    /** Calculate the page that should be current page to display the comment
     *
     * @param $commentId
     * @param $limit
     * @return float|int
     * @throws NonUniqueResultException
     */
    public function getCommentPage($commentId, $limit)
    {
        $countLatestComments = $this->countLatestComments($commentId);

        return floor($countLatestComments / $limit) + 1;
    }

    /**
     * @param $page
     * @param $limit
     * @param $orderByAndDirection
     * @param null $currentUserId
     * @return QueryBuilder
     */
    public function getQb($page, $limit, $orderByAndDirection, $currentUserId = null)
    : QueryBuilder {

        if ($limit == 'null') {
            $limit = -1;
        }

        $orderByDirection = substr($orderByAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';

        $orderByColumn = trim($orderByAndDirection, '-');
        if (strpos($orderByColumn, '_') !== false || strpos($orderByColumn, '-') !== false) {
            $orderByColumn = camel_case($orderByColumn);
        }

        // parse request params and prepare db query parms
        $alias = 'c';
        $aliasContent = 'content';

        $orderByColumn = $alias . '.' . $orderByColumn;
        if($orderByColumn == $alias . '.' .'repliedOn'){
            $orderByColumn ='r.createdOn';
        }

        $qb = $this->commentRepository->createQueryBuilder($alias);

        $qb->join($alias . '.content', $aliasContent)
            ->leftJoin($alias.'.children','r')
            ->andWhere(
                $qb->expr()
                    ->in($aliasContent . '.brand', ':availableBrands')
            )
            ->setParameter('availableBrands', array_values(array_wrap(config('railcontent.available_brands'))))
            ->andWhere(
                $qb->expr()
                    ->isNull('c.deletedAt')
            )
            ->andWhere(
                $qb->expr()
                    ->isNull('c.parent')
            )
        ;

        if ($orderByColumn == $alias . ".mine") {
            CommentRepository::$availableUserId = $currentUserId;
            $orderByColumn = $alias . '.createdOn';
        }

        if ($orderByColumn == $alias . ".likeCount") {

            $qb->leftJoin($alias . '.likes', 'likes');
            $qb->addSelect('COUNT(likes) AS HIDDEN counter')
                ->groupBy($alias . '.id');

            $orderByColumn = 'counter';
        }

        if (CommentRepository::$availableUserId) {
            $qb->andWhere($alias . '.user = :availableUserId')
                ->setParameter('availableUserId', CommentRepository::$availableUserId);
        }

        if (CommentRepository::$availableContentType) {
            $contentType = (array)CommentRepository::$availableContentType;

            $qb->andWhere($aliasContent . '.type IN (:availableContentType)')
                ->setParameter('availableContentType', $contentType);
        }

        if (CommentRepository::$availableContentId) {
            $qb->andWhere($alias . '.content = :availableContentId')
                ->setParameter('availableContentId', CommentRepository::$availableContentId);
        }

        if (CommentRepository::$conversationStatus) {
//            $qb->andWhere($alias . '.conversationStatus = :conversationStatus')
//                ->setParameter('conversationStatus', CommentRepository::$conversationStatus);
        }

        $qb->addSelect([$alias])
            ->paginate($limit, $page - 1)
            ->orderBy($orderByColumn, $orderByDirection);

        return $qb;
    }

    /**
     * @return mixed
     * @throws NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function countCommentsAndReplies()
    {
        $alias = 'c';
        $aliasContent = 'content';

        $qb = $this->commentRepository->createQueryBuilder('c');

        $qb->select('count(c)')
            ->join($alias . '.content', $aliasContent)

            ->where(
                $qb->expr()
                    ->isNull('c.deletedAt')
            )
            ->andWhere(
                $qb->expr()
                    ->in($aliasContent . '.brand', ':availableBrands')
            )
            ->setParameter('availableBrands', array_values(array_wrap(config('railcontent.available_brands'))));

        if (CommentRepository::$availableUserId) {
            $qb->andWhere($alias . '.user = :availableUserId')
                ->setParameter('availableUserId', CommentRepository::$availableUserId);
        }

        if (CommentRepository::$availableContentType) {
            $qb->andWhere($aliasContent . '.type = :availableContentType')
                ->setParameter('availableContentType', CommentRepository::$availableContentType);
        }

        if (CommentRepository::$availableContentId) {
            $qb->andWhere($alias . '.content = :availableContentId')
                ->setParameter('availableContentId', CommentRepository::$availableContentId);
        }

        if (CommentRepository::$conversationStatus) {
            $qb->andWhere($alias . '.conversationStatus = :conversationStatus')
                ->setParameter('conversationStatus', CommentRepository::$conversationStatus);
        }

        return $qb->getQuery()
            ->getSingleScalarResult();

    }
}