<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Carbon\Carbon;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Entities\UserPermission;
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
                        config('railcontent.table_prefix') . 'content' . '.status',
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
                        config('railcontent.table_prefix') . 'content' . '.publishedOn',
                        ':published'
                    )
            )
                ->setParameter('published', Carbon::now());
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $this->andWhere(
            config('railcontent.table_prefix') . 'content' . '.brand IN (:brands)'
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
            $this->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $typesToInclude);
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
            $this->join(UserContentProgress::class, 'p', 'WITH', 'railcontent_content.id = p.content');
            $this->andWhere('p.state IN (:states)')
                ->andWhere('p.user = :user')
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
                    '  (:value'.$index.')'
                )
                    ->setParameter('value'.$index, $requiredFieldData['value']);
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
                        'p'
                    )
                        ->andWhere('p '.$requiredFieldData['operator'] .' (:value'.$index.')')
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
                        'p' . $index
                    );
                    $conditions['p' . $index] = $requiredFieldData['value'];
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
            )->setParameter('brand', config('railcontent.brand'));

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
                                        ->gte('user_permission.expirationDate', ':expirationDateOrNow')
                                )
                        )

                )
        )
            ->setParameter(
                'expirationDateOrNow',
                Carbon::now()
            )
            ->setParameter('brand', config('railcontent.brand'))
            ->setParameter(
                'user',
                app()
                    ->make(UserProviderInterface::class)
                    ->getUserById(auth()->id() ?? 0)
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
        $this->andWhere($param . ' IN (:values)')
            ->setParameter('values', $values);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictByFilterOptions()
    {
        foreach (config('railcontent.field_option_list', []) as $requiredFieldData) {
            if (in_array(
                $requiredFieldData,
                $this->getEntityManager()
                    ->getClassMetadata(Content::class)
                    ->getAssociationNames()
            )) {
                $this->addSelect($requiredFieldData);
                $this->leftJoin(
                    config('railcontent.table_prefix') .
                    'content' .
                    '.' .
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getFieldName($requiredFieldData),
                    $requiredFieldData
                );
            }
        }

        return $this;
    }
}