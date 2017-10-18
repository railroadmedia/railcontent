<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/15/2017
 * Time: 4:23 PM
 */

namespace Railroad\Railcontent\Services;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Requests\ContentIndexRequest;

interface SearchInterface
{
    /**
     * @return Builder
     */
    public function generateQuery();

}