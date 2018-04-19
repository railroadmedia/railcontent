<?php

namespace Railroad\Railcontent\Entities;

use ArrayObject;

class Entity extends ArrayObject
{
    public function fetch($dotNotationString)
    {
        return $this->dot()[$dotNotationString] ?? null;
    }

    public function dot()
    {
        return array_dot($this->getArrayCopy());
    }

    public function replace(array $data)
    {
        $this->exchangeArray($data);
    }
}