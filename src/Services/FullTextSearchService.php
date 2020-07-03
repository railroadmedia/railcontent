<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\NonUniqueResultException;
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
     * @var ElasticService
     */
    private $elasticService;

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
        ContentService $contentService,
        ElasticService $elasticService
    ) {
        $this->entityManager = $entityManager;
        $this->contentService = $contentService;
        $this->elasticService = $elasticService;

        $this->fullTextSearchRepository = $this->entityManager->getRepository(SearchIndex::class);
    }

    /** Full text search by term
     *
     * @param $term
     * @param int $page
     * @param int $limit
     * @param array $contentTypes
     * @param array $contentStatuses
     * @param string $sort
     * @param null $dateTimeCutoff
     * @param null $brands
     * @return array
     * @throws NonUniqueResultException
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
        ContentRepository::$bypassPermissions = true;

        $orderByDirection = substr($sort, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($sort, '-');

        $oldBrands = config('railcontent.available_brands');

        if (empty($contentStatuses)) {
            $contentStatuses = ContentRepository::$availableContentStatues;
        }

        if (!empty($brands)) {
            config(['railcontent.available_brands' => $brands]);
        }

        $customPagination = [];

        if (config('railcontent.useElasticSearch') == true) {

            $elasticData = $this->elasticService->search(
                $term,
                $page,
                $limit,
                $contentTypes,
                $contentStatuses,
                $orderByColumn,
                $orderByDirection,
                $dateTimeCutoff
            );

            $totalResults = $elasticData->getTotalHits();

            $contentIds = [];
            foreach ($elasticData->getResults() as $elData) {
                $contentIds[] = $elData->getData()['id'];
            }
        } else {
            $term = $output = preg_replace(
                '!\s+!',
                ' ',
                trim(
                    preg_replace("/[^a-zA-Z0-9\\s\/]+/", "", $term)
                )
            );
            $term = str_replace('/', '_', $term);

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

            $totalResults = $this->fullTextSearchRepository->countTotalResults(
                $term,
                $contentTypes,
                $contentStatuses,
                $dateTimeCutoff
            );
        }

        $contents = $this->contentService->getByIds($contentIds);
        $return = [
            'results' => $contents,
            'total_results' => $totalResults,
            'custom_pagination' => [
                'total' => $totalResults,
                'count' => count($contents),
                'per_page' => $limit,
                'current_page' => $page,
                'total_pages' => ceil($totalResults / $limit),
                'links' => [],
            ],
            // 'qb' => $qb->addSelect('p'),
        ];
        config(['railcontent.available_brands' => $oldBrands]);

        return $return;
    }
}