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
        parent::__construct(self::getName(), 'Challenge', withLogos: true, withEnrollment:true, withResources: true) ;
        $detailsGroup = new Group('editorFields', 'Details', true);

        // Define multiple child references
        $childReference = new Reference([['type' => "challenge-part"],['type' => "pack-bundle-lesson"]]);

        $this->addFields([
                             new Field(
                                 FieldType::Array,
                                 'child',
                                 'Child Items',
                                 group: $detailsGroup,
                                 of: $childReference,
                             ),
                             new Field(FieldType::Number, 'length_in_seconds', 'Duration', group: $detailsGroup)
                         ]);
    }

    public static function getName(): string
    {
        return 'challenge';
    }
}
