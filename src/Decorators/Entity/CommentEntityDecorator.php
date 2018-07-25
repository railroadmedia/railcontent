<?php

namespace Railroad\Railcontent\Decorators\Entity;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Entities\CommentEntity;
use Railroad\Railcontent\Support\Collection;

class CommentEntityDecorator implements DecoratorInterface
{
    public function decorate(Collection $commentResults)
    {
        $entities = [];

        foreach ($commentResults as $resultsIndex => $result) {
            $entities[$resultsIndex] = new CommentEntity($result);
        }

        return new Collection($entities);
    }
}