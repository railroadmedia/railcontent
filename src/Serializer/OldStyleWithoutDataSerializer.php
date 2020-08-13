<?php
namespace Railroad\Railcontent\Serializer;

use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\DataArraySerializer;

class OldStyleWithoutDataSerializer extends DataArraySerializer
{
    /**
     * @param $transformedData
     * @param $includedData
     * @return array
     */
    public function mergeIncludes($transformedData, $includedData)
    {
        $includedData = array_map(function ($include) {
            return $include;
        }, $includedData);

        return parent::mergeIncludes($transformedData, $includedData);
    }

    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return $data[0];
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return $data;
    }

    /**
     * @param PaginatorInterface $paginator
     * @return array
     */
    public function paginator(PaginatorInterface $paginator)
    {
        $pagination = [
            'totalResults' => (int) $paginator->getTotal(),
            'limit' => (int) $paginator->getPerPage(),
            'page' => (int) $paginator->getCurrentPage(),
        ];

        return $pagination;
    }
}