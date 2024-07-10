<?php

namespace App\Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

/**
 * A String type of selectable list item
 * @see https://www.sanity.io/docs/string-type
 */
class StringListItem extends ArrayItem
{
    public function __construct()
    {
        parent::__construct(FieldType::String);
    }

    /**
     * Get the array-formatted values for this item, so that it can be rendered as an option in the array input field
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type->value
        ];
    }
}
