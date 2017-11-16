<?php

namespace Railroad\Railcontent\Factories;


use Faker\Generator;
use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Services\ConfigService;

class CommentAssignationFactory extends CommentAssignmentService
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @param null $contentId
     * @param null $key
     * @param null $value
     * @param null $position
     * @return array
     */
    public function create($commentId = null, $contentType = null)
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                ['user_id' => rand()],
                $this->faker->randomElement(ConfigService::$commentsAssignation),
            ];

        return parent::store(...$parameters);
    }
}