<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;

class ContentChildrensDecorator implements DecoratorInterface
{

    /**
     * @param array $entities
     * @return array
     */
    public function decorate(array $entities)
    : array {
        foreach ($entities as $entity) {
            $entityIds = [];
            foreach($entity->getChild() as $child){
                $entityIds[] = $child->getChild()->getId();
            }
            $entity->createProperty('child_ids', $entityIds);
        }

        return $entities;
    }
}