<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\Reference;

/**
 * Defines the schema structure for a Level document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class MethodLevel extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(
            self::getName(),
            'Level',
            childName: 'Courses',
            withResources: true,
            withTrailer: true,
            parentType: 'learning-path',
        );

        $detailsGroup = new Group('editorFields', 'Details', true);

        // Define child references
        $coursesChildReference = new Reference([['type' => "learning-path-course"],['type' => "learning-path-lesson"]]);
        $this->addFields([
                             new Field(
                                 FieldType::Array,
                                 'child',
                                 'Child Items',
                                 group: $detailsGroup,
                                 of: $coursesChildReference,
                             ),
                         ],
                         );
    }

    public static function getName(): string
    {
        return 'learning-path-level';
    }
}
