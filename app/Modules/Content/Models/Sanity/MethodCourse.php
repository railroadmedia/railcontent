<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use Modules\Content\Models\Sanity\Structure\ParentTypeField;

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
    }

    public static function getName(): string
    {
        return 'learning-path-course';
    }
}
