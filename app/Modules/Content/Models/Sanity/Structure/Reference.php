<?php

namespace App\Modules\Content\Models\Sanity\Structure;

/**
 * A reference of a Sanity CMS document field
 */
class Reference
{
    public function __construct(public string $type, public array $to)
    {
    }

    /**
     * Get the array-formatted values for this reference
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'of' => [$this->to]
        ];
    }
}
