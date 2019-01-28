<?php

namespace Railroad\Railcontent\Tests\Hydrators;

use Railroad\Doctrine\Hydrators\FakeDataHydrator;
use Railroad\Railcontent\Entities\Content;

class ContentFakeDataHydrator extends FakeDataHydrator
{
    public function fill(&$entity, $customColumnFormatters = [])
    {
        /**
         * @var $defaultEntity User
         */
        $defaultEntity = parent::fill($entity, $customColumnFormatters);

//        $defaultEntity->setDisplayName($this->faker->userName);
//
//        $defaultEntity->setDrumsPlayingSinceYear(rand(1900, 2019));
//        $defaultEntity->setPianoPlayingSinceYear(rand(1900, 2019));
//        $defaultEntity->setGuitarPlayingSinceYear(rand(1900, 2019));

        return $defaultEntity;
    }
}