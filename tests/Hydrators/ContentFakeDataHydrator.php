<?php

namespace Railroad\Railcontent\Tests\Hydrators;

use Railroad\Doctrine\Hydrators\FakeDataHydrator;

class ContentFakeDataHydrator extends FakeDataHydrator
{
    public function fill(&$entity, $customColumnFormatters = [])
    {
        /**
         * @var $defaultEntity User
         */
        $defaultEntity = parent::fill($entity, $customColumnFormatters);

        return $defaultEntity;
    }
}