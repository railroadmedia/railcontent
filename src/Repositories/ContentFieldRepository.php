<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class ContentFieldRepository extends RepositoryBase
{
    use ByContentIdTrait;

    /**
     * @return Builder
     */
    protected function query()
    {
        return $this->connection()->table(ConfigService::$tableContentFields);
    }
}