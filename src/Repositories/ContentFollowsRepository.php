<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class ContentFollowsRepository extends RepositoryBase
{
    use ByContentIdTrait;

    public static $cache = [];

    public function query()
    {
        return parent::connection()
            ->table(ConfigService::$tableContentFollows);
    }

    /**
     * @param $userId
     * @param $brand
     * @param null $contentType
     * @return array
     */
    public function getFollowedContent($userId, $brand, $contentType = null)
    {
        $query =
            $this->query()
                ->select('*')
                ->leftJoin(
                    ConfigService::$tableContent,
                    'content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableContentFollows . '.user_id', $userId)
                ->where(ConfigService::$tableContent . '.brand', $brand);

        if ($contentType) {
            $query->where(ConfigService::$tableContent . '.type', $contentType);
        }

        return $query->get()
            ->toArray();
    }

}
