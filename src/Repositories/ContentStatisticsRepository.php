<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

class ContentStatisticsRepository extends RepositoryBase
{
    /**
     * @param integer $id
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     *
     * @return integer
     */
    public function getCompletedContentCount($id, ?Carbon $smallDate, ?Carbon $bigDate)
    {
        $query =
            $this->query()
                ->from(ConfigService::$tableUserContentProgress)
                ->where(ConfigService::$tableUserContentProgress . '.content_id', $id)
                ->where(ConfigService::$tableUserContentProgress . '.state', 'completed');

        if ($smallDate) {
            $query->where(ConfigService::$tableUserContentProgress . '.updated_on', '>=', $smallDate);
        }

        if ($bigDate) {
            $query->where(ConfigService::$tableUserContentProgress . '.updated_on', '<=', $bigDate);
        }

        return $query->count();
    }

    /**
     * @param integer $id
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     *
     * @return integer
     */
    public function getStartedContentCount($id, ?Carbon $smallDate, ?Carbon $bigDate)
    {
        $query =
            $this->query()
                ->from(ConfigService::$tableUserContentProgress)
                ->where(ConfigService::$tableUserContentProgress . '.content_id', $id)
                ->where(ConfigService::$tableUserContentProgress . '.state', 'started');

        if ($smallDate) {
            $query->where(ConfigService::$tableUserContentProgress . '.updated_on', '>=', $smallDate);
        }

        if ($bigDate) {
            $query->where(ConfigService::$tableUserContentProgress . '.updated_on', '<=', $bigDate);
        }

        return $query->count();
    }

    /**
     * @param integer $id
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     *
     * @return integer
     */
    public function getContentCommentsCount($id, ?Carbon $smallDate, ?Carbon $bigDate)
    {
        $query =
            $this->query()
                ->from(ConfigService::$tableComments)
                ->where(ConfigService::$tableComments . '.content_id', $id)
                ->whereNull(ConfigService::$tableComments . '.deleted_at');

        if ($smallDate) {
            $query->where(ConfigService::$tableComments . '.created_on', '>=', $smallDate);
        }

        if ($bigDate) {
            $query->where(ConfigService::$tableComments . '.created_on', '<=', $bigDate);
        }

        return $query->count();
    }

    /**
     * @param integer $id
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     *
     * @return integer
     */
    public function getContentLikesCount($id, ?Carbon $smallDate, ?Carbon $bigDate)
    {
        $query =
            $this->query()
                ->from(ConfigService::$tableContentLikes)
                ->where(ConfigService::$tableContentLikes . '.content_id', $id);

        if ($smallDate) {
            $query->where(ConfigService::$tableContentLikes . '.created_on', '>=', $smallDate);
        }

        if ($bigDate) {
            $query->where(ConfigService::$tableContentLikes . '.created_on', '<=', $bigDate);
        }

        return $query->count();
    }

    /**
     * @param integer $id
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     *
     * @return integer
     */
    public function getContentAddToListCount($id, ?Carbon $smallDate, ?Carbon $bigDate)
    {
        $query =
            $this->query()
                ->from(ConfigService::$tableContent)
                ->leftJoin(
                    ConfigService::$tableContentHierarchy,
                    ConfigService::$tableContentHierarchy . '.parent_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableContent . '.type', 'user-playlist')
                ->where(ConfigService::$tableContentHierarchy . '.child_id', $id);

        if ($smallDate) {
            $query->where(ConfigService::$tableContentHierarchy . '.created_on', '>=', $smallDate);
        }

        if ($bigDate) {
            $query->where(ConfigService::$tableContentHierarchy . '.created_on', '<=', $bigDate);
        }

        return $query->count();
    }

    public function getStatisticsContentIds(Carbon $bigDate)
    {
        return $this->query()
                ->from(ConfigService::$tableContent)
                ->select(
                    [
                        ConfigService::$tableContent . '.id as content_id',
                        ConfigService::$tableContent . '.type as content_type',
                        ConfigService::$tableContent . '.published_on as content_published_on'
                    ]
                )
                ->whereIn(ConfigService::$tableContent . '.type', ConfigService::$statisticsContentTypes)
                ->where(ConfigService::$tableContent . '.created_on', '<=', $bigDate)
                ->get()
                ->toArray();
    }

    /**
     * @return ContentQueryBuilder
     */
    public function query()
    {
        return (new ContentQueryBuilder(
            $this->connection(),
            $this->connection()
                ->getQueryGrammar(),
            $this->connection()
                ->getPostProcessor()
        ))->from(ConfigService::$tableContentStatistics);
    }
}
