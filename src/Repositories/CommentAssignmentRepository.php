<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Repositories\QueryBuilders\CommentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

class CommentAssignmentRepository extends \Railroad\Resora\Repositories\RepositoryBase
{
    protected function newQuery()
    {
        return (new CommentQueryBuilder(
            $this->connection(),
            $this->connection()
                ->getQueryGrammar(),
            $this->connection()
                ->getPostProcessor()
        ))->from(ConfigService::$tableCommentsAssignment);
    }
}