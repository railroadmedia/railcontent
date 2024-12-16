<?php

namespace App\Modules\Content\Models\Sanity\Shows;

use App\Modules\Content\Models\Sanity\LessonTemplate;
use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for an Odd Times with Aaron Edgar document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class OddTimes extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Odd Times With Aaron Edgar');
    }
    public static function getName(): string
    {
        return 'odd-times';
    }
}
