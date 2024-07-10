<?php

namespace App\Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

abstract class FormItem
{
    public function __construct(public FieldType $type)
    {
    }
}
