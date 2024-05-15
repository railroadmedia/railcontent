<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Venue document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Venue extends BaseSanityModel
{
    // DELETEME - just here for a test of the Day One With Sanity lesson
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'name'),
        ];
        parent::__construct('venue', 'Venue', $fields);
    }
}
