<?php

namespace App\Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

/**
 * A reference of a Sanity CMS document field
 */
class Reference extends ArrayItem
{
    public function __construct(public array $to, public ?array $options = null)
    {
        parent::__construct(FieldType::Reference);
    }

    /**
     * Get the array-formatted values for this reference
     *
     * @return array
     */
    public function toArray(): array
    {
        $reference = [
            'type' => $this->type->value,
            'to' => [$this->to]
        ];
        if (!is_null($this->options)) {
            $reference['options'] = $this->options;
        }
        return $reference;
    }
}
