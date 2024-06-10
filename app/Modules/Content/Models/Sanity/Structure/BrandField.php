<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * A field of a Sanity CMS document used for Brand Values
 */
class BrandField extends Field
{
    /**
     * @param  Group|array<Group>|null  $group
     */
    public function __construct(
        public Group|array|null $group = null,
    ) {
        parent::__construct(FieldType::String, 'brand', options:['list' => array_column(Brand::cases(), 'value')], group: $this->group, validation: "(rule) => rule.required()");
    }

}
