<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;

class ContentDecorator implements DecoratorInterface
{

    /**
     * @param array $entities
     * @return array
     */
    public function decorate(array $entities)
    : array {

        foreach ($entities as $entity) {

            $entity->createProperty('length_in_seconds', $entity->fetch('video.length_in_seconds'));
        }

        return $entities;
    }
}