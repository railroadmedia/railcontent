<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\ArrayItem;
use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * A reference of a Sanity CMS document field
 */
class ListObject extends ArrayItem
{
    public function __construct(public array $fields, public ?array $preview = null)
    {
        parent::__construct(FieldType::Object);
        $this->fields = array_map(function (Field $field) {
            return $field->toArray();
        }, $this->fields);

    }

    /**
     * Get the array-formatted values for this reference
     *
     * @return array
     */
    public function toArray(): array
    {
        $required =  [
            'type' => $this->type->value,
            'fields' => $this->fields
        ];
        if($this->preview) {
            $required['preview'] = $this->preview;
        }
        return $required;
    }
}
