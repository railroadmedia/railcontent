<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Foundation unit document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class Unit extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(
            self::getName(),
            'Unit',
            childType: 'unit-part',
            childName: 'Unit Parts',
            withResources: true,
            withTrailer: true,
            parentType: 'learning-path',
        );
    }

    public static function getName(): string
    {
        return 'unit';
    }
}
