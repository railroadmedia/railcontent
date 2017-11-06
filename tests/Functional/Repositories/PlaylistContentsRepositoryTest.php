<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\PlaylistRepository;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PlaylistContentsRepositoryTest extends RailcontentTestCase
{
    /**
     * @var PlaylistRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(PlaylistRepository::class);
    }
}
