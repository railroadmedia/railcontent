<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/15/2017
 * Time: 4:23 PM
 */

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Requests\ContentIndexRequest;

interface SearchInterface
{
    public function generateQuery(ContentIndexRequest $request);

}