<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\ContentExerciseRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_content_exercise")
 *
 */
class ContentExercise
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     *
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     *
     */
    private $exercise;

    /**
     * @return int
     */
    public function getId()
    : int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
       // $content->addExercise($this);
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getExercise()
    {
        return $this->exercise;
    }

    /**
     * @param mixed $content
     */
    public function setExercise($exercise)
    {
        $this->exercise = $exercise;
    }
}