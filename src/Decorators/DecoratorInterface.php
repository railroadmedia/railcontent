<?php

namespace Railroad\Railcontent\Decorators;


interface DecoratorInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function decorate($data);
}