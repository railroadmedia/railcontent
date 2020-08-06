<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\OldStructure;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Response;

class MobileApiEndpointsOldStructureTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentService::class);

        ResponseService::$oldResponseStructure = true;
    }

    public function test_get_all_content()
    {
        $courseNumber = 15;
        $this->fakeContent(
            $courseNumber,
            [
                'type' => 'course',
                'status' => 'published',
            ]
        );
        $this->fakeContent(
            rand(1, 5),
            [
                'type' => $this->faker->word,
                'status' => 'published',
            ]
        );

        $limit = 5;

        $response = $this->call(
            'GET',
            'api/railcontent/all?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on&limit=' .
            $limit
        );

        $this->assertNotEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals($courseNumber, $response->decodeResponseJson('meta')['totalResults']);
        $this->assertArrayHasKey('filterOptions', $response->decodeResponseJson('meta'));
    }

    public function test_get_all_content_not_released()
    {
        $courseNumber = 15;
        $this->fakeContent(
            $courseNumber,
            [
                'type' => 'course',
                'status' => 'published',
                'publishedOn' => Carbon::now()
                    ->addDay(3),
            ]
        );
        $this->fakeContent(
            rand(1, 5),
            [
                'type' => $this->faker->word,
                'status' => 'published',
            ]
        );

        $limit = 5;

        $response = $this->call(
            'GET',
            'api/railcontent/all?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on&limit=' .
            $limit
        );

        $this->assertEquals([], $response->decodeResponseJson('data'));

        $response = $this->call(
            'GET',
            'api/railcontent/all?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on&limit=' .
            $limit .
            '&future=true'
        );

        $this->assertNotEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals($courseNumber, $response->decodeResponseJson('meta')['totalResults']);
        $this->assertArrayHasKey('filterOptions', $response->decodeResponseJson('meta'));
    }

    public function test_get_all_content_filtered()
    {
        $user = $this->createAndLogInNewUser();
        $courseNumber = 15;

        $contents = $this->fakeContent(
            $courseNumber,
            [
                'type' => 'course',
                'status' => 'published',
                'difficulty' => 2,
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($contents as $content) {

            $this->fakeUserContentProgress(
                [
                    'user_id' => $user,
                    'content_id' => $content->getId(),
                    'state' => 'started',
                ]
            );
        }

        $this->fakeContent(
            rand(1, 5),
            [
                'type' => 'course',
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $limit = 5;

        $response = $this->call(
            'GET',
            'api/railcontent/all?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on&limit=' .
            $limit .
            '&required_fields[]=difficulty,2&required_user_states[]=started'
        );

        $this->assertNotEquals([], $response->decodeResponseJson('data'));

        foreach ($response->decodeResponseJson('data') as $content) {
            $this->assertTrue(
                in_array(
                    [
                        "content_id" => $content['id'],
                        "key" => "difficulty",
                        "value" => "2",
                        "position" => 1,
                    ],
                    $content['fields']
                )
            );
        }
    }

    public function test_get_all_content_no_results()
    {
        $response = $this->call(
            'GET',
            'api/railcontent/all?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on'
        );

        $this->assertEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals(0, $response->decodeResponseJson('meta')['totalResults']);
        $this->assertArrayNotHasKey('filterOptions', $response->decodeResponseJson('meta'));
    }

    public function test_get_in_progress_no_content()
    {
        $this->createAndLogInNewUser();
        $courseNumber = 15;

        $this->fakeContent(
            $courseNumber,
            [
                'type' => 'course',
                'status' => 'published',
                'difficulty' => 2,
                'publishedOn' => Carbon::now(),
            ]
        );

        $response = $this->call(
            'GET',
            'api/railcontent/in-progress?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on'
        );

        $this->assertEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals(0, $response->decodeResponseJson('meta')['totalResults']);
        $this->assertArrayNotHasKey('filterOptions', $response->decodeResponseJson('meta'));
    }

    public function test_get_in_progress_content()
    {
        $user = $this->createAndLogInNewUser();
        $courseNumber = 15;

        $contents = $this->fakeContent(
            $courseNumber,
            [
                'type' => 'course',
                'status' => 'published',
                'difficulty' => 8,
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->fakeContent(
            1,
            [
                'type' => 'show',
                'status' => 'published',
                'difficulty' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );

        foreach ($contents as $content) {
            $this->fakeUserContentProgress(
                1,
                [
                    'userId' => $user,
                    'content' => $content,
                    'state' => 'started',
                ]
            );
        }

        $response = $this->call(
            'GET',
            'api/railcontent/in-progress?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on'
        );

        $this->assertNotEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals($courseNumber, $response->decodeResponseJson('meta')['totalResults']);
        $this->assertArrayHasKey('filterOptions', $response->decodeResponseJson('meta'));
        $this->assertArrayHasKey('difficulty', $response->decodeResponseJson('meta')['filterOptions']);
        $this->assertArrayHasKey('content_type', $response->decodeResponseJson('meta')['filterOptions']);
    }

    public function test_get_in_progress_content_filtered_without_results()
    {
        $user = $this->createAndLogInNewUser();
        $courseNumber = 15;

        $contents = $this->fakeContent(
            $courseNumber,
            [
                'type' => 'course',
                'status' => 'published',
                'difficulty' => 8,
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->fakeContent(
            1,
            [
                'type' => 'show',
                'status' => 'published',
                'difficulty' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );

        foreach ($contents as $content) {
            $this->fakeUserContentProgress(
                1,
                [
                    'userId' => $user,
                    'content' => $content,
                    'state' => 'started',
                ]
            );
        }

        $response = $this->call(
            'GET',
            'api/railcontent/in-progress?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on&required_fields[]=difficulty,1'
        );

        $this->assertEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals(0, $response->decodeResponseJson('meta')['totalResults']);
    }

    public function test_get_in_progress_content_filtered_with_results()
    {
        $user = $this->createAndLogInNewUser();
        $courseNumber = 15;

        $contents = $this->fakeContent(
            $courseNumber,
            [
                'type' => 'course',
                'status' => 'published',
                'difficulty' => 8,
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->fakeContent(
            1,
            [
                'type' => 'show',
                'status' => 'published',
                'difficulty' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );

        foreach ($contents as $content) {
            $this->fakeUserContentProgress(
                1,
                [
                    'userId' => $user,
                    'content' => $content,
                    'state' => 'started',
                ]
            );
        }

        $response = $this->call(
            'GET',
            'api/railcontent/in-progress?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on&required_fields[]=difficulty,8'
        );

        $this->assertNotEquals([], $response->decodeResponseJson('data'));

        $this->assertEquals($courseNumber, $response->decodeResponseJson('meta')['totalResults']);

        foreach ($response->decodeResponseJson('data') as $item) {
            $this->assertTrue(
                in_array(
                    [
                        "content_id" => $item['id'],
                        "key" => "difficulty",
                        "value" => 8,
                        "position" => 1,
                    ],
                    $item['fields']
                )
            );
        }
    }

    public function test_get_our_picks_content_home_page()
    {
        $user = $this->createAndLogInNewUser();

        $content1 = $this->fakeContent(
            1,
            [
                'type' => 'course',
                'status' => 'published',
                'difficulty' => 8,
                'homeStaffPickRating' => 2,
                'publishedOn' => Carbon::now(),
            ]
        );

        $content2 = $this->fakeContent(
            1,
            [
                'type' => 'course',
                'status' => 'published',
                'homeStaffPickRating' => 1,
                'difficulty' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );

        $content3 = $this->fakeContent(
            1,
            [
                'type' => 'course',
                'status' => 'published',
                'homeStaffPickRating' => 21,
                'difficulty' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );

        $response = $this->call(
            'GET',
            'api/railcontent/our-picks?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on&is_home=true'
        );

        $this->assertNotEquals([], $response->decodeResponseJson('data'));

        $this->assertEquals(2, $response->decodeResponseJson('meta')['totalResults']);

        $homeStaffPickRating = 0;
        foreach ($response->decodeResponseJson('data') as $item) {
            $index = array_search('home_staff_pick_rating', array_column($item['fields'], 'key'));
            $value = ($item['fields'][$index]['value']);

            $this->assertTrue($content3[0]->getId() != $item['id']);
            $this->assertTrue($value <= 20);
            $this->assertTrue($homeStaffPickRating <= $value);
            $homeStaffPickRating = $value;
        }
    }

    public function test_get_our_picks_content()
    {
        $user = $this->createAndLogInNewUser();

        $content1 = $this->fakeContent(
            1,
            [
                'type' => 'course',
                'status' => 'published',
                'difficulty' => 8,
                'staffPickRating' => 2,
                'publishedOn' => Carbon::now(),
            ]
        );

        $content2 = $this->fakeContent(
            1,
            [
                'type' => 'course',
                'status' => 'published',
                'staffPickRating' => 1,
                'difficulty' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );

        $content3 = $this->fakeContent(
            1,
            [
                'type' => 'course',
                'status' => 'published',
                'staffPickRating' => 21,
                'difficulty' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );

        $response = $this->call(
            'GET',
            'api/railcontent/our-picks?included_types[]=course&statuses[]=published&statuses[]=scheduled&sort=-published_on'
        );

        $this->assertNotEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals(2, $response->decodeResponseJson('meta')['totalResults']);

        $staffPickRating = 0;
        foreach ($response->decodeResponseJson('data') as $item) {
            $index = array_search('staff_pick_rating', array_column($item['fields'], 'key'));
            $value = ($item['fields'][$index]['value']);

            $this->assertTrue($content3[0]->getId() != $item['id']);
            $this->assertTrue($value <= 20);
            $this->assertTrue($staffPickRating <= $value);
            $staffPickRating = $value;
        }
    }

    public function test_add_to_my_list()
    {
        $loggedInUserId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'type' => 'course',
                'status' => 'published',
                'difficulty' => 8,
                'staffPickRating' => 2,
                'publishedOn' => Carbon::now(),
            ]
        );

        $response = $this->call(
            'PUT',
            'api/railcontent/add-to-my-list',
            [
                'content_id' => $content[0]->getId(),
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            'success',
            $response->decodeResponseJson('data')
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'user_playlists',
            [
                'user_id' => $loggedInUserId,
                'brand' => config('railcontent.brand'),
                'type' => 'primary-playlist',
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'user_playlist_content',
            [
                'content_id' => $content[0]->getId(),
                'user_playlist_id' => 1,
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
    }

    public function test_remove_from_my_list()
    {
        $userId = $this->createAndLogInNewUser();

        $myList = $this->fakeUserPlaylist(1, ['userId' => $userId]);

        $content1 = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );
        $content2 = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->fakeUserPlaylistContent(
            1,
            [
                'userPlaylist' => $myList[0],
                'content' => $content1[0],
            ]
        );

        $this->fakeUserPlaylistContent(
            1,
            [
                'userPlaylist' => $myList[0],
                'content' => $content2[0],
            ]
        );

        $response = $this->call(
            'PUT',
            'api/railcontent/remove-from-my-list',
            [
                'content_id' => $content1[0]->getId(),
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            'success',
            $response->decodeResponseJson('data')
        );
        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_hierarchy',
            [
                'child_id' => $content1[0]->getId(),
            ]
        );
    }

    public function test_my_list()
    {
        $userId = $this->createAndLogInNewUser();
        $type = $this->faker->randomElement(['course', 'play-along', 'song']);

        $myList = $this->fakeUserPlaylist(
            1,
            [
                'type' => 'primary-playlist',
                'brand' => config('railcontent.brand'),
                'userId' => $userId,
            ]
        );

        $content1 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );
        $content2 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );
        $content3 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->fakeUserPlaylistContent(
            1,
            [
                'userPlaylist' => $myList[0],
                'content' => $content1[0],
            ]
        );

        $this->fakeUserPlaylistContent(
            1,
            [
                'userPlaylist' => $myList[0],
                'content' => $content2[0],
            ]
        );

        $response = $this->call(
            'GET',
            'api/railcontent/my-list'
        );
dd($response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals(2, count($response->decodeResponseJson('data')));
    }

    public function test_my_list_completed()
    {
        $userId = $this->createAndLogInNewUser();
        $type = $this->faker->randomElement(['course', 'play-along', 'song']);

        $content1 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );
        $content2 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );
        $content3 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $content1[0],
                'state' => 'completed',
            ]
        );

        $response = $this->call(
            'GET',
            'api/railcontent/my-list?state=completed'
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals(1, count($response->decodeResponseJson('data')));
        $this->assertEquals($content1[0]->getId(), $response->decodeResponseJson('data')['0']['id']);
    }

    public function test_onboarding()
    {
        $contents[] = $this->fakeContent();
        $response = $this->call(
            'GET',
            'api/railcontent/onboarding'
        );

        $this->assertEquals(
            count(config('railcontent.onboardingContentIds')),
            count($response->decodeResponseJson('data'))
        );

        foreach ($response->decodeResponseJson('data') as $item) {
            $this->assertTrue(in_array($item['id'], config('railcontent.onboardingContentIds')));
        }
    }

    public function test_shows()
    {
        $response = $this->call(
            'GET',
            'api/railcontent/shows'
        );
        $results = $response->decodeResponseJson('data')[0];

        $this->assertEquals(200, $response->status());

        foreach ($results as $key => $result) {
            $this->assertTrue(array_key_exists($result['type'], config('railcontent.shows')));
            $this->assertTrue(array_key_exists($key, config('railcontent.shows')));
        }
    }

    public function test_strip_comments()
    {
        $user = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'type' => 'course',
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $commentText = $this->faker->paragraph;
        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'comment' => '<p>' . $commentText . '</p>',
                'userId' => $user,
                'deletedAt' => null,
            ]
        );

        $replyText = $this->faker->paragraph;
        $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'comment' => '<p>' . $replyText . '</p>',
                'parent' => $comment[0],
                'deletedAt' => null,
            ]
        );

        $response = $this->call(
            'GET',
            'api/railcontent/comments',
            [
                'content_id' => $content[0]->getId(),
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals($commentText, $response->decodeResponseJson('data')[0]['comment']);
    }
}