<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;


/**
 * Defines the schema structure for a Routine document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class Routine extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Routine');

        $detailsGroup = new Group('editorFields', 'Details', true);
        $this->addFields([
                             new Field(FieldType::String, 'low_soundslice_slug', 'low_soundslice_slug', group: $detailsGroup),
                             new Field(FieldType::String, 'high_soundslice_slug', 'high_soundslice_slug', group: $detailsGroup)
                         ]);
    }

    public static function getName(): string
    {
        return 'routine';
    }
}
