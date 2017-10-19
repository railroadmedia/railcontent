<?php

namespace Railroad\Railcontent\Services;

use Illuminate\Database\Query\Builder;

interface SearchInterface
{
    /**
     * @return Builder
     */
    public function generateQuery();

}