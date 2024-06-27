<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use Modules\Content\Models\Sanity\Structure\Block;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Song document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Song extends BaseSanityModel
{
    public function __construct()
    {
        $genreReference = new Reference([['type' => 'genre']],  options: ['aiAssist'=>['embeddingsIndex' => 'genre-index']]);
        $permissionReference = new Reference([['type' => 'permission']], options: ['disableNew' => false]);

        $resourceList = new ListObject(
            fields: [new Field(FieldType::String, 'resource_name'),
                        new Field(FieldType::URL, 'resource_url')],
            preview: ['select' => ['title' => 'resource_name', 'subtitle' => 'resource_url']]
        );
        $soundsliceList = new ListObject(
            fields: [new Field(FieldType::String, 'soundslice_title'),
                       new Field(FieldType::String, 'soundslice_slug', inputComponent: 'SoundsliceSlugInput'), new Field(FieldType::Number, 'soundslice_length_in_second')],
            preview: ['select' => ['title' => 'soundslice_title', 'subtitle' => 'soundslice_slug']]
        );
        $blockList = new Block();

        $detailsGroup = new Group('editorFields', 'Details', true);
        $openAIGroup = new Group('openAI', 'OpenAI');
        $groups = [
            $detailsGroup,
            $openAIGroup,
        ];

        $fields = [
            new Field(FieldType::String, 'title', validation: "(rule) => rule.required()",group:$detailsGroup),
            new Field(FieldType::Slug, 'slug', options:['source' => 'title','isUnique'=>'IsUniqueAcrossBrand'], hidden: "({document}) => !document?.title,", group:$detailsGroup),
            new BrandField($detailsGroup),
            new Field(FieldType::Datetime, 'published_on', options: ['dateformat' => 'YYYY-MM-DD '], group:$detailsGroup),
            new Field(FieldType::Array, 'permission', 'Permissions', of: $permissionReference, inputComponent: 'RolesBasedPermissionsInput',group:$detailsGroup),
            new Field(
                FieldType::Number,
                'difficulty',
                validation: "rule => rule.min(0).max(10)",
                inputComponent: 'DifficultyInput',group:$detailsGroup
            ),
            new Field(FieldType::String, 'difficulty_string', 'Difficulty String', readOnly: "true",group:$detailsGroup),
           // new Field(FieldType::Array, 'description', 'Description', of:$blockList),
            new Field(FieldType::Number, 'xp', 'XP', validation: "rule => rule.min(0)",group:$detailsGroup),
            new Field(FieldType::Number, 'total_xp', 'Total XP', hidden: "({document}) => !document?.xp", readOnly: "true",group:$detailsGroup),
            new Field(FieldType::Number, 'released', 'Year Released', validation: "rule => rule.min(0).max(new Date().getFullYear())",group:$detailsGroup ),
            new Field(FieldType::String, 'released_year_ai', 'Year Released AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::String, 'difficulty_ai', 'Difficulty AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::String, 'genre_ai', 'Genre AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::String, 'album',group:$detailsGroup),
            new Field(FieldType::String, 'transcriber_name', 'Transcribed By',group:$detailsGroup),
            new Field(FieldType::Boolean, 'instrumentless', 'Is instrumentless',group:$detailsGroup),
            new Field(FieldType::Boolean, 'show_in_new_feed', 'Show in new feed',group:$detailsGroup),
            new Field(FieldType::Boolean, 'hide_from_recsys', 'Hide from recsys',group:$detailsGroup),
            new Field(FieldType::Reference, 'artist', 'Artist', '', to: 'artist', options: ['aiAssist'=>['embeddingsIndex' => 'artists-index']],group:$detailsGroup),
            new Field(FieldType::Array, 'genre', 'Genre', '', of: $genreReference,group:$detailsGroup),
            new Field(FieldType::Array, 'soundslice', 'Soundslice', of:  $soundsliceList, inputComponent: 'ArrayInput',group:$detailsGroup),
            new Field(FieldType::Number, 'child_count', 'Child count', hidden: "({document}) => !document?.soundslice", readOnly: "true",group:$detailsGroup),
            new Field(FieldType::Array, 'resource', 'Resources', of: $resourceList,group:$detailsGroup),
            new Field(FieldType::Image, 'thumbnail', 'Thumbnail',group:$detailsGroup),
            new Field(FieldType::Number, 'railcontent_id', 'MWP Railcontent ID', readOnly: "true",group:$detailsGroup), //web_url_path
            new Field(FieldType::String, 'web_url_path', 'MWP web_url_path', readOnly: "true",group:$detailsGroup),
            new Field(FieldType::String, 'language', 'Language', hidden: "true",group:$detailsGroup),
        ];
        $preview = ['select' => ['title' => 'title', 'subtitle' => 'brand', 'media' => 'thumbnail']];
        parent::__construct('song', 'Song', fields: $fields, preview: $preview, groups: $groups);
    }
}
