<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\QueryBuilder;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;
use Railroad\Doctrine\Services\FractalResponseService;
use Railroad\Railcontent\Transformers\ContentTransformer;
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
        return self::create($entityOrEntities, 'content', new ContentTransformer(), new JsonApiSerializer(), $queryBuilder)
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
        return self::create($entityOrEntities, 'content', new ContentTransformer(), new ArraySerializer(), $queryBuilder)
            ->parseIncludes($includes);
    }
}