<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Theory document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Theory extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'name'),
        ];
        parent::__construct(self::getName(), 'Theory', $fields);
    }

    public static function getName(): string
    {
        return 'theory';
    }
}
