<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\StringListItem;

/**
 * Defines the schema structure for a Genre document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Genre extends BaseSanityModel
{
    public function __construct()
    {
        $filterTypeOptions = [Song::getName()];

        $fields = [
            new Field(FieldType::String, 'name'),
            new Field(FieldType::Image, 'thumbnail_url'),
            new Field(
                FieldType::Array,
                'filter_types',
                description: 'Content types for which this genre will be a filter option',
                of: new StringListItem(),
                options: ['list' => $filterTypeOptions]
            ),
        ];
        parent::__construct(self::getName(), 'Genre', $fields);
    }

    /**
     * @inheritDoc
     */
    public static function getName(): string
    {
        return 'genre';
    }
}
