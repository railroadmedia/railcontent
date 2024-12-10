<?php

namespace Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\BaseSanityModel;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\ParentTemplate;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
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
class OnboardingContentCard extends BaseSanityModel
{
    public function __construct()
    {
        $allowedTypes = ['course', 'challenge', 'workout', 'quick-tips', 'pack', 'song', 'learning-path-level'];
        $formattedAllowedTypes = [];
        foreach($allowedTypes as $allowedType) {
            $formattedAllowedTypes[] = ['type' => $allowedType];
        }
        $contentFields = new ListObject( fields:[
            new Field(FieldType::Reference, 'content', 'Content', to: $formattedAllowedTypes, validation: [new Required()]),
            new Field(FieldType::String, 'header', "Header", validation: [new Required()]),
            new Field(FieldType::String, 'subheader', "Sub Header", validation: [new Required()]),
            new Field(FieldType::Image, 'logo', 'Logo'),
            new Field(FieldType::Image, 'bgImg', 'Background Image'),
            new Field(FieldType::Image, 'squareImg', 'Square Image', validation: [new Required()]),
            new Field(FieldType::Image, 'wideImg', 'Wide Image'),
        ],);


        $fields = [
            new Field(FieldType::String, 'description', "Description", readOnly: "true"),
            new BrandField(),
            new Field(FieldType::String, 'access_level', "AccessLevel", validation: [new Required()], options: [
                'list' => ['plus', 'basic'],
                'layout' => 'dropdown'
            ]),
            new Field(FieldType::String, 'experience_level', "Experience Level", validation: [new Required()], options: [
                'list' => ['New', 'Beginner', 'Intermediate', 'Advanced', 'Expert'],
                'layout' => 'dropdown'
            ]),

            new Field(FieldType::Object, 'first_content', 'First Content', fields: $contentFields->fields),
            new Field(FieldType::Object, 'second_content', 'Second Content', fields: $contentFields->fields),

        ];
        $preview = new ListItemPreview('description');
        parent::__construct(self::getName(), 'Onboarding Content Card', $fields, preview: $preview);

    }

    public static function getName(): string
    {
        return 'onboarding-content-card';
    }
}
