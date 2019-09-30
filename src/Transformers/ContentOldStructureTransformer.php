<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\PersistentCollection;
use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\Content;

class ContentOldStructureTransformer extends TransformerAbstract
{
    public function transform(Content $content)
    {
        $entityManager = app()->make(EntityManager::class);

        $fields = [];
        foreach (config('oldResponseMapping.fields', []) as $field) {
            $getterName = $getFields = Inflector::camelize('get' . ucwords(camel_case($field)));
            $value = call_user_func([$content, $getterName]);

            if ($value) {
                if ($value instanceof PersistentCollection) {
                    foreach ($value as $item) {
                        $fields[] = [
                            'content_id' => $content->getId(),
                            'key' => $field,
                            'value' => call_user_func([$item, $getterName]),
                            'type' => 'string',
                            'position' => 1,
                        ];
                    }
                } elseif (in_array(
                    $field,
                    $entityManager->getClassMetadata(get_class($content))
                        ->getAssociationNames()
                )) {
                    $instructor = call_user_func([$value, $getterName]);
                    if ($instructor) {
                        $arrayValue = $this->transform($instructor);

                        $fields[] = [
                            'content_id' => $content->getId(),
                            'key' => $field,
                            'value' => $arrayValue,
                            'type' => 'content_id',
                            'position' => 1,
                        ];
                    }
                } else {
                    $fields[] = [
                        'content_id' => $content->getId(),
                        'key' => $field,
                        'value' => $value,
                        'type' => 'string',
                        'position' => 1,
                    ];
                }
            }
        }

        $dataArray = [];
        if (!$content->getData()
            ->isEmpty()) {
            foreach (
                $content->getData()
                    ->toArray() as $data
            ) {
                $value = $data->getValue();
                if (mb_check_encoding($value) == false) {
                    $value = utf8_encode($value);
                }
                $dataArray[] = [
                    'content_id' => $content->getId(),
                    'key' => $data->getKey(),
                    'value' => $value,
                    'position' => $data->getPosition(),
                ];
            }
        }

        return [
            'id' => $content->getId(),
            'slug' => $content->getSlug(),
            'type' => $content->getType(),
            'sort' => $content->getSort(),
            'status' => $content->getStatus(),
            'language' => $content->getLanguage(),
            'brand' => $content->getBrand(),
            'published_on' => $content->getPublishedOn(),
            'created_on' => $content->getCreatedOn(),
            'archived_on' => $content->getArchivedOn(),
            'parent_id' => ($content->getParent()) ?
                $content->getParent()
                    ->getId() : null,
            'child_id' => null,

            'fields' => $fields ?? [],
            'data' => $dataArray,
        ];
    }
}