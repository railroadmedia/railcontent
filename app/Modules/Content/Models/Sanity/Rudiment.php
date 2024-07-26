<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Rudiment document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class Rudiment extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Rudiments', withSheetMusicThumb: true, withGear: true, withResources: true);
    }


    public static function getName(): string
    {
        return 'rudiment';
    }
}
