<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class PermissionRepository extends RepositoryBase
{
    use ByContentIdTrait;

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->query()->get()->toArray();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tablePermissions);
    }
}