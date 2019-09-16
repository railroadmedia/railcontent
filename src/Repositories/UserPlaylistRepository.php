<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Railroad\Railcontent\Repositories\Traits\RailcontentCustomQueryBuilder;

class UserPlaylistRepository extends EntityRepository
{

    use RailcontentCustomQueryBuilder;

    /**
     * @param $user
     * @param string $type
     * @param $brand
     * @return mixed
     */
    public function getUserPlaylist($user, $type = 'primary-playlist', $brand)
    {
        $qb = $this->createQueryBuilder('up');

        $qb->where('up.user = :user')
            ->andWhere('up.type = :type')
            ->andWhere('up.brand = :brand')
            ->setParameter('user', $user)
            ->setParameter('type', $type)
            ->setParameter('brand', $brand)
            ->orderByColumn('up', 'id', 'desc');

        return $qb->getQuery()
            ->setCacheable(true)
            ->setCacheRegion('userPlaylists')
            ->getResult();
    }
}