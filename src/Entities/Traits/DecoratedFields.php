<?php

namespace Railroad\Railcontent\Entities\Traits;

use Doctrine\Common\Collections\ArrayCollection;

trait DecoratedFields
{
    /**
     * @var ArrayCollection
     */
    private $extra;

    /**
     * DecoratedFields constructor.
     */
    public function __construct()
    {
        $this->extra = new ArrayCollection();
    }

    /** Create non-mapped property
     * @param $propertyName
     * @param $propertyValue
     */
    public function createProperty($propertyName, $propertyValue)
    {
        $this->{$propertyName} = $propertyValue;

        $this->extra[$propertyName] = $propertyName;
    }

    /** Getter
     * @param $propertyName
     * @return mixed
     */
    public function getProperty($propertyName, $default = null)
    {

        return $this->{$propertyName} ?? $default;
    }

    /**
     * @return ArrayCollection
     */
    public function getExtra()
    {
        return $this->extra;
    }
}