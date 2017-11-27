<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\FullTextSearchRepository;

class FullTextSearchService
{
    /**
     * @var FullTextSearchRepository
     */
    protected $fullTextSearchRepository;

    /**
     * FullTextSearchService constructor.
     * @param FullTextSearchRepository $fullTextSearchRepository
     */
    public function __construct(
        FullTextSearchRepository $fullTextSearchRepository
    ) {
        $this->fullTextSearchRepository = $fullTextSearchRepository;
    }

    /** Full text search by term
     * @param string $term
     * @return array|null
     */
    public function search($term, $page = 1, $limit = 10)
    {
        return [
            'results' => $this->fullTextSearchRepository->search($term, $page, $limit),
            'total_results' => $this->fullTextSearchRepository->countTotalResults($term)
        ];
    }
}