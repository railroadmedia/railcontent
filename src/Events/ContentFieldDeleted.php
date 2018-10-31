<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentFieldDeleted extends Event
{
    /**
     * @var array
     */
    public $deletedField;

    public function __construct(array $deletedField)
    {
        $this->deletedField = $deletedField;
    }
}