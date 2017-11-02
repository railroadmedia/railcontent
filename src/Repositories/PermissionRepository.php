<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class PermissionRepository extends RepositoryBase
{
    use ByContentIdTrait;

    /**
     * This tells the query to only pull content that has its required permissions satisfied by these ids.
     *
     * If false, content permissions are ignored.
     * If an array, only content with those permissions are returned.
     *
     * @var bool|array
     */
    public static $availableContentPermissionIds = false;

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