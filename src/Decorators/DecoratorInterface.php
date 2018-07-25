<?php

namespace Railroad\Railcontent\Decorators;


use Railroad\Railcontent\Support\Collection;

interface DecoratorInterface
{
    /**
     * @param Collection $data
     * @return mixed
     */
    public function decorate(Collection $data);
}