<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentFieldUpdated extends Event
{
    /**
     * @var array
     */
    public $newField;

    /**
     * @var array
     */
    public $oldFieldData;

    public function __construct(array $newField, array $oldFieldData)
    {
        $this->newField = $newField;
        $this->oldFieldData = $oldFieldData;
    }
}