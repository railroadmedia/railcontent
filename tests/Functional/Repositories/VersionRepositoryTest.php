<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 8/25/2017
 * Time: 3:03 PM
 */

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function test_store_content_with_datum()
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
            'datum' => [
                1 =>[
                    $this->faker->word => $this->faker->word
                ]
            ]
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

    public function test_get_old_content_version()
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

        $versionContentId1 = $this->classBeingTested->store(1, null, '', serialize($content));

        $newContent = array_merge($content,['slug' => $this->faker->word]);

        $versionContentId2 = $this->classBeingTested->store(1, null, '', serialize($newContent));

        $expectedContentVersion = [
            'id' => $versionContentId1,
            'content_id' => 1,
            'author_id' => null,
            'state' => '',
            'data' => serialize($content),
            'saved_on' => Carbon::now()->toDateTimeString()

        ];

        $oldContentVersion = $this->classBeingTested->get($versionContentId1);

        $this->assertEquals($expectedContentVersion, $oldContentVersion);
    }
}
