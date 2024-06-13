<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\Reference;
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
        $genreReference = new Reference('reference', [['type' => 'genre']]);
        $permissionReference = new Reference('reference', [['type' => 'permission']],options: ['disableNew'=> false]);

        $resourceList = new ListObject('object',fields: [new Field(FieldType::String, 'resource_name'),
                        new Field(FieldType::URL, 'resource_url')],preview: ['select' => ['title' => 'resource_name', 'subtitle' => 'resource_url']]
                                              );
        $soundsliceList = new ListObject('object',fields: [new Field(FieldType::String, 'soundslice_title'),
                       new Field(FieldType::String, 'soundslice_slug', inputComponent: 'SoundsliceSlug'), new Field(FieldType::Number, 'soundslice_length_in_second')],preview: ['select' => ['title' => 'soundslice_title', 'subtitle' => 'soundslice_slug']]
        );

        $fields = [
            new Field(FieldType::String, 'title', validation: "(rule) => rule.required()"),
            new Field(FieldType::Slug, 'slug', options:['source' => 'title'],  hidden: "({document}) => !document?.title,"),
            new BrandField(),
            new Field(FieldType::Datetime, 'published_on', options: ['dateformat' => 'YYYY-MM-DD ']),
            new Field(FieldType::Array, 'permission', 'Permissions', of: $permissionReference,  inputComponent: 'RolesBasedArrayInput'),
            new Field(FieldType::Number, 'difficulty',  validation: "rule => rule.min(0).max(10)"
                , inputComponent: 'CustomInput'
            ),
            new Field(FieldType::String, 'difficulty_string', 'Difficulty String', readOnly: "true"),
            new Field(FieldType::Number, 'xp', 'XP',  validation: "rule => rule.min(0)"),
            new Field(FieldType::Number, 'total_xp', 'Total XP',   hidden: "({document}) => !document?.xp", readOnly: "true"),
            new Field(FieldType::Number, 'released', 'Year Released', validation: "rule => rule.min(1500).max(new Date().getFullYear())"),
            new Field(FieldType::String, 'album'),
            new Field(FieldType::String, 'transcriber_name', 'Transcribed By'),
            new Field(FieldType::Boolean, 'instrumentless', 'Is instrumentless'),
            new Field(FieldType::Boolean, 'show_in_new_feed', 'Show in new feed'),
            new Field(FieldType::Boolean, 'hide_from_recsys', 'Hide from recsys'),
            new Field(FieldType::Reference, 'artist', 'Artist', '', to: 'artist'),
            new Field(FieldType::Array, 'genre', 'Genre', '', of: $genreReference),
            new Field(FieldType::Array, 'soundslice', 'Soundslice', of:  $soundsliceList,  inputComponent: 'ArrayInput'),
            new Field(FieldType::Number, 'child_count', 'Child count',   hidden: "({document}) => !document?.soundslice", readOnly: "true"),
            new Field(FieldType::Array, 'resource', 'Resources', of: $resourceList),
            new Field(FieldType::Image, 'thumbnail', 'Thumbnail'),
            new Field(FieldType::Number, 'railcontent_id', 'MWP Railcontent ID', readOnly: "true"), //web_url_path
            new Field(FieldType::String, 'web_url_path', 'MWP web_url_path', readOnly: "true"),
            new Field(FieldType::String, 'language', 'Language', hidden: "true"),
        ];
        $preview = ['select' => ['title' => 'title', 'subtitle' => 'brand', 'media' => 'thumbnail']];
        parent::__construct('song', 'Song', fields: $fields, preview: $preview);
    }
}
