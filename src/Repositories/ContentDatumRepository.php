<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\CachedQuery;

class ContentDatumRepository extends \Railroad\Resora\Repositories\RepositoryBase
{
    use ByContentIdTrait;
    /**
     * @return CachedQuery|$this
     */
    protected function newQuery()
    {
        return (new CachedQuery($this->connection()))->from(ConfigService::$tableContentData);
    }
}