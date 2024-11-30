<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use App\Modules\Content\Models\Sanity\Structure\Validation\Integer;
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
        $detailsGroup = new Group('editorFields', 'Details', true);

        // Define multiple child references
        $childReference = new Reference([['type' => "challenge-part"],['type' => "pack-bundle-lesson"]]);
        $contentCardGroup = new Group('contentCards', 'Content Cards', false);
        parent::__construct(self::getName(), 'Challenge', withLogos: true, withEnrollment:true, withResources: true, extraGroups: [$contentCardGroup]) ;

        $contentCardFields = [
            new Field(FieldType::Image, 'bgImg', 'Background Image', group: $contentCardGroup, options: ['accept' => '.png']),
            new Field(FieldType::Image, 'squareImg', 'Square Image', validation: [new Required()], group: $contentCardGroup, options: ['accept' => '.png']),
            new Field(FieldType::Image, 'wideImg', 'Wide Image', group: $contentCardGroup, options: ['accept' => '.png']),
        ];

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
                            new Field(FieldType::Boolean, 'is_solo', 'Is Solo Challenge', group: $detailsGroup, initialValue: false),
                            new Field(FieldType::Number, 'product_id', 'Shopify Product Id', group: $detailsGroup, validation: [new Integer()]),
                            ... $contentCardFields,
                         ]);

    }

    public static function getName(): string
    {
        return 'challenge';
    }
}
