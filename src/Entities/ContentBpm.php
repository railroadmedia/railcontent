<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_bpm",
 *     indexes={
 *         @ORM\Index(name="bc", columns={"bpm","content_id"}),
 *         @ORM\Index(name="railcontent_content_bpm_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_bpm_bpm_index", columns={"bpm"}),
 *         @ORM\Index(name="railcontent_content_bpm_position_index", columns={"position"})
 *     }
 * )
 *
 */
class ContentBpm extends ArrayExpressible
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @Gedmo\SortableGroup()
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="content_id", referencedColumnName="id")
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $bpm;

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
        $content->addBpm($this);

        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getBpm()
    {
        return $this->bpm;
    }

    /**
     * @param mixed $bpm
     */
    public function setBpm($bpm)
    {
        $this->bpm = $bpm;
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