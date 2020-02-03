<?php

namespace Railroad\Railcontent\Decorators;


interface DecoratorInterface
{
    const DECORATION_MODE_MAXIMUM = 'maximum';
    const DECORATION_MODE_PARTIAL = 'partial';
    const DECORATION_MODE_MINIMUM = 'minimum';

    /**
     * @param array $entities
     * @return mixed
     */
    public function decorate(array $entities): array;
}