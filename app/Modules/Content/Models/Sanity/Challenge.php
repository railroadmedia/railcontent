<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use App\Modules\Content\Models\Sanity\Structure\Validation\Integer;
use App\Modules\Content\Models\Sanity\Structure\Validation\Min;
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
        $enrollmentGroup = new Group('enrollmentFields', 'Enrollment', false);
        $contentCardGroup = new Group('banner', 'Banner Cards', false);
        parent::__construct(self::getName(), 'Challenge', withLogos: true, withEnrollment:true, withResources: true, extraGroups: [$enrollmentGroup, $contentCardGroup]) ;
        $detailsGroup = new Group('editorFields', 'Details', true);


        $childReference = new Reference([['type' => "challenge-part"]]);

        $contentCardFields = [
            new Field( FieldType::Boolean, 'is_custom_banner', 'Show as Custom Banner (not just for enrollment)', group: $contentCardGroup),
            new Field( FieldType::Boolean, 'is_banner_draft', 'Is Draft Banner', group: $contentCardGroup),
            new Field(FieldType::Datetime, 'start_time', 'Start Time (Used for Custom Banner', group: $contentCardGroup),
            new Field(FieldType::Datetime, 'end_time', 'End Time (Used for Custom Banner', group: $contentCardGroup),
            new Field(FieldType::Number, 'display_order', 'Display Order', validation: [new Min(0)], group: $contentCardGroup),
            new Field(FieldType::Image, 'bgImg', 'Portrait Image', group: $contentCardGroup, options: ['accept' => '.png']),
            new Field(FieldType::Image, 'squareImg', 'Square Image', validation: [new Required()], group: $contentCardGroup, options: ['accept' => '.png']),
            new Field(FieldType::Image, 'wideImg', '16x9 Image', group: $contentCardGroup, options: ['accept' => '.png']),
        ];

        $dropdownFields = [['type'=> 'challengeDropDownItem' ]];

        $enrollmentFields = [
            new Field( FieldType::String, 'headline', 'Headline', group: $enrollmentGroup),
            new Field( FieldType::String, 'subheadline', 'Subheadline', group: $enrollmentGroup),
            new Field( FieldType::Text, 'header_description', 'Header Description', group: $enrollmentGroup),
            new Field( FieldType::Image, 'header_image_url', 'Header Image Url', group: $enrollmentGroup),
            new Field( FieldType::String, 'cohort_trailer', 'Cohort Trailer', group: $enrollmentGroup),
            new Field( FieldType::String, 'icon1_title', 'Icon1 Title', group: $enrollmentGroup),
            new Field( FieldType::String, 'icon1_copy', 'Icon1 Copy', group: $enrollmentGroup),
            new Field( FieldType::String, 'icon2_title', 'Icon2 Title', group: $enrollmentGroup),
            new Field( FieldType::String, 'icon2_copy', 'Icon2 Copy', group: $enrollmentGroup),
            new Field( FieldType::String, 'icon3_title', 'Icon3 Title', group: $enrollmentGroup),
            new Field( FieldType::String, 'icon3_copy', 'Icon3 Copy', group: $enrollmentGroup),
            new Field( FieldType::String, 'body_title', 'Body Title', group: $enrollmentGroup),
            new Field( FieldType::Text, 'body_top_description', 'Body Top Description', group: $enrollmentGroup),
            new Field( FieldType::Image, 'body_image_url', 'Body Image Url', group: $enrollmentGroup),
            new Field( FieldType::String, 'body_bottom_description', 'Body Bottom Description', group: $enrollmentGroup),
            new Field( FieldType::String, 'dropdown_title', 'Dropdown Title', group: $enrollmentGroup),
            new Field( FieldType::String, 'bottom_title', 'Bottom Title', group: $enrollmentGroup),
            new Field( FieldType::Text, 'bottom_description', 'Bottom Description', group: $enrollmentGroup),
            new Field( FieldType::Number, 'product_id', 'Product Id', group: $enrollmentGroup),
            new Field( FieldType::Datetime, 'cohort_start_date', 'Cohort Start Date', group: $enrollmentGroup),
            new Field( FieldType::Datetime, 'cohort_end_date', 'Cohort End Date', group: $enrollmentGroup),
            new Field( FieldType::String, 'content_id', 'Content Id', group: $enrollmentGroup),
            new Field( FieldType::Number, 'conversation_thread_id', 'Conversation Thread Id', group: $enrollmentGroup),
            new Field( FieldType::Image, 'icon1_url', 'Icon1 Url', group: $enrollmentGroup),
            new Field( FieldType::Image, 'icon2_url', 'Icon2 Url', group: $enrollmentGroup),
            new Field( FieldType::Image, 'icon3_url', 'Icon3 Url', group: $enrollmentGroup),
            new Field( FieldType::String, 'description_trailer_1', 'Description Trailer 1', group: $enrollmentGroup),
            new Field( FieldType::Image, 'description_trailer_1_thumb_url', 'Description Trailer 1 Thumb Url', group: $enrollmentGroup),
            new Field( FieldType::String, 'description_trailer_2', 'Description Trailer 2', group: $enrollmentGroup),
            new Field( FieldType::Image, 'description_trailer_2_thumb_url', 'Description Trailer 2 Thumb Url', group: $enrollmentGroup),
            new Field( FieldType::Image, 'demo_background_image_url', 'Demo Background Image Url', group: $enrollmentGroup),
            new Field( FieldType::Image, 'demo_desktop_center_image_url', 'Demo Desktop Center Image Url', group: $enrollmentGroup),
            new Field( FieldType::Image, 'demo_mobile_center_image_url', 'Demo Mobile Center Image Url', group: $enrollmentGroup),
            new Field( FieldType::String, 'demo_title_text', 'Demo Title Text', group: $enrollmentGroup),
            new Field( FieldType::Text, 'demo_description_text', 'Demo Description Text', group: $enrollmentGroup),
            new Field( FieldType::Text, 'demo_label_text', 'Demo Label Text', group: $enrollmentGroup),
            new Field( FieldType::String, 'demo_trailer', 'Demo Trailer', group: $enrollmentGroup),
            new Field( FieldType::Text, 'first_day_text', 'First Day Text', group: $enrollmentGroup),
            new Field( FieldType::Text, 'last_day_text', 'Last Day Text', group: $enrollmentGroup),
            new Field( FieldType::Text, 'benefit_1', 'Benefit 1', group: $enrollmentGroup),
            new Field( FieldType::Text, 'benefit_2', 'Benefit 2', group: $enrollmentGroup),
            new Field( FieldType::Text, 'benefit_3', 'Benefit 3', group: $enrollmentGroup),
            new Field( FieldType::Boolean, 'is_product', 'Is Product', group: $enrollmentGroup),
            new Field( FieldType::String, 'product_description_header', 'Product Description Header', group: $enrollmentGroup),
            new Field( FieldType::Text, 'product_description_body', 'Product Description Body', group: $enrollmentGroup),
            new Field( FieldType::Number, 'product_original_price', 'Product Original Price', group: $enrollmentGroup),
            new Field( FieldType::Number, 'product_sale_price', 'Product Sale Price', group: $enrollmentGroup),
            new Field( FieldType::Image, 'product_image', 'Product Image', group: $enrollmentGroup),
            new Field( FieldType::Text, 'course_description', 'Course Description', group: $enrollmentGroup),
            new Field( FieldType::Text, 'course_product_description', 'Course Product Description', group: $enrollmentGroup),
            new Field( FieldType::String, 'get_product_badge', 'Get Product Badge', group: $enrollmentGroup),
            new Field( FieldType::String, 'product_cart_link', 'Product Cart Link', group: $enrollmentGroup),
            new Field( FieldType::String, 'product_name', 'Product Name', group: $enrollmentGroup),
            new Field( FieldType::Text, 'product_cart_link_description', 'Product Cart Link Description', group: $enrollmentGroup),
            new Field( FieldType::Boolean, 'custom_cohort', 'Custom Cohort', group: $enrollmentGroup),
            new Field(FieldType::Array, 'dropdown', 'Dropdowns', of: $dropdownFields, group: $enrollmentGroup),
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
                            ... $enrollmentFields,
                            ... $contentCardFields,
                         ]);
        $enrollmentFieldNamesThatExistInDetails = ['brand', 'slug', 'title', 'light_mode_logo_url', 'dark_mode_logo_url', 'railcontent_id', 'enrollment_start_time', 'enrollment_end_time',];
        $this->addGroupToFields($enrollmentFieldNamesThatExistInDetails, $enrollmentGroup);
        $contentCardFieldNamesThatExistInDetails = ['title', 'is_solo', 'enrollment_start_time', 'enrollment_end_time'];
        $this->addGroupToFields($contentCardFieldNamesThatExistInDetails, $contentCardGroup);

    }

    public static function getName(): string
    {
        return 'challenge';
    }
}
