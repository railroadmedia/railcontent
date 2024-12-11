<?php

namespace Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\BaseSanityModel;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\ParentTemplate;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use App\Modules\Content\Models\Sanity\Structure\Validation\Max;
use App\Modules\Content\Models\Sanity\Structure\Validation\Min;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;
use Modules\Content\Models\Sanity\Structure\BrandField;
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
class BannerCard extends BaseSanityModel
{
    public function __construct()
    {
        $allowedTypes = ['course', 'challenge', 'workout', 'quick-tips', 'pack', 'song', 'learning-path-level'];
        $formattedAllowedTypes = [];
        foreach($allowedTypes as $allowedType) {
            $formattedAllowedTypes[] = ['type' => $allowedType];
        }

        $fields = [
            new Field(FieldType::Boolean, 'is_draft', 'Is Draft'),
            new BrandField(),
            new Field(FieldType::String, 'name', 'Name', validation: [new Required()]),
            new Field(FieldType::Datetime, 'start_time', 'Start Time'),
            new Field(FieldType::Datetime, 'end_time', 'End Time'),
            new Field(
                FieldType::Number,
                'difficulty',
                validation:     [new Min(0), new Max(10)],
                inputComponent: 'DifficultyInput',
            ),
            new Field(FieldType::Boolean, 'visible_on_desktop', 'Visible On Desktop'),
            new Field(FieldType::Boolean, 'visible_on_mobile', 'Visible On Mobile'),
            new Field(FieldType::Boolean, 'all_but_latest_version', 'All But Latest Version'),

            new Field(FieldType::Number, 'display_order', 'Display Order', validation: [new Min(0), new Required()]),
            new Field(FieldType::String, 'super_title', "Super Title"),
            new Field(FieldType::String, 'super_title_colour', "Super title Colour"),
            new Field(FieldType::String, 'title', "Title", validation:  [new Required()]),
            new Field(FieldType::String, 'title_colour', "Title Colour"),
            new Field(FieldType::String, 'description', "Description"),
            new Field(FieldType::String, 'description_colour', "Description Colour"),

            new Field(FieldType::String, 'button_text', "Button Text"),
            new Field(FieldType::String, 'button_url', "Button URL"),

            new Field(FieldType::Image, 'bgImg', 'Portrait Image', options: ['accept' => '.png']),
            new Field(FieldType::Image, 'squareImg', 'Square Image', validation: [new Required()], options: ['accept' => '.png']),
            new Field(FieldType::Image, 'wideImg', '16x9 Image', options: ['accept' => '.png']),

            new Field(FieldType::Image, 'logo', 'Logo'),
            new Field(FieldType::Reference, 'content', 'Content', to: $formattedAllowedTypes),
        ];
        $preview = new ListItemPreview('description');
        parent::__construct(self::getName(), 'Banner Card', $fields, preview: $preview);
    }

    public static function getName(): string
    {
        return 'banner-card';
    }
}
