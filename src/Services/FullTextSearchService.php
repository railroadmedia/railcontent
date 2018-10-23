<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\FullTextSearchRepository;

class FullTextSearchService
{
    /**
     * @var FullTextSearchRepository
     */
    protected $fullTextSearchRepository;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * FullTextSearchService constructor.
     *
     * @param FullTextSearchRepository $fullTextSearchRepository
     * @param ContentService $contentService
     */
    public function __construct(
        FullTextSearchRepository $fullTextSearchRepository,
        ContentService $contentService
    )
    {
        $this->fullTextSearchRepository = $fullTextSearchRepository;
        $this->contentService = $contentService;
    }

    /** Full text search by term
     *
     * @param string $term
     * @param int $page
     * @param int $limit
     * @param array $contentTypes
     * @param array $contentStatuses
     * @param string $sort
     * @param null $dateTimeCutoff
     * @param null $brands
     * @return array|null
     * @internal param null $brand
     */
    public function search(
        $term,
        $page = 1,
        $limit = 10,
        $contentTypes = [],
        $contentStatuses = [],
        $sort = '-score',
        $dateTimeCutoff = null,
        $brands = null
    )
    {
        $term = $output = preg_replace(
            '!\s+!',
            ' ',
            trim(
                preg_replace("/[^a-zA-Z0-9\\s\/]+/", "", $term)
            )
        );
        $term = str_replace('/', '_', $term);

        $orderByDirection = substr($sort, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($sort, '-');

        $oldBrands = ConfigService::$availableBrands;

        if(empty($contentStatuses)){
            $contentStatuses = ContentRepository::$availableContentStatues;
        }

        if (!empty($brands)) {
            ConfigService::$availableBrands = $brands;
        }

        $return = [
            'results' => $this->contentService->getByIds(
                $this->fullTextSearchRepository->search(
                    $term,
                    $page,
                    $limit,
                    $contentTypes,
                    $contentStatuses,
                    $orderByColumn,
                    $orderByDirection,
                    $dateTimeCutoff
                )
            ),
            'total_results' => $this->fullTextSearchRepository->countTotalResults(
                $term,
                $contentTypes,
                $contentStatuses,
                $dateTimeCutoff
            )
        ];

        ConfigService::$availableBrands = $oldBrands;

        return $return;
    }
}