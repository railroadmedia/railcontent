<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Decorators\Decorator;
use Railroad\Resora\Queries\CachedQuery;

class ContentFieldRepository extends EntityRepository
{
    use ByContentIdTrait;
//    /**
//     * @return CachedQuery|$this
//     */
//    protected function newQuery()
//    {
//        return (new CachedQuery($this->connection()))->from(ConfigService::$tableContentFields);
//    }
//
//    protected function decorate($results)
//    {
//        return Decorator::decorate($results, 'content-field');
//    }
}