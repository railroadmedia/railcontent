<?php

namespace Railroad\Railcontent\Decorators\Entity;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Entities\ContentEntity;

class ContentEntityDecorator implements DecoratorInterface
{
    public function decorate($contentResults)
    {
        if (isset($contentResults['id'])) {

            // convert field linked contents to entities as well
            foreach ($contentResults['fields'] as $fieldIndex => $field) {
                if (isset($field['value']['slug'])) {
                    $contentResults['fields'][$fieldIndex]['value'] = new ContentEntity($field['value']);
                }
            }

            return new ContentEntity($contentResults);
        }

        $entities = [];

        foreach ($contentResults as $resultsIndex => $result) {
            $entities[$resultsIndex] = new ContentEntity($result);

            // convert field linked contents to entities as well
            foreach ($result['fields'] ?? [] as $fieldIndex => $field) {
                if (isset($field['value']['slug'])) {
                    $entities[$resultsIndex]['fields'][$fieldIndex]['value'] = new ContentEntity($field['value']);
                }
            }
        }

        return $entities;
    }
}