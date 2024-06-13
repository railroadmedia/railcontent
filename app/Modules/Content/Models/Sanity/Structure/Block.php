<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * A reference of a Sanity CMS document field
 */
class Block
{
    public function __construct(public string $type)
    {
    }

    /**
     * Get the array-formatted values for this reference
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type
        ];
    }
}
