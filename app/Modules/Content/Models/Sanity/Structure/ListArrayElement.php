<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\FormItem;

class ListArrayElement extends FormItem
{
    public function __construct()
    {
        parent::__construct(FieldType::String);
    }
}
