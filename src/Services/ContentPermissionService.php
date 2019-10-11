<?php

namespace Railroad\Railcontent\Services;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

/**
 * Class PermissionService
 *
 * @package Railroad\Railcontent\Services
 */
class ContentPermissionService
{
    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentPermissionRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $permissionRepository;

    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * ContentPermissionService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(
        RailcontentEntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;

        $this->contentPermissionRepository = $this->entityManager->getRepository(ContentPermission::class);
        $this->contentRepository = $this->entityManager->getRepository(Content::class);
        $this->permissionRepository = $this->entityManager->getRepository(Permission::class);
    }

    /**
     * @param null $contentId
     * @param null $contentType
     * @param $permissionId
     * @return array|mixed
     */
    public function getByContentTypeOrIdAndByPermissionId($contentId = null, $contentType = null, $permissionId)
    {
        if (empty($contentId) && empty($contentType)) {
            return [];
        }

        $qb = $this->contentPermissionRepository->createQueryBuilder('cp');

        $qb->where('cp.brand = :brand')
            ->andWhere('cp.permission = :permission')
            ->andWhere(
                $qb->expr()
                    ->orX(
                        $qb->expr()
                            ->eq('cp.content', ':contentId'),
                        $qb->expr()
                            ->eq('cp.contentType', ':contentType')
                    )
            )
            ->setParameter('brand', config('railcontent.brand'))
            ->setParameter('permission', $permissionId)
            ->setParameter('contentId', $contentId)
            ->setParameter('contentType', $contentType);

        $results = $qb->getQuery()
            ->getResult('Railcontent');

        return $results;
    }

    /**
     * @param null $contentId
     * @param null $contentType
     * @param $permissionId
     * @return bool
     */
    public function dissociate($contentId = null, $contentType = null, $permissionId)
    {
        $q = $this->entityManager->createQuery(
            'delete from ' .
            ContentPermission::class .
            ' cp where cp.permission = :permissionId and (cp.content = :contentId or cp.contentType = :contentType)'
        )
            ->setParameters(
                ['permissionId' => $permissionId, 'contentId' => $contentId, 'contentType' => $contentType]
            );

        $q->execute();

        $this->entityManager->getCache()->getQueryCache('pull')->clear();

        $this->entityManager->getCache()
            ->evictQueryRegion('pull');

        return true;
    }

    /**
     * @param null $contentId
     * @param null $contentType
     * @param $permissionId
     * @param null $brand
     * @return ContentPermission
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create($contentId = null, $contentType = null, $permissionId, $brand = null)
    {
        $content = null;
        if ($contentId) {
            $content = $this->contentRepository->find($contentId);
        }

        $permission = $this->permissionRepository->find($permissionId);

        $contentPermission = new ContentPermission();
        $contentPermission->setBrand($brand ?? config('railcontent.brand'));
        $contentPermission->setContentType($contentType);
        $contentPermission->setContent($content);
        $contentPermission->setPermission($permission);

        $this->entityManager->persist($contentPermission);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        $this->entityManager->getCache()->getQueryCache('pull')->clear();

        $this->entityManager->getCache()
            ->evictQueryRegion('pull');

        return $contentPermission;
    }

    /**
     * @param array $contentIds
     * @param null $contentType
     * @return array|mixed
     */
    public function getByContentTypeOrIds($contentIds = [], $contentType = null)
    {
        if (empty($contentIds) && empty($contentType)) {
            return [];
        }

        $qb = $this->contentPermissionRepository->createQueryBuilder('cp');

        $qb->where('cp.brand = :brand')
            ->andWhere(
                $qb->expr()
                    ->orX(
                        $qb->expr()
                            ->in('cp.content', ':contentIds'),
                        $qb->expr()
                            ->eq('cp.contentType', ':contentType')
                    )
            )
            ->setParameter('brand', config('railcontent.brand'))
            ->setParameter('contentIds', $contentIds)
            ->setParameter('contentType', $contentType);

        return $qb->getQuery()
            ->getResult('Railcontent');
    }

    /**
     * @param $permissionId
     * @return mixed
     */
    public function getByPermission($permissionId)
    {
        return $this->contentPermissionRepository->findByPermission($permissionId);
    }
}