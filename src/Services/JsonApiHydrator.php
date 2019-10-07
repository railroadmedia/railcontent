<?php

namespace Railroad\Railcontent\Services;

use Railroad\DoctrineArrayHydrator\JsonApiHydrator as BaseHydrator;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class JsonApiHydrator extends BaseHydrator
{
    public function __construct(RailcontentEntityManager $em)
    {
        parent::__construct($em);
    }
}