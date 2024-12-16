<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListArrayElement;

/**
 * Defines the schema structure for a Catalogue Metadata document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class CatalogMetadata extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'catalog_type', validation: [new Required()]),
            new BrandField(),
            new Field(FieldType::String, 'groq_results', title:'Fields that should be returned:'),
            new Field(FieldType::Array, 'groq_search_fields', title:'Search in fields:', of: new ListArrayElement()),
            new Field(FieldType::String, 'meta_data_groq'),
            new Field(FieldType::String, 'modal_text'),
            new Field(FieldType::String, 'sort_by'),
        ];
        parent::__construct(self::getName(), 'Catalog Metadata', $fields);
    }

    public static function getName(): string
    {
        return 'catalog-metadata';
    }
}
