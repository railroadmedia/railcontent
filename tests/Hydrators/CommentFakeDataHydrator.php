<?php

namespace Railroad\Railcontent\Tests\Hydrators;

use Railroad\Doctrine\Hydrators\FakeDataHydrator;
use Railroad\Railcontent\Entities\Comment;

class CommentFakeDataHydrator extends FakeDataHydrator
{
    public function fill(&$entity, $customColumnFormatters = [])
    {
        /**
         * @var $defaultEntity Comment
         */
        $defaultEntity = parent::fill($entity, $customColumnFormatters);

        return $defaultEntity;
    }
}