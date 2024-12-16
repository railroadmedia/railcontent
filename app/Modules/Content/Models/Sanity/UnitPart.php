<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * Defines the schema structure for a Foundation lesson document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class UnitPart extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Lesson', withResources: true, parentType: 'unit');
    }

    public static function getName(): string
    {
        return 'unit-part';
    }
}
