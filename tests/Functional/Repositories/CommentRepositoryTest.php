<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Carbon\Carbon;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentRepositoryTest extends RailcontentTestCase
{
    /**
     * @var CommentRepository
     */
    protected $classBeingTested;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->classBeingTested = $this->app->make(CommentRepository::class);

        CommentRepository::$availableContentType = null;
        CommentRepository::$availableUserId = null;
        CommentRepository::$availableContentId = null;
    }

    public function test_create_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $data = [
            'comment' => $this->faker->word,
            'content_id' => rand(),
            'user_id' => $userId,
            'created_on' => Carbon::now()->toDateTimeString(),
            'temporary_display_name' => $this->faker->word
        ];

        $commentId = $this->classBeingTested->create($data);

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            array_merge(
                [
                    'id' => $commentId,
                ],
                $data
            )
        );
    }

    public function test_update_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create($this->faker->word, $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);

        $newComment = [
            'comment' => $this->faker->word
        ];;

        $this->classBeingTested->update($comment['id'], $newComment);

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            array_merge(
                $newComment,
                [
                    'id' => $comment['id'],
                ]
            )
        );
    }

    public function test_get_user_comments()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create($this->faker->word, 'course', ContentService::STATUS_PUBLISHED);

        for ($i = 0; $i < 12; $i++) {
            $expectedComments[$i] = $this->commentFactory->create($this->faker->text(), $content['id'], null, $userId);
            $expectedComments[$i]['replies'] = [];
        }

        // create random comments
        for ($i = 1; $i < 5; $i++) {
            $comments = $this->commentFactory->create($this->faker->text(), $content['id']);
        }

        CommentRepository::$availableUserId = $userId;

        $results = $this->classBeingTested->getComments();
        $this->assertEquals($expectedComments, $results);
    }

    public function test_get_content_comments()
    {
        $firstContent = $this->contentFactory->create($this->faker->word, $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        $secondContent =  $this->contentFactory->create($this->faker->word, $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);

        //create comments for second content
        for($i = 0; $i<5; $i++)
        {
            $expectedComments[$i] = $this->commentFactory->create($this->faker->text(), $secondContent['id']);
            $expectedComments[$i]['replies'] = [];
        }

        //create comments for first content
        for($i = 0; $i<5; $i++)
        {
            $comments = $this->commentFactory->create($this->faker->text(), $firstContent['id']);
        }

        CommentRepository::$availableUserId = null;
        CommentRepository::$availableContentId = $secondContent['id'];
        // CommentRepository::$availableContentType = 'course';

        $results = $this->classBeingTested->getComments();

        $this->assertEquals($expectedComments, $results);
    }

    public function test_get_content_type_comments()
    {
        $userId = $this->createAndLogInNewUser();

        $firstContent = $this->contentFactory->create($this->faker->word, ConfigService::$commentableContentTypes[0], ContentService::STATUS_PUBLISHED);
        $secondContentWithOtherType = $this->contentFactory->create($this->faker->word, ConfigService::$commentableContentTypes[1], ContentService::STATUS_PUBLISHED);

        //create comments for first content
        for($i = 0; $i<5; $i++)
        {
            $expectedComments[$i] = $this->commentFactory->create($this->faker->text(), $firstContent['id'], null, $userId);
            $expectedComments[$i]['replies'] = [];

        }

        //create comments for second content
        for($i = 0; $i<5; $i++)
        {
            $otherComments = $this->commentFactory->create($this->faker->text(), $secondContentWithOtherType['id']);
        }

        CommentRepository::$availableUserId = null;
        CommentRepository::$availableContentId = null;
        CommentRepository::$availableContentType =  $firstContent['type'];

        $results = $this->classBeingTested->getComments();

        $this->assertEquals($expectedComments, $results);
    }

    public function test_comments_with_replies()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create($this->faker->word, 'course', ContentService::STATUS_PUBLISHED);
        $numberOfComments = 12;

        for ($i = 0; $i <= $numberOfComments; $i++) {
            $expectedComments[$i] = $this->commentFactory->create($this->faker->text(), $content['id'], null, $userId);
            $expectedComments[$i]['replies'] = [];
        }

        for($i = 0; $i<=3; $i++){
            $expectedComments[$i]['replies'][] = $this->commentFactory->create($this->faker->text(), null,  $expectedComments[$i]['id'], rand());
            unset($expectedComments[$i]['replies'][0]['replies']);
        }

        $results = $this->classBeingTested->getComments();

        $this->assertEquals($expectedComments, $results);
    }
}
