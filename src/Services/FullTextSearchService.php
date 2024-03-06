<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\FullTextSearchRepository;
use Railroad\Railcontent\Repositories\QueryBuilders\ElasticQueryBuilder;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;

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
     * @var UserPermissionsRepository
     */
    private $userPermissionRepository;

    /**
     * @param FullTextSearchRepository $fullTextSearchRepository
     * @param ContentService $contentService
     * @param ElasticService $elasticService
     * @param UserPermissionsRepository $userPermissionsRepository
     */
    public function __construct(
        FullTextSearchRepository $fullTextSearchRepository,
        ContentService $contentService,
        ElasticService $elasticService,
        UserPermissionsRepository $userPermissionsRepository
    ) {
        $this->fullTextSearchRepository = $fullTextSearchRepository;
        $this->contentService = $contentService;
        $this->elasticService = $elasticService;
        $this->userPermissionRepository = $userPermissionsRepository;
    }

    /**
     * @param $term
     * @param int $page
     * @param int $limit
     * @param array $contentTypes
     * @param array $contentStatuses
     * @param string $sort
     * @param null $dateTimeCutoff
     * @param null $brands
     * @param array $instructorIds
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function search(
        $term,
        $page = 1,
        $limit = 10,
        $contentTypes = [],
        $contentStatuses = [],
        $sort = '-score',
        $dateTimeCutoff = null,
        $brands = null,
        $instructorIds = []
    ) {
        if ($term) {
            $term = $output = preg_replace(
                '!\s+!',
                ' ',
                trim(
                    preg_replace("/[^a-zA-Z0-9\\s\/]+/", "", $term)
                )
            );
            $term = str_replace('/', '_', $term);
        }

        $orderByDirection = substr($sort, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($sort, '-');

        $oldBrands = ConfigService::$availableBrands;

        if (empty($contentStatuses)) {
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
                        $dateTimeCutoff,
                        $instructorIds
                    )
                ),
                'total_results' => $this->fullTextSearchRepository->countTotalResults(
                    $term,
                    $contentTypes,
                    $contentStatuses,
                    $dateTimeCutoff,
                    $instructorIds
                ),
            ];

        ConfigService::$availableBrands = $oldBrands;

        return $return;
    }
}
