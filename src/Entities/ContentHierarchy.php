<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\ContentHierarchyRepository")
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
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $childPosition;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     *
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="child_id", referencedColumnName="id")
     *
     */
    private $child;

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