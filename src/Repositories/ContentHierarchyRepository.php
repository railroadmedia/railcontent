<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;


class ContentHierarchyRepository extends EntityRepository
{
    use ByContentIdTrait;

}