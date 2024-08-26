<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Enums\FilterType;
use App\Modules\Content\Models\Sanity\Shows\BootCamp;
use App\Modules\Content\Models\Sanity\Shows\Live;
use App\Modules\Content\Models\Sanity\Shows\QuestionAndAnswer;
use App\Modules\Content\Models\Sanity\Shows\Spotlight;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\StringListItem;

/**
 * Defines the schema structure for a Essential document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Essential extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'name'),
            new Field(
                FieldType::Array,
                'filter_types',
                description: 'Content types for which this essential will be a filter option',
                of: new StringListItem(),
                options: ['list' => FilterType::Essential->filterOptions()]
            ),
        ];
        parent::__construct(self::getName(), 'Essentials', $fields);
    }

    public static function getName(): string
    {
        return 'essential';
    }
}
