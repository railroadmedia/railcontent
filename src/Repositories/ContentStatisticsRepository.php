<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

class ContentStatisticsRepository extends RepositoryBase
{
    /**
     * @param array $data
     */
    public function bulkInsert($data)
    {
        $this->databaseManager->table(ConfigService::$tableContentStatistics)
            ->insert($data);
    }

    public function initIntervalContentStatistics(Carbon $start, Carbon $end, int $weekOfYear)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `content_type`,
    `content_published_on`,
    `completes`,
    `starts`,
    `comments`,
    `likes`,
    `added_to_list`,
    `start_interval`,
    `end_interval`,
    `week_of_year`,
    `created_on`
)
SELECT
    c.`id` AS `content_id`,
    c.`type` AS `content_type`,
    c.`published_on` AS `content_published_on`,
    0 AS `completes`,
    0 AS `starts`,
    0 AS `comments`,
    0 AS `likes`,
    0 AS `added_to_list`,
    '%s' as `start_interval`,
    '%s' as `end_interval`,
    %s as `week_of_year`,
    '%s' as `created_on`
FROM `%s` c
WHERE
    c.`type` IN ('%s')
    and c.`created_on` <= '%s'
EOT;

        $statement = sprintf(
            $sql,
            ConfigService::$tableContentStatistics,
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            $weekOfYear,
            Carbon::now()->toDateTimeString(),
            ConfigService::$tableContent,
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function computeIntervalCompletesContentStatistics(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
LEFT JOIN (
    SELECT
        c.`id` AS `content_id`,
        COUNT(ucp.`id`) AS `completes`
    FROM `%s` c
    LEFT JOIN `%s` ucp
        ON ucp.`content_id` = c.`id`
    WHERE
        ucp.`state` = 'completed'
        AND ucp.`updated_on` >= '%s'
        AND ucp.`updated_on` <= '%s'
        AND c.`type` IN ('%s')
        AND c.`created_on` <= '%s'
    GROUP BY c.`id`
) as s ON cs.`content_id` = s.`content_id`
SET cs.`completes` = s.`completes`
WHERE
    s.`completes` IS NOT NULL
    AND cs.`start_interval` = '%s'
    AND cs.`end_interval` = '%s'
EOT;

        $statement = sprintf(
            $sql,
            ConfigService::$tableContentStatistics,
            ConfigService::$tableContent,
            ConfigService::$tableUserContentProgress,
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString(),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function computeIntervalStartsContentStatistics(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
LEFT JOIN (
    SELECT
        c.`id` AS `content_id`,
        COUNT(ucp.`id`) AS `starts`
    FROM `%s` c
    LEFT JOIN `%s` ucp
        ON ucp.`content_id` = c.`id`
    WHERE
        ucp.`state` = 'started'
        AND ucp.`updated_on` >= '%s'
        AND ucp.`updated_on` <= '%s'
        AND c.`type` IN ('%s')
        AND c.`created_on` <= '%s'
    GROUP BY c.`id`
) as s ON cs.`content_id` = s.`content_id`
SET cs.`starts` = s.`starts`
WHERE
    s.`starts` IS NOT NULL
    AND cs.`start_interval` = '%s'
    AND cs.`end_interval` = '%s'
EOT;

        $statement = sprintf(
            $sql,
            ConfigService::$tableContentStatistics,
            ConfigService::$tableContent,
            ConfigService::$tableUserContentProgress,
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString(),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function computeIntervalCommentsContentStatistics(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
LEFT JOIN (
    SELECT
        c.`id` AS `content_id`,
        COUNT(rcc.`id`) AS `comments`
    FROM `%s` c
    LEFT JOIN `%s` rcc
        ON rcc.`content_id` = c.`id`
    WHERE
        rcc.`created_on` >= '%s'
        AND rcc.`created_on` <= '%s'
        AND rcc.`deleted_at` IS NULL
        AND c.`type` IN ('%s')
        AND c.`created_on` <= '%s'
    GROUP BY c.`id`
) as s ON cs.`content_id` = s.`content_id`
SET cs.`comments` = s.`comments`
WHERE
    s.`comments` IS NOT NULL
    AND cs.`start_interval` = '%s'
    AND cs.`end_interval` = '%s'
EOT;

        $statement = sprintf(
            $sql,
            ConfigService::$tableContentStatistics,
            ConfigService::$tableContent,
            ConfigService::$tableComments,
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString(),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function computeIntervalLikesContentStatistics(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
LEFT JOIN (
    SELECT
        c.`id` AS `content_id`,
        COUNT(cl.`id`) AS `likes`
    FROM `%s` c
    LEFT JOIN `%s` cl
        ON cl.`content_id` = c.`id`
    WHERE
        cl.`created_on` >= '%s'
        AND cl.`created_on` <= '%s'
        AND c.`type` IN ('%s')
        AND c.`created_on` <= '%s'
    GROUP BY c.`id`
) as s ON cs.`content_id` = s.`content_id`
SET cs.`likes` = s.`likes`
WHERE
    s.`likes` IS NOT NULL
    AND cs.`start_interval` = '%s'
    AND cs.`end_interval` = '%s'
EOT;

        $statement = sprintf(
            $sql,
            ConfigService::$tableContentStatistics,
            ConfigService::$tableContent,
            ConfigService::$tableContentLikes,
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString(),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function computeIntervalAddToListContentStatistics(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
LEFT JOIN (
    SELECT
        c.`id` AS `content_id`,
        COUNT(csj.`id`) AS `added_to_list`
    FROM `%s` c
    LEFT JOIN `%s` ch ON ch.`child_id` = c.`id`
    LEFT JOIN `%s` csj ON csj.`id` = ch.`parent_id`
    WHERE
        ch.`created_on` >= '%s'
        AND ch.`created_on` <= '%s'
        AND csj.`type` = 'user-playlist'
        AND c.`type` IN ('%s')
        AND c.`created_on` <= '%s'
    GROUP BY c.`id`
) as s ON cs.`content_id` = s.`content_id`
SET cs.`added_to_list` = s.`added_to_list`
WHERE
    s.`added_to_list` IS NOT NULL
    AND cs.`start_interval` = '%s'
    AND cs.`end_interval` = '%s'
EOT;

        $statement = sprintf(
            $sql,
            ConfigService::$tableContentStatistics,
            ConfigService::$tableContent,
            ConfigService::$tableContentHierarchy,
            ConfigService::$tableContent,
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString(),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function cleanIntervalContentStatistics(Carbon $start, Carbon $end)
    {
        $this->query()
            ->where(ConfigService::$tableContentStatistics . '.start_interval', $start)
            ->where(ConfigService::$tableContentStatistics . '.end_interval', $end)
            ->where(ConfigService::$tableContentStatistics . '.completes', 0)
            ->where(ConfigService::$tableContentStatistics . '.starts', 0)
            ->where(ConfigService::$tableContentStatistics . '.comments', 0)
            ->where(ConfigService::$tableContentStatistics . '.likes', 0)
            ->where(ConfigService::$tableContentStatistics . '.added_to_list', 0)
            ->delete();
    }

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
                        ConfigService::$tableContent . '.brand as content_brand',
                        ConfigService::$tableContentFields . '.value as content_title',
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
                ->leftJoin(
                    ConfigService::$tableContentFields,
                    function (JoinClause $joinClause) {
                        $joinClause->on(
                            ConfigService::$tableContentStatistics . '.content_id',
                            '=',
                            ConfigService::$tableContentFields . '.content_id'
                        )
                            ->where(ConfigService::$tableContentFields . '.key', 'title');
                    }
                )
                ->join(
                    ConfigService::$tableContent,
                    ConfigService::$tableContent . '.id',
                    '=',
                    ConfigService::$tableContentStatistics . '.content_id'
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
