<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class HierarchyUpdated extends Event
{
    public $parentId;

    /**
     * HierarchyUpdated constructor.
     *
     * @param $parentId
     */
    public function __construct($parentId)
    {
        $this->parentId = $parentId;
    }
}