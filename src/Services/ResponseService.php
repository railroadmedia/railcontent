<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\QueryBuilder;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;
use Railroad\Doctrine\Services\FractalResponseService;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Serializer\OldStyleSerializer;
use Railroad\Railcontent\Transformers\ArrayTransformer;
use Railroad\Railcontent\Transformers\BooleanTransformer;
use Railroad\Railcontent\Transformers\CommentLikeOldStructureTransformer;
use Railroad\Railcontent\Transformers\CommentLikeTransformer;
use Railroad\Railcontent\Transformers\CommentOldStructureTransformer;
use Railroad\Railcontent\Transformers\CommentTransformer;
use Railroad\Railcontent\Transformers\ContentDataTransformer;
use Railroad\Railcontent\Transformers\ContentHierarchyTransformer;
use Railroad\Railcontent\Transformers\ContentLikeOldStructureTransformer;
use Railroad\Railcontent\Transformers\ContentLikeTransformer;
use Railroad\Railcontent\Transformers\ContentOldStructureTransformer;
use Railroad\Railcontent\Transformers\ContentPermissionTransformer;
use Railroad\Railcontent\Transformers\DecoratedContentTransformer;
use Railroad\Railcontent\Transformers\PermissionTransformer;
use Railroad\Railcontent\Transformers\UserPermissionTransformer;
use Spatie\Fractal\Fractal;

class ResponseService extends FractalResponseService
{
    public static $oldResponseStructure = true;

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
        array $filterOptions = []
    ) {

        if (self::$oldResponseStructure) {
            $filters = [];
            foreach ($filterOptions as $key => $filterOption) {
                foreach ($filterOption as $key2 => $filter) {
                    if ($filter instanceof Content) {
                        $transformer = new ContentOldStructureTransformer();
                        $filterOption[$key2] = $transformer->transform($filter);
                    }
                }
                $filters[$key] = $filterOption;
            }

            return self::create(
                $entityOrEntities,
                'content',
                new ContentOldStructureTransformer(),
                new OldStyleSerializer(),
                $queryBuilder
            )
                ->addMeta((count($filters) > 0) ? ['filterOptions' => $filters] : []);
        }

        return self::create(
            $entityOrEntities,
            'content',
            new DecoratedContentTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes)
            ->addMeta((count($filterOptions) > 0) ? ['filterOption' => $filterOptions] : []);
    }

    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function permission($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
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
            $entityOrEntities,
            'shows',
            new ArrayTransformer(),
            new DataArraySerializer(),
            $queryBuilder
        );
    }
}