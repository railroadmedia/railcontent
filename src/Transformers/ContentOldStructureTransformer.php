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
                    foreach ($value as $val) {
                        if (is_object($val)) {
                            $extraProperties[$item][] = $serializer->serialize(
                                $val,
                                $entityManager->getClassMetadata(get_class($val))
                            );
                        } else {
//                            array_walk_recursive($value, function(&$item, $key){
//                                if(!mb_check_encoding($item)){
//                                    $item = utf8_encode($item);
//                                }
//                            });

                            $extraProperties[$item] = $value;
                        }
                    }
                } else {
//                    if(mb_check_encoding($value) == false){
//                        $value = utf8_encode($value);
//                    }
                    $extraProperties[$item] = $value;
                }
            }
        }

        $createdOn =
            ($content->getCreatedOn()) ?
                $content->getCreatedOn()
                    ->toDateTimeString() : null;
        $publishedOn =
            ($content->getPublishedOn()) ?
                $content->getPublishedOn()
                    ->toDateTimeString() : null;
        $archivedOn =
            ($content->getArchivedOn()) ?
                $content->getArchivedOn()
                    ->toDateTimeString() : null;

        $defaultIncludes = ['fields'];
        if (count($content->getData()) > 0) {
            $defaultIncludes[] = 'data';
        }

        if ($content->getProperty('permissions')) {
            $defaultIncludes[] = 'permissions';
        }

        if (count($content->getChild()) > 0) {
            $defaultIncludes[] = 'children';
        }


        $this->setDefaultIncludes($defaultIncludes);

        return array_merge([
            'id' => $content->getId(),
            'slug' => $content->getSlug(),
            'type' => $content->getType(),
            'sort' => $content->getSort(),
            'status' => $content->getStatus(),
            'language' => $content->getLanguage(),
            'brand' => $content->getBrand(),
            'published_on' => $publishedOn,
            'created_on' => $createdOn,
            'archived_on' => $archivedOn,
            'parent_id' => ($content->getParent()) ?
                $content->getParent()->getParent()
                    ->getId() : null,
            'child_id' => null,
            'completed' => $content->isCompleted(),
            'started' => $content->isStarted(),
            'progress_percent' => $content->getProgressPercent(),
        ], $extraProperties);
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
        return $this->collection(
            $content->getData(),
            new ContentDataOldStructureTransformer(),
            'contentData'
        );
    }

    /**
     * @param Content $content
     * @return Collection
     */
    public function includeFields(Content $content)
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
                    if($value instanceof Content){
                        $this->includeFields($value);
                        $arrayValue = $this->transform($value);

                        $arrayValue['fields'] = $this->includeFields($value)->getData();
                        $arrayValue['data'] = $this->includeData($value)->getData();

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

                        $arrayValue['fields'] = $this->includeFields($instructor)->getData();
                        $arrayValue['data'] = $this->includeData($instructor)->getData();

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
                'contentProgress'
            );
        } else {
            return $this->item(
                $content->getUserProgress(auth()->id()),
                new ArrayTransformer(),
                'contentProgress'
            );
        }
    }

    /**
     * @param Content $content
     * @return Collection
     */
    public function includeChildren(Content $content)
    {
        $childrens = $content->getChild()->getValues();

        return $this->collection(
            $childrens,
            new ContentHierarchyChildrensOldStructureTransformer(),
            'children'
        );
    }
}