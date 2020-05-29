<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentLikes;
use Railroad\Railcontent\Entities\ContentStatistics;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Entities\UserPlaylist;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\Traits\RailcontentCustomQueryBuilder;

class ContentStatisticsRepository extends EntityRepository
{
    use RailcontentCustomQueryBuilder;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|EntityRepository
     */
    private $contentRepository;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|EntityRepository
     */
    private $userProgressRepository;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|EntityRepository
     */
    private $commentRepository;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|EntityRepository
     */
    private $contentLikeRepository;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|EntityRepository
     */
    private $userPlaylistRepository;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * ContentStatisticsRepository constructor.
     *
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(RailcontentEntityManager $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(ContentStatistics::class));

        $this->contentRepository = $entityManager->getRepository(Content::class);
        $this->userProgressRepository = $entityManager->getRepository(UserContentProgress::class);
        $this->commentRepository = $entityManager->getRepository(Comment::class);
        $this->contentLikeRepository = $entityManager->getRepository(ContentLikes::class);
        $this->userPlaylistRepository = $entityManager->getRepository(UserPlaylist::class);

        $this->databaseManager = app()->make(DatabaseManager::class);
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

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @param int $weekOfYear
     */
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
            config('railcontent.table_prefix') . 'content_statistics',
            $start->toDateTimeString(),
            $end->toDateTimeString(),
            $weekOfYear,
            Carbon::now()
                ->toDateTimeString(),
            config('railcontent.table_prefix') . 'content',
            implode("', '", config('railcontent.statistics_content_types')),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
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
            config('railcontent.table_prefix') . 'content_statistics',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'user_content_progress',
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

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
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
            config('railcontent.table_prefix') . 'content_statistics',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'user_content_progress',
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

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
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
            config('railcontent.table_prefix') . 'content_statistics',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'comments',
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

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
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
            config('railcontent.table_prefix') . 'content_statistics',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'content_likes',
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

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
    public function computeIntervalAddToListContentStatistics(Carbon $start, Carbon $end)
    {
        $sql = <<<'EOT'
UPDATE `%s` cs
LEFT JOIN (
    SELECT
        c.`id` AS `content_id`,
        COUNT(csj.`id`) AS `added_to_list`
    FROM `%s` c
    LEFT JOIN `%s` csj ON csj.`content_id` = c.`id`
    LEFT JOIN `%s` ch ON csj.`user_playlist_id` = ch.`id`
    WHERE
        csj.`created_at` >= '%s'
        AND csj.`created_at` <= '%s'
        AND ch.`user_id` NOT IN (%s)
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
            config('railcontent.table_prefix') . 'content_statistics',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'user_playlist_content',
            config('railcontent.table_prefix') . 'user_playlists',
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

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
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
            config('railcontent.table_prefix') . 'content_statistics',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'content_hierarchy',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'comments',
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

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
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
            config('railcontent.table_prefix') . 'content_statistics',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'content_hierarchy',
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'content_likes',
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

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
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
            config('railcontent.table_prefix') . 'content_statistics',
            $end->toDateTimeString(),
            $start->toDateTimeString(),
            $end->toDateTimeString()
        );

        $this->databaseManager->statement($statement);
    }

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function cleanIntervalContentStatistics(Carbon $start, Carbon $end)
    {
        $stats =
            $this->createQueryBuilder('st')
                ->where('st.startInterval = :startInterval')
                ->andWhere('st.endInterval = :endInterval')
                ->andWhere('st.completes = :completes')
                ->andWhere('st.starts = :starts')
                ->andWhere('st.comments = :comments')
                ->andWhere('st.likes = :likes')
                ->andWhere('st.addedToList = :addedToList')
                ->setParameter('startInterval', $start)
                ->setParameter('endInterval', $end)
                ->setParameter('completes', 0)
                ->setParameter('starts', 0)
                ->setParameter('comments', 0)
                ->setParameter('likes', 0)
                ->setParameter('addedToList', 0)
                ->getQuery()
                ->getResult();

        foreach ($stats as $stat) {
            $this->getEntityManager()
                ->remove($stat);
            $this->getEntityManager()
                ->flush();
        }
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
            $this->userProgressRepository->createQueryBuilder('ucp')
                ->select('count(ucp.id)')
                ->where('ucp.content = :content')
                ->andWhere('ucp.state = :state')
                ->setParameter('content', $id)
                ->setParameter('state', 'completed');

        if ($smallDate) {
            $query->andWhere('ucp.updatedOn >= :smallDate')
                ->setParameter('smallDate', $smallDate);
        }

        if ($bigDate) {
            $query->andWhere('ucp.updatedOn <= :bigDate')
                ->setParameter('bigDate', $bigDate);
        }

        return $query->getQuery()
            ->getSingleScalarResult();
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
            $this->userProgressRepository->createQueryBuilder('ucp')
                ->select('count(ucp.id)')
                ->where('ucp.content = :content')
                ->andWhere('ucp.state = :state')
                ->setParameter('content', $id)
                ->setParameter('state', 'started');

        if ($smallDate) {
            $query->andWhere('ucp.updatedOn >= :smallDate')
                ->setParameter('smallDate', $smallDate);
        }

        if ($bigDate) {
            $query->andWhere('ucp.updatedOn <= :bigDate')
                ->setParameter('bigDate', $bigDate);
        }

        return $query->getQuery()
            ->getSingleScalarResult();
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
            $this->commentRepository->createQueryBuilder('co')
                ->select('count(co.id)')
                ->where('co.content = :content')
                ->andWhere('co.deletedAt is null')
                ->setParameter('content', $id);

        if ($smallDate) {
            $query->andWhere('co.createdOn >= :smallDate')
                ->setParameter('smallDate', $smallDate);
        }

        if ($bigDate) {
            $query->andWhere('co.createdOn <= :bigDate')
                ->setParameter('bigDate', $bigDate);
        }

        return $query->getQuery()
            ->getSingleScalarResult();
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
            $this->contentLikeRepository->createQueryBuilder('cl')
                ->select('count(cl.id)')
                ->where('cl.content = :content')
                ->setParameter('content', $id);

        if ($smallDate) {
            $query->andWhere('cl.createdOn >= :smallDate')
                ->setParameter('smallDate', $smallDate);
        }

        if ($bigDate) {
            $query->andWhere('cl.createdOn <= :bigDate')
                ->setParameter('bigDate', $bigDate);
        }

        return $query->getQuery()
            ->getSingleScalarResult();
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
            $this->userPlaylistRepository->createQueryBuilder('up')
                ->select('count(p.id)')
                ->join('up.playlistContent', 'p')
                ->where('p.content = :content')
                ->andWhere('up.type = :type')
                ->setParameter('content', $id)
                ->setParameter('type', 'user-playlist');

        if ($smallDate) {
            $query->andWhere('p.createdAt >= :smallDate')
                ->setParameter('smallDate', $smallDate);
        }

        if ($bigDate) {
            $query->andWhere('p.createdAt <= :bigDate')
                ->setParameter('bigDate', $bigDate);
        }

        return $query->getQuery()
            ->getSingleScalarResult();
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

        $qb =
            $this->createQueryBuilder('cs')
                ->select(
                    [
                        'c.id as content_id',
                        'cs.contentType as content_type',
                        'cs.contentPublishedOn as content_published_on',
                        'c.brand as content_brand',
                        'c.title as content_title',
                        'SUM(cs.completes) as total_completes',
                        'SUM(cs.starts) as total_starts',
                        'SUM(cs.comments) as total_comments',
                        'SUM(cs.likes) as total_likes',
                        'SUM(cs.addedToList) as total_added_to_list',
                    ]
                )
                ->join('cs.content', 'c');

        if ($smallDate) {
            $qb->andWhere('cs.startInterval >= :smallDate')
                ->andWhere('cs.endInterval >= :smallDate')
                ->setParameter('smallDate', $smallDate);
        }

        if ($bigDate) {
            $qb->andWhere('cs.startInterval <= :bigDate')
                ->andWhere('cs.endInterval <= :bigDate')
                ->setParameter('bigDate', $bigDate);
        }

        if ($publishedOnSmallDate) {
            $qb->andWhere('cs.contentPublishedOn >= :publishedSmallDate')
                ->setParameter('publishedSmallDate', $publishedOnSmallDate);
        }

        if ($publishedOnBigDate) {
            $qb->andWhere('cs.contentPublishedOn <= :publishedOnBigDate')
                ->setParameter('publishedOnBigDate', $publishedOnBigDate);
        }

        if ($brand) {
            $qb->andWhere('c.brand = :brand')
                ->setParameter('brand', $brand);
        }

        if (!empty($contentTypes)) {
            $qb->andWhere('cs.contentType IN (:contentTypes)')
                ->setParameter('contentTypes', $contentTypes);
        }

        if ($statsEpoch) {
            $qb->andWhere('cs.statsEpoch <= :statsEpoch')
                ->setParameter('statsEpoch', $statsEpoch);
        }

        if (!empty($difficultyFields)) {
            $qb->andWhere('c.difficulty IN (:difficulty)')
                ->setParameter('difficulty', $difficultyFields);
        }

        if (!empty($styleFields)) {
            $qb->andWhere('c.style IN (:styles)')
                ->setParameter('styles', $styleFields);
        }

        if (!empty($tagFields)) {
            $qb->join('c.tag', 'tag')
                ->andWhere('tag.tag IN (:tags)')
                ->setParameter('tags', $tagFields);
        }

        if (!empty($topicFields)) {
            $qb->join('c.topic', 'topic')
                ->andWhere('topic.topic IN (:topics)')
                ->setParameter('topics', $topicFields);
        }

        if (!empty($instructorFields)) {
            $qb->join('c.instructor', 'ci')
                ->join('ci.instructor', 'i')
                ->andWhere('i.name IN (:instructors)')
                ->setParameter('instructors', $instructorFields);
        }

        $qb->groupBy('cs.content');

        if ($sortBy && $sortDir) {
            $qb->orderBy($sortBy, $sortDir);
        }

        $results =
            $qb->getQuery()
                ->getResult();

        return $results;
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