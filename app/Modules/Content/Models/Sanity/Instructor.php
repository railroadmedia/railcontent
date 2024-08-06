<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;

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
        $fields = [
            new Field(FieldType::String, 'name'),
            new Field(FieldType::Image, 'thumbnail_url'),
            new Field(FieldType::Number, 'railcontent_id', 'MWP Railcontent ID', readOnly: "true"),
            new Field(FieldType::String, 'web_url_path', 'MWP web_url_path', readOnly: "true"),
        ];
        parent::__construct(self::getName(), 'Instructor', $fields);
    }

    public static function getName(): string
    {
        return 'instructor';
    }
}
