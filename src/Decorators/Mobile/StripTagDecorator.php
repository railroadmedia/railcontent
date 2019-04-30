<?php

namespace Railroad\Railcontent\Decorators\Mobile;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Entities\CommentEntity;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class StripTagDecorator implements DecoratorInterface
{
    public function decorate(Collection $entities)
    {
        foreach ($entities as $entityIndex => $entity) {

            if ($entity instanceof ContentEntity) {
                $contentData = $entity['data'] ?? [];
                foreach ($contentData as $index => $data) {
                    if ($data['key'] == 'description') {
                        $entities[$entityIndex]['data'][$index]['value'] =
                            strip_tags(html_entity_decode($data['value']));
                    }
                }

                $assignments = $entity['assignments'] ?? [];
                foreach ($assignments as $index => $item) {
                    foreach ($item['data'] as $indexData => $data) {
                        if ($data['key'] == 'description') {
                            $entities[$entityIndex]['assignments'][$index]['data'][$indexData]['value'] =
                                strip_tags(html_entity_decode($data['value']));
                        }
                    }
                }
            }

            if ($entity instanceof CommentEntity) {
                $entities[$entityIndex]['comment'] = strip_tags(html_entity_decode($entity['comment']));
                $replies = $entity['replies'] ?? [];
                foreach ($replies as $index => $reply) {
                    $entities[$entityIndex]['replies'][$index]['comment'] =
                        strip_tags(html_entity_decode($reply['comment']));
                }
            }
        }

        return $entities;
    }
}