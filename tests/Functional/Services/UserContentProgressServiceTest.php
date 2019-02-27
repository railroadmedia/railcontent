<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserContentProgressServiceTest extends RailcontentTestCase
{

    /**
     * @var UserContentProgressService
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(UserContentProgressService::class);
    }

    public function test_getMostRecentByContentTypeUserState()
    {
        $userId = $this->createAndLogInNewUser();
        $contents = $this->fakeContent(
            5,
            [
                'type' => 'course',
            ]
        );

        $up1 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[0],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up2 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[1],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up3 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[2],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now()
                    ->subMonth(1),
            ]
        );

        $up4 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[3],
                'state' => 'started',
                'progressPercent' => 30,
                'updatedOn' => Carbon::now()
                    ->subDay(2),
            ]
        );

        $up5 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[4],
                'state' => 'started',
                'progressPercent' => 14,
                'updatedOn' => Carbon::now()
                    ->subDay(1),
            ]
        );

        $mostRecent = ($this->classBeingTested->getMostRecentByContentTypeUserState('course', $userId, 'started'));

        $this->assertEquals($up2[0], $mostRecent);
    }

    public function test_countTotalStatesForContentIds()
    {
        $userId = $this->createAndLogInNewUser();
        $contents = $this->fakeContent(
            5,
            [
                'type' => 'course',
            ]
        );

        $up1 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[0],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up2 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[1],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up3 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[2],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now()
                    ->subMonth(1),
            ]
        );

        $up4 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[3],
                'state' => 'started',
                'progressPercent' => 30,
                'updatedOn' => Carbon::now()
                    ->subDay(2),
            ]
        );

        $up42 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => rand(2, 10),
                'content' => $contents[3],
                'state' => 'started',
                'progressPercent' => 30,
                'updatedOn' => Carbon::now()
                    ->subDay(2),
            ]
        );

        $up5 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[4],
                'state' => 'started',
                'progressPercent' => 14,
                'updatedOn' => Carbon::now()
                    ->subDay(1),
            ]
        );

        $countTotal = ($this->classBeingTested->countTotalStatesForContentIds(
            'started',
            [
                $contents[0]->getId(),
                $contents[1]->getId(),
                $contents[2]->getId(),
                $contents[3]->getId(),
                $contents[4]->getId(),
            ]
        ));

        $this->assertEquals(
            [
                $contents[1]->getId() => 1,
                $contents[3]->getId() => 2,
                $contents[4]->getId() => 1,
            ],
            $countTotal
        );
    }

    public function test_getForUser()
    {
        $userId = $this->createAndLogInNewUser();
        $contents = $this->fakeContent(
            5,
            [
                'type' => 'course',
                'brand' => config('railcontent.brand'),
            ]
        );

        $up1 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[0],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up2 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[1],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up3 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[2],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now()
                    ->subMonth(1),
            ]
        );

        $up4 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => rand(2, 10),
                'content' => $contents[3],
                'state' => 'started',
                'progressPercent' => 30,
                'updatedOn' => Carbon::now()
                    ->subDay(2),
            ]
        );

        $results = $this->classBeingTested->getForUser($userId);

        $this->assertEquals(3, count($results));

        foreach ($results as $result) {
            $this->assertEquals($userId, $result->getUserId());
            $this->assertEquals(
                config('railcontent.brand'),
                $result->getContent()
                    ->getBrand()
            );
        }
    }

    public function test_getForUserStateContentTypes()
    {
        $userId = $this->createAndLogInNewUser();
        $courses = $this->fakeContent(
            2,
            [
                'type' => 'course',
                'brand' => config('railcontent.brand'),
            ]
        );

        $songs = $this->fakeContent(
            3,
            [
                'type' => 'song',
                'brand' => config('railcontent.brand'),
            ]
        );

        $up1 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $courses[0],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up2 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $courses[1],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up3 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $songs[0],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now()
                    ->subMonth(1),
            ]
        );

        $up4 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => rand(2, 10),
                'content' => $songs[1],
                'state' => 'started',
                'progressPercent' => 30,
                'updatedOn' => Carbon::now()
                    ->subDay(2),
            ]
        );

        $results = $this->classBeingTested->getForUserStateContentTypes($userId, ['course', 'song'], 'started');

        $this->assertEquals(2, count($results));

        foreach ($results as $result) {
            $this->assertEquals($userId, $result->getUserId());
            $this->assertEquals('started', $result->getState());
            $this->assertTrue(
                in_array(
                    $result->getContent()
                        ->getType(),
                    ['course', 'song']
                )
            );
        }
    }

    public function test_getLessonsForUserByType()
    {
        $userId = $this->createAndLogInNewUser();
        $courses = $this->fakeContent(
            2,
            [
                'type' => 'course',
                'brand' => config('railcontent.brand'),
            ]
        );

        $songs = $this->fakeContent(
            3,
            [
                'type' => 'song',
                'brand' => config('railcontent.brand'),
            ]
        );

        $up1 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $courses[0],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up2 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $courses[1],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up3 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $songs[0],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now()
                    ->subMonth(1),
            ]
        );

        $up4 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => rand(2, 10),
                'content' => $songs[1],
                'state' => 'started',
                'progressPercent' => 30,
                'updatedOn' => Carbon::now()
                    ->subDay(2),
            ]
        );

        $results = $this->classBeingTested->getLessonsForUserByType($userId, 'course');

        $this->assertEquals(2, count($results));

        foreach ($results as $result) {
            $this->assertEquals($userId, $result->getUserId());
            $this->assertEquals(
                'course',
                $result->getContent()
                    ->getType()
            );
        }
    }

    public function test_countLessonsForUserByTypeAndProgressState()
    {
        $userId = $this->createAndLogInNewUser();
        $courses = $this->fakeContent(
            2,
            [
                'type' => 'course',
                'brand' => config('railcontent.brand'),
            ]
        );

        $songs = $this->fakeContent(
            3,
            [
                'type' => 'song',
                'brand' => config('railcontent.brand'),
            ]
        );

        $up1 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $courses[0],
                'state' => 'completed',
                'progressPercent' => 100,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up2 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $courses[1],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now(),
            ]
        );

        $up3 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $songs[0],
                'state' => 'started',
                'progressPercent' => 10,
                'updatedOn' => Carbon::now()
                    ->subMonth(1),
            ]
        );

        $up4 = $this->fakeUserContentProgress(
            1,
            [
                'userId' => rand(2, 10),
                'content' => $songs[1],
                'state' => 'started',
                'progressPercent' => 30,
                'updatedOn' => Carbon::now()
                    ->subDay(2),
            ]
        );

        $results = $this->classBeingTested->countLessonsForUserByTypeAndProgressState($userId, 'course','started');

        $this->assertEquals(1, $results);
    }
}
