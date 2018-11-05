<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentHierarchyServiceTest extends RailcontentTestCase
{
    protected $classBeingTested;

    /**
     * @var ContentHierarchyRepository
     */
    protected $contentHierarchyRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentHierarchyService::class);
        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
    }

    public function _testCountParentsChildren()
    {

    }

    public function _testDelete()
    {

    }

    public function test_get()
    {
        $hierarchy =
            $this->contentHierarchyRepository->query()
                ->create(
                    [
                        'parent_id' => $this->faker->randomNumber(),
                        'child_id' => $this->faker->randomNumber(),
                        'child_position' => $this->faker->randomNumber(),
                        'created_on' => Carbon::now()
                            ->toDateTimeString(),
                    ]
                );

        $this->assertEquals($hierarchy, $this->classBeingTested->get($hierarchy->parent_id, $hierarchy->child_id));
    }

    public function test_get_by_parent_ids()
    {
        $hierarchy =
            $this->contentHierarchyRepository->query()
                ->create(
                    [
                        'parent_id' => $this->faker->randomNumber(),
                        'child_id' => $this->faker->randomNumber(),
                        'child_position' => $this->faker->randomNumber(),
                        'created_on' => Carbon::now()
                            ->toDateTimeString(),
                    ]
                );

        $this->assertEquals([$hierarchy],
            $this->classBeingTested->getByParentIds([$hierarchy['parent_id']])
                ->toArray()
        );
    }

    public function _testRepositionSiblings()
    {

    }

    public function _testCreate()
    {

    }
}
