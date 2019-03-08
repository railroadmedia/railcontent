<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\CachedQuery;

class UserPermissionsRepository extends EntityRepository
{

    /** Pull the user permissions record
     *
     * @param integer|null $userId
     * @param boolean $onlyActive
     * @return array
     */
    public function getUserPermissions($userId, $onlyActive)
    {
        if(!$userId){
            return;
        }

        $user = app()->make(UserProviderInterface::class)->getUserById(auth()->id());

        $qb = $this->createQueryBuilder('up');

        if ($userId) {
            $qb->where('up.user = :user')
                ->setParameter('user', $user)
            ->orderBy('up.expirationDate', 'asc');
        }

        if ($onlyActive) {
            $qb->andWhere(
                $qb->expr()
                    ->orX(
                        $qb->expr()
                            ->isNull('up.expirationDate'),
                        $qb->expr()
                            ->gte('up.expirationDate', ':expirationDate')
                    )
            )
                ->setParameter(
                    'expirationDate',
                    Carbon::now()
                        ->toDateTimeString()
                );
        }

        return $qb->getQuery()
            ->getResult();
    }

    /**
     * @param int $userId
     * @param int $permissionId
     * @return array
     */
    public function getIdByPermissionAndUser($userId, $permissionId)
    {
        return $this->query()
            ->where('user_id', $userId)
            ->where('permission_id', $permissionId)
            ->get()
            ->toArray();
    }

    /**
     * @param int $userId
     * @param int $permissionName
     * @return boolean
     */
    public function userHasPermissionName($userId, $permissionName)
    {
        return $this->query()
            ->join(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions . '.id',
                '=',
                ConfigService::$tableUserPermissions . '.permission_id'
            )
            ->where(
                function ($query) {
                    $query->whereDate(
                        'expiration_date',
                        '>=',
                        Carbon::now()
                            ->toDateTimeString()
                    )
                        ->orWhereNull('expiration_date');
                }
            )
            ->where('user_id', $userId)
            ->where('name', $permissionName)
            ->exists();
    }
}