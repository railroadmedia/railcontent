<?php

namespace App\Modules\Content\Models\Sanity\Structure;

/**
 * A group of a Sanity CMS document, that can be used to structure the display of fields in a document type
 */
class Reference
{
    public function __construct(public string $type, public array $to)
    {
    }

    /**
     * Get the array-formatted values for this group, so that it can be rendered as part of the Sanity document type
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
