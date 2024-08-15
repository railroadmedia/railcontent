<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Semester-pack document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class SemesterPack extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Semester Packs', childType: 'semester-pack-lesson', withResources: true, withLogos: true);
    }

    public static function getName(): string
    {
        return 'semester-pack';
    }
}
