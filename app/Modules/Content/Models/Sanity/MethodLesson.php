<?php

namespace App\Modules\Content\Models\Sanity;

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
class MethodLesson extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Lesson', withResources: true, parentType: 'learning-path-course');
    }

    public static function getName(): string
    {
        return 'learning-path-lesson';
    }
}
