<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Services\ConfigService;

class ContentLikeRepository extends RepositoryBase
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->connection()->table(ConfigService::$tableContentLikes);
    }
}