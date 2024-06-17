<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use Modules\Content\Models\Sanity\Structure\BrandField;

/**
 * Defines the schema structure for a Permission document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Permission extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'name'),
            new BrandField(),
        ];
        parent::__construct('permission', 'Permission', $fields);
    }
}
