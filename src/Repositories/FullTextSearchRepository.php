<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\PersistentCollection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\SearchIndex;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Repositories\QueryBuilders\FullTextSearchQueryBuilder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;
use Illuminate\Support\Facades\DB;
use Railroad\Resora\Decorators\Decorator;
use Railroad\Resora\Entities\Entity;

class FullTextSearchRepository extends EntityRepository
{
    use RefreshDatabase;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    private $entityManager;

    /** Delete old indexes for the brand
     *
     * @return mixed
     */
    public function deleteOldIndexes()
    {
        $qb = $this->createQueryBuilder('s');

        $qb->delete('s');
        $qb->where('s.brand = :brand');
        $qb->setParameter('brand', ConfigService::$brand);

        return true;
    }

    /** Prepare search indexes based on config settings
     *
     * @param string $type
     * @param array $content
     * @return string
     */
    public function prepareIndexesValues($type, $content)
    {
        $searchIndexValues = ConfigService::$searchIndexValues;
        $configSearchIndexValues = $searchIndexValues[$type];
        $values = [];

        foreach ($configSearchIndexValues['content_attributes'] as $contentAttribute) {
            $getter = 'get' . ucwords($contentAttribute);
            $values[] = $content->$getter();
        }

        if (in_array('*', $configSearchIndexValues['field_keys'])) {
            $associations =
                ($this->getEntityManager()
                    ->getClassMetadata(Content::class)
                    ->getAssociationNames());

            foreach ($associations as $association) {
                if ($association == 'userProgress' || $association == 'data') {
                    continue;
                }

                $getter = 'get' . ucwords($association);
                if ($content->$getter()) {
                    if (!$content->$getter() instanceof PersistentCollection) {
                        $values[] =
                            $content->$getter()
                                ->$getter();
                    } else {
                        foreach ($content->$getter() as $assoc) {
                            $values[] = $assoc->$getter();
                        }
                    }
                }
            }
        } else {
            foreach ($configSearchIndexValues['field_keys'] as $fieldKey) {
                $conf = explode(':', $fieldKey);
                if (count($conf) == 2) {
                    $getter = 'get' . ucwords($conf[0]);
                    $assocAttribute = 'get' . ucwords($conf[1]);
                    if ($content->$getter()) {
                        $values[] =
                            $content->$getter()
                                ->$assocAttribute();
                    }
                }
            }
        }

        if (in_array('*', $configSearchIndexValues['data_keys'])) {
            foreach ($content->getData() as $data) {
                $values[] = $data->getValue();
            }
        } else {
            foreach ($configSearchIndexValues['data_keys'] as $dataKey) {
                foreach ($content->getData() as $data) {
                    if ($data->getKey() == $dataKey) {
                        $values[] = $data->getValue();
                    }
                }
            }
        }

        foreach ($values as $valueIndex => $value) {
            $values[$valueIndex] = str_replace('/', '_', $value);
        }

        return implode(' ', $values);
    }

    /**
     * Perform a boolean full text search by term, paginate and order the results by score.
     * Returns an array with the contents that contain the search criteria
     *
     * @param $term
     * @param int $page
     * @param int $limit
     * @param array $contentTypes
     * @param array $contentStatuses
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @param null $dateTimeCutoff
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function search(
        $term,
        $page = 1,
        $limit = 10,
        $contentTypes = [],
        $contentStatuses = [],
        $orderByColumn = 'score',
        $orderByDirection = 'desc',
        $dateTimeCutoff = null
    ) {
        $alias = 'p';

        if (strpos($orderByColumn, '_') !== false || strpos($orderByColumn, '-') !== false) {
            $orderByColumn = camel_case($orderByColumn);
        }
        if ($orderByColumn != 'score') {
            $orderByColumn = $alias . '.' . $orderByColumn;
        }

        $query = $this->prepareQb(
            $term,
            $page,
            $limit,
            $contentTypes,
            $contentStatuses,
            $orderByColumn,
            $orderByDirection,
            $dateTimeCutoff
        );

        return $query;
    }

    /** Count all the matches
     *
     * @param string|null $term
     * @param null $contentType
     * @return int
     */
    public function countTotalResults(
        $term,
        $contentType = null,
        $contentStatus = null,
        $dateTimeCutoff = null
    ) {

        $alias = 'p';
        $query = $this->createQueryBuilder($alias);
        $query->select('count(p.id)');
        $query->where($alias . '.brand IN (:brands)')
            ->andWhere(
                $query->expr()
                    ->orX(
                        $query->expr()
                            ->gt('MATCH_AGAINST(' . $alias . '.highValue, :searchterm)', 0),
                        $query->expr()
                            ->gt('MATCH_AGAINST(' . $alias . '.mediumValue, :searchterm)', 0),
                        $query->expr()
                            ->gt('MATCH_AGAINST(' . $alias . '.lowValue, :searchterm)', 0)
                    )
            )
            ->setParameter('searchterm', implode(' +', explode(' ', $term)))
            ->setParameter('brands', array_values(array_wrap(ConfigService::$availableBrands)));

        if (!empty($contentTypes)) {
            $query->andWhere($alias . '.content_type IN (:contentTypes)')
                ->setParameter('contentTypes', $contentType);
        }

        if (!empty($contentStatuses)) {
            $query->andWhere($alias . '.content_status IN (:contentStatuses)')
                ->setParameter('contentStatuses', $contentStatus);
        }

        if (!empty($dateTimeCutoff)) {
            $query->where($alias . '.contentPublishedOn > :dateTimeCutoff')
                ->setParameter('dateTimeCutoff', $dateTimeCutoff);
        }

        return $query->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param $term
     * @param $page
     * @param $limit
     * @param $contentTypes
     * @param $contentStatuses
     * @param $orderByColumn
     * @param $orderByDirection
     * @param $dateTimeCutoff
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function prepareQb(
        $term,
        $page,
        $limit,
        $contentTypes,
        $contentStatuses,
        $orderByColumn,
        $orderByDirection,
        $dateTimeCutoff
    )
    : \Doctrine\ORM\QueryBuilder {

        $first = ($page - 1) * $limit;
        $alias = 'p';

        $query = $this->createQueryBuilder($alias);

        $query->select('IDENTITY(p.content)');
        $query->addSelect(
            "(MATCH_AGAINST(" .
            $alias .
            ".highValue, :searchterm 'IN BOOLEAN MODE')*18 *(UNIX_TIMESTAMP(" .
            $alias .
            ".contentPublishedOn)/1000000000)  +  (MATCH_AGAINST(" .
            $alias .
            ".mediumValue, :searchterm 'IN BOOLEAN MODE')*2) + (MATCH_AGAINST(" .
            $alias .
            ".lowValue, :searchterm 'IN BOOLEAN MODE')) ) as HIDDEN score "
        )
            ->where($alias . '.brand IN (:brands)')
            ->andWhere(
                $query->expr()
                    ->orX(
                        $query->expr()
                            ->gt('MATCH_AGAINST(' . $alias . '.highValue, :searchterm)', 0),
                        $query->expr()
                            ->gt('MATCH_AGAINST(' . $alias . '.mediumValue, :searchterm)', 0),
                        $query->expr()
                            ->gt('MATCH_AGAINST(' . $alias . '.lowValue, :searchterm)', 0)
                    )
            )
            ->setParameter('searchterm', implode(' +', explode(' ', $term)))
            ->setParameter('brands', array_values(array_wrap(ConfigService::$availableBrands)))
            ->orderBy($orderByColumn, $orderByDirection)
            ->setMaxResults($limit)
            ->setFirstResult($first);

        if (!empty($contentTypes)) {
            $query->andWhere($alias . '.contentType IN (:contentTypes)')
                ->setParameter('contentTypes', $contentTypes);
        }

        if (!empty($contentStatuses)) {
            $query->andWhere($alias . '.contentStatus IN (:contentStatuses)')
                ->setParameter('contentStatuses', $contentStatuses);
        }

        if (!empty($dateTimeCutoff)) {
            $query->where($alias . '.contentPublishedOn > :dateTimeCutoff')
                ->setParameter('dateTimeCutoff', $dateTimeCutoff);
        }

        return $query;
    }
}