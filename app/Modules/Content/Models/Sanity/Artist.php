<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for an Artist document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Artist extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'name'),
            new Field(FieldType::Image, 'thumbnail_url'),
        ];
        parent::__construct(self::getName(), 'Artist', $fields);
    }

    /**
     * @inheritDoc
     */
    public static function getName(): string
    {
        return 'artist';
    }
}
