<?php
namespace Railroad\Railcontent\Serializer;

use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\DataArraySerializer;

class OldStyleSerializer extends DataArraySerializer
{
    /**
     * @param $transformedData
     * @param $includedData
     * @return array
     */
    public function mergeIncludes($transformedData, $includedData)
    {
        $includedData = array_map(function ($include) {
            return $include['data'];
        }, $includedData);

        return parent::mergeIncludes($transformedData, $includedData);
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