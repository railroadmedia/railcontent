<?php

namespace App\Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

/**
 * A reference of a Sanity CMS document field
 */
class Reference extends FormItem
{
    public function __construct(public array $to, public ?array $options = null)
    {
        parent::__construct(FieldType::Reference);
    }
}
