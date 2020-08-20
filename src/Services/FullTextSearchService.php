<?php

namespace Railroad\Railcontent\Services;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\SearchIndex;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\FullTextSearchRepository;
use Railroad\Railcontent\Repositories\QueryBuilders\ElasticQueryBuilder;

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
     * @var ObjectRepository|EntityRepository
     */
    private $userPermissionRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * FullTextSearchService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param ContentService $contentService
     * @param ElasticService $elasticService
     * @param UserProviderInterface $userProvider
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        ContentService $contentService,
        ElasticService $elasticService,
        UserProviderInterface $userProvider
    ) {
        $this->entityManager = $entityManager;
        $this->contentService = $contentService;
        $this->elasticService = $elasticService;
        $this->userProvider = $userProvider;

        $this->fullTextSearchRepository = $this->entityManager->getRepository(SearchIndex::class);
        $this->userPermissionRepository = $this->entityManager->getRepository(UserPermission::class);
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

        $orderByDirection = substr($sort, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($sort, '-');

        $oldBrands = config('railcontent.available_brands');

        if (empty($contentStatuses)) {
            $contentStatuses = ContentRepository::$availableContentStatues;
        }

        if (!empty($brands)) {
            config(['railcontent.available_brands' => $brands]);
        }

        if (config('railcontent.use_elastic_search') == true) {
            $permissionIds = [];
            if (auth()->id()) {
                $userPermissions = $this->userPermissionRepository->getUserPermissions(auth()->id(), true);
                foreach ($userPermissions as $permission) {
                    $permissionIds[] =
                        $permission->getPermission()
                            ->getId();
                }
            }

            switch (config('railcontent.brand')) {
                case 'drumeo':
                    ElasticQueryBuilder::$skillLevel =
                        $this->userProvider->getCurrentUser()
                            ->getDrumsSkillLevel();
                    break;
                case 'pianote':
                    ElasticQueryBuilder::$skillLevel =
                        $this->userProvider->getCurrentUser()
                            ->getPianoSkillLevel();
                    break;
                case 'guitareo':
                    ElasticQueryBuilder::$skillLevel =
                        $this->userProvider->getCurrentUser()
                            ->getGuitarSkillLevel();
                    break;
            }

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

            $totalResults = $elasticData->getTotalHits();

            $contentIds = [];
            foreach ($elasticData->getResults() as $elData) {
                $contentIds[] = $elData->getData()['id'];
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
            $filters = [];
        }

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
    }
}