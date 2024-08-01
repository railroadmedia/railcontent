<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListArrayElement;
use Modules\Content\Models\Sanity\Structure\ListObject;

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
        $resourceList = new ListArrayElement(
//            fields: [new Field(FieldType::String, 'search_in')]
        );
        $fields = [
            new Field(FieldType::String, 'catalog_type', validation: "(rule) => rule.required()"),
            new BrandField(),
            new Field(FieldType::String, 'general_groq_start'),
            new Field(FieldType::String, 'general_groq_end'),
            new Field(FieldType::String, 'groq_results'),
            new Field(FieldType::Array, 'groq_search_fields',  of: $resourceList),
            new Field(FieldType::String, 'groq'),
            new Field(FieldType::String, 'meta_data_groq'),
            new Field(FieldType::String, 'modal_text'),
            new Field(FieldType::String, 'sort_by'),
            //sortBy

        ];
        parent::__construct(self::getName(), 'Catalog Metadata', $fields);
    }

    public static function getName(): string
    {
        return 'catalog-metadata';
    }
}
