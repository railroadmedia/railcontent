<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class HierarchyUpdated extends Event
{
    public $parentId;
    public $childId;
    public $deleted;

    public function __construct($parentId, $childId, $deleted=false)
    {
        $this->parentId = $parentId;
        $this->childId = $childId;
        $this->deleted = $deleted;
    }
}