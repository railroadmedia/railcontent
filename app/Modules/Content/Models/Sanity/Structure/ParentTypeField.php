<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;

/**
 * A field of a Sanity CMS document used for ParentTypes
 */
class ParentTypeField extends Field
{
    /**
     * @param  string $initialValue
     * @param Group|array<Group>|null $group
     */
    public function __construct(string $initialValue, Group|array|null $group = null)
    {
        parent::__construct(FieldType::String, 'parent_type', 'Parent type', group: $group, initialValue: $initialValue);
    }

}
