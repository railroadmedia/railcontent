<?php

namespace App\Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

abstract class ArrayItem
{

    public function __construct(public FieldType $type) {
    }

    /**
     * Get the array-formatted values for this array item, so that it can be used to fill the "of" setting for a field
     *
     * @return array
     */
    abstract public function toArray(): array;
}
