<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentStatistics;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\Traits\RailcontentCustomQueryBuilder;

class ContentStatisticsRepository extends EntityRepository
{
    private $contentRepository;

    /**
     * CommentRepository constructor.
     *
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(RailcontentEntityManager $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(ContentStatistics::class));

        $this->contentRepository =  $entityManager->getRepository(Content::class);
    }

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function removeExistingIntervalContentStatistics(Carbon $start, Carbon $end)
    {
        $stats =
            $this->createQueryBuilder('st')
                ->where('st.startInterval = :startInterval')
                ->andWhere('st.endInterval = :endInterval')
                ->setParameter('startInterval', $start)
                ->setParameter('endInterval', $end)
                ->getQuery()
                ->getResult();

        foreach ($stats as $stat) {
            $this->getEntityManager()
                ->remove($stat);
            $this->getEntityManager()
                ->flush();
        }
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
    `stats_epoch`,
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
    NULL AS `stats_epoch`,
    '%s' as `created_on`
FROM `%s` c
WHERE
    c.`type` IN ('%s')
    and c.`created_on` <= '%s'
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix'). 'content_statistics',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            $weekOfYear,
            Carbon::now()->toDateTimeString(),
            config('railcontent.table_prefix'). 'content',
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
        AND ucp.`user_id` NOT IN (%s)
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
            config('railcontent.table_prefix'). 'content_statistics',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'user_content_progress',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode(", ", config('railcontent.user_ids_excluded_from_stats')),
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
        AND ucp.`user_id` NOT IN (%s)
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
            config('railcontent.table_prefix'). 'content_statistics',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'user_content_progress',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode(", ", config('railcontent.user_ids_excluded_from_stats')),
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
        AND rcc.`user_id` NOT IN (%s)
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
            config('railcontent.table_prefix'). 'content_statistics',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'comments',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode(", ", config('railcontent.user_ids_excluded_from_stats')),
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
        AND cl.`user_id` NOT IN (%s)
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
            config('railcontent.table_prefix'). 'content_statistics',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'content_likes',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode(", ", config('railcontent.user_ids_excluded_from_stats')),
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
        AND csj.`user_id` NOT IN (%s)
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
            config('railcontent.table_prefix'). 'content_statistics',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'content_hierarchy',
            config('railcontent.table_prefix'). 'content',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode(", ", config('railcontent.user_ids_excluded_from_stats')),
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString(),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function computeTopLevelCommentsContentStatistics(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
LEFT JOIN (
    SELECT
        c.`id` AS `content_id`,
        SUM(cs.`child_content_comments`) AS `comments`
    FROM `%s` c
    LEFT JOIN `%s` ch ON ch.`parent_id` = c.`id`
    LEFT JOIN (
        SELECT
            rc.`id` AS `child_content_id`,
            COUNT(rcc.`id`) AS `child_content_comments`
        FROM `%s` rc
        LEFT JOIN `%s` rcc
            ON rcc.`content_id` = rc.`id`
        WHERE
            rcc.`created_on` >= '%s'
            AND rcc.`created_on` <= '%s'
            AND rcc.`user_id` NOT IN (%s)
            AND rc.`type` IN ('%s')
            AND rc.`created_on` <= '%s'
        GROUP BY rc.`id`
    ) cs ON cs.`child_content_id` = ch.`child_id`
    WHERE
        c.`type` IN ('%s')
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
            config('railcontent.table_prefix'). 'content_statistics',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'content_hierarchy',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'comments',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode(", ", config('railcontent.user_ids_excluded_from_stats')),
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString(),
            implode("', '", config('railcontent.topLevelContentTypes')),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function computeTopLevelLikesContentStatistics(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
LEFT JOIN (
    SELECT
        c.`id` AS `content_id`,
        SUM(cs.`child_content_likes`) AS `likes`
    FROM `%s` c
    LEFT JOIN `%s` ch ON ch.`parent_id` = c.`id`
    LEFT JOIN (
        SELECT
            rc.`id` AS `child_content_id`,
            COUNT(cl.`id`) AS `child_content_likes`
        FROM `%s` rc
        LEFT JOIN `%s` cl
            ON cl.`content_id` = rc.`id`
        WHERE
            cl.`created_on` >= '%s'
            AND cl.`created_on` <= '%s'
            AND cl.`user_id` NOT IN (%s)
            AND rc.`type` IN ('%s')
            AND rc.`created_on` <= '%s'
        GROUP BY rc.`id`
    ) cs ON cs.`child_content_id` = ch.`child_id`
    WHERE
        c.`type` IN ('%s')
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
            config('railcontent.table_prefix'). 'content_statistics',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'content_hierarchy',
            config('railcontent.table_prefix'). 'content',
            config('railcontent.table_prefix'). 'content_likes',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            implode(", ", config('railcontent.user_ids_excluded_from_stats')),
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString(),
            implode("', '", config('railcontent.topLevelContentTypes')),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function computeContentStatisticsAge(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
SET cs.`stats_epoch` = CEIL(DATEDIFF('%s', cs.`content_published_on`)/7)
WHERE
    cs.`content_published_on` IS NOT NULL
    AND cs.`start_interval` = '%s'
    AND cs.`end_interval` = '%s'
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix'). 'content_statistics',
            $end->toDateTimeString(),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    public function cleanIntervalContentStatistics(Carbon $start, Carbon $end)
    {
        $this->query()
            ->where(config('railcontent.table_prefix'). 'content_statistics' . '.start_interval', $start)
            ->where(config('railcontent.table_prefix'). 'content_statistics'. '.end_interval', $end)
            ->where(config('railcontent.table_prefix'). 'content_statistics'. '.completes', 0)
            ->where(config('railcontent.table_prefix'). 'content_statistics' . '.starts', 0)
            ->where(config('railcontent.table_prefix'). 'content_statistics'. '.comments', 0)
            ->where(config('railcontent.table_prefix'). 'content_statistics'. '.likes', 0)
            ->where(config('railcontent.table_prefix'). 'content_statistics' . '.added_to_list', 0)
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
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     * @param Carbon|null $publishedOnSmall
     * @param Carbon|null $publishedOnBig
     * @param string|null $brand
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
        $brand,
        $contentTypes,
        $sortBy,
        $sortDir,
        $statsEpoch,
        $difficultyFields,
        $instructorFields,
        $styleFields,
        $tagFields,
        $topicFields
    ) {

        $qb = $this->createQueryBuilder('cs');

        $results =  $qb->getQuery()
            ->getResult();

        return $results;

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

        if ($brand) {
            $query->where(ConfigService::$tableContent . '.brand', $brand);
        }

        if (!empty($contentTypes)) {
            $query->whereIn(ConfigService::$tableContentStatistics . '.content_type', $contentTypes);
        }

        if ($statsEpoch) {
            $query->where(ConfigService::$tableContentStatistics . '.stats_epoch', '<=', $statsEpoch);
        }

        if ($sortBy && $sortDir) {
            $query->orderByRaw($sortBy . ' ' . $sortDir);
        }

        if (
            !empty($difficultyFields)
            || !empty($instructorFields)
            || !empty($styleFields)
            || !empty($tagFields)
            || !empty($topicFields)
        ) {
            $filters = [];

            foreach ($instructorFields ?? [] as $instructorValue) {
                $filters[] = [
                    'key' => 'instructor',
                    'value' => $instructorValue
                ];
            }

            foreach ($difficultyFields ?? [] as $difficultyValue) {
                $filters[] = [
                    'key' => 'difficulty',
                    'value' => $difficultyValue
                ];
            }

            foreach ($styleFields ?? [] as $styleValue) {
                $filters[] = [
                    'key' => 'style',
                    'value' => $styleValue
                ];
            }

            foreach ($tagFields ?? [] as $tagValue) {
                $filters[] = [
                    'key' => 'tag',
                    'value' => $tagValue
                ];
            }

            foreach ($topicFields ?? [] as $topicValue) {
                $filters[] = [
                    'key' => 'topic',
                    'value' => $topicValue
                ];
            }

            $query->whereIn(
                ConfigService::$tableContentStatistics . '.content_id',
                function($query) use ($filters) {

                    $aliases = range('a', 'z');
                    $index = 0;
                    $mainAlias = null;

                    foreach ($filters as $filterData) {
                        $key = $filterData['key'];
                        $value = $filterData['value'];
                        $alias = $aliases[$index];

                        if ($index == 0) {
                            $mainAlias = $alias;

                            if ($key == 'instructor') {

                                $subAlias = 'cfji_' . $alias;
                                $subJoinAlias = 'cji_' . $alias;

                                $query->select($alias . '.content_id')
                                    ->from(ConfigService::$tableContentFields . ' AS ' . $alias)
                                    ->where(
                                        DB::raw('LOWER(' . $alias . '.`key`)'),
                                        $key
                                    )
                                    ->whereIn(
                                        DB::raw($alias . '.`value`'),
                                        function($query) use ($value, $subAlias, $subJoinAlias) {
                                            $query->selectRaw('CAST(' . $subAlias . '.content_id AS CHAR)')
                                                ->from(DB::raw(ConfigService::$tableContentFields . ' AS ' . $subAlias))
                                                ->leftJoin(
                                                    DB::raw(ConfigService::$tableContent . ' AS ' . $subJoinAlias),
                                                    DB::raw($subJoinAlias . '.id'),
                                                    DB::raw($subAlias . '.content_id')
                                                )
                                                ->where(
                                                    DB::raw($subAlias . '.`key`'),
                                                    'name'
                                                )
                                                ->where(
                                                    DB::raw('LOWER(' . $subAlias . '.`value`)'),
                                                    'LIKE',
                                                    '%' . $value . '%'
                                                )
                                                ->where(
                                                    DB::raw($subJoinAlias . '.type'),
                                                    'instructor'
                                                );
                                        }
                                    );
                            } else {
                                $query->select($alias . '.content_id')
                                    ->fromSub(
                                        function($query) use ($key, $value) {
                                            $query->select('content_id')
                                                ->from(ConfigService::$tableContentFields)
                                                ->where(
                                                    DB::raw('LOWER(`key`)'),
                                                    $key
                                                )
                                                ->where(
                                                    DB::raw('LOWER(`value`)'),
                                                    'LIKE',
                                                    '%' . $value . '%'
                                                );
                                        },
                                        $alias
                                    );
                            }
                        } else {
                            if ($key == 'instructor') {
                                $subAlias = 'cfji_' . $alias;
                                $subJoinAlias = 'cji_' . $alias;
                                $subQuery = DB::table(ConfigService::$tableContentFields)
                                    ->select('content_id')
                                    ->where(
                                        DB::raw('LOWER(`key`)'),
                                        $key
                                    )
                                    ->whereIn(
                                        'value',
                                        function($query) use ($value, $subAlias, $subJoinAlias) {
                                            $query->selectRaw('CAST(' . $subAlias . '.content_id AS CHAR)')
                                                ->from(DB::raw(ConfigService::$tableContentFields . ' AS ' . $subAlias))
                                                ->leftJoin(
                                                    DB::raw(ConfigService::$tableContent . ' AS ' . $subJoinAlias),
                                                    DB::raw($subJoinAlias . '.id'),
                                                    DB::raw($subAlias . '.content_id')
                                                )
                                                ->where(
                                                    DB::raw($subAlias . '.`key`'),
                                                    'name'
                                                )
                                                ->where(
                                                    DB::raw('LOWER(' . $subAlias . '.`value`)'),
                                                    'LIKE',
                                                    '%' . $value . '%'
                                                )
                                                ->where(
                                                    DB::raw($subJoinAlias . '.type'),
                                                    'instructor'
                                                );
                                        }
                                    );

                                $query->joinSub(
                                    $subQuery,
                                    $alias,
                                    function($join)  use ($alias, $mainAlias) {
                                        $join->on($alias . '.content_id', '=', $mainAlias . '.content_id');
                                    }
                                );
                            } else {
                                $subQuery = DB::table(ConfigService::$tableContentFields)
                                    ->select('content_id')
                                    ->where(
                                        DB::raw('LOWER(`key`)'),
                                        $key
                                    )
                                    ->where(
                                        DB::raw('LOWER(`value`)'),
                                        'LIKE',
                                        '%' . $value . '%'
                                    );

                                $query->joinSub(
                                    $subQuery,
                                    $alias,
                                    function($join)  use ($alias, $mainAlias) {
                                        $join->on($alias . '.content_id', '=', $mainAlias . '.content_id');
                                    }
                                );
                            }
                        }

                        $index++;
                    }
                }
            );
        }

        return $query->get()
            ->toArray();
    }

    public function getDifficultyFieldsValues()
    {
        return $this->contentRepository->createQueryBuilder('c')
            ->where('c.difficulty is not null')
            ->getQuery()
            ->getResult();

//        return $this->query()
//            ->select([ConfigService::$tableContentFields . '.value'])
//            ->from(ConfigService::$tableContentFields)
//            ->where(ConfigService::$tableContentFields . '.key', 'difficulty')
//            ->whereNotNull(ConfigService::$tableContentFields . '.value')
//            ->distinct()
//            ->pluck(ConfigService::$tableContentFields . '.value')
//            ->toArray();
    }

    public function getInstructorFieldsValues()
    {
        return [];
        return $this->query()
            ->from(ConfigService::$tableContentFields)
            ->where(ConfigService::$tableContentFields . '.key', 'name')
            ->whereNotNull(ConfigService::$tableContentFields . '.value')
            ->leftJoin(
                ConfigService::$tableContent,
                ConfigService::$tableContent . '.id',
                ConfigService::$tableContentFields . '.content_id'
            )
            ->where(ConfigService::$tableContent . '.type', 'instructor')
            ->distinct()
            ->pluck(ConfigService::$tableContentFields . '.value')
            ->toArray();
    }

    public function getStyleFieldsValues()
    {
        return [];
        return $this->query()
            ->from(ConfigService::$tableContentFields)
            ->where(ConfigService::$tableContentFields . '.key', 'style')
            ->whereNotNull(ConfigService::$tableContentFields . '.value')
            ->distinct()
            ->pluck(ConfigService::$tableContentFields . '.value')
            ->toArray();
    }

    public function getTagFieldsValues()
    {
        return [];
        return $this->query()
            ->from(ConfigService::$tableContentFields)
            ->where(ConfigService::$tableContentFields . '.key', 'tag')
            ->whereNotNull(ConfigService::$tableContentFields . '.value')
            ->distinct()
            ->pluck(ConfigService::$tableContentFields . '.value')
            ->toArray();
    }

    public function getTopicFieldsValues()
    {
        return [];
        return $this->query()
            ->from(ConfigService::$tableContentFields)
            ->where(ConfigService::$tableContentFields . '.key', 'topic')
            ->whereNotNull(ConfigService::$tableContentFields . '.value')
            ->distinct()
            ->pluck(ConfigService::$tableContentFields . '.value')
            ->toArray();
    }

}