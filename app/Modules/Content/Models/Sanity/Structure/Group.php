<?php

namespace App\Modules\Content\Models\Sanity\Structure;

/**
 * A group of a Sanity CMS document, that can be used to structure the display of fields in a document type
 */
class Group
{
    public function __construct(public string $name, public string $title, public bool $default = false)
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
            'name' => $this->name,
            'title' => $this->title,
            'default' => $this->default
        ];
    }
}
