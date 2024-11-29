<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Validation\Max;

/**
 * Defines the schema structure for a Post document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Post extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'title', 'Title', validation: [new Max(62)]),
        ];
        parent::__construct(self::getName(), 'Post', $fields);
    }

    /**
     * @inheritDoc
     */
    public static function getName(): string
    {
        return 'post';
    }
}
