<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\ArrayItem;

/**
 * A reference of a Sanity CMS document field
 */
class Image extends ArrayItem
{
    public function __construct()
    {
        parent::__construct(FieldType::Image);
    }

    /**
     * Get the array-formatted values for this reference
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
