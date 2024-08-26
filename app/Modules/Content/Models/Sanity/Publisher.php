<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Publisher document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Publisher extends BaseSanityModel
{
    public function __construct()
    {
        $childrenList = new ListObject(
            fields: [new Field(FieldType::String, 'name')],
            previewItem: new ListItemPreview('name')
        );

        $fields = [
            new Field(FieldType::String, 'name', validation: [new Required()]),
            new Field(FieldType::Array, 'child', "Children", of: $childrenList, validation: [new Required()]),
        ];
        $isAdmin = user()?->isAdmin() ?? false;
        $isAdmin = true;
        parent::__construct('publisher', 'Publisher', fields: $fields, preview: new ListItemPreview('name'), readOnly: !$isAdmin);
    }

    public static function getName(): string
    {
        return 'Publisher';
    }
}
