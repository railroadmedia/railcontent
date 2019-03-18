<?php

namespace Railroad\Railcontent\Entities\Traits;

use Doctrine\Common\Collections\ArrayCollection;

trait DecoratedFields
{
    private $extra;

    public function __construct()
    {
        $this->extra = new ArrayCollection();
    }

    public function createProperty($propertyName, $propertyValue)
    {
        $this->{$propertyName} = $propertyValue;

        $this->extra[$propertyName] = $propertyName;
    }

    public function getProperty($propertyName)
    {

        return $this->{$propertyName};
    }

    public function getExtra()
    {
        return $this->extra;
    }


}