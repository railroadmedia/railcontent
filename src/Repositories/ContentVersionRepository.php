<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\CachedQuery;

class ContentVersionRepository extends \Railroad\Resora\Repositories\RepositoryBase
{
    /**
     * @return CachedQuery|$this
     */
    protected function newQuery()
    {
        return (new CachedQuery($this->connection()))->from(ConfigService::$tableContentVersions);
    }
}