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

    /**
     * @param Carbon $bigDate
     *
     * @return array
     */
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
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     * @param Carbon|null $publishedOnSmall
     * @param Carbon|null $publishedOnBig
     * @param array|null $contentTypes
     * @param string|null $sortBy
     * @param string|null $sortDir
     *
     * @return array
     */
    public function getContentStatistics(
        $smallDate,
        $bigDate,
        $publishedOnSmallDate,
        $publishedOnBigDate,
        $contentTypes,
        $sortBy,
        $sortDir
    ) {
        $query = $this->query()
                ->select(
                    [
                        ConfigService::$tableContentStatistics . '.content_id',
                        ConfigService::$tableContentStatistics . '.content_type',
                        ConfigService::$tableContentStatistics . '.content_published_on',
                        $this->databaseManager->raw(
                            'SUM(' . ConfigService::$tableContentStatistics . '.completes) as total_completes'
                        ),
                        $this->databaseManager->raw(
                            'SUM(' . ConfigService::$tableContentStatistics . '.starts) as total_starts'
                        ),
                        $this->databaseManager->raw(
                            'SUM(' . ConfigService::$tableContentStatistics . '.comments) as total_comments'
                        ),
                        $this->databaseManager->raw(
                            'SUM(' . ConfigService::$tableContentStatistics . '.likes) as total_likes'
                        ),
                        $this->databaseManager->raw(
                            'SUM(' . ConfigService::$tableContentStatistics . '.added_to_list) as total_added_to_list'
                        ),
                    ]
                )
                ->groupBy(ConfigService::$tableContentStatistics . '.content_id');

        if ($smallDate) {
            $query->where(ConfigService::$tableContentStatistics . '.start_interval', '>=', $smallDate)
                ->where(ConfigService::$tableContentStatistics . '.end_interval', '>=', $smallDate);
        }

        if ($bigDate) {
            $query->where(ConfigService::$tableContentStatistics . '.start_interval', '<=', $bigDate)
                ->where(ConfigService::$tableContentStatistics . '.end_interval', '<=', $bigDate);
        }

        if ($publishedOnSmallDate) {
            $query->where(ConfigService::$tableContentStatistics . '.content_published_on', '>=', $publishedOnSmallDate);
        }

        if ($publishedOnBigDate) {
            $query->where(ConfigService::$tableContentStatistics . '.content_published_on', '<=', $publishedOnBigDate);
        }

        if (!empty($contentTypes)) {
            $query->whereIn(ConfigService::$tableContentStatistics . '.content_type', $contentTypes);
        }

        if ($sortBy && $sortDir) {
            $query->orderByRaw($sortBy . ' ' . $sortDir);
        }

        return $query->get()
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
