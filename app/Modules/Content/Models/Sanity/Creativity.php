<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Creativity document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Creativity extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'name'),
        ];
        parent::__construct('creativity', 'Creativity', $fields);
    }
}
