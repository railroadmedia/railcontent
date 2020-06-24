<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Carbon\Carbon;
use Elastica\Aggregation\DateRange;
use Elastica\Query;
use Elastica\Query\Terms;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Entities\UserPlaylistContent;
use Railroad\Railcontent\Repositories\ContentRepository;

use Elastica\Query\Match;

class ElasticQueryBuilder extends \Elastica\Query
{
    /**
     * @param array $slugHierarchy
     * @return $this
     */
    public function restrictBySlugHierarchy(array $slugHierarchy)
    {
        if (empty($slugHierarchy)) {
            return $this;
        }
        //TODO
        //        $this->join(ContentHierarchy::class, 'hierarchy', 'WITH', 'railcontent_content.id = hierarchy.child');
        //        $this->join(Content::class, 'inherited_content_', 'WITH', 'hierarchy.parent = inherited_content_.id');
        //        $this->andWhere('inherited_content_.slug IN (:slugs)')
        //            ->setParameter('slugs', $slugHierarchy);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictStatuses()
    {
        if (is_array(ContentRepository::$availableContentStatues)) {
            $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
            $termsQuery = new Terms('status', ContentRepository::$availableContentStatues);

            $query->addMust($termsQuery);

            $this->setQuery($query);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictPublishedOnDate()
    {
        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();

        if (!ContentRepository::$pullFutureContent) {

            $range = new \Elastica\Query\Range();
            $range->addField('published_on.date', ['lte' => 'now']);

            $query->addMust($range);

            $this->setQuery($query);
        }

        if (ContentRepository::$getFutureContentOnly) {
            $range = new \Elastica\Query\Range();
            $range->addField('published_on.date', ['gt' => 'now']);

            $query->addMust($range);

            $this->setQuery($query);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $termsQuery = new Terms('brand', array_values(array_wrap(config('railcontent.available_brands'))));

        $query->addMust($termsQuery);

        $this->setQuery($query);

        return $this;
    }

    /**
     * @param array $typesToInclude
     * @return $this
     */
    public function restrictByTypes(array $typesToInclude)
    {
        if (!empty($typesToInclude)) {
            $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
            $termsQuery = new Terms('content_type', $typesToInclude);

            $query->addMust($termsQuery);

            $this->setQuery($query);
        }

        return $this;
    }

    /**
     * @param array $parentIds
     * @return $this
     */
    public function restrictByParentIds(array $parentIds)
    {
        if (empty($parentIds)) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $termsQuery = new Terms('parent_id', $parentIds);

        $query->addMust($termsQuery);

        $this->setQuery($query);

        return $this;
    }

    /**
     * @param array $requiredUserStates
     * @return $this
     */
    public function restrictByUserStates(array $requiredUserStates)
    {
        //TODO
        if (empty($requiredUserStates)) {
            return $this;
        }

        foreach ($requiredUserStates as $index => $requiredUserState) {
            $this->andWhere('progress.state IN (:states)')
                ->andWhere('progress.user = :user')
                ->setParameter('states', $requiredUserState['state'])
                ->setParameter('user', $requiredUserState['user']);
        }
        return $this;
    }

    /**
     * @param array $includedUserStates
     * @return $this
     */
    public function includeByUserStates(array $includedUserStates)
    {
        //TODO
        if (empty($includedUserStates)) {
            return $this;
        }
        $this->join(UserContentProgress::class, 'pu', 'WITH', 'railcontent_content.id = pu.content');
        $orX =
            $this->expr()
                ->orX();
        foreach ($includedUserStates as $includedUserState) {
            $condition =
                $this->expr()
                    ->andX(
                        'pu.state  = ' .
                        $this->expr()
                            ->literal($includedUserState['state']) .
                        ' AND pu.user = ' .
                        $includedUserState['user']
                    );

            $orX->add($condition);
        }
        $this->andWhere($orX);

        return $this;
    }

    /**
     * @param array $requiredFields
     * @return $this
     */
    public function restrictByFields(array $requiredFields)
    {
        //TODO
        if (empty($requiredFields)) {
            return $this;
        }

        foreach ($requiredFields as $index => $requiredFieldData) {
            if (in_array(
                $requiredFieldData['name'],
                $this->getEntityManager()
                    ->getClassMetadata(Content::class)
                    ->getFieldNames()
            )) {
                $this->andWhere(
                    config('railcontent.table_prefix') .
                    'content' .
                    '.' .
                    $requiredFieldData['name'] .
                    ' ' .
                    $requiredFieldData['operator'] .
                    '  (:value' .
                    $index .
                    ')'
                )
                    ->setParameter('value' . $index, $requiredFieldData['value']);
            } else {
                if (in_array(
                    $requiredFieldData['name'],
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getAssociationNames()
                )) {
                    $this->join(
                        config('railcontent.table_prefix') .
                        'content' .
                        '.' .
                        $this->getEntityManager()
                            ->getClassMetadata(Content::class)
                            ->getFieldName($requiredFieldData['name']),
                        'pf' . $index
                    )
                        ->andWhere(
                            'pf' .
                            $index .
                            '.' .
                            $requiredFieldData['name'] .
                            $requiredFieldData['operator'] .
                            ' (:value' .
                            $index .
                            ')'
                        )
                        ->setParameter('value' . $index, $requiredFieldData['value']);
                }
            }
        }

        return $this;
    }

    /**
     * @param array $includedFields
     * @return $this
     */
    public function includeByFields(array $includedFields)
    {
        //TODO
        if (empty($includedFields)) {
            return $this;
        }

        $conditions = [];

        foreach ($includedFields as $index => $requiredFieldData) {
            if (in_array(
                $requiredFieldData['name'],
                $this->getEntityManager()
                    ->getClassMetadata(Content::class)
                    ->getFieldNames()
            )) {
                $conditions[config('railcontent.table_prefix') . 'content' . '.' . $requiredFieldData['name']] =
                    $requiredFieldData['value'];
            } else {
                if (in_array(
                    $requiredFieldData['name'],
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getAssociationNames()
                )) {
                    $this->join(
                        config('railcontent.table_prefix') .
                        'content' .
                        '.' .
                        $this->getEntityManager()
                            ->getClassMetadata(Content::class)
                            ->getFieldName($requiredFieldData['name']),
                        'ipf' . $index
                    );
                    $conditions['ipf' . $index] = $requiredFieldData['value'];
                }
            }
        }
        if (!empty($conditions)) {
            $orX =
                $this->expr()
                    ->orX();
            foreach ($conditions as $key => $value) {
                $condition =
                    $this->expr()
                        ->orX(
                            $key . ' IN (' . $value . ')'
                        );

                $orX->add($condition);
            }
            $this->andWhere($orX);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictByPermissions()
    {

        if (ContentRepository::$bypassPermissions === true) {
            return $this;
        }

        $this->leftJoin(
            ContentPermission::class,
            'content_permission',
            'WITH',
            $this->expr()
                ->andX(
                    $this->expr()
                        ->eq('content_permission.brand', ':brand'),
                    $this->expr()
                        ->orX(
                            $this->expr()
                                ->eq('railcontent_content.id', 'content_permission.content'),
                            $this->expr()
                                ->eq('railcontent_content.type', 'content_permission.contentType')
                        )
                )
        )
            ->leftJoin(
                UserPermission::class,
                'user_permission',
                'WITH',
                'content_permission.permission = user_permission.permission'
            )
            ->setParameter('brand', config('railcontent.brand'));

        $this->andWhere(
            $this->expr()
                ->orX(
                    $this->expr()
                        ->isNull('content_permission'),
                    $this->expr()
                        ->andX(
                            $this->expr()
                                ->eq('user_permission.user', ':user'),
                            $this->expr()
                                ->orX(
                                    $this->expr()
                                        ->isNull('user_permission.expirationDate'),
                                    $this->expr()
                                        ->gte('user_permission.expirationDate', 'CURRENT_TIMESTAMP()')
                                )
                        )

                )
        )
            ->setParameter('brand', config('railcontent.brand'))
            ->setParameter(
                'user',
                app()
                    ->make(UserProviderInterface::class)
                    ->getCurrentUser()
            );

        return $this;

    }

    /**
     * @return $this
     */
    public function restrictByUserAccess()
    {
        $this->restrictPublishedOnDate()
            ->restrictStatuses()
            ->restrictBrand();
//            ->restrictByPermissions();

        return $this;
    }



    /**
     * @param array $userPlaylistIds
     * @return $this
     */
    public function restrictByPlaylistIds(array $userPlaylistIds)
    {
        if (empty($userPlaylistIds)) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $termsQuery = new Terms('playlist_ids', $userPlaylistIds);

        $query->addFilter($termsQuery);

        $this->setQuery($query);

        return $this;
    }

    /**
     * @param $orderBy
     * @return $this
     */
    public function sortResults($orderBy)
    {
        switch ($orderBy) {
            case 'newest':
                $this->addSort(
                        [
                            'published_on' => [
                                'order' => 'desc',
                            ],
                        ]
                    );
                break;
            case 'oldest':
                $this->addSort(
                    [
                        'published_on' => [
                            'order' => 'asc',
                        ],
                    ]
                );

                break;
            case 'popularity':
                $this->addSort(
                        [
                            'all_progress_count' => [
                                'order' => 'desc',
                            ],
                        ]
                    );

                break;

            case 'trending':
                $this->addSort(
                    [
                        'last_week_progress_count' => [
                            'order' => 'desc',
                        ],
                    ]
                );

                break;
            case 'relevance':
                //TODO
                break;
        }

        return $this;
    }
}