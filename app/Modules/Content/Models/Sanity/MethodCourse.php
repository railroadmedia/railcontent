<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * Defines the schema structure for a Method Course document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class MethodCourse extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Course', childType: 'learning-path-lesson', withResources: true, parentType: 'learning-path-level');
        $detailsGroup = new Group('editorFields', 'Details', true);

        $this->addFields(
            [
                new Field(FieldType::Number, 'length_in_seconds','Duration', group: $detailsGroup)
            ],
        );
    }

    public static function getName(): string
    {
        return 'learning-path-course';
    }
}
