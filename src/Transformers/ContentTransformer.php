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

        if ($content->getData()) {
            $this->defaultIncludes[] = 'data';
        }

        if($content->getInstructor()){
            $this->defaultIncludes[] = 'instructor';
        }

        if ($content->getTopic()) {
            $this->defaultIncludes[] = 'topic';
        }

        if($content->getExercise()){
            $this->defaultIncludes[] = 'exercise';
        }

        if($content->getTag()){
            $this->defaultIncludes[] = 'tag';
        }

        if($content->getKey()){
            $this->defaultIncludes[] = 'key';
        }

        if($content->getKeyPitchType()){
            $this->defaultIncludes[] = 'keyPitchType';
        }

        if($content->getSbtBpm()){
            $this->defaultIncludes[] = 'sbtBpm';
        }

        if($content->getSbtExerciseNumber()){
            $this->defaultIncludes[] = 'sbtExerciseNumber';
        }

        if($content->getPlaylist()){
            $this->defaultIncludes[] = 'playlist';
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
}