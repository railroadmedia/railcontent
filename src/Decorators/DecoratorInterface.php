<?php

namespace Railroad\Railcontent\Decorators;


use Railroad\Railcontent\Support\Collection;

interface DecoratorInterface
{
    const DECORATION_MODE_MAXIMUM = 'maximum';
    const DECORATION_MODE_PARTIAL = 'partial';
    const DECORATION_MODE_MINIMUM = 'minimum';

    /**
     * @param Collection $data
     * @return mixed
     */
    public function decorate(Collection $data);
}