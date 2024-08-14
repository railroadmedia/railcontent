<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a pack bundle document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class PackBundle extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Pack Bundles', childType: 'pack-bundle-lesson', withResources: true);
    }

    public static function getName(): string
    {
        return 'pack-bundle';
    }
}
