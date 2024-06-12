<?php

namespace App\Modules\Content\Models\Sanity\Structure;

/**
 * A reference of a Sanity CMS document field
 */
class Reference
{
    public function __construct(public string $type, public array $to, public ?array $options = null)
    {
    }

    /**
     * Get the array-formatted values for this reference
     *
     * @return array
     */
    public function toArray(): array
    {
        $reference = [
            'type' => $this->type,
            'to' => [$this->to]
        ];
        if (!is_null($this->options)) {
            $reference['options'] = $this->options;
        }
        return $reference;
    }
}
