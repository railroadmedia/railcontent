<?php

namespace Railroad\Railcontent\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\FullTextSearchRepository")
 * @ORM\Table(indexes={@ORM\Index(columns={"highValue","mediumValue","lowValue"}, flags={"fulltext"})})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_search_indexes")
 *
 */
class SearchIndex
{

    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

    /**
     * @ORM\Column(type="text", name="high_value")
     * @var string
     */
    protected $highValue;

    /**
     * @ORM\Column(type="text", name="medium_value")
     * @var string
     */
    protected $mediumValue;

    /**
     * @ORM\Column(type="text", name="low_value")
     * @var string
     */
    protected $lowValue;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $brand;

    /**
     * @ORM\Column(type="string", name="content_type")
     * @var string
     */
    protected $contentType;

    /**
     * @ORM\Column(type="string", name="content_status")
     * @var string
     */
    protected $contentStatus;

    /**
     * @ORM\Column(type="datetime", name="content_published_on", nullable=true)
     * @var DateTime
     */
    protected $contentPublishedOn;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content
     */
    public function setContent(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getHighValue()
    {
        return $this->highValue;
    }

    /**
     * @param $highValue
     */
    public function setHighValue($highValue)
    {
        $this->highValue = $highValue;
    }

    /**
     * @return string
     */
    public function getMediumValue()
    {
        return $this->mediumValue;
    }

    /**
     * @param $mediumValue
     */
    public function setMediumValue($mediumValue)
    {
        $this->mediumValue = $mediumValue;
    }

    /**
     * @return string
     */
    public function getLowValue()
    {
        return $this->lowValue;
    }

    /**
     * @param $lowValue
     */
    public function setLowValue($lowValue)
    {
        $this->lowValue = $lowValue;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType(string $contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return string
     */
    public function getContentStatus()
    {
        return $this->contentStatus;
    }

    /**
     * @param string $contentStatus
     */
    public function setContentStatus(string $contentStatus)
    {
        $this->contentStatus = $contentStatus;
    }

    /**
     * @return DateTime
     */
    public function getContentPublishedOn()
    {
        return $this->contentPublishedOn;
    }

    /**
     * @param $publishedOn
     */
    public function setContentPublishedOn($publishedOn)
    {
        $this->contentPublishedOn = $publishedOn;
    }
}