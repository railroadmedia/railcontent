<?php

namespace Railroad\Railcontent\Entities;

use ArrayObject;

class Entity extends ArrayObject
{
    protected $dotCache = null;

    public function fetch($dotNotationString, $default = '')
    {
        $dotNotationField = str_replace('fields.','', $dotNotationString);
        if(isset($this[$dotNotationField])){
            return $this[$dotNotationField] ?? $default;
        }
        return $this->dot()[$dotNotationString] ?? $default;
    }

    public function dot()
    {
        if (!is_null($this->dotCache)) {
            return $this->dotCache;
        }

        $this->dotCache = array_dot($this->getArrayCopy());

        return $this->dotCache;
    }

    public function replace(array $data)
    {
        $this->exchangeArray($data);

        $this->dotCache = null;
    }

    public function offsetSet($index, $newval)
    {
        parent::offsetSet($index, $newval);

        $this->dotCache = null;
    }

    public function offsetUnset($index)
    {
        parent::offsetUnset($index);

        $this->dotCache = null;
    }

    public function __set($name, $value)
    {
        $this->dotCache = null;
    }
}