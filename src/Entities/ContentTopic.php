<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_topics",
 *     indexes={
 *         @ORM\Index(name="tc", columns={"topic","content_id"}),
 *         @ORM\Index(name="railcontent_content_topics_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_topics_topic_index", columns={"topic"}),
 *         @ORM\Index(name="railcontent_content_topics_position_index", columns={"position"})
 *     }
 * )
 *
 */
class ContentTopic extends ArrayExpressible
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
    protected $topic;

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
        $content->addTopic($this);

        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
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