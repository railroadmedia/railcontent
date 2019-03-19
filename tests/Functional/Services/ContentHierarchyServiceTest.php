<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentHierarchy;

use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentHierarchyServiceTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $populator = new Populator($this->faker, $this->entityManager);

        $populator->addEntity(
            Content::class,
            6,
            [
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'publishedOn' => Carbon::now(),
            ]
        );
        $populator->execute();

        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(2),
                'childPosition' => 1,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(3),
                'childPosition' => 2,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(4),
                'childPosition' => 3,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(2),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(5),
                'childPosition' => 1,
            ]
        );
        $populator->execute();

        $this->classBeingTested = $this->app->make(ContentHierarchyService::class);
    }

    public function test_count_parents_children()
    {
        $results = $this->classBeingTested->countParentsChildren([2, 1]);

        $this->assertEquals(1, $results[2]);
        $this->assertEquals(3, $results[1]);

    }

    public function test_get()
    {
        $results = $this->classBeingTested->get(1, 2);
        $this->assertEquals(1, $results->getChildPosition());
        $this->assertEquals(
            1,
            $results->getParent()
                ->getId()
        );
        $this->assertEquals(
            2,
            $results->getChild()
                ->getId()
        );
    }

    public function test_get_by_parent_ids()
    {
        $results = $this->classBeingTested->getByParentIds([2, 1]);

        foreach ($results as $hierarchy) {
            $this->assertTrue(
                in_array(
                    $hierarchy->getParent()
                        ->getId(),
                    [2, 1]
                )
            );
        }
    }

    public function test_reposition_siblings()
    {
        $this->classBeingTested->repositionSiblings(3);

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'content_hierarchy',
            [
                'parent_id' => 1,
                'child_id' => 4,
                'child_position' => 2,
            ]
        );

    }
}
