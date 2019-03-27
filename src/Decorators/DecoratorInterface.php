<?php

namespace Railroad\Railcontent\Decorators;


interface DecoratorInterface
{
    /**
     * @param array $entities
     * @return mixed
     */
    public function decorate(array $entities): array;
}