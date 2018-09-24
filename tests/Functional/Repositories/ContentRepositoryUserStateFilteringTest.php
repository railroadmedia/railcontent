<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\UserContentProgressFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryUserStateFilteringTest extends RailcontentTestCase
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
     * @var UserContentProgressFactory
     */
    protected $userStateFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->userStateFactory = $this->app->make(UserContentProgressFactory::class);
    }

    public function test_require_started_state_with_pagination()
    {
        /*
         * Expected content ids before pagination:
         * [ 3, 4, 5, 6, 7... 13 ]
         *
         * Expected content ids after pagination:
         * [ 6, 7, 8 ]
         *
         */

        $type = $this->faker->word;
        $startedState = UserContentProgressService::STATE_STARTED;
        $completeState = UserContentProgressService::STATE_COMPLETED;
        $userId = $this->faker->randomNumber();

        // content with complete state
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );
            $userState = $this->userStateFactory->completeContent(
                $content['id'],
                $userId
            );
        }

        // content with started state (the required state)
        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );

            $userState = $this->userStateFactory->startContent(
                $content['id'],
                $userId
            );
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type], [], [])
            ->requireUserStates(
                $startedState,
                $userId
            )
            ->retrieveFilter();

        $this->assertEquals([6, 7, 8], array_column($rows, 'id'));
    }

    public function test_include_states_with_pagination()
    {
        /*
        * Expected content ids before pagination:
        * [ 4, 5, 6, 7... 15 ]
        *
        * Expected content ids after  pagination:
        * [ 7, 8, 9 ]
        *
        */

        $type = $this->faker->word;
        $startedState = UserContentProgressService::STATE_STARTED;
        $completedState = UserContentProgressService::STATE_COMPLETED;
        $userId = $this->faker->randomNumber();

        //content without user state
        for ($i = 0; $i < 3; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );
        }
        // content with complete state (included state)
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );
            $userState = $this->userStateFactory->completeContent(
                $content['id'],
                $userId
            );
        }

        // content with started state (included state)
        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );

            $userState = $this->userStateFactory->startContent(
                $content['id'],
                $userId
            );
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type], [], [])
            ->includeUserStates(
                $startedState,
                $userId
            )
            ->includeUserStates(
                $completedState,
                $userId
            )
            ->retrieveFilter();

        $this->assertEquals([7, 8, 9], array_column($rows, 'id'));
    }
}
