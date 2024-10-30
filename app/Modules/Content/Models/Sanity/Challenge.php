<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;
use Modules\Content\Models\Sanity\Structure\ListObject;

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
                            new Field(FieldType::Number, 'length_in_seconds', 'Duration', group: $detailsGroup),
                            new Field(FieldType::String, 'award_custom_text', 'Custom Text for the PDF award', group: $detailsGroup),
                            new Field(FieldType::File, 'gold_award', 'Gold Award', group: $detailsGroup, validation: [new Required()], options: ['accept' => '.png']),
                            new Field(FieldType::File, 'silver_award', 'Silver Award', group: $detailsGroup, validation: [new Required()], options: ['accept' => '.png']),
                            new Field(FieldType::File, 'bronze_award', 'Bronze Award', group: $detailsGroup, validation: [new Required()], options: ['accept' => '.png']),
                            new Field(FieldType::File, 'badge', 'Badge', group: $detailsGroup, validation: [new Required()], options: ['accept' => '.png']),
                            //new Field(FieldType::File, 'instructor_signature', 'Instructor Signature', group: $detailsGroup, validation: [new Required()], options: ['accept' => 'image/png']),
                            new Field(FieldType::Boolean, 'is_solo', 'Is Solo Challenge', group: $detailsGroup, initialValue: false),
                         ]);
    }

    public static function getName(): string
    {
        return 'challenge';
    }
}
