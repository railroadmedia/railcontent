<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Quick Tips document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class PlayAlongPart extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Play Along Part', withResources:true, withAssignments: false);
    }

    public static function getName(): string
    {
        return 'play-along-part';
    }
}
