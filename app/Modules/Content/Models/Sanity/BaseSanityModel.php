<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Abstract class to represent a document type's schema in Sanity
 */
abstract class BaseSanityModel
{
    public string $type = 'document';
    public string $name;
    public string $title;
    public ?string $icon;
    /** @var array<Field> */
    public array $fields;

    /**
     * @param  string  $name
     * @param  string  $title
     * @param  array<Field>  $fields
     * @param  string|null  $icon
     */
    public function __construct(string $name, string $title, array $fields, ?string $icon = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->fields = $fields;
        $this->icon = $icon;
    }

    /**
     * Get the array-formatted values for this schema, so that it can be rendered
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => 'document',
            'name' => 'post',
            'title' => 'Post',
            'fields' => array_map(function (Field $field) {
                return $field->toArray();
            }, $this->fields)
        ];
    }
}
