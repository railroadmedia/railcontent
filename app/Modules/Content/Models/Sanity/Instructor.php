<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use Modules\Content\Models\Sanity\Structure\Block;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListArrayElement;

/**
 * Defines the schema structure for an Instructor document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Instructor extends BaseSanityModel
{
    public function __construct()
    {
        $focusTagsReference = new Reference([['type' => 'focus']], options: ['disableNew' => false]);
        $genreReference = new Reference([['type' => 'genre']], options: ['aiAssist' => ['embeddingsIndex' => 'genre-index']]);

        $fields = [
            new BrandField(),
            new Field(FieldType::String, 'name'),
            new Field(FieldType::Image, 'thumbnail_url'),
            new Field(FieldType::Boolean, 'is_coach', 'Is this person a coach that should be listed in the coaches list?'),
            new Field(FieldType::Boolean, 'is_coach_of_the_month', 'Coach of the month - (puts coach in home page top banner (MUST UNSET PREVIOUS))'),
            new Field(FieldType::Boolean, 'is_featured', 'Featured Coach - (can feature 0-3 total, shows in featured coaches list)'),
            new Field(FieldType::Boolean, 'is_active', 'Active Coach - (can activate 0-10 total, shows in active coaches list)'),
            new Field(FieldType::Boolean, 'is_house_coach', 'Is this person an internal coach?'),
            new Field(FieldType::Number, 'associated_user_id', 'Associated user id'),
            new Field(FieldType::String, 'focus_text', 'Coach Focus/Card Text - (On the coach cards, 3-8 words.)'),
            new Field(FieldType::Array, 'focus', title:'Focus Tags (used for filtering and search)', of: $focusTagsReference),
            new Field(FieldType::Array, 'genre', 'Genre', '', of: $genreReference),
            new Field(FieldType::String, 'bands', 'Coach Bands Text - (shown near their bio, should be less than 200 words)'),
            new Field(FieldType::String, 'endorsements', 'Coach Endorsements Text - (shown near their bio, should be less than 200 words)'),
            new Field(FieldType::Number, 'forum_thread_id', "Coach Forum Thread ID - (forum thread database ID for 'Ask A Question' link)"),
            new Field(FieldType::Array, 'short_bio', 'Short Coach Bio <br>(Shown in header section under coach name. 1-3 short sentences. HTML allowed.)', of: new Block()),
            new Field(FieldType::Array, 'long_bio', 'Long Coach Bio <br>(Shown bottom coach information section. A paragraph or 2. HTML allowed.)', of: new Block()),
            new Field(FieldType::Image, 'coach_featured_image', 'Coach Featured Image (shown as their featured card background, 16x9 ratio)'),
            new Field(FieldType::Image, 'coach_card_image', 'Coach Card Image (shown as their generic vertical card background, 11x16 ratio)'),
            new Field(FieldType::Image, 'coach_top_banner_image', 'Coach Top Banner Image (in their top info section/banner, 16x9 ratio)'),
            new Field(FieldType::Image, 'coach_bottom_banner_image', 'Coach Bottom Banner Image (in their bottom info section, 16x9 ratio)'),

            new Field(FieldType::Number, 'railcontent_id', 'MWP Railcontent ID', readOnly: "true"),
            new Field(FieldType::String, 'web_url_path', 'MWP web_url_path', readOnly: "true"),
            new Field(FieldType::String, 'calendar_id', 'Subscription CalendarID'),
            new Field(FieldType::File, 'signature', 'Signature'),
        ];
        $preview = new ListItemPreview('name', 'brand', 'thumbnail');
        parent::__construct(self::getName(), 'Instructor', $fields, preview: $preview);
    }

    public static function getName(): string
    {
        return 'instructor';
    }
}
