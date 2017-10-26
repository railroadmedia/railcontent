<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Services\ContentService;

class ContentHierarchyFactory extends FactoryBase
{
    /**
     * @var ContentHierarchyRepository
     */
    private $contentHierarchyRepository;

    /**
     * ContentFactory constructor.
     *
     * @param ContentHierarchyRepository $contentHierarchyRepository
     */
    public function __construct(ContentHierarchyRepository $contentHierarchyRepository)
    {
        parent::__construct();

        $this->contentHierarchyRepository = $contentHierarchyRepository;
    }

    /**
     * @param array $parameterOverwrites
     * @return void
     */
    public function create(array $parameterOverwrites)
    {
        $parameters =
            $parameterOverwrites + [
                rand(),
                rand(),
                rand(),
            ];

        ksort($parameters);

        $this->contentHierarchyRepository->updateOrCreateChildToParentLink(...$parameters);
    }
}