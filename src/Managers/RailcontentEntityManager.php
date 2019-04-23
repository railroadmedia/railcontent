<?php

namespace Railroad\Railcontent\Managers;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use InvalidArgumentException;

class RailcontentEntityManager extends EntityManager
{
    /**
     * Factory method to create EntityManager instances.
     *
     * @param array|Connection $connection An array with the connection parameters or an existing Connection instance.
     * @param Configuration $config The Configuration instance to use.
     * @param EventManager $eventManager The EventManager instance to use.
     *
     * @return EntityManager The created EntityManager.
     *
     * @throws InvalidArgumentException
     * @throws ORMException
     */
    public static function create($connection, Configuration $config, EventManager $eventManager = null)
    {
        if (!$config->getMetadataDriverImpl()) {
            throw ORMException::missingMappingDriverImpl();
        }

        $connection = static::createConnection($connection, $config, $eventManager);

        return new self($connection, $config, $connection->getEventManager());
    }

    /**
     * @param string $dql
     * @return Query
     */
    public function createQuery($dql = '')
    {
        $query = parent::createQuery($dql)
            ->setHint(Query::HINT_INCLUDE_META_COLUMNS, true);

        return $query;
    }
}