<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_instructors",
 *     indexes={
 *         @ORM\Index(name="ic", columns={"instructor_id","content_id"}),
 *         @ORM\Index(name="railcontent_content_instructors_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_instructors_instructor_id_index", columns={"instructor_id"}),
 *         @ORM\Index(name="railcontent_content_instructors_position_index", columns={"position"})
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 */
class ContentInstructor
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="instructor_id", referencedColumnName="id")
     *
     */
    private $instructor;

    /**
     * @Gedmo\SortableGroup()
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

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
     * @return Content
     */
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * @param Content $instructor
     */
    public function setInstructor(Content $instructor)
    {
        $this->instructor = $instructor;
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
        $content->addContentInstructors($this);

        $this->content = $content;
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
     * @param Content $instructor
     * @return $this
     */
    public function addInstructor(Content $instructor)
    {
        $this->instructor = $instructor;

        return $this;
    }
}