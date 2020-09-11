<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_key_pitch_types",
 *     indexes={
 *         @ORM\Index(name="kpc", columns={"key_pitch_type","content_id"}),
 *         @ORM\Index(name="railcontent_content_key_pitch_types_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_key_pitch_types_key_pitch_type_index", columns={"key_pitch_type"}),
 *         @ORM\Index(name="railcontent_content_key_pitch_types_position_index", columns={"position"})
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 */
class ContentKeyPitchType extends ArrayExpressible
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
    protected $keyPitchType;

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
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getKeyPitchType()
    {
        return $this->keyPitchType;
    }

    /**
     * @param $keyPitchType
     */
    public function setKeyPitchType($keyPitchType)
    {
        $this->keyPitchType = $keyPitchType;
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