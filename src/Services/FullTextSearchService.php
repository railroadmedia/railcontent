<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Entities\SearchIndex;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
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
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * FullTextSearchService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param ContentService $contentService
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        ContentService $contentService
    ) {
        $this->entityManager = $entityManager;
        $this->contentService = $contentService;

        $this->fullTextSearchRepository = $this->entityManager->getRepository(SearchIndex::class);
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
    ) {
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

        $oldBrands = config('railcontent.available_brands');

        if (empty($contentStatuses)) {
            $contentStatuses = ContentRepository::$availableContentStatues;
        }

        if (!empty($brands)) {
            config(['railcontent.available_brands' => $brands]);
        }

        $qb = $this->fullTextSearchRepository->search(
            $term,
            $page,
            $limit,
            $contentTypes,
            $contentStatuses,
            $orderByColumn,
            $orderByDirection,
            $dateTimeCutoff
        );

        $results =
            $qb->getQuery()
                ->getResult();

        $contentIds = array_flatten(array_values($results));

        $return = [
            'results' => $this->contentService->getByIds($contentIds),
            'total_results' => $this->fullTextSearchRepository->countTotalResults(
                $term,
                $contentTypes,
                $contentStatuses,
                $dateTimeCutoff
            ),
            'qb' => $qb->addSelect('p'),
        ];
        config(['railcontent.available_brands' => $oldBrands]);

        return $return;
    }
}