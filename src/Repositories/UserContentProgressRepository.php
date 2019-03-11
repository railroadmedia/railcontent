<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;


class UserContentProgressRepository extends EntityRepository
{
    public static $cache = [];

    /**
     * @param $userId
     * @param array $contentIds
     * @return array
     */
    public function getByUserIdAndWhereContentIdIn($userId, array $contentIds)
    {
        $key = $userId . '+' . implode('_', $contentIds);

        if (!key_exists($key, self::$cache)) {
            self::$cache[$key] =
                $this->createQueryBuilder('up')
                    ->where('up.content IN (:contentIds)')
                    ->andWhere('up.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->setParameter('contentIds', $contentIds)
                    ->getQuery()
                    ->getResult();

            return self::$cache[$key];
        }

        return self::$cache[$key];
    }
}