<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_data",
 *     indexes={
 *         @ORM\Index(name="railcontent_content_data_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_data_key_index", columns={"key"}),
 *         @ORM\Index(name="railcontent_content_data_position_index", columns={"position"})
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 */
class ContentData extends ArrayExpressible
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @Gedmo\SortableGroup()
     * @ORM\Column(type="string", name="`key`" )
     * @var string
     */
    protected $key;

    /**
     * @ORM\Column(type="string", name="`value`")
     * @var string
     */
    protected $value;

    /**
     * @Gedmo\SortablePosition()
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @Gedmo\SortableGroup()
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content", inversedBy="data")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

    /**
     * @return int
     */
    public function getId()
    : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey()
    : string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key)
    : void {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getValue()
    : string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    : void {
        $this->value = $value;
    }

    /**
     * @return integer
     */
    public function getPosition()
    : int
    {
        return $this->position;
    }

    /**
     * @param integer|null $position
     */
    public function setPosition($position)
    : void {
        $this->position = $position;
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
        $content->addData($this);

        $this->content = $content;
    }
}