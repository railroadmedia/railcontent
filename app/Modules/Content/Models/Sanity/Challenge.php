<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use Modules\Content\Models\Sanity\Structure\BrandField;

/**
 * Defines the schema structure for a Challenge document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Challenge extends BaseSanityModel
{
    public function __construct()
    {
        $topicReference = new Reference([['type' => 'topic']], options: ['disableNew' => false]);
        $instructorReference = new Reference([['type' => 'instructor']]);
        $childReference = new Reference([['type' => 'challenge-part']]);
        $permissionReference = new Reference([['type' => 'permission']], options: ['disableNew' => false]);

        $detailsGroup = new Group('editorFields', 'Details', true);
        $openAIGroup = new Group('openAI', 'OpenAI');
        $groups = [
            $detailsGroup,
            $openAIGroup
        ];

        $fields = [
            new Field(FieldType::String, 'title', validation: "(rule) => rule.required()",group:$detailsGroup),
            new Field(FieldType::Slug, 'slug', options:['source' => 'title','isUnique'=>'IsUniqueAcrossBrand'], hidden: "({document}) => !document?.title,", group:$detailsGroup),
            new BrandField($detailsGroup),
            new Field(FieldType::Datetime, 'published_on', options: ['dateformat' => 'YYYY-MM-DD '], group:$detailsGroup),
            new Field(FieldType::Datetime, 'enrollment_start_time', options: ['dateformat' => 'YYYY-MM-DD '], group:$detailsGroup),
            new Field(FieldType::Datetime, 'enrollment_end_time', options: ['dateformat' => 'YYYY-MM-DD '], group:$detailsGroup),
            new Field(FieldType::Array, 'permission', 'Permissions', of: $permissionReference, inputComponent: 'RolesBasedPermissionsInput',group:$detailsGroup),
            new Field(FieldType::Array, 'instructor', 'Instructor', '', of: $instructorReference,group:$detailsGroup),
            new Field(
                FieldType::Number,
                'difficulty',
                validation: "rule => rule.min(0).max(10)",
                inputComponent: 'DifficultyInput',group:$detailsGroup
            ),
            new Field(FieldType::String, 'difficulty_string', 'Difficulty String', readOnly: "true",group:$detailsGroup),
            new Field(FieldType::Number, 'xp', 'XP', validation: "rule => rule.min(0)",group:$detailsGroup),
            new Field(FieldType::Number, 'total_xp', 'Total XP', hidden: "({document}) => !document?.xp", readOnly: "true",group:$detailsGroup),
            new Field(FieldType::String, 'difficulty_ai', 'Difficulty AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::String, 'genre_ai', 'Genre AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::Boolean, 'hide_from_recsys', 'Hide from recsys',group:$detailsGroup),
            new Field(FieldType::Array, 'topic', 'Topic', '', of: $topicReference,group:$detailsGroup),
            new Field(FieldType::Number, 'child_count', 'Child count', hidden: "({document}) => !document?.soundslice", readOnly: "true",group:$detailsGroup),
            new Field(FieldType::Image, 'thumbnail', 'Thumbnail',group:$detailsGroup),
            new Field(FieldType::Image, 'pack_logo', 'Pack Logo',group:$detailsGroup),
            new Field(FieldType::Image, 'dark_logo', 'Dark Logo',group:$detailsGroup),
            new Field(FieldType::Image, 'light_logo', 'Light Logo',group:$detailsGroup),
            new Field(FieldType::Array, 'child', 'Lessons', '', of: $childReference,group:$detailsGroup),
            new Field(FieldType::Number, 'railcontent_id', 'MWP Railcontent ID', readOnly: "true",group:$detailsGroup), //web_url_path
            new Field(FieldType::String, 'web_url_path', 'MWP web_url_path', readOnly: "true",group:$detailsGroup),
            new Field(FieldType::String, 'language', 'Language', hidden: "true",group:$detailsGroup),
            new Field(FieldType::Number, 'popularity', 'Popularity', readOnly: "true",group:$detailsGroup), //web_url_path
        ];
        $preview = ['select' => ['title' => 'title', 'subtitle' => 'brand', 'media' => 'thumbnail']];
        parent::__construct('challenge', 'Challenge', fields: $fields, preview: $preview, groups: $groups);
    }
}
