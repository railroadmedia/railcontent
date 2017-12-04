<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\CommentService;

class CommentFactory extends CommentService
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
    public function create($comment=null, $contentId = null, $parentId = null, $userId = null, $temporaryUserDisplayName = '')
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                $this->faker->word,
                rand(),
                null,
                rand(),
                ''
            ];

        return parent::create(...$parameters);
    }
}