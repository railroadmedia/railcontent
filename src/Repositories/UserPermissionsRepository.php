<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Repositories\Traits\RailcontentCustomQueryBuilder;

class UserPermissionsRepository extends EntityRepository
{

    use RailcontentCustomQueryBuilder;

    /** Pull the user permissions record
     *
     * @param integer|null $userId
     * @param boolean $onlyActive
     * @return array
     */
    public function getUserPermissions($userId, $onlyActive)
    {
        $qb = $this->createQueryBuilder('up');

        if ($userId) {
            $user =
                app()
                    ->make(UserProviderInterface::class)
                    ->getUserById($userId);
            $qb->where('up.user = :user')
                ->setParameter('user', $user)
                ->orderByColumn('up', 'expirationDate', 'asc');
        }

        if ($onlyActive) {
            $qb->andWhere(
                $qb->expr()
                    ->orX(
                        $qb->expr()
                            ->isNull('up.expirationDate'),
                        $qb->expr()
                            ->gte('up.expirationDate', ':currentExpirationDate')
                    )
            )
                ->andWhere(
                    $qb->expr()
                        ->orX(
                            $qb->expr()
                                ->isNull('up.startDate'),
                            $qb->expr()
                                ->lte('up.startDate', ':startDate')
                        )
                )
                ->setParameter(
                    'currentExpirationDate',
                    Carbon::now()
                )
                ->setParameter(
                    'startDate',
                    Carbon::now()
                );
        }

        return $qb->getQuery()
            ->getResult();
    }

    /**
     * @param $user
     * @param $permission
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function userPermission($user, $permission)
    {
        $alias = 'up';
        $qb = $this->createQueryBuilder($alias);
        $qb->where($alias . '.user = :user')
            ->andWhere($alias . '.permission = :permission')
            ->setParameter('user', $user)
            ->setParameter('permission', $permission)
            ->setMaxResults(1)
            ->orderBy($alias . '.id', 'desc');

        return $qb->getQuery()
            ->getOneOrNullResult('Railcontent');

    }
}