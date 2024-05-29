<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Soundslice document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Soundslice extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'title'),
            new Field(FieldType::String, 'soundslice_slug'),
        ];
        $preview = ['select' => ['title' => 'title', 'subtitle' => 'soundslice_slug']];
        parent::__construct('soundslice', 'Soundslice', $fields, preview: $preview);
    }
}
