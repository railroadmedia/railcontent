<?php

namespace App\Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

/**
 * A field of a Sanity CMS document
 */
class Field
{
    public FieldType $type;
    public string $name;
    public ?string $title;
    public ?array $options;

    /**
     * @param  FieldType  $type
     * @param  string  $name
     * @param  string|null  $title
     * @param  array|null  $options
     */
    public function __construct(FieldType $type, string $name, ?string $title = null, ?array $options = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->title = $title;
        $this->options = $options;
    }

    /**
     * Get the array-formatted values for this field, so that it can be rendered
     *
     * @return array
     */
    public function toArray(): array
    {
        $required = [
            'type' => $this->type->value,
            'name' => $this->name,
        ];
        $optional = [];
        if (!is_null($this->title)) {
            $optional['title'] = $this->title;
        }
        if (!is_null($this->options)) {
            $optional['options'] = $this->options;
        }
        return array_merge($required, $optional);
    }
}
