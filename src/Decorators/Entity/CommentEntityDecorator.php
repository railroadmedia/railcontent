<?php

namespace Railroad\Railcontent\Decorators\Entity;

use Railroad\Railcontent\Entities\CommentEntity;
use Railroad\Railcontent\Support\Collection;
use Railroad\Resora\Decorators\DecoratorInterface;

class CommentEntityDecorator implements DecoratorInterface
{
    public function decorate($commentResults)
    {
        $entities = [];

        foreach ($commentResults as $resultsIndex => $result) {
            $entities[$resultsIndex] = new CommentEntity($result);
        }

        return new Collection($entities);
    }
}