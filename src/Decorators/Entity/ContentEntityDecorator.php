<?php

namespace Railroad\Railcontent\Decorators\Entity;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Entities\ContentEntity;

class ContentEntityDecorator implements DecoratorInterface
{
    public function decorate($contentResults)
    {
        if (isset($contentResults['id'])) {
            return new ContentEntity($contentResults);
        }

        $entities = [];

        foreach ($contentResults as $resultsIndex => $result) {
            $entities[$resultsIndex] = new ContentEntity($result);
        }

        return $entities;
    }
}