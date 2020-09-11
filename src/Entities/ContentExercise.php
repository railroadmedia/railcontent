<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_exercises",
 *     indexes={
 *         @ORM\Index(name="ec", columns={"exercise_id","content_id"}),
 *         @ORM\Index(name="railcontent_content_exercises_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_exercises_exercise_id_index", columns={"exercise_id"}),
 *         @ORM\Index(name="railcontent_content_exercises_position_index", columns={"position"})
 *     }
 * )
 *
 */
class ContentExercise extends ArrayExpressible
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @Gedmo\SortableGroup()
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
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
     * @Gedmo\SortablePosition()
     * @ORM\Column(type="integer")
     */
    protected $position;

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
     * @param Content $content
     */
    public function setContent(Content $content)
    {
        $content->addExercise($this);

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
     * @param Content $exercise
     */
    public function setExercise(Content $exercise)
    {
        $this->exercise = $exercise;
    }

    /**
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param integer|null $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @param $exercise
     * @return $this
     */
    public function addExercise(Content $exercise)
    {
        $this->exercise = $exercise;

        return $this;
    }

}