<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Repositories\QueryBuilders\QueryBuilder;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\BaseQuery;
use Railroad\Resora\Queries\CachedQuery;
use Railroad\Resora\Repositories\RepositoryBase;

class ContentLikeRepository extends RepositoryBase
{
    /**
     * @return BaseQuery|$this
     */
    protected function newQuery()
    {
        return (new BaseQuery($this->connection()))->from(ConfigService::$tableContentLikes);
    }

    public function connection()
    {
        return parent::connection();
    }
}