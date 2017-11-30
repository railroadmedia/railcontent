<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Listeners\UserContentProgressEventListener;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserContentProgressServiceTest extends RailcontentTestCase
{
    /** @var array */
    private $allowedTypes;

    /**
     * @var UserContentProgressService
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var UserContentProgressEventListener
     */
    private $progressEventListener;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(UserContentProgressService::class);
        $this->contentService = $this->app->make(ContentService::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyService = $this->app->make(ContentHierarchyService::class);
        $this->progressEventListener = $this->app->make(UserContentProgressEventListener::class);
    }

    protected function getEnvironmentSetUp($app){
        parent::getEnvironmentSetUp($app);
        $this->allowedTypes = ['foo', 'bar'];
        $app['config']->set('railcontent.allowed_types_for_bubble_progress', $this->allowedTypes);
    }

    public function test_start_content()
    {
        $userId = $this->faker->randomNumber();

        $content = $this->contentFactory->create(
            $this->faker->words(rand(2, 6), true),
            $this->faker->randomElement($this->allowedTypes)
        );

        $state = UserContentProgressService::STATE_STARTED;

        $userContentId = $this->classBeingTested->startContent($content['id'], $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $content['id'],
                'user_id' => $userId,
                'state' => $state,
                'progress_percent' => 0
            ]
        );
    }

    public function test_complete_content()
    {
        $userId = $this->faker->randomNumber();

        $content = $this->contentFactory->create(
            $this->faker->words(rand(2, 6), true),
            $this->faker->randomElement($this->allowedTypes)
        );

        $userContent = [
            'content_id' => $content['id'],
            'user_id' => $userId,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 99),
            'updated_on' => Carbon::now()->toDateString()
        ];
        $userContentId =
            $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

        $this->classBeingTested->completeContent($content['id'], $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $content['id'],
                'user_id' => $userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress_percent' => 100
            ]
        );
    }

    public function test_save_user_progress_content()
    {
        $userId = $this->faker->randomNumber();

        $content = $this->contentFactory->create(
            $this->faker->words(rand(2, 6), true),
            $this->faker->randomElement($this->allowedTypes)
        );

        $state = UserContentProgressService::STATE_STARTED;
        $progress = $this->faker->numberBetween(1, 100);
        $userContent = [
            'content_id' => $content['id'],
            'user_id' => $userId,
            'state' => $state,
            'progress_percent' => $progress,
            'updated_on' => Carbon::now()->toDateString()
        ];

        $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

        $this->classBeingTested->saveContentProgress($content['id'], $progress, $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $content['id'],
                'user_id' => $userId,
                'state' => $state,
                'progress_percent' => $progress
            ]
        );
    }

    public function test_attach_user_progress_to_content_empty()
    {
        $results = $this->classBeingTested->attachProgressToContents(rand(), []);

        $this->assertEquals([], $results);
    }

    public function test_attach_user_progress_to_content_no_progress()
    {
        $userId = rand();
        $content = $this->contentFactory->create();
        $content['completed'] = false;
        $content['started'] = false;

        $results = $this->classBeingTested->attachProgressToContents($userId, [$content]);

        $content['user_progress'][$userId] = [];

        $this->assertEquals([$content], $results);
    }

    public function test_attach_user_progress_to_contents_with_progress()
    {
        $userId = rand();

        $expectedContents = [];

        for ($i = 0; $i < 3; $i++) {
            $content = $this->contentFactory->create();
            $content['completed'] = false;
            $content['started'] = true;
            $content['user_progress'][$userId] = [
                'id' => $i + 1,
                'content_id' => $i + 1,
                'user_id' => $userId,
                'state' => UserContentProgressService::STATE_STARTED,
                'progress_percent' => '0',
                'updated_on' => Carbon::now()->toDateTimeString()
            ];
            $expectedContents[] = $content;

            $this->classBeingTested->startContent($content['id'], $userId);
        }

        $results = $this->classBeingTested->attachProgressToContents($userId, $expectedContents);

        $this->assertEquals($expectedContents, $results);
    }

    public function test_progress_bubble_started()
    {
        // One ---------------------------------------------------------------------------------------------------------
        // Set up some basic variables ---------------------------------------------------------------------------------

        $userId = rand();
        $type = $this->faker->randomElement($this->allowedTypes);
        $numberOfChildren = 5;
        $content = [];


        // Two ---------------------------------------------------------------------------------------------------------
        // Create the content ------------------------------------------------------------------------------------------

        //$parent = $this->contentFactory->create(null, $type);
        $parent = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);

        for ($i = 0; $i < $numberOfChildren; $i++) {
            //$content[$i] = $this->contentFactory->create(null, $type);
            $content[$i] = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);
            $this->contentHierarchyService->create($parent['id'], $content[$i]['id'], $i + 1);
        }


        // Three -------------------------------------------------------------------------------------------------------
        // Make sure that the parent is as expected at this point, so that it's change marks success -------------------

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        if ($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]) {
            $this->fail('$parentWithProgressAttached[\'started\'] should be false at this point in the test');
        }


        // Four --------------------------------------------------------------------------------------------------------
        // Pick a child at random, setting their "started" state to true. This should then trigger
        // UserContentProgressService's "bubbleProgress" method—which is what we're aiming to test here.

        $randomChild = $content[rand(0, $numberOfChildren - 1)];
        $this->classBeingTested->startContent($randomChild['id'], $userId);


        // Five --------------------------------------------------------------------------------------------------------
        // Check that parent was updated as expected -------------------------------------------------------------------

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        $this->assertTrue($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]);
    }

    public function test_progress_bubble_completed()
    {
        // One ---------------------------------------------------------------------------------------------------------
        // Set up some basic variables ---------------------------------------------------------------------------------

        $userId = rand();
        $type = $this->faker->randomElement($this->allowedTypes);
        $numberOfChildren = 5;
        $content = [];


        // Two ---------------------------------------------------------------------------------------------------------
        // Create the content ------------------------------------------------------------------------------------------

        //$parent = $this->contentFactory->create(null, $type);
        $parent = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);

        for ($i = 0; $i < $numberOfChildren; $i++) {
            //$content[$i] = $this->contentFactory->create(null, $type);
            $content[$i] = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);
            $this->contentHierarchyService->create($parent['id'], $content[$i]['id'], $i + 1);
        }


        // Three -------------------------------------------------------------------------------------------------------
        // Make sure that the parent is as expected at this point, so that it's change marks success -------------------

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        if ($parentWithProgressAttached[UserContentProgressService::STATE_COMPLETED]) {
            $this->fail('$parentWithProgressAttached[\'completed\'] should be false at this point in the test');
        }


        // Four --------------------------------------------------------------------------------------------------------
        // Set all children to "complete", except one. Check that the parent is not complete. Then set that remaining
        // child to "complete", and this should then trigger UserContentProgressService's "bubbleProgress" method,
        // setting the parent as complete—which is what we're aiming to test here.

        $randomChild = $content[rand(0, $numberOfChildren - 1)];
        foreach($content as $child){
            if($child['id'] !== $randomChild['id']){
                $this->classBeingTested->completeContent($child['id'], $userId);
            }
        }

        if ($parentWithProgressAttached[UserContentProgressService::STATE_COMPLETED]) {
            $this->fail('$parentWithProgressAttached[\'completed\'] should be false at this point in the test');
        }

        $this->classBeingTested->completeContent($randomChild['id'], $userId);


        // Five --------------------------------------------------------------------------------------------------------
        // Check that parent was updated as expected -------------------------------------------------------------------

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        $this->assertTrue($parentWithProgressAttached[UserContentProgressService::STATE_COMPLETED]);
    }

    public function test_progress_bubble_calculates_percentage()
    {
        // One ---------------------------------------------------------------------------------------------------------
        // Set up some basic variables ---------------------------------------------------------------------------------

        $userId = rand();
        $type = $this->faker->randomElement($this->allowedTypes);
        $numberOfChildren = 4;
        $content = [];


        // Two ---------------------------------------------------------------------------------------------------------
        // Create the content ------------------------------------------------------------------------------------------

        //$parent = $this->contentFactory->create(null, $type);
        $parent = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);

        for ($i = 0; $i < $numberOfChildren; $i++) {
            //$content[$i] = $this->contentFactory->create(null, $type);
            $content[$i] = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);
            $this->contentHierarchyService->create($parent['id'], $content[$i]['id'], $i + 1);
        }


        // Three -------------------------------------------------------------------------------------------------------
        // Make sure that the parent is as expected at this point, so that it's change marks success -------------------

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        if (!empty(reset($parentWithProgressAttached['user_progress']))) {
            $this->fail('$parentWithProgressAttached[\'user_progress\'] should be empty at this point in the test');
        }

        // Four --------------------------------------------------------------------------------------------------------
        // Set all children to "complete", except one. Check that the parent is not complete. Then set that remaining
        // child to "complete", and this should then trigger UserContentProgressService's "bubbleProgress" method,
        // setting the parent as complete—which is what we're aiming to test here.

        $randomChild = $content[rand(0, $numberOfChildren - 1)];
        foreach($content as $child){
            if($child['id'] !== $randomChild['id']){
                $this->classBeingTested->saveContentProgress($child['id'], 20, $userId);
            }
        }

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        $userProgressForParentContent = reset($parentWithProgressAttached['user_progress']);

        if ( !empty($userProgressForParentContent) ) {
            $parentProgress = (integer) $userProgressForParentContent['progress_percent'];
            if($parentProgress !== 15){ // (20 + 20 + 20 + 0) / 4 = 15
                $this->fail('$parentWithProgressAttached[\'started\'] should be false at this point in the test');
            }
        }

        $this->classBeingTested->saveContentProgress($randomChild['id'], 40, $userId);


        // Five --------------------------------------------------------------------------------------------------------
        // Check that parent was updated as expected -------------------------------------------------------------------

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        $userProgressForParentContent = reset($parentWithProgressAttached['user_progress']);

        if(empty($userProgressForParentContent)){
            $this->fail('\'$parentWithProgressAttached\' should not be empty here. This test is likely broken.');
        }

        // (20 + 20 + 20 + 40) / 4 = 25
        $this->assertEquals(25, $userProgressForParentContent['progress_percent']);
    }

    public function test_progress_bubble_not_allowed_type()
    {
        // One ---------------------------------------------------------------------------------------------------------
        // Set up some basic variables ---------------------------------------------------------------------------------

        $userId = rand();
        $type = $this->faker->word;
        $numberOfChildren = 5;
        $content = [];


        // Two ---------------------------------------------------------------------------------------------------------
        // Create the content ------------------------------------------------------------------------------------------

        //$parent = $this->contentFactory->create(null, $type);
        $parent = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);

        if(in_array($type, $this->allowedTypes)){
            $this->fail('Oops, Faker just so happened to have picked a random word that was also the random "' .
            'allowed type" set for this test. Just run this test again and things will likely be just fine.');
        }

        for ($i = 0; $i < $numberOfChildren; $i++) {
            //$content[$i] = $this->contentFactory->create(null, $type);
            $content[$i] = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);
            $this->contentHierarchyService->create($parent['id'], $content[$i]['id'], $i + 1);
        }


        // Three -------------------------------------------------------------------------------------------------------
        // Make sure that the parent is as expected at this point, so that it's change marks success -------------------

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        if ($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]) {
            $this->fail('$parentWithProgressAttached[\'started\'] should be false at this point in the test');
        }


        // Four --------------------------------------------------------------------------------------------------------
        // Pick a child at random, setting their "started" state to true. This should then trigger
        // UserContentProgressService's "bubbleProgress" method—which is what we're aiming to test here.

        $randomChild = $content[rand(0, $numberOfChildren - 1)];
        $this->classBeingTested->startContent($randomChild['id'], $userId);


        // Five --------------------------------------------------------------------------------------------------------
        // Check that parent was updated as expected -------------------------------------------------------------------

        $parentWithProgressAttached = $this->classBeingTested->attachProgressToContents(
            $userId,
            $this->contentService->getById($parent['id'])
        );

        $this->assertFalse($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]);
    }

}
