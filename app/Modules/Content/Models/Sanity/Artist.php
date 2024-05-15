<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Artist document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Artist extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'name'),
            new Field(FieldType::String, 'name2'),
            new Field(FieldType::String, 'hiddenField', hidden:"({document}) => !document?.name2"),
        ];
        parent::__construct('artist', 'Artist', $fields);
    }
}
