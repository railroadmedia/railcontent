<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Student Focus document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class StudentFocus extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Student Focus', withResources: true);
    }

    public static function getName(): string
    {
        return 'student-focus';
    }
}
