<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentFieldCreated extends Event
{
    /** @var array */
    public $newField;

    /** @var array */
    public $input;

    public function __construct(array $newField, array $input)
    {
        $this->newField = $newField;
        $this->input = $input;
    }
}