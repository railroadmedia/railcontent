<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Content;

class ContentTransformer extends TransformerAbstract
{
    public function transform(Content $content)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        $contents = (new Collection(
            $serializer->serializeToUnderScores(
                $content,
                $entityManager->getClassMetadata(get_class($content))
            )
        ))->toArray();

        if (count($content->getData()) > 0) {
            $this->defaultIncludes[] = 'data';
        }

        if ($content->getInstructor()) {
            $this->defaultIncludes[] = 'instructor';
        }

        if (count($content->getTopic()) > 0) {
            $this->defaultIncludes[] = 'topic';
        }

        if (count($content->getExercise()) > 0) {
            $this->defaultIncludes[] = 'exercise';
        }

        if (count($content->getTag()) > 0) {
            $this->defaultIncludes[] = 'tag';
        }

        if (count($content->getKey()) > 0) {
            $this->defaultIncludes[] = 'key';
        }

        if (count($content->getKeyPitchType()) > 0) {
            $this->defaultIncludes[] = 'keyPitchType';
        }

        if (count($content->getSbtBpm()) > 0) {
            $this->defaultIncludes[] = 'sbtBpm';
        }

        if (count($content->getSbtExerciseNumber()) > 0) {
            $this->defaultIncludes[] = 'sbtExerciseNumber';
        }

        if (count($content->getPlaylist()) > 0) {
            $this->defaultIncludes[] = 'playlist';
        }

        if ($content->getParent()) {
            $this->defaultIncludes[] = 'parent';
        }

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
     * @return \League\Fractal\Resource\Item
     */
    public function includeInstructor(Content $content)
    {
        return $this->item(
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
    public function includeSbtBpm(Content $content)
    {
        return $this->collection(
            $content->getSbtBpm(),
            new ContentSbtBpmTransformer(),
            'sbtBpm'
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
     * @return \League\Fractal\Resource\Collection
     */
    public function includeSbtExerciseNumber(Content $content)
    {
        return $this->collection(
            $content->getSbtExerciseNumber(),
            new ContentSbtExerciseNumberTransformer(),
            'sbtExerciseNumber'
        );
    }

    /**
     * @param Content $content
     * @return \League\Fractal\Resource\Item
     */
    public function includeParent(Content $content)
    {
        return $this->item(
            $content->getParent(),
            new ContentParentTransformer(),
            'parent'
        );
    }
}