<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Course part document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class CoursePart extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Course Part', withResources: true, parentType: 'course');
    }

    public static function getName(): string
    {
        return 'course-part';
    }
}
