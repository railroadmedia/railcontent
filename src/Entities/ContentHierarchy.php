<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_content_hierarchy")
 *
 */
class ContentHierarchy
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @Gedmo\SortablePosition()
     * @ORM\Column(type="integer")
     */
    protected $childPosition;

    /**
     * @Gedmo\SortableGroup()
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     *
     */
    protected $parent;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="child_id", referencedColumnName="id")
     *
     */
    protected $child;

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
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $content
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        $parent->addChild($this);
    }
    /**
     * @return mixed
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @param mixed $content
     */
    public function setChild($child)
    {
        $this->child = $child;

        $child->setParent($this);
    }

    /**
     * @return mixed
     */
    public function getChildPosition()
    {
        return $this->childPosition;
    }

    /**
     * @param mixed $content
     */
    public function setChildPosition($childPosition)
    {
        $this->childPosition = $childPosition;
    }
}