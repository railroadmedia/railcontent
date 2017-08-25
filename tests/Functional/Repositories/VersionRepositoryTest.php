<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 8/25/2017
 * Time: 3:03 PM
 */

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\VersionRepository;
use Railroad\Railcontent\Tests\RailcontentTestCase;
USE Railroad\Railcontent\Services\ConfigService;

class VersionRepositoryTest extends RailcontentTestCase{

    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(VersionRepository::class);
    }

    public function test_store_content_version()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

       $versionContentId = $this->classBeingTested->store(1, null, '', serialize($content));

        $this->assertDatabaseHas(
            ConfigService::$tableVersions,
            [
                'id' => $versionContentId,
                'content_id' => 1,
                'author_id' => null,
                'state' => '',
                'data' => serialize($content),
                'saved_on' => Carbon::now()->toDateTimeString()
            ]
        );
    }

}
