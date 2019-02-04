<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\QueryBuilder;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;
use Railroad\Doctrine\Services\FractalResponseService;
use Railroad\Railcontent\Transformers\CommentLikeTransformer;
use Railroad\Railcontent\Transformers\CommentTransformer;
use Railroad\Railcontent\Transformers\ContentHierarchyTransformer;
use Railroad\Railcontent\Transformers\ContentPermissionTransformer;
use Railroad\Railcontent\Transformers\ContentTransformer;
use Railroad\Railcontent\Transformers\PermissionTransformer;
use Spatie\Fractal\Fractal;

class ResponseService extends FractalResponseService
{
    /**
     * @param $entityOrEntities
     * @param QueryBuilder|null $queryBuilder
     * @param array $includes
     * @return Fractal
     */
    public static function content($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        return self::create(
            $entityOrEntities,
            'content',
            new ContentTransformer(),
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
    public static function contentArray($entityOrEntities, QueryBuilder $queryBuilder = null, array $includes = [])
    {
        return self::create(
            $entityOrEntities,
            'content',
            new ContentTransformer(),
            new ArraySerializer(),
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
        return self::create(
            $entityOrEntities,
            'commentlike',
            new CommentLikeTransformer(),
            new JsonApiSerializer(),
            $queryBuilder
        )
            ->parseIncludes($includes);
    }
}