<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * Defines the schema structure for a pack bundle lesson document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class PackBundleLesson extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Pack Bundle Lesson', withResources: true);
    }

    public static function getName(): string
    {
        return 'pack-bundle-lesson';
    }
}
