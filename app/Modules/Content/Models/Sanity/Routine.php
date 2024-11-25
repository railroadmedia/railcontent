<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Enums\VideoType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use App\Modules\Content\Models\Sanity\Structure\Validation\Max;
use App\Modules\Content\Models\Sanity\Structure\Validation\Min;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;
use Modules\Content\Models\Sanity\Structure\Block;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Routine document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class Routine extends BaseSanityModel
{
    public function __construct()
    {
        $instructorReference = new Reference([['type' => 'instructor']]);
        $permissionReference = new Reference([['type' => 'permission']], options: ['disableNew' => false]);
        $blockList = new Block();
        $video               = new ListObject(
            fields: [
                        new Field(FieldType::String, 'type', options: ['list' => array_column(VideoType::cases(), 'value')], validation: [new Required()]),
                        new Field(FieldType::String, 'external_id')
                    ],
        );
        $chapterList = new ListObject(
            fields: [new Field(FieldType::String, 'chapter_description'),
                        new Field(FieldType::Number, 'chapter_timecode', description: 'Time in seconds'),
                        new Field(FieldType::Image, 'chapter_thumbnail_url')
                        ],
            previewItem: new ListItemPreview('chapter_description', 'chapter_timecode')
        );

        $assignmentsList = new ListObject(
            fields: [new Field(FieldType::String, 'assignment_title', validation: [new Required()]),
                        new Field(FieldType::String, 'assignment_soundslice'),
                        new Field(FieldType::String, 'assignment_description'),
                        new Field(FieldType::URL, 'assignment_sheet_music_image')
                    ]
        );
        $topicReference = new Reference([['type' => 'topic']], options: ['disableNew' => false]);
        $genreReference = new Reference([['type' => 'genre']], options: ['aiAssist' => ['embeddingsIndex' => 'genre-index']]);
        $theoryReference = new Reference([['type' => 'theory']], options: ['disableNew' => false]);
        $lifestyleReference = new Reference([['type' => 'lifestyle']], options: ['disableNew' => false]);
        $essentialReference = new Reference([['type' => 'topic']], options: ['disableNew' => false]);
        $creativityReference = new Reference([['type' => 'topic']], options: ['disableNew' => false]);

        $detailsGroup = new Group('editorFields', 'Details', true);
        $openAIGroup  = new Group('openAI', 'OpenAI');
        $groups       = [
            $detailsGroup,
            $openAIGroup,
        ];

        $fields  = [
            new Field(FieldType::String, 'title', validation: [new Required()], group: $detailsGroup),
            new Field(
                FieldType::Slug,
                'slug',
                options: ['source' => 'title', 'isUnique' => 'IsUniqueAcrossBrand'],
                hidden:  "({document}) => !document?.title,",
                group:   $detailsGroup
            ),
            new BrandField($detailsGroup),
            new Field(FieldType::Datetime, 'published_on', options: ['dateformat' => 'YYYY-MM-DD '], group: $detailsGroup),
            new Field(FieldType::Array, 'permission', 'Permissions', of: $permissionReference, inputComponent: 'RolesBasedPermissionsInput', group: $detailsGroup),
            new Field(FieldType::Array, 'instructor', 'Instructor', '', of: $instructorReference, group: $detailsGroup),
            new Field(FieldType::Array, 'description', 'Description', of:$blockList, group:$detailsGroup),
            new Field(
                FieldType::Number,
                'difficulty',
                validation:     [new Min(0), new Max(10)],
                inputComponent: 'DifficultyInput',
                group: $detailsGroup
            ),
            new Field(FieldType::String, 'difficulty_string', 'Difficulty String', readOnly: "true", group: $detailsGroup),
            new Field(FieldType::Number, 'xp', 'XP', validation: [new Min(0)], group: $detailsGroup),
            new Field(FieldType::Number, 'total_xp', 'Total XP', hidden: "({document}) => !document?.xp", readOnly: "true", group: $detailsGroup),
            new Field(FieldType::String, 'difficulty_ai', 'Difficulty AI', inputComponent: 'OpenAiInput', group: $openAIGroup),

            new Field(FieldType::Array, 'genre', 'Genre', '', of: $genreReference, group:$detailsGroup),
            new Field(FieldType::Array, 'essential', 'Essentials', '', of: $essentialReference, group:$detailsGroup),
            new Field(FieldType::Array, 'creativity', 'Creativity', '', of: $creativityReference, group:$detailsGroup),
            new Field(FieldType::Array, 'theory', 'Theory', '', of: $theoryReference, group:$detailsGroup),
            new Field(FieldType::Array, 'topic', 'Topic', '', of: $topicReference, group:$detailsGroup),
            new Field(FieldType::Array, 'lifestyle', 'Lifestyle', '', of: $lifestyleReference, group:$detailsGroup),

            new Field(FieldType::Object, 'video', fields: $video->fields, group: $detailsGroup),
            new Field(FieldType::String, 'low_soundslice_slug', 'low_soundslice_slug', group: $detailsGroup),
            new Field(FieldType::String, 'high_soundslice_slug', 'high_soundslice_slug', group: $detailsGroup),
            new Field(FieldType::Boolean, 'show_in_new_feed', 'Show in New feed', group:$detailsGroup),
            new Field(FieldType::Boolean, 'is_featured', 'Feature in coach/instructor "Featured Lessons" list', group:$detailsGroup),
            new Field(FieldType::Boolean, 'hide_from_recsys', 'Hide from recsys', group: $detailsGroup),
            new Field(FieldType::Image, 'thumbnail', 'Thumbnail', group: $detailsGroup),
            new Field(FieldType::Array, 'chapter', 'Chapters', of: $chapterList, group:$detailsGroup),
            new Field(FieldType::Array, 'assignment', 'Assignments', of: $assignmentsList, group:$detailsGroup),
            new Field(FieldType::Number, 'railcontent_id', 'MWP Railcontent ID', readOnly: "true", group: $detailsGroup),
            new Field(FieldType::String, 'web_url_path', 'MWP web_url_path', readOnly: "true", group: $detailsGroup),
            new Field(FieldType::String, 'language', 'Language', hidden: "true", group: $detailsGroup),
            new Field(FieldType::Number, 'popularity', 'Popularity', readOnly: "true", group: $detailsGroup),
        ];
        $preview = new ListItemPreview('title', 'brand', 'thumbnail');
        parent::__construct(self::getName(), 'Routine', fields: $fields, preview: $preview, groups: $groups);
    }

    public static function getName(): string
    {
        return 'routine';
    }
}
