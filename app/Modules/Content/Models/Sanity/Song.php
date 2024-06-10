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
        $artistReference = new Reference('reference', [['type' => 'artist']]);
        $genreReference = new Reference('reference', [['type' => 'genre']]);
        $soundsliceReference =  new Reference('reference', [['type' => 'soundslice']]);
        $resourceReference = new Reference('reference', [['type' => 'resource']]);
        $permissionReference = new Reference('reference', [['type' => 'permission']]);

        $resourceList = new ListObject('object',fields: [new Field(FieldType::String, 'resource_name'),
                        new Field(FieldType::URL, 'resource_url')],preview: ['select' => ['title' => 'resource_name', 'subtitle' => 'resource_url']]
                                              );
        $soundsliceList = new ListObject('object',fields: [new Field(FieldType::String, 'soundslice_title'),
                       new Field(FieldType::String, 'soundslice_slug', inputComponent: 'SoundsliceSlug'), new Field(FieldType::Number, 'soundslice_length_in_second')],preview: ['select' => ['title' => 'soundslice_title', 'subtitle' => 'soundslice_slug']]
        );

        $fields = [
            new Field(FieldType::String, 'title', validation: "(rule) => rule.required()"),
            new Field(FieldType::Slug, 'slug', options:['source' => 'title'],  hidden: "({document}) => !document?.title,"),
            new Field(FieldType::Datetime, 'published_on', options: ['dateformat' => 'YYYY-MM-DD ']),

            new Field(FieldType::Array, 'permission', 'Permissions', of: $permissionReference),

            //TODO we have numbers and text, like 1, 4, all, beginner, etc. What should we do here??
            new Field(FieldType::Number, 'difficulty',  validation: "rule => rule.min(0).max(10)"
                , inputComponent: 'CustomInput'
            ),
            new Field(FieldType::String, 'difficulty_string', 'Difficulty String', readOnly: "true"),

            new Field(FieldType::Number, 'xp', 'XP',  validation: "rule => rule.min(0)"),
            new Field(FieldType::Number, 'total_xp', 'Total XP',   hidden: "({document}) => !document?.xp", readOnly: "true"),
            //TODO song style is in the railcontent_content_styles table. We'll need a styles schema and reference it on this
            // new Field(FieldType::Array, 'style', of:'reference', list:),
            //TODO reference??

            //TODO can/should we do date instead and store just the year?
            new Field(FieldType::Number, 'released', 'Year Released', validation: "rule => rule.min(1500).max(new Date().getFullYear())"),
            //TODO reference??
            new Field(FieldType::String, 'album'),
            //TODO reference??
            new Field(FieldType::String, 'transcriber_name', 'Transcribed By'),
            new Field(FieldType::Boolean, 'instrumentless', 'Is instrumentless'),
            new BrandField(),

            new Field(FieldType::Number, 'length_in_seconds', 'Length', description: 'song length in seconds'),
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
        ];
        $preview = ['select' => ['title' => 'title', 'media' => 'thumbnail']];
        parent::__construct('song', 'Song', fields: $fields, preview: $preview);
    }
}
