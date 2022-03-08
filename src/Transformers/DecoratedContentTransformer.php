<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class DecoratedContentTransformer extends TransformerAbstract
{
    public function transform(Content $content)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

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
                            $extraProperties[$item] = $value;
                        }
                    }
                } else {
                    $extraProperties[$item] = $value;
                }
            }
        }

        $contents = (new Collection(
            array_merge(
                $serializer->serialize(
                    $content,
                    $entityManager->getClassMetadata(get_class($content))
                ),
                $extraProperties
            )
        ))->toArray();

        $defaultIncludes = [];
        if (count($content->getData()) > 0) {
            $defaultIncludes[] = 'data';
        }

        if (count($content->getInstructor()) > 0) {
            $defaultIncludes[] = 'instructor';
        }

        if (count($content->getTopic()) > 0) {
            $defaultIncludes[] = 'topic';
        }

        if (count($content->getExercise()) > 0) {
            $defaultIncludes[] = 'exercise';
        }

        if (count($content->getTag()) > 0) {
            $defaultIncludes[] = 'tag';
        }

        if (count($content->getKey()) > 0) {
            $defaultIncludes[] = 'key';
        }

        if (count($content->getKeyPitchType()) > 0) {
            $defaultIncludes[] = 'keyPitchType';
        }

        if (count($content->getPlaylist()) > 0) {
            $defaultIncludes[] = 'playlist';
        }

        if ($content->getParent() && $content->getParent()->count() > 0) {
            $defaultIncludes[] = 'parent';
        }

        $this->setDefaultIncludes($defaultIncludes);

        array_walk_recursive(
            $contents,
            function (&$item) {
                if(is_string($item)) {
                    $item = utf8_encode($item);
                }
            }
        );

        return $contents;
    }

    /**
     * @param Content $content
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTag(Content $content)
    {
        return $this->collection(
            $content->getTag(),
            new ContentTagTransformer(),
            'tag'
        );
    }

    /**
     * @param Content $content
     * @return \League\Fractal\Resource\Collection
     */
    public function includeData(Content $content)
    {
        return $this->collection(
            $content->getData(),
            new ContentDataTransformer(),
            'contentData'
        );
    }

    /**
     * @param Content $content
     * @return Item
     */
    public function includeInstructor(Content $content)
    {
        return $this->collection(
            $content->getInstructor(),
            new ContentInstructorTransformer(),
            'instructor'
        );
    }

    /**
     * @param Content $content
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTopic(Content $content)
    {
        return $this->collection(
            $content->getTopic(),
            new ContentTopicTransformer(),
            'topic'
        );
    }

    /**
     * @param Content $content
     * @return \League\Fractal\Resource\Collection
     */
    public function includeKey(Content $content)
    {
        return $this->collection(
            $content->getKey(),
            new ContentKeyTransformer(),
            'key'
        );
    }

    /**
     * @param Content $content
     * @return \League\Fractal\Resource\Collection
     */
    public function includeKeyPitchType(Content $content)
    {
        return $this->collection(
            $content->getKeyPitchType(),
            new ContentKeyPitchTypeTransformer(),
            'keyPitchType'
        );
    }

    /**
     * @param Content $content
     * @return \League\Fractal\Resource\Collection
     */
    public function includeExercise(Content $content)
    {
        return $this->collection(
            $content->getExercise(),
            new ContentExerciseTransformer(),
            'exercise'
        );
    }

    /**
     * @param Content $content
     * @return \League\Fractal\Resource\Collection
     */
    public function includePlaylist(Content $content)
    {
        return $this->collection(
            $content->getPlaylist(),
            new ContentPlaylistTransformer(),
            'playlist'
        );
    }

    /**
     * @param Content $content
     * @return Item
     */
    public function includeParent(Content $content)
    {
        return $this->collection(
            $content->getParent(),
            new ContentParentTransformer(),
            'parent'
        );
    }

}