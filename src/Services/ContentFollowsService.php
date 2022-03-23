<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Entities\ContentFollows;
use Railroad\Railcontent\Entities\ContentLikes;
use Railroad\Railcontent\Hydrators\CustomRailcontentHydrator;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\ContentFollowsRepository;
use Railroad\Railcontent\Repositories\ContentLikeRepository;
use Railroad\Railcontent\Repositories\ContentRepository;

class ContentFollowsService
{
    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentFollowsRepository;

    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var CustomRailcontentHydrator
     */
    private $resultsHydrator;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param RailcontentEntityManager $entityManager
     * @param UserProviderInterface $userProvider
     * @param ContentFollowsRepository $contentFollowsRepository
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        UserProviderInterface $userProvider,
        ContentFollowsRepository $contentFollowsRepository,
        CustomRailcontentHydrator $resultsHydrator,
        ContentService $contentService
    ) {
        $this->entityManager = $entityManager;
        $this->userProvider = $userProvider;
        $this->contentFollowsRepository = $contentFollowsRepository;
        $this->contentService = $contentService;
        $this->resultsHydrator = $resultsHydrator;
        $this->contentRepository = $this->entityManager->getRepository(Content::class);
    }

    /**
     * @param $contentId
     * @param $userId
     * @return array|object[]|ContentLikes
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function followContent($contentId, $userId)
    {
        $user = $this->userProvider->getUserById($userId);
        $content = $this->contentRepository->find($contentId);

        $alias = 'ul';

        $contentFollows =
            $this->contentFollowsRepository->createQueryBuilder($alias)
                ->where($alias.'.content = :content')
                ->andWhere($alias.'.user = :user')
                ->setParameter('content', $content)
                ->setParameter('user', $user)
                ->getQuery()
                ->getResult();

        if (empty($contentLikes)) {
            $contentFollows = new ContentFollows();
            $contentFollows->setUser($user);
        }
        $contentFollows->setContent($content);
        $contentFollows->setCreatedOn(Carbon::now());

        $this->entityManager->persist($contentFollows);
        $this->entityManager->flush();

//        $this->entityManager->getCache()
//            ->evictEntity(Content::class, $contentId);

        return $contentFollows;
    }

    /**
     * @param $contentId
     * @param $userId
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function unfollowContent($contentId, $userId)
    {
        $user = $this->userProvider->getUserById($userId);
        $content = $this->contentRepository->find($contentId);
        $alias = 'ul';

        $contentFollows =
            $this->contentFollowsRepository->createQueryBuilder($alias)
                ->where($alias.'.content = :content')
                ->andWhere($alias.'.user = :user')
                ->setParameter('content', $content)
                ->setParameter('user', $user)
                ->getQuery()
                ->getOneOrNullResult();

        if ($contentFollows) {
            $this->entityManager->remove($contentFollows);
            $this->entityManager->flush();
        }

//        $this->entityManager->getCache()
//            ->evictEntity(Content::class, $contentId);

        return true;
    }

    /**
     * @param $userId
     * @param $brand
     * @param null $contentType
     * @param int $page
     * @param int $limit
     * @return ContentFilterResultsEntity
     */
    public function getUserFollowedContent($userId, $brand, $contentType = null, $page = 1, $limit = 10)
    {
        $alias = 'cf';
        $contents = [];

        $first = ($page - 1) * $limit;
        $qb =
            $this->contentFollowsRepository->createQueryBuilder($alias)
                ->join($alias.'.content', 'c')
                ->where('c.type = :type')
                ->andWhere($alias.'.user = :user')
                ->andWhere('c.brand = :brand')
                ->setParameter('type', $contentType)
                ->setParameter('user', $userId)
                ->setParameter('brand', $brand)
                ->setMaxResults($limit)
                ->setFirstResult($first)
                ->orderBy('c.createdOn','desc');
        $contentFollows =
            $qb->getQuery()
                ->getResult('Railcontent');

        foreach ($contentFollows as $contentFollow) {
            $contents[] = $contentFollow->getContent();
        }
        $hydratedResults = $this->resultsHydrator->hydrate($contents, $this->entityManager);

        $results = new ContentFilterResultsEntity([
                                                      'qb' => $qb,
                                                      'results' => $hydratedResults,
                                                  ]);

        return $results;
    }

    public function isSubscribedCurrentUserToContent($contentId)
    {
        $followedContentIds = $this->getCurrentUserFollowedContentIds();

        return in_array($contentId, $followedContentIds);
    }

    /**
     * @return array|mixed
     */
    public function getCurrentUserFollowedContentIds()
    {
        return $this->contentFollowsRepository->getFollowedContentIds();
    }

    /**
     * @param $brand
     * @param null $contentType
     * @param array $statuses
     * @param int $page
     * @param int $limit
     * @param string $sort
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function getLessonsForFollowedCoaches(
        $brand,
        $contentTypes = [],
        $statuses = [],
        $page = 1,
        $limit = 10,
        $sort = '-published_on'
    ) {
        $followedContent= [];

        $qb =
            $this->contentFollowsRepository->createQueryBuilder('fc')
                ->join('fc.content', 'c')
                ->where('fc.user = :user')
                ->andWhere('c.brand = :brand')
                ->setParameter('user', auth()->id())
                ->setParameter('brand', $brand)
                ->orderBy('c.createdOn','desc');
        $contentFollows =
            $qb->getQuery()
                ->getResult('Railcontent');

        foreach ($contentFollows as $contentFollow) {
            $followedContent[] = $contentFollow->getContent();
        }

        $contentData = new ContentFilterResultsEntity(['results' => [], 'total_results' => 0]);

        if (!empty($followedContent)) {
            $includedFields = [];

            foreach ($followedContent as $content) {
                $includedFields[] = 'instructor,' . $content->getId();
                $instructor =         array_first($this->contentService->getBySlugAndType($content->getSlug(), 'coach'));

                if ($instructor) {
                    $includedFields[] = 'instructor,' . $instructor->getId();
                }
            }

            ContentRepository::$pullFutureContent = false;
            ContentRepository::$availableContentStatues =
                (!empty($statuses)) ? $statuses : [ContentService::STATUS_PUBLISHED];

            $contentData = $this->contentService->getFiltered(
                $page,
                $limit,
                $sort,
                $contentTypes,
                [],
                [],
                [],
                $includedFields
            );
        }

        return $contentData;
    }

}