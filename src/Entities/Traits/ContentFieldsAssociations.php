<?php

namespace Railroad\Railcontent\Entities\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentExercise;
use Railroad\Railcontent\Entities\ContentFocus;
use Railroad\Railcontent\Entities\ContentInstructor;
use Railroad\Railcontent\Entities\ContentKey;
use Railroad\Railcontent\Entities\ContentKeyPitchType;
use Railroad\Railcontent\Entities\ContentPlaylist;
use Railroad\Railcontent\Entities\ContentStyle;
use Railroad\Railcontent\Entities\ContentTag;
use Railroad\Railcontent\Entities\ContentTopic;

trait ContentFieldsAssociations
{
    /**
     * @ORM\OneToMany(targetEntity="ContentExercise", mappedBy="content", cascade={"persist"})
     */
    protected $exercise = [];

    /**
     * @ORM\OneToMany(targetEntity="ContentInstructor",mappedBy="content", cascade={"persist","remove"})
     */
    protected $instructor = [];

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentTopic", mappedBy="content",
     *     cascade={"persist","remove"})
     */
    protected $topic = [];

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentTag", mappedBy="content",
     *     cascade={"persist","remove"})
     */
    protected $tag = [];

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentStyle", mappedBy="content",
     *     cascade={"persist","remove"})
     */
    protected $style = [];

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentKey", mappedBy="content",
     *     cascade={"persist","remove"})
     */
    protected $key = [];

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentKeyPitchType", mappedBy="content",
     *     cascade={"persist","remove"})
     */
    protected $keyPitchType = [];

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentPlaylist", mappedBy="content",
     *     cascade={"persist","remove"})
     */
    protected $playlist = [];

    /**
     * @ORM\OneToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="video", referencedColumnName="id")
     */
    protected $video;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentData", mappedBy="content",
     *     cascade={"persist","remove"})
     */
    protected $data = [];

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentFocus", mappedBy="content",
     *     cascade={"persist","remove"})
     */
    protected $focus = [];

     /**
     * @return ArrayCollection
     */
    public function getExercise()
    {
        return $this->exercise;
    }

    /**
     * @param ContentExercise $exercise
     * @return $this|void
     */
    public function addExercise(ContentExercise $exercise)
    {
        if ($this->exercise->contains($exercise)) {
            // Do nothing if its already part of our collection
            return;
        }

        $predictate = function ($element) use ($exercise) {
            return $element->getExercise() === $exercise->getExercise();
        };
        $exist = $this->exercise->filter($predictate);

        if ($exist->isEmpty()) {
            $this->exercise->add($exercise);
        } else {
            $exercises = $exist->first();
            if ($exercises->getPosition() == $exercise->getPosition()) {
                return $this;
            }

            $key = $exist->key();
            if ($exercise->getPosition()) {
                $this->getExercise()
                    ->get($key)
                    ->setPosition($exercise->getPosition());
            }
        }

        return $this;
    }

    /**
     * @param ContentExercise $contentExercise
     */
    public function removeExercise(ContentExercise $contentExercise)
    {
        // If does not exist in the collection, then we don't need to do anything
        if (!$this->exercise->contains($contentExercise)) {
            return;
        }

        $this->exercise->removeElement($contentExercise);
    }

    /**
     * @return string
     */
    public function getInstructorsNamesString()
    {
        $names = [];

        foreach ($this->getInstructor() as $contentInstructor) {
            $names[] = $contentInstructor->getInstructor()->getName();
        }

        return implode(', ', $names);
    }

    /**
     * @return ContentInstructor[]
     */
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * @param ContentInstructor $instructor
     */
    public function addInstructor(ContentInstructor $instructor)
    {
        if ($this->instructor->contains($instructor)) {
            // Do nothing if its already part of our collection
            return;
        }

        $predictate = function ($element) use ($instructor) {
            return $element->getInstructor() === $instructor->getInstructor();
        };
        $exist = $this->instructor->filter($predictate);

        if ($exist->isEmpty()) {
            $this->instructor->add($instructor);
        } else {
            $instructors = $exist->first();
            if ($instructors->getPosition() == $instructor->getPosition()) {
                return $this;
            }

            $key = $exist->key();
            if ($instructor->getPosition()) {
                $this->getInstructor()
                    ->get($key)
                    ->setPosition($instructor->getPosition());
            }
        }

        return $this;
    }

    /**
     * @param ContentInstructor $instructor
     */
    public function setInstructor(?ContentInstructor $instructor)
    {
        $this->instructor = $instructor;
    }

    /**
     * @param ContentInstructor $contentInstructor
     */
    public function removeInstructor(ContentInstructor $contentInstructor)
    {
        // If does not exist in the collection, then we don't need to do anything
        if (!$this->instructor->contains($contentInstructor)) {
            return;
        }

        $this->instructor->removeElement($contentInstructor);
    }

    /**
     * @return ArrayCollection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param ContentTopic $contentTopic
     * @return $this|void
     */
    public function addTopic(ContentTopic $contentTopic)
    {
        if ($this->topic->contains($contentTopic)) {
            // Do nothing if its already part of our collection
            return;
        }

        $predictate = function ($element) use ($contentTopic) {
            return $element->getTopic() === $contentTopic->getTopic();
        };
        $existTopic = $this->topic->filter($predictate);

        if ($existTopic->isEmpty()) {
            $this->topic->add($contentTopic);
        } else {
            $topic = $existTopic->first();
            if ($topic->getPosition() == $contentTopic->getPosition()) {
                return $this;
            }

            $key = $existTopic->key();
            if ($contentTopic->getPosition()) {
                $this->getTopic()
                    ->get($key)
                    ->setPosition($contentTopic->getPosition());
            }
        }
    }

    /**
     * @param ContentTopic $contentTopic
     */
    public function removeTopic(ContentTopic $contentTopic)
    {
        // If the topic does not exist in the collection, then we don't need to do anything
        if (!$this->topic->contains($contentTopic)) {
            return;
        }

        $this->topic->removeElement($contentTopic);
    }

    /**
     * @return ArrayCollection
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param ContentTag $contentTag
     * @return $this
     */
    public function addTag(ContentTag $contentTag)
    {

        $predictate = function ($element) use ($contentTag) {
            return $element->getTag() === $contentTag->getTag();
        };
        $existTag = $this->tag->filter($predictate);

        if ($existTag->isEmpty()) {
            $this->tag->add($contentTag);
        } else {
            $tag = $existTag->first();
            if ($tag->getPosition() == $contentTag->getPosition()) {
                return $this;
            }

            $key = $existTag->key();
            if ($contentTag->getPosition()) {
                $this->getTag()
                    ->get($key)
                    ->setPosition($contentTag->getPosition());
            }
        }

        return $this;
    }

    /**
     * @param ContentTag $contentTag
     */
    public function removeTag(ContentTag $contentTag)
    {
        // If the tag does not exist in the collection, then we don't need to do anything
        if (!$this->tag->contains($contentTag)) {
            return;
        }

        $this->tag->removeElement($contentTag);
    }

    /**
     * @return ArrayCollection
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param ContentKey $contentKey
     * @return $this|void
     */
    public function addKey(ContentKey $contentKey)
    {
        if ($this->key->contains($contentKey)) {
            // Do nothing if its already part of our collection
            return;
        }

        $predictate = function ($element) use ($contentKey) {
            return $element->getKey() === $contentKey->getKey();
        };

        $exist = $this->key->filter($predictate);

        if ($exist->isEmpty()) {
            $this->key->add($contentKey);
        } else {
            $key = $exist->first();
            if ($key->getPosition() == $contentKey->getPosition()) {
                return $this;
            }

            $key = $exist->key();
            if ($contentKey->getPosition()) {
                $this->getKey()
                    ->get($key)
                    ->setPosition($contentKey->getPosition());
            }
        }

        return $this;
    }

    /**
     * @param ContentKey $contentKey
     */
    public function removeKey(ContentKey $contentKey)
    {
        // If does not exist in the collection, then we don't need to do anything
        if (!$this->key->contains($contentKey)) {
            return;
        }

        $this->key->removeElement($contentKey);
    }

    /**
     * @return ArrayCollection
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param ContentKeyPitchType $contentKeyPitchType
     * @return $this|void
     */
    public function addKeyPitchType(ContentKeyPitchType $contentKeyPitchType)
    {
        if ($this->keyPitchType->contains($contentKeyPitchType)) {
            // Do nothing if its already part of our collection
            return;
        }

        $predictate = function ($element) use ($contentKeyPitchType) {
            return $element->getKeyPitchType() === $contentKeyPitchType->getKeyPitchType();
        };

        $exist = $this->keyPitchType->filter($predictate);

        if ($exist->isEmpty()) {
            $this->keyPitchType->add($contentKeyPitchType);
        } else {
            $key = $exist->first();
            if ($key->getPosition() == $contentKeyPitchType->getPosition()) {
                return $this;
            }

            $key = $exist->key();
            if ($contentKeyPitchType->getPosition()) {
                $this->getKey()
                    ->get($key)
                    ->setPosition($contentKeyPitchType->getPosition());
            }
        }

        return $this;
    }

    /**
     * @param ContentKeyPitchType $contentKeyPitchType
     */
    public function removeKeyPitchType(ContentKeyPitchType $contentKeyPitchType)
    {
        // If does not exist in the collection, then we don't need to do anything
        if (!$this->keyPitchType->contains($contentKeyPitchType)) {
            return;
        }

        $this->keyPitchType->removeElement($contentKeyPitchType);
    }

    /**
     * @return ArrayCollection
     */
    public function getKeyPitchType()
    {
        return $this->keyPitchType;
    }

    /**
     * @param ContentPlaylist $contentPlaylist
     * @return $this|void
     */
    public function addPlaylist(ContentPlaylist $contentPlaylist)
    {
        if ($this->playlist->contains($contentPlaylist)) {
            // Do nothing if its already part of our collection
            return;
        }

        $predictate = function ($element) use ($contentPlaylist) {
            return $element->getPlaylist() === $contentPlaylist->getPlaylist();
        };

        $exist = $this->playlist->filter($predictate);

        if ($exist->isEmpty()) {
            $this->playlist->add($contentPlaylist);
        } else {
            $playlist = $exist->first();
            if ($playlist->getPosition() == $contentPlaylist->getPosition()) {
                return $this;
            }

            $key = $exist->key();
            if ($contentPlaylist->getPosition()) {
                $this->getKey()
                    ->get($key)
                    ->setPosition($contentPlaylist->getPosition());
            }
        }

        return $this;
    }

    /**
     * @param ContentPlaylist $contentPlaylist
     */
    public function removePlaylist(ContentPlaylist $contentPlaylist)
    {
        // If does not exist in the collection, then we don't need to do anything
        if (!$this->playlist->contains($contentPlaylist)) {
            return;
        }

        $this->playlist->removeElement($contentPlaylist);
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Content $video
     */
    public function addVideo(Content $video)
    {
        $this->video = $video;
    }

    /**
     * @param Content|null $video
     */
    public function setVideo(?Content $video)
    {
        $this->video = $video;
    }

    /**
     * @param Content $video
     */
    public function removeVideo(Content $video)
    {
        $this->video->removeElement($video);
    }

    /**
     * @return ArrayCollection
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * @param ContentStyle $contentStyle
     * @return $this
     */
    public function addStyle(ContentStyle $contentStyle)
    {
        if ($this->style->contains($contentStyle)) {
            // Do nothing if its already part of our collection
            return;
        }

        $predictate = function ($element) use ($contentStyle) {
            return $element->getStyle() === $contentStyle->getStyle();
        };
        $existStyle = $this->style->filter($predictate);

        if ($existStyle->isEmpty()) {
            $this->style->add($contentStyle);
        } else {
            $style = $existStyle->first();
            if ($style->getPosition() == $contentStyle->getPosition()) {
                return $this;
            }

            $key = $existStyle->key();
            if ($contentStyle->getPosition()) {
                $this->getStyle()
                    ->get($key)
                    ->setPosition($contentStyle->getPosition());
            }
        }

        return $this;
    }

    /**
     * @param ContentStyle $contentStyle
     */
    public function removeStyle(ContentStyle $contentStyle)
    {
        // If the style does not exist in the collection, then we don't need to do anything
        if (!$this->style->contains($contentStyle)) {
            return;
        }

        $this->style->removeElement($contentStyle);
    }

    /**
     * @return ArrayCollection
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param ContentFocus $contentFocus
     * @return $this
     */
    public function addFocus(ContentFocus $contentFocus)
    {

        $predictate = function ($element) use ($contentFocus) {
            return $element->getFocus() === $contentFocus->getFocus();
        };
        $existFocus = $this->focus->filter($predictate);

        if ($existFocus->isEmpty()) {
            $this->focus->add($contentFocus);
        } else {
            $focus = $existFocus->first();
            if ($focus->getPosition() == $contentFocus->getPosition()) {
                return $this;
            }

            $key = $existFocus->key();
            if ($contentFocus->getPosition()) {
                $this->getFocus()
                    ->get($key)
                    ->setPosition($contentFocus->getPosition());
            }
        }

        return $this;
    }

    /**
     * @param ContentFocus $contentFocus
     */
    public function removeFocus(ContentFocus $contentFocus)
    {
        // If the focus does not exist in the collection, then we don't need to do anything
        if (!$this->focus->contains($contentFocus)) {
            return;
        }

        $this->focus->removeElement($contentFocus);
    }

    /**
     * @return ArrayCollection
     */
    public function getFocus()
    {
        return $this->focus;
    }


}
