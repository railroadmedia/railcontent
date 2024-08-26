<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Course document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Course extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Courses', childType: 'course-part', withResources: true);
    }

    public static function getName(): string
    {
        return 'course';
    }
}
