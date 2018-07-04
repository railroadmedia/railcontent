<?php

namespace Railroad\Railcontent\Tests\Stress;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentStressTest extends RailcontentTestCase
{
    /**
     * @var UserPermissionsRepository
     */
    private $userPermissionRepository;

    /**
     * @var \Railroad\Railcontent\Repositories\ContentRepository
     */
    private $contentRepository;

    /**
     * @var \Railroad\Railcontent\Repositories\ContentHierarchyRepository
     */
    private $contentHierarchyRepository;

    protected static $migrationsRun = false;

    public function setUp()
    {
        parent::setUp();

        $this->userPermissionRepository   = $this->app->make(UserPermissionsRepository::class);
        $this->contentRepository          = $this->app->make(ContentRepository::class);
        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);

        $this->artisan('db:seed', ['--class' => 'ContentSeeder']);
    }

    public function test_get_contents()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $tStart         = microtime(true);

        $results = $this->call('GET', 'railcontent/content');

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.5, $tEnd);
    }

    public function test_get_contents_no_permissions()
    {
        $tStart = microtime(true);

        $this->call('GET', 'railcontent/content');

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.2, $tEnd);
    }

    public function test_show_content()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $tStart         = microtime(true);

        $results = $this->call('GET', 'railcontent/content/' . $this->faker->numberBetween(1, 100000));

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_get_content_by_parent_id()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);

        $parent = $this->contentRepository->create([
            'slug'       => $this->faker->word,
            'type'       => $this->faker->word,
            'status'     => 'published',
            'brand'      => ConfigService::$brand,
            'language'   => $this->faker->languageCode,
            'created_on' => Carbon::now()->toDateTimeString()
        ]);

        $this->contentHierarchyRepository->create([
            'parent_id'      => $parent,
            'child_id'       => 1,
            'child_position' => 1,
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);

        $this->contentHierarchyRepository->create([
            'parent_id'      => $parent,
            'child_id'       => 2,
            'child_position' => 2,
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);

        $tStart = microtime(true);

        $results = $this->call('GET', 'railcontent/content/parent/' . $parent);

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_get_contents_by_ids()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $tStart         = microtime(true);

        $results = $this->call('GET', 'railcontent/content/get-by-ids', [
            'ids' => '1,2,3'
        ]);

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_show_content_field()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $tStart         = microtime(true);

        $results = $this->call('GET', 'railcontent/content/field/' . $this->faker->numberBetween(1, 100000));

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_start_content()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $tStart         = microtime(true);

        $results = $this->call('GET', 'railcontent/start', [
            'content_id' => $this->faker->numberBetween(1, 100000)
        ]);

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_complete_content()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $tStart         = microtime(true);

        $results = $this->call('GET', 'railcontent/complete', [
            'content_id' => $this->faker->numberBetween(1, 100000)
        ]);

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_reset_content()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $tStart         = microtime(true);

        $results = $this->call('GET', 'railcontent/reset', [
            'content_id' => $this->faker->numberBetween(1, 100000)
        ]);

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_save_content_progress()
    {
        $userId         = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => 1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $tStart         = microtime(true);

        $results = $this->call('GET', 'railcontent/progress', [
            'content_id'       => $this->faker->numberBetween(1, 100000),
            'progress_percent' => $this->faker->numberBetween(1, 99)
        ]);

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
