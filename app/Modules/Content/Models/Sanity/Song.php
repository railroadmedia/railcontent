<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
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
        $fields = [
            new Field(FieldType::String, 'title'),
            //TODO we have numbers and text, like 1, 4, all, beginner, etc. What should we do here??
            new Field(FieldType::Number, 'difficulty'),
            new Field(FieldType::Number, 'xp', 'XP'),
            //TODO song style is in the railcontent_content_styles table. We'll need a styles schema and reference it on this
            // new Field(FieldType::Array, 'style', of:'reference', list:),
            //TODO reference??

            //TODO can/should we do date instead and store just the year?
            new Field(FieldType::Number, 'released', 'Year Released'),
            //TODO reference??
            new Field(FieldType::String, 'album'),
            //TODO reference??
            new Field(FieldType::String, 'transcriber_name', 'Transcribed By'),
            new Field(FieldType::Boolean, 'instrumentless', 'Is instrumentless'),
            new BrandField(),
            new Field(FieldType::Slug, 'slug', options:['source' => 'title']),
            new Field(FieldType::Number, 'length_in_seconds', 'Length', description: 'song length in seconds'),
            new Field(FieldType::Reference, 'artist','Artist','' ,null,'artist'),
            new Field(FieldType::Reference, 'genre','Genre','' ,null,'genre')
        ];
        parent::__construct('song', 'Song', $fields);
    }
}
