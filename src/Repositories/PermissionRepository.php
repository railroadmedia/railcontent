<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\CachedQuery;

class PermissionRepository extends \Railroad\Resora\Repositories\RepositoryBase
{
    use ByContentIdTrait;

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->query()->get()->toArray();
    }

    protected function newQuery()
    {
        return (new CachedQuery($this->connection()))->from(ConfigService::$tablePermissions);
    }

    /**
     * @return Builder
     */
//    public function query()
//    {
//        return parent::connection()->table(ConfigService::$tablePermissions);
//    }
}