<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 11/14/2017
 * Time: 4:14 PM
 */

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentAssignmentServiceTest extends RailcontentTestCase
{

    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(CommentAssignmentService::class);
    }

    public function test_store()
    {
        $this->assertEquals(1, $this->classBeingTested->store(rand(), 'course'));
    }
}
