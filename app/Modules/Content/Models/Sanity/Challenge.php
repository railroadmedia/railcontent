<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\Reference;

/**
 * Defines the schema structure for a Challenge document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Challenge extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Challenge',  withLogos: true, withEnrollment:true, withResources: true) ;
        $detailsGroup = new Group('editorFields', 'Details', true);

        // Define child references
        $coursesChildReference = new Reference([['type' => "challenge-part"],['type' => "pack-bundle-lesson"]]);

        $this->addFields([
                             new Field(
                                        FieldType::Array,
                                        'child',
                                        'Child Items',
                                 group: $detailsGroup,
                                 of: $coursesChildReference,
                             ),
                         ]);
    }

    public static function getName(): string
    {
        return 'challenge';
    }
}
