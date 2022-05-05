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
        $brands = null,
        $instructorIds = []
    ) {
        if($term) {
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

        if (config('railcontent.use_elastic_search') == true) {
            $permissionIds = [];
            if (auth()->id()) {
                $userPermissions = $this->userPermissionRepository->getUserPermissions(auth()->id(), true);
                $permissionIds = array_pluck($userPermissions,'permission_id');
            }

//            switch (config('railcontent.brand')) {
//                case 'drumeo':
//                    ElasticQueryBuilder::$skillLevel =
//                        $this->userProvider->getCurrentUser()
//                            ->getDrumsSkillLevel();
//                    break;
//                case 'pianote':
//                    ElasticQueryBuilder::$skillLevel =
//                        $this->userProvider->getCurrentUser()
//                            ->getPianoSkillLevel();
//                    break;
//                case 'guitareo':
//                    ElasticQueryBuilder::$skillLevel =
//                        $this->userProvider->getCurrentUser()
//                            ->getGuitarSkillLevel();
//                    break;
//            }

            ElasticQueryBuilder::$userPermissions = $permissionIds;

            $elasticData = $this->elasticService->search(
                $term,
                $page,
                $limit,
                $contentTypes,
                $contentStatuses,
                $dateTimeCutoff,
                $sort
            );

            $totalResults = $elasticData['hits']['total']['value'];

            $contentIds = [];
            foreach ($elasticData['hits']['hits'] as $elData) {
                $contentIds[$elData['_source']['content_id']] = $elData['_source']['content_id'];
            }

            $filters = $this->elasticService->getFilterFields(
                $contentTypes,
                [],
                [],
                [],
                [],
                null,
                null,
                [],
                $term
            );

            $contents = $this->contentService->getByIds($contentIds);
            $return = [
                'results' => $contents,
                'total_results' => $totalResults,
                'filter_options' => $filters,
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

        } else {
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
        }
        ConfigService::$availableBrands = $oldBrands;

        return $return;
    }
}
