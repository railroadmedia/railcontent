<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;

class ContentPositionInHierarchyDecorator implements DecoratorInterface
{
    /**
     * @param array $entities
     * @return array
     */
    public function decorate(array $entities)
    : array {
        foreach ($entities as $entity) {
            $entity->createProperty('length_in_seconds', $entity->fetch('video.length_in_seconds', 0));

            if ($entity->getParent()
                    ->count() > 0) {
                $entity->createProperty('position', $entity->getParent()[0]->getChildPosition());
            }
        }

        return $entities;
    }
}