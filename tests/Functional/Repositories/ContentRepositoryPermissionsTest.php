<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryPermissionsTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionFactory;

    /**
     * @var \Railroad\Railcontent\Repositories\UserPermissionsRepository
     */
    protected $userPermissionsRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);
        $this->userPermissionsRepository = $this->app->make(UserPermissionsRepository::class);

    }

    protected function tearDown()
    {
       // Cache::store('redis')->flush();
    }

    public function test_get_by_id_is_protected_by_single()
    {
        $content = $this->contentFactory->create();
        $permission = $this->permissionFactory->create($this->faker->word);
        $contentPermission = $this->contentPermissionFactory->create(
            $content['id'],
            null,
            $permission['id']
        );

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertNull($response);
    }

    public function test_get_by_id_is_protected_by_multiple()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create($this->faker->word);
        $contentPermission = $this->contentPermissionFactory->create(
            $content['id'],
            null,
            $permission['id']
        );

        $otherPermission = $this->permissionFactory->create($this->faker->word);
        $otherContentPermission =
            $this->contentPermissionFactory->create(
                $content['id'],
                null,
                $permission['id']
            );

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertNull($response);
    }

    public function test_get_by_id_is_satisfiable_by_single()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->word,
            ContentService::STATUS_PUBLISHED);

        $permission = $this->permissionFactory->create($this->faker->word);
        $contentPermission = $this->contentPermissionFactory->create(
            $content['id'],
            null,
            $permission['id']
        );

        $content['permissions'][] = $contentPermission;

        $userPermission = $this->userPermissionsRepository->create([
            'user_id' => $userId,
            'permission_id' => $permission['id'],
            'start_date' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString()
        ]);

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals($content->getArrayCopy(), $response);
    }

    public function test_get_by_id_is_satisfiable_by_multiple()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->word,
            ContentService::STATUS_PUBLISHED);

        $permission = $this->permissionFactory->create($this->faker->word);
        $contentPermission = $this->contentPermissionFactory->create(
            $content['id'],
            null,
            $permission['id']
        );
        $content['permissions'][] = $contentPermission;

        $otherPermission = $this->permissionFactory->create($this->faker->word);
        $otherContentPermission =
            $this->contentPermissionFactory->create($content['id'], null, $otherPermission['id']);
        $content['permissions'][] = $otherContentPermission;

        $userPermission = $this->userPermissionsRepository->create([
            'user_id' => $userId,
            'permission_id' => $otherPermission['id'],
            'start_date' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString()
        ]);

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals($content->getArrayCopy(), $response);
    }

    public function test_get_by_id_is_protected_by_single_type()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create($this->faker->word);
        $contentPermission = $this->contentPermissionFactory->create(
            null,
            $content['type'],
            $permission['id']
        );

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertNull($response);
    }

    public function test_get_by_id_is_protected_by_multiple_type()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create($this->faker->word);
        $contentPermission = $this->contentPermissionFactory->create(
            null,
            $content['type'],
            $permission['id']
        );

        $otherPermission = $this->permissionFactory->create($this->faker->word);
        $otherContentPermission =
            $this->contentPermissionFactory->create(null, $content['type'], $permission['id']);
$user = $this->createAndLogInNewUser();
        $response = $this->classBeingTested->getById($content['id']);

        $this->assertNull($response);
    }

    public function test_get_by_id_is_satisfiable_by_single_type()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED,
            'en-US',
            ConfigService::$brand,
            rand(),
            Carbon::now()->toDateTimeString());

        $permission = $this->permissionFactory->create($this->faker->word);
        $contentPermission = $this->contentPermissionFactory->create(
            null,
            $content['type'],
            $permission['id']
        );
        $content['permissions'][] = $contentPermission;
        $userPermission = $this->userPermissionsRepository->create([
            'user_id' => $userId,
            'permission_id' => $permission['id'],
            'start_date' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString()
        ]);

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals($content->getArrayCopy(), $response);
    }

    public function test_get_by_id_is_satisfiable_by_multiple_type()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->word,
            ContentService::STATUS_PUBLISHED);

        $permission = $this->permissionFactory->create($this->faker->word);
        $contentPermission = $this->contentPermissionFactory->create(
            null,
            $content['type'],
            $permission['id']
        );
        $content['permissions'][] = $contentPermission;

        $otherPermission = $this->permissionFactory->create($this->faker->word);
        $otherContentPermission =
            $this->contentPermissionFactory->create(null, $content['type'], $otherPermission['id']);
        $content['permissions'][] = $otherContentPermission;
        $userPermission = $this->userPermissionsRepository->create([
            'user_id' => $userId,
            'permission_id' => $otherPermission['id'],
            'start_date' => Carbon::now()->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString()
        ]);

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals($content->getArrayCopy(), $response);
    }

}