<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentFieldCreated extends Event
{
    /**
     * @var array
     */
    public $newField;

    public function __construct(array $newField)
    {
        $this->newField = $newField;
    }
}