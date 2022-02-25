<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_styles",
 *     indexes={
 *         @ORM\Index(name="sc", columns={"style","content_id"}),
 *         @ORM\Index(name="railcontent_content_styles_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_styles_style_index", columns={"style"}),
 *         @ORM\Index(name="railcontent_content_styles_position_index", columns={"position"})
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 */
class ContentStyle extends ArrayExpressible
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
     * @ORM\Column(type="string")
     * @var string
     */
    protected $style;

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
        $content->addStyle($this);

        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
