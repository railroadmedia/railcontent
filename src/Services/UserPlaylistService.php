<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Entities\UserPlaylist;
use Railroad\Railcontent\Entities\UserPlaylistContent;
use Railroad\Railcontent\Hydrators\CustomRailcontentHydrator;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\UserPlaylistRepository;

class UserPlaylistService
{
    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $userPlaylistRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentUserPlaylistRepository;

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
     * UserPlaylistService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param UserProviderInterface $userProvider
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        UserProviderInterface $userProvider,
        CustomRailcontentHydrator $resultsHydrator
    ) {
        $this->entityManager = $entityManager;
        $this->userProvider = $userProvider;
        $this->resultsHydrator = $resultsHydrator;

        $this->userPlaylistRepository = $this->entityManager->getRepository(UserPlaylist::class);
        $this->contentUserPlaylistRepository = $this->entityManager->getRepository(UserPlaylistContent::class);
        $this->contentRepository = $this->entityManager->getRepository(Content::class);
    }

    /** Save/update user playlist
     *
     * @param $attributes
     * @param $values
     * @return object|UserPermission|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateOrCeate($userId, $type, $brand)
    {
        $user = $this->userProvider->getUserById($userId);

        $userPlaylist = $this->userPlaylistRepository->getUserPlaylist($user, $type, $brand);

        if (!$userPlaylist) {
            $userPlaylist = new UserPlaylist();
            $userPlaylist->setUser($user);
            $userPlaylist->setBrand($brand);
            $userPlaylist->setType($type);
            $userPlaylist->setCreatedAt(Carbon::now());

            $this->entityManager->persist($userPlaylist);
            $this->entityManager->flush();
        }

        return $userPlaylist;
    }

    /**
     * @param $userId
     * @param $playlistType
     * @return object|null
     */
    public function userPlaylist($userId, $playlistType, $brand = null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }
        $user = $this->userProvider->getUserById($userId);

        $qb =
            $this->userPlaylistRepository->createQueryBuilder('up')
                ->addSelect(['up', 'upc'])
                ->leftJoin('up.playlistContent', 'upc');

        $qb->where('up.user = :user')
            ->andWhere('up.type = :type')
            ->andWhere('up.brand = :brand');

        $qb->setParameter('user', $user)
            ->setParameter('type', $playlistType)
            ->setParameter('brand', $brand)
            ->orderByColumn('up', 'id', 'desc');

        $userPlaylist =
            $qb->getQuery()
                ->getResult();

        return $userPlaylist;
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @return UserPlaylistContent
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addContentToUserPlaylist($userPlaylistId, $contentId)
    {
        $content = $this->contentRepository->find($contentId);
        $userPlaylist = $this->userPlaylistRepository->find($userPlaylistId);
        $userPlaylistContent =
            $this->contentUserPlaylistRepository->createQueryBuilder('uc')
                ->where('uc.content = :content')
                ->andWhere('uc.userPlaylist = :playlist')
                ->setParameter('content', $content)
                ->setParameter('playlist', $userPlaylist)
                ->getQuery()
                ->getOneOrNullResult();

        if (!$userPlaylistContent) {
            $userPlaylistContent = new UserPlaylistContent();
            $userPlaylistContent->setContent($content);
            $userPlaylistContent->setUserPlaylist($userPlaylist);
            $userPlaylistContent->setCreatedAt(Carbon::now());
        }

        $this->entityManager->persist($userPlaylistContent);
        $this->entityManager->flush();

//        $this->entityManager->getCache()
//            ->getQueryCache('pull')
//            ->clear();
//
//        $this->entityManager->getCache()
//            ->evictQueryRegion('pull');

        return $userPlaylistContent;
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function removeContentFromUserPlaylist($userPlaylistId, $contentId)
    {
        $content = $this->contentRepository->find($contentId);
        $userPlaylist = $this->userPlaylistRepository->find($userPlaylistId);

        $userPlaylistContent = $this->contentUserPlaylistRepository->findOneBy(
            [
                'content' => $content,
                'userPlaylist' => $userPlaylist,
            ]
        );

        if (!$userPlaylistContent) {
            return true;
        }

        $this->entityManager->remove($userPlaylistContent);
        $this->entityManager->flush();

//        $this->entityManager->getCache()
//            ->getQueryCache('pull')
//            ->clear();
//
//        $this->entityManager->getCache()
//            ->evictQueryRegion('pull');
    }

    /**
     * @param $playlistId
     * @param array $contentType
     * @param $limit
     * @param $skip
     * @return array|mixed
     */
    public function getUserPlaylistContents($playlistId, $contentType = [], $limit, $skip = 0)
    {
        $qb = $this->contentRepository->createQueryBuilder('content');

        $qb->join(
            UserPlaylistContent::class,
            'upc',
            'WITH',
            'upc.content = content'
        )
            ->where('upc.userPlaylist = :playlist');

        if (!empty($contentType)) {
            $qb->andWhere('content.type IN (:types)')
                ->setParameter('types', $contentType);
        }

        $qb->setParameter('playlist', $playlistId)
            ->paginate($limit, $skip)
            ->orderBy('upc.id', 'desc');

        $results =
            $qb->getQuery()
                ->getResult();

        return $this->resultsHydrator->hydrate($results, $this->entityManager);
    }

    /**
     * @param $playlistId
     * @param array $contentType
     * @return array|mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countUserPlaylistContents($playlistId, $contentType = [])
    {
        $qb = $this->contentRepository->createQueryBuilder('content');
        $qb->select(
            $qb->expr()
                ->count('content')
        );

        $qb->join(
            UserPlaylistContent::class,
            'upc',
            'WITH',
            'upc.content = content'
        )
            ->where('upc.userPlaylist = :playlist');

        if (!empty($contentType)) {
            $qb->andWhere('content.type IN (:types)')
                ->setParameter('types', $contentType);
        }
        $qb->setParameter('playlist', $playlistId)
            ->orderBy('upc.id', 'desc');

        return $qb->getQuery()
            ->getSingleScalarResult();

        $qb = $this->contentRepository->build();

        return $qb->select(
            $qb->expr()
                ->count(config('railcontent.table_prefix') . 'content')
        )
            ->restrictByUserAccess()
            ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
            ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
            ->andWhere('p.parent = :parentId')
            ->setParameter('parentId', $parentId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}