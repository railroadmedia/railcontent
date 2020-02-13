<?php

namespace Railroad\Railcontent\Decorators\Mobile;

use Railroad\Railcontent\Decorators\DecoratorInterface;

class StripTagDecorator implements DecoratorInterface
{
    /**
     * @param array $entities
     * @return array
     */
    public function decorate(array $entities)
    : array {

        foreach ($entities['results'] as $entity) {

            $commentText = $entity->getComment();
            $entity->setComment(strip_tags(html_entity_decode($commentText)));

            foreach ($entity->getChildren() as $reply) {
                $reply->setComment(strip_tags(html_entity_decode($reply->getComment())));
            }
        }

        return $entities;
    }
}