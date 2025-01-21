<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * Defines the schema structure for a Workout document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Workout extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Workout', withResources: true, withAssignments: false);
        $detailsGroup = new Group('editorFields', 'Details', true);
        $this->addFields([
                             new Field(FieldType::String, 'soundslice_slug', group:$detailsGroup)
                         ]);
    }

    public static function getName(): string
    {
        return 'workout';
    }
}
