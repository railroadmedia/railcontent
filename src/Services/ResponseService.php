<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\QueryBuilder;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;
use Railroad\Doctrine\Services\FractalResponseService;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Serializer\OldStylePaginatorAdapter;
use Railroad\Railcontent\Serializer\OldStyleSerializer;
use Railroad\Railcontent\Serializer\OldStyleWithoutDataForArraySerializer;
use Railroad\Railcontent\Serializer\OldStyleWithoutDataSerializer;
use Railroad\Railcontent\Transformers\BooleanTransformer;
use Railroad\Railcontent\Transformers\CommentLikeOldStructureTransformer;
use Railroad\Railcontent\Transformers\CommentLikeTransformer;
use Railroad\Railcontent\Transformers\CommentOldStructureTransformer;
use Railroad\Railcontent\Transformers\CommentTransformer;
use Railroad\Railcontent\Transformers\ContentDataTransformer;
use Railroad\Railcontent\Transformers\ContentDataWithPostOldStructureTransformer;
use Railroad\Railcontent\Transformers\ContentFollowOldStructureTransformer;
use Railroad\Railcontent\Transformers\ContentFollowTransformer;
use Railroad\Railcontent\Transformers\ContentHierarchyOldStructureTransformer;
use Railroad\Railcontent\Transformers\ContentHierarchyTransformer;
use Railroad\Railcontent\Transformers\ContentLikeOldStructureTransformer;
use Railroad\Railcontent\Transformers\ContentLikeTransformer;
use Railroad\Railcontent\Transformers\ContentOldStructureTransformer;
use Railroad\Railcontent\Transformers\ContentPermissionOldStructureTransformer;
use Railroad\Railcontent\Transformers\ContentPermissionTransformer;
use Railroad\Railcontent\Transformers\ContentStatsTransformer;
use Railroad\Railcontent\Transformers\ContentTransformer;
use Railroad\Railcontent\Transformers\DecoratedContentTransformer;
use Railroad\Railcontent\Transformers\FilterOptionsTransformer;
use Railroad\Railcontent\Transformers\PacksTransformer;
use Railroad\Railcontent\Transformers\PermissionOldStructureTransformer;
use Railroad\Railcontent\Transformers\PermissionTransformer;
use Railroad\Railcontent\Transformers\ShowsTransformer;
use Railroad\Railcontent\Transformers\UserPermissionOldStructureTransformer;
use Railroad\Railcontent\Transformers\UserPermissionTransformer;
use Spatie\Fractal\Fractal;

class ResponseService extends FractalResponseService
{
    public static $oldResponseStructure = false;

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @param array $filterOptions
     * @return Fractal
     */
    public static function content(
        $entityOrEntities,
        QueryBuilder $queryBuilder = null,
        array $includes = [],
        array $filterOptions = [],
        array $customPaginator = [],
        array $activeFilters = [],
        $withoutDataSerialization = false
    ) {
        $activFilters = [];
        foreach ($activeFilters as $key => $filterOption) {
            $activFilters[$key] = $filterOption;
            foreach ($filterOption as $key2 => $filter) {
                if ($filter instanceof Content) {
                    $arrayValue = Fractal::create()
                        ->item($filter)
                        ->transformWith(ContentOldStructureTransformer::class)
                        ->serializeWith(OldStyleWithoutDataForArraySerializer::class)
                        ->toArray();
                    $activFilters[$key][$key2] = $arrayValue;
                } elseif (is_string($filter) && (!mb_check_encoding($filter))) {
                    $activFilters[$key][$key2] = utf8_encode($filter);
                }
            }

        }

        if (self::$oldResponseStructure) {
            $filters = [];
            foreach ($filterOptions as $key => $filterOption) {
                foreach ($filterOption as $key2 => $filter) {
                    if ($filter instanceof Content) {
                        $arrayValue = Fractal::create()
                            ->item($filter)
                            ->transformWith(ContentOldStructureTransformer::class)
                            ->serializeWith(OldStyleWithoutDataForArraySerializer::class)
                            ->toArray();
                        $filterOption[$key2] = $arrayValue;
                    } elseif (is_string($filter) && (!mb_check_encoding($filter))) {
                        $filterOption[$key2] = utf8_encode($filter);
                    }
                }

                $filters[$key] = $filterOption;
            }

            return self::create(
                $entityOrEntities,
                'content',
                new ContentOldStructureTransformer(),
                ($withoutDataSerialization) ? new OldStyleWithoutDataSerializer() : new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes)
                ->addMeta(
                    array_merge(
                        ($queryBuilder) ? [
                            'limit' => $queryBuilder->getMaxResults(),
                            'page' => (($queryBuilder->getFirstResult() / $queryBuilder->getMaxResults()) + 1),
                        ] : ((!empty($customPaginator)) ? [
                            'limit' => $customPaginator['per_page'],
                            'page' => $customPaginator['current_page'],
                            'totalResults' => $customPaginator['total'],
                        ] : []),
                        (count($filters) > 0) ? ['filterOptions' => $filters] : [],
                        (count($activFilters) > 0) ? ['activeFilters' => $activFilters] : [],
                    )
                );
        }

        $filters = [];
        foreach ($filterOptions as $key => $filterOption) {
            foreach ($filterOption as $key2 => $filter) {
                if ($filter instanceof Content) {
                    $transformer = new ContentTransformer();
                    $arrayValue = $transformer->transform($filter);
                    $filterOption[$key2] = $arrayValue;
                } elseif (is_string($filter) && (!mb_check_encoding($filter))) {
                    $filterOption[$key2] = utf8_encode($filter);
                }
            }
            $filters[$key] = $filterOption;
        }

        return self::create(
            $entityOrEntities,
            'content',
            new DecoratedContentTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes)
            ->addMeta(
                array_merge(
                    (count($filterOptions) > 0) ? ['filterOptions' => $filters] : [],
                    (count($activFilters) > 0) ? ['activeFilters' => $activFilters] : [],
                    (count($customPaginator) > 0) ? ['pagination' => $customPaginator] : []
                )
            );
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function permission($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'permission',
                new PermissionOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }
        return self::create(
            $entityOrEntities,
            'permission',
            new PermissionTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function contentPermission($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'contentPermission',
                new ContentPermissionOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }

        return self::create(
            $entityOrEntities,
            'contentPermission',
            new ContentPermissionTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function contentHierarchy($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'contentHierarchy',
                new ContentHierarchyOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }

        return self::create(
            $entityOrEntities,
            'contentHierarchy',
            new ContentHierarchyTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function comment($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'comment',
                new CommentOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }

        return self::create(
            $entityOrEntities,
            'comment',
            new CommentTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function commentLike($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'commentlike',
                new CommentLikeOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }

        return self::create(
            $entityOrEntities,
            'commentlike',
            new CommentLikeTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function contentData($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'contentData',
                new ContentDataWithPostOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }
        return self::create(
            $entityOrEntities,
            'contentData',
            new ContentDataTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function userPermission($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'userPermission',
                new UserPermissionOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }

        return self::create(
            $entityOrEntities,
            'userPermission',
            new UserPermissionTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function userContentProgress(
        $entityOrEntities,
        QueryBuilder $queryBuilder = null,
        array $includes = []
    ) {
        return self::create(
            $entityOrEntities,
            'userContentProgress',
            new UserPermissionTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function contentLike($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'contentlike',
                new ContentLikeOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }

        return self::create(
            $entityOrEntities,
            'contentlike',
            new ContentLikeTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function shows($entityOrEntities, QueryBuilder $queryBuilder = null)
    {
        return self::create(
            [$entityOrEntities],
            'shows',
            new ShowsTransformer(),
            new OldStyleWithoutDataForArraySerializer(),
            $queryBuilder
        );
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function contentStats($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {

        return self::create(
            $entityOrEntities,
            'contentStats',
            new ContentStatsTransformer(),
            new DataArraySerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function filtersOptions($entityOrEntities, QueryBuilder $queryBuilder = null)
    {
        return self::create(
            $entityOrEntities,
            'filterOptions',
            new FilterOptionsTransformer(),
            new DataArraySerializer(),
            $queryBuilder
        );
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function packsArray($entityOrEntities, QueryBuilder $queryBuilder = null)
    {
        return self::create(
            $entityOrEntities,
            'pack',
            new PacksTransformer(),
            new OldStyleWithoutDataForArraySerializer(),
            $queryBuilder
        );
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function packs($entityOrEntities, QueryBuilder $queryBuilder = null)
    {
        return self::create(
            $entityOrEntities,
            'pack',
            new ContentOldStructureTransformer(),
            new OldStyleWithoutDataForArraySerializer(),
            $queryBuilder
        );
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function contentFollow($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        if (self::$oldResponseStructure) {
            return self::create(
                $entityOrEntities,
                'contentFollow',
                new ContentFollowOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->parseIncludes($includes);
        }

        return self::create(
            $entityOrEntities,
            'contentFollow',
            new ContentFollowTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }

}
