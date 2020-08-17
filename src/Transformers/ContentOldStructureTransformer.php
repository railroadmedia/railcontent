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
                            $valExtra = $val->getExtra();
                            $extraPropertiesItem = [];
                            if ($valExtra) {
                                foreach ($valExtra as $extraItemVal) {
                                    $valueExtraItem = $val->getProperty($extraItemVal);
                                    if (is_array($valueExtraItem)) {
                                        foreach ($valueExtraItem as $index => $item2) {
                                            if (is_object($item2) && ($item2->getId() != $content->getId())) {
                                                $extraPropertiesItem[$extraItemVal][$index] =
                                                    $serializer->serializeToUnderScores(
                                                        $item2,
                                                        $entityManager->getClassMetadata(get_class($item2))
                                                    );
                                            }
                                        }
                                    } elseif (is_object($extraItemVal) && ($extraItemVal->getId() != $content->getId())) {
                                        $extraPropertiesItem[$extraItemVal] = $serializer->serializeToUnderScores(
                                            $valueExtraItem,
                                            $entityManager->getClassMetadata(get_class($valueExtraItem))
                                        );
                                    } else {
                                        $extraPropertiesItem[$extraItemVal] = $valueExtraItem;
                                    }
                                }
                            }

                            if ($val->getId() != $content->getId()) {

                                $extraProperties[$item][$index1] = array_merge(
                                    $serializer->serializeToUnderScores(
                                        $val,
                                        $entityManager->getClassMetadata(get_class($val))
                                    ),
                                    $extraPropertiesItem ?? []
                                );

                                if ($val instanceof Content) {
                                    $extraProperties[$item][$index1]['fields'] =
                                        $this->includeFields($val)
                                            ->getData();
                                    $extraProperties[$item][$index1]['data'] =
                                        $this->includeData($val)
                                            ->getData();
                                }

                            }
                        } else {
                            if (is_array($val)) {
                                foreach ($val as $index => $val1) {
                                    if (is_string($val1) && (!mb_check_encoding($val1))) {
                                        $value[$index1][$index] = utf8_encode($val1);
                                    }
                                }
                            }

                            $extraProperties[$item] = $value;
                        }
                    }
                } else {
                    if ($value instanceof Content) {
                        $valExtra = $value->getExtra();

                        $extraPropertiesItem = [];
                        if ($valExtra) {
                            foreach ($valExtra as $extraItemVal) {
                                $valueExtraItem = $value->getProperty($extraItemVal);
                                $extraPropertiesItem[$extraItemVal] = $valueExtraItem;
                            }
                        }
                        if ($value->getId() != $content->getId()) {
                            $extraProperties[$item] = array_merge(
                                $serializer->serializeToUnderScores(
                                    $value,
                                    $entityManager->getClassMetadata(get_class($value))
                                ),
                                $extraPropertiesItem
                            );
                            $extraProperties[$item]['fields'] =
                                $this->includeFields($value)
                                    ->getData();
                            $extraProperties[$item]['data'] =
                                $this->includeData($value)
                                    ->getData();
                        }
                    } else {
                        $extraProperties[$item] = $value;
                    }
                }
            }
        }

        $defaultIncludes = ['fields', 'data'];

        if ($content->getProperty('permissions')) {
            $defaultIncludes[] = 'permissions';
        }

        if (count($content->getChild()) > 0) {
            $defaultIncludes[] = 'children';
        }

        $this->setDefaultIncludes($defaultIncludes);

        $serialized = $serializer->serializeToUnderScores($content, $entityManager->getClassMetadata(Content::class));

        //        if ($content->getParent()
        //                ->count() > 0) {
        //            $extraProperties['position'] = array_first(
        //                $content->getParent()
        //            )->getChildPosition();
        //        }
        foreach (config('oldResponseMapping.extraProperties', []) as $extraKey) {
            unset($serialized[$extraKey]);
        }

        $results = array_merge(
            $serialized,
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
        if (!empty($content->getData())) {
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

                        if (is_string($value) && mb_check_encoding($value) == false) {
                            $arrayValue = utf8_encode($value);
                        } else {
                            if (($value instanceof Content)) {
                                $arrayValue = $this->transform($value);

                                $arrayValue['fields'] =
                                    $this->includeFields($value)
                                        ->getData();
                                $arrayValue['data'] =
                                    $this->includeData($value)
                                        ->getData()
                                        ->getValues();
                            } else {
                                $arrayValue = $value;
                            }
                        }

                        $fields[] = [
                            'content_id' => $content->getId(),
                            'key' => $field,
                            'value' => $arrayValue,
                            'type' => ($value instanceof Content) ? 'content_id' : 'string',
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
                                ->getData()
                                ->getValues();

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
                                ->getData();

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
                    if (is_string($value) && mb_check_encoding($value) == false) {
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