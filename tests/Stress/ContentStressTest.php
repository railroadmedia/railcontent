<?php

namespace Railroad\Railcontent\Tests\Stress;

use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Orchestra\Testbench\TestCase;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentStressTest extends RailcontentTestCase
{
    private $userPermissionRepository;

    protected static $migrationsRun = false;

    public function setUp()
    {
        parent::setUp();
        /*TestCase::setUp();

        $this->faker = $this->app->make(Generator::class);
        $this->databaseManager = $this->app->make(DatabaseManager::class);
        $this->databaseManager->connection()->beginTransaction();
        $this->authManager = $this->app->make(AuthManager::class);
        RepositoryBase::$connectionMask = null;

        Carbon::setTestNow(Carbon::now()); */
        $this->userPermissionRepository = $this->app->make(UserPermissionsRepository::class);


        //if (!self::$migrationsRun) {

         //   $this->artisan('migrate:fresh');
            $this->artisan('db:seed', ['--class' => 'ContentSeeder']);

           // self::$migrationsRun = true;
       // }
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

        $this->call('GET', 'railcontent/content');

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_get_contents_no_permissions()
    {
        $tStart = microtime(true);

        $this->call('GET', 'railcontent/content');

        $tEnd = microtime(true) - $tStart;
        $this->assertLessThan(0.1, $tEnd);
    }

    public function test_get_content()
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

    public function tearDown()
    {
      //  $this->databaseManager->connection()->rollBack();
        parent::tearDown();
    }
}
