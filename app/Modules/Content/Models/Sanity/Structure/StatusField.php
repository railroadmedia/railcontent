<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Brand\Enums\Status;
use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;

/**
 * A field of a Sanity CMS document used for Status Values
 */
class StatusField extends Field
{
    /**
     * @param  Group|array<Group>|null  $group
     */
    public function __construct(
        public Group|array|null $group = null,
    ) {
        parent::__construct(FieldType::String, 'status', options:['list' => array_column(Status::cases(), 'value')], group: $this->group, validation: [new Required()]);
    }

}
