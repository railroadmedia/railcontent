<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Carbon\Carbon;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentFollows;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Entities\UserPlaylistContent;
use Railroad\Railcontent\Repositories\ContentRepository;

class ContentQueryBuilder extends FromRequestRailcontentQueryBuilder
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

        $this->join(ContentHierarchy::class, 'hierarchy', 'WITH', 'railcontent_content.id = hierarchy.child');
        $this->join(Content::class, 'inherited_content_', 'WITH', 'hierarchy.parent = inherited_content_.id');
        $this->andWhere('inherited_content_.slug IN (:slugs)')
            ->setParameter('slugs', $slugHierarchy);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictStatuses()
    {
        if (is_array(ContentRepository::$availableContentStatues)) {
            $this->andWhere(
                $this->expr()
                    ->in(
                        config('railcontent.table_prefix').'content'.'.status',
                        ContentRepository::$availableContentStatues
                    )
            );
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictPublishedOnDate()
    {
        if (!ContentRepository::$pullFutureContent) {
            $this->add(
                'where',
                $this->expr()
                    ->lte(
                        config('railcontent.table_prefix').'content'.'.publishedOn',
                        'CURRENT_TIMESTAMP()'
                    )
            );
        }

        if (ContentRepository::$getFutureContentOnly) {
            $this->andWhere(
                $this->expr()
                    ->gt(
                        config('railcontent.table_prefix').'content'.'.publishedOn',
                        'CURRENT_TIMESTAMP()'
                    )
            );
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $this->andWhere(
            config('railcontent.table_prefix').'content'.'.brand IN (:brands)'
        )
            ->setParameter('brands', array_values(array_wrap(config('railcontent.available_brands'))));

        return $this;
    }

    /**
     * @param array $typesToInclude
     * @return $this
     */
    public function restrictByTypes(array $typesToInclude)
    {
        if (!empty($typesToInclude)) {
            $this->andWhere(config('railcontent.table_prefix').'content'.'.type IN (:types)')
                ->setParameter('types', $typesToInclude);
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

        $this->join(ContentHierarchy::class, 'ph', 'WITH', 'railcontent_content.id = ph.child');
        $this->andWhere('ph.parent IN (:parentIds)')
            ->setParameter('parentIds', $parentIds);

        return $this;
    }

    /**
     * @param array $requiredUserStates
     * @return $this
     */
    public function restrictByUserStates(array $requiredUserStates)
    {
        if (empty($requiredUserStates)) {
            return $this;
        }

        foreach ($requiredUserStates as $index => $requiredUserState) {
            $this->join(config('railcontent.table_prefix').'content'.'.userProgress', 'progress')
                ->andWhere('progress.state IN (:states)')
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
                        'pu.state  = '.
                        $this->expr()
                            ->literal($includedUserState['state']).
                        ' AND pu.user = '.
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
        if (empty($requiredFields)) {
            return $this;
        }

        foreach ($requiredFields as $index => $requiredFieldData) {
            $fieldName = $requiredFieldData['name'];
            if (strpos($requiredFieldData['name'], '_') !== false ||
                strpos($requiredFieldData['name'], '-') !== false) {
                $fieldName = camel_case($requiredFieldData['name']);
            }

            if (in_array(
                $fieldName,
                $this->getEntityManager()
                    ->getClassMetadata(Content::class)
                    ->getFieldNames()
            )) {
                if ($fieldName == 'isCoach') {
                    $this->andWhere(
                        'railcontent_content'.'.'.$fieldName.' '.$requiredFieldData['operator'].'  :value'.$index.''
                    )
                        ->setParameter('value'.$index, (int)$requiredFieldData['value']);
                } else {
                    $likeOp = ($requiredFieldData['operator'] == 'like')?'%':'';
                    $this->andWhere(
                        config('railcontent.table_prefix').
                        'content'.
                        '.'.
                        $fieldName.
                        ' '.
                        $requiredFieldData['operator'].
                        '  :value'.
                        $index.
                        ''
                    )
                        ->setParameter('value'.$index, $likeOp.$requiredFieldData['value'].$likeOp);
                }
            } else {
                if($fieldName == 'instructor'){
                    $fieldName = 'contentInstructors';
                }
                if (in_array(
                    $fieldName,
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getAssociationNames()
                )) {
                    $this->join(
                        config('railcontent.table_prefix').
                        'content'.
                        '.'.
                        $this->getEntityManager()
                            ->getClassMetadata(Content::class)
                            ->getFieldName($fieldName),
                        'pf'.$index
                    )
                        ->andWhere(
                            'pf'.
                            $index.
                            '.'.
                            $requiredFieldData['name'].
                            $requiredFieldData['operator'].
                            ' (:value'.
                            $index.
                            ')'
                        )
                        ->setParameter('value'.$index, $requiredFieldData['value']);
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
                $conditions[config('railcontent.table_prefix').'content'.'.'.$requiredFieldData['name']] =
                    [$requiredFieldData['value']];
            } else {
                if (in_array(
                    $requiredFieldData['name'],
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getAssociationNames()
                )) {
                    $this->join(
                        config('railcontent.table_prefix').
                        'content'.
                        '.'.
                        $this->getEntityManager()
                            ->getClassMetadata(Content::class)
                            ->getFieldName($requiredFieldData['name']),
                        'ipf'.$index
                    );
                    $conditions['ipf'.$index.'.'.$requiredFieldData['name']] = [$requiredFieldData['value']];
                } elseif ($requiredFieldData['name'] == 'instructor') {
                    $this->join(
                        config('railcontent.table_prefix').'content'.'.contentInstructors',
                        'ipf'.$index
                    );
                    $conditions['ipf'.$index.'.instructor'] =
                        is_array($requiredFieldData['value']) ? $requiredFieldData['value'] :
                            [$requiredFieldData['value']];
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
                            $key.' IN ('.implode(",", $value).')'
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
                $this->expr()
                    ->andX(
                        $this->expr()
                            ->eq('content_permission.permission', 'user_permission.permission'),

                        $this->expr()
                            ->eq('user_permission.user', ':user')
                    )
            );

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
            ->restrictBrand()
            ->restrictByPermissions();

        return $this;
    }

    /**
     * @param $param
     * @param $values
     * @return $this
     */
    public function whereIn($param, $values)
    {
        $this->andWhere($param.' IN (:values)')
            ->setParameter('values', $values);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictByFilterOptions()
    {
        //TODO:   verify in results that at list one filter exists
        foreach (config('railcontent.field_option_list', []) as $requiredFieldData) {
            if (in_array(
                $requiredFieldData,
                $this->getEntityManager()
                    ->getClassMetadata(Content::class)
                    ->getAssociationNames()
            )) {
                $this->addSelect($requiredFieldData);
                $this->leftJoin(
                    config('railcontent.table_prefix').
                    'content'.
                    '.'.
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getFieldName($requiredFieldData),
                    $requiredFieldData
                );
            }
        }

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

        $this->join(UserPlaylistContent::class, 'upc', 'WITH', 'railcontent_content.id = upc.content');
        $this->andWhere('upc.userPlaylist IN (:userPlaylistIds)')
            ->setParameter('userPlaylistIds', $userPlaylistIds);

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
                $this->orderBy('railcontent_content.publishedOn', 'desc');

                break;
            case 'oldest':
                $this->orderBy('railcontent_content.publishedOn', 'asc');

                break;
            case 'popularity':
                $this->leftJoin(
                    UserContentProgress::class,
                    'user_progress',
                    'WITH',
                    'railcontent_content.id = user_progress.content'
                );

                $this->groupBy('railcontent_content.id');
                $this->orderBy('COUNT(user_progress)', 'desc');

                break;

            case 'trending':
                $this->leftJoin(
                    UserContentProgress::class,
                    'user_progress',
                    'WITH',
                    $this->expr()
                        ->andX(
                            'railcontent_content.id = user_progress.content',
                            'user_progress.updatedOn >= :lastWeek'
                        )
                );
                $this->setParameter(
                    'lastWeek',
                    Carbon::now()
                        ->subWeek(1)
                );
                $this->groupBy('railcontent_content.id');
                $this->orderBy('COUNT(user_progress)', 'desc');

                break;
            case 'relevance':
                //TODO
                break;
            case 'title':
                $this->orderBy('railcontent_content.title', 'asc');

                break;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictFollowedContent()
    {
        $this->join(ContentFollows::class, 'cf', 'WITH',
                    $this->expr()
                        ->andX(
                            $this->expr()
                                ->eq('railcontent_content.id', 'cf.content'),

                            $this->expr()
                                ->eq('cf.user', ':user')
                        )
        )
        ->setParameter('user', auth()->id());

        return $this;
    }
}
