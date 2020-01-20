<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\PersistentCollection;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Content;

class ContentOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param Content $content
     * @return array
     */
    public function transform(Content $content)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        $extraProperties = [];
        $extra = $content->getExtra();

        if ($extra) {
            foreach ($extra as $item) {
                $value = $content->getProperty($item);

                if (is_array($value)) {
                    if (empty($value)) {
                        $extraProperties[$item] = [];
                    }
                    foreach ($value as $index1 => $val) {
                        if (is_object($val)) {
                            $extraProperties[$item][] = $serializer->serializeToUnderScores(
                                $val,
                                $entityManager->getClassMetadata(get_class($val))
                            );
                        } else {
                            if (is_array($val)) {
                                foreach ($val as $index => $val1) {
                                    if (is_string($val1) && (!mb_check_encoding($val1))) {
                                        $value[$index1][$index] = utf8_encode($val1);
                                    }
                                };
                            }

                            $extraProperties[$item] = $value;
                        }
                    }
                } else {
                    $extraProperties[$item] = $value;
                }
            }
        }

        $defaultIncludes = ['fields','userProgress', 'data'];

         if ($content->getProperty('permissions')) {
            $defaultIncludes[] = 'permissions';
        }

        if (count($content->getChild()) > 0) {
            $defaultIncludes[] = 'children';
        }

        $this->setDefaultIncludes($defaultIncludes);

        $serialized = $serializer->serializeToUnderScores($content, $entityManager->getClassMetadata(Content::class));

        $results = array_merge(
            $serialized,
            [
//                'parent_id' => (!$content->getParent()->isEmpty()) ?
//                    $content->getParent()[0]->getParent()->getId() : null,
                'child_id' => null,
                'completed' => $content->isCompleted(),
                'started' => $content->isStarted(),
                'progress_percent' => $content->getProgressPercent(),
            ],
            $extraProperties
        );

        return $results;
    }

    /**
     * @param Content $content
     * @return Item
     */
    public function includeParent(Content $content)
    {
        return $this->item(
            $content->getParent()
                ->getParent(),
            new ContentOldStructureTransformer(),
            'parent'
        );
    }

    /**
     * @param Content $content
     * @return Collection
     */
    public function includeData(Content $content)
    {
        if(!empty($content->getData())) {
            return $this->collection(
                $content->getData(),
                new ContentDataOldStructureTransformer(),
                'contentData'
            );
        } else {
            return $this->collection(
                [],
                new ArrayTransformer(),
                'contentData'
            );
        }
    }

    /**
     * @param Content $content
     * @return Collection
     */
    public function includeFields(Content $content)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        $fields = [];
        foreach (config('oldResponseMapping.fields', []) as $field) {
            $getterName = $getFields = Inflector::camelize('get' . ucwords(camel_case($field)));
            $value = call_user_func([$content, $getterName]);

            if ($value) {
                if ($value instanceof PersistentCollection) {
                    foreach ($value as $item) {
                        $value = call_user_func([$item, $getterName]);

                        if (!($value instanceof Content) && mb_check_encoding($value) == false) {
                            $value = utf8_encode($value);
                        }

                        $fields[] = [
                            'content_id' => $content->getId(),
                            'key' => $field,
                            'value' => ($value instanceof Content)?$this->transform($value):$value,
                            'type' => ($value instanceof Content)?'content_id':'string',
                            'position' => 1,
                        ];
                    }
                } elseif (in_array(
                    $field,
                    $entityManager->getClassMetadata(get_class($content))
                        ->getAssociationNames()
                )) {
                    if ($value instanceof Content) {
                        $this->includeFields($value);
                        $arrayValue = $this->transform($value);

                        $arrayValue['fields'] =
                            $this->includeFields($value)
                                ->getData();
                        $arrayValue['data'] =
                            $this->includeData($value)
                                ->getData()->getValues();

                        $fields[] = [
                            'id' => rand(),
                            'content_id' => $content->getId(),
                            'key' => $field,
                            'value' => $arrayValue,
                            'type' => 'content_id',
                            'position' => 1,
                        ];
                    }

                    $instructor = call_user_func([$value, $getterName]);
                    if ($instructor) {
                        $this->includeFields($instructor);
                        $arrayValue = $this->transform($instructor);

                        $arrayValue['fields'] =
                            $this->includeFields($instructor)
                                ->getData();
                        $arrayValue['data'] =
                            $this->includeData($instructor)
                                ->getData()->getValues();

                        $fields[] = [
                            'id' => rand(),
                            'content_id' => $content->getId(),
                            'key' => $field,
                            'value' => $arrayValue,
                            'type' => 'content_id',
                            'position' => 1,
                        ];
                    }
                } else {
                    if (mb_check_encoding($value) == false) {
                        $value = utf8_encode($value);
                    }
                    $fields[] = [
                        'id' => rand(),
                        'content_id' => $content->getId(),
                        'key' => $field,
                        'value' => $value,
                        'type' => 'string',
                        'position' => 1,
                    ];
                }
            }
        }

        return $this->collection(
            $fields,
            new FieldTransformer(),
            'fields'
        );
    }

    /**
     * @param Content $content
     * @return Collection
     */
    public function includePermissions(Content $content)
    {
        return $this->collection(
            $content->getProperty('permissions'),
            new ContentPermissionOldStructureTransformer(),
            'contentPermissions'
        );
    }

    /**
     * @param Content $content
     * @return Item
     */
    public function includeUserProgress(Content $content)
    {
        if (!empty($content->getUserProgress(auth()->id()))) {
            return $this->item(
                $content->getUserProgress(auth()->id()),
                new UserContentProgressOldStructureTransformer(),
                'user-progress'
            );
        } else {
            return $this->item(
                [auth()->id() => []],
                new ArrayTransformer(),
                'user-progress'
            );
        }
    }

    /**
     * @param Content $content
     * @return Collection
     */
    public function includeChildren(Content $content)
    {
        $childrens =
            $content->getChild()
                ->getValues();

        return $this->collection(
            $childrens,
            new ContentHierarchyChildrensOldStructureTransformer(),
            'children'
        );
    }
}