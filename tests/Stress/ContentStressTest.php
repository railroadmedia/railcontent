<?php

namespace Railroad\Railcontent\Tests\Stress;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Tests\SeedDatabase;

class ContentStressTest extends RailcontentTestCase
{
    use SeedDatabase;

    protected static $migrationsRun = false;
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
    /**
     * @var ContentFieldRepository
     */
    private $contentFieldRepository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->userPermissionRepository = $this->app->make(UserPermissionsRepository::class);
        $this->contentRepository = $this->app->make(ContentRepository::class);
        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
        $this->contentFieldRepository = $this->app->make(ContentFieldRepository::class);
        $this->permissionRepository = $this->app->make(PermissionRepository::class);

        $this->seedDatabase();
    }

    public function test_get_contents()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $tStart = microtime(true);

        $results = $this->call('GET', 'railcontent/content');

        $tEnd1 = microtime(true) - $tStart;
        $tStart2 = microtime(true);

        $results = $this->call('GET', 'railcontent/content');

        $tEnd2 = microtime(true) - $tStart2;
        $this->assertLessThan(1.2, $tEnd1);
        $this->assertLessThan(0.1, $tEnd2);
    }

    public function test_get_contents_no_permissions()
    {
        $tStart = microtime(true);

        $this->call('GET', 'railcontent/content');

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_show_content()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $tStart = microtime(true);

        $results = $this->call('GET', 'railcontent/content/' . $this->faker->numberBetween(1, 100000));

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_get_content_by_parent_id()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $parent = $this->contentRepository->create(
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->word,
                'status' => 'published',
                'brand' => ConfigService::$brand,
                'language' => $this->faker->languageCode,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->contentHierarchyRepository->create(
            [
                'parent_id' => $parent,
                'child_id' => 1,
                'child_position' => 1,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->contentHierarchyRepository->create(
            [
                'parent_id' => $parent,
                'child_id' => 2,
                'child_position' => 2,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $tStart = microtime(true);

        $results = $this->call('GET', 'railcontent/content/parent/' . $parent);

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_get_contents_by_ids()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $tStart = microtime(true);

        $results = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            [
                'ids' => '1,2,3',
            ]
        );

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_show_content_field()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $tStart = microtime(true);

        $results = $this->call('GET', 'railcontent/content/field/' . $this->faker->numberBetween(1, 100000));

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_start_content()
    {
        $userId = $this->createAndLogInNewUser();
        $this->call('GET', 'railcontent/content');

        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $this->assertGreaterThan(0, count(Redis::hgetall(CacheHelper::getUserSpecificHashedKey())));

        $userPermission = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $tStart = microtime(true);

        $results = $this->call(
            'GET',
            'railcontent/start',
            [
                'content_id' => $this->faker->numberBetween(1, 100000),
            ]
        );
        $this->assertEquals([], Redis::hgetall(CacheHelper::getUserSpecificHashedKey()));
        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_complete_content()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $tStart = microtime(true);

        $results = $this->call(
            'GET',
            'railcontent/complete',
            [
                'content_id' => $this->faker->numberBetween(1, 100000),
            ]
        );

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_reset_content()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $tStart = microtime(true);

        $results = $this->call(
            'GET',
            'railcontent/reset',
            [
                'content_id' => $this->faker->numberBetween(1, 100000),
            ]
        );

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_save_content_progress()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $tStart = microtime(true);

        $results = $this->call(
            'GET',
            'railcontent/progress',
            [
                'content_id' => $this->faker->numberBetween(1, 100000),
                'progress_percent' => $this->faker->numberBetween(1, 99),
            ]
        );

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_content_slug_hierarchy()
    {
        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $parent = $this->contentRepository->create(
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->randomElement(ConfigService::$contentHierarchyDecoratorAllowedTypes),
                'status' => 'published',
                'brand' => ConfigService::$brand,
                'language' => $this->faker->languageCode,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $parent2 = $this->contentRepository->create(
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->randomElement(ConfigService::$contentHierarchyDecoratorAllowedTypes),
                'status' => 'published',
                'brand' => ConfigService::$brand,
                'language' => $this->faker->languageCode,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $parent3 = $this->contentRepository->create(
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->randomElement(ConfigService::$contentHierarchyDecoratorAllowedTypes),
                'status' => 'published',
                'brand' => ConfigService::$brand,
                'language' => $this->faker->languageCode,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $this->contentHierarchyRepository->create(
            [
                'parent_id' => $parent3,
                'child_id' => $parent2,
                'child_position' => 1,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $this->contentHierarchyRepository->create(
            [
                'parent_id' => $parent2,
                'child_id' => $parent,
                'child_position' => 1,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $this->contentHierarchyRepository->create(
            [
                'parent_id' => $parent,
                'child_id' => 1,
                'child_position' => 1,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->contentHierarchyRepository->create(
            [
                'parent_id' => $parent,
                'child_id' => 2,
                'child_position' => 2,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $tStart = microtime(true);

        $results = $this->call('GET', 'railcontent/content/parent/' . $parent);

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_content_fields()
    {
        for ($j = 0; $j < 1000; $j++) {
            $contentField = $this->contentFieldRepository->create(
                [
                    'content_id' => $this->faker->numberBetween(1, 100000),
                    'key' => $this->faker->word,
                    'value' => $this->faker->word,
                    'type' => 'string',
                ]
            );
        }

        $userId = $this->createAndLogInNewUser();
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => 1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $tStart = microtime(true);

        $results = $this->call('GET', 'railcontent/content');

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.3, $tEnd);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
