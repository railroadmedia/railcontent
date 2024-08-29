<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * Defines the schema structure for a Semester pack lesson document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class SemesterPackLesson extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Semester Pack Lesson', withResources: true, parentType: 'semester-pack');
    }

    public static function getName(): string
    {
        return 'semester-pack-lesson';
    }
}
