<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Services\ConfigService;

class UserContentProgressRepository extends RepositoryBase
{
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableUserContentProgress);
    }
}