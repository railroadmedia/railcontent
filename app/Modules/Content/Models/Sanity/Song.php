<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use Modules\Content\Models\Sanity\Structure\BrandField;

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

        $fields = [
            new Field(FieldType::String, 'title'),
            new Field(FieldType::Datetime, 'published_on'),
            //TODO we have numbers and text, like 1, 4, all, beginner, etc. What should we do here??
            new Field(FieldType::Number, 'difficulty', null, null, null, null, null, null, null, null, validation: "rule => rule.min(0).max(10)"),
           // new Field(FieldType::String, 'difficulty_string', 'Difficulty String', null, null,null,null,null,null,null,null,null, 'MyCustomScript' ),

            new Field(FieldType::Number, 'xp', 'XP', null, null, null, null, null, null, null, null, validation: "rule => rule.min(0)"),
            //TODO song style is in the railcontent_content_styles table. We'll need a styles schema and reference it on this
            // new Field(FieldType::Array, 'style', of:'reference', list:),
            //TODO reference??

            //TODO can/should we do date instead and store just the year?
            new Field(FieldType::Number, 'released', 'Year Released', null, null, null, null, null, null, null, null, validation: "rule => rule.min(1500).max(new Date().getFullYear())"),
            //TODO reference??
            new Field(FieldType::String, 'album'),
            //TODO reference??
            new Field(FieldType::String, 'transcriber_name', 'Transcribed By'),
            new Field(FieldType::Boolean, 'instrumentless', 'Is instrumentless'),
            new BrandField(),
            new Field(FieldType::Slug, 'slug', options:['source' => 'title']),
            new Field(FieldType::Number, 'length_in_seconds', 'Length', description: 'song length in seconds'),
            new Field(FieldType::Boolean, 'show_in_new_feed', 'Show in new feed'),
            new Field(FieldType::Boolean, 'hide_from_recsys', 'Hide from recsys'),

            new Field(FieldType::Array, 'artist', 'Artist', '', null, null, of: $artistReference),
            new Field(FieldType::Array, 'genre', 'Genre', '', null, null, of: $genreReference),
            new Field(FieldType::Array, 'soundslice', 'Soundslice', '', null, null, of:  $soundsliceReference),
            new Field(FieldType::Array, 'resource', 'Resources', '', null, null, of: $resourceReference),

            new Field(FieldType::URL, 'thumbnail_url', 'Thumbnail url'),

        ];
        parent::__construct('song', 'Song', $fields);
    }
}
