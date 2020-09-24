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

            $entity->setLengthInSeconds($entity->fetch('video.length_in_seconds'));
        }

        return $entities;
    }
}