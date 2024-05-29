<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

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
    /** @var array<Group>|null */
    public ?array $groups;
    public ?array $preview;

    /**
     * @param  string  $name
     * @param  string  $title
     * @param  array<Field>  $fields
     * @param  array<Group>|null  $groups
     * @param  string|null  $icon
     */
    public function __construct(string $name, string $title, array $fields, ?array $groups = null, ?string $icon = null, ?array $preview = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->fields = $fields;
        $this->groups = $groups;
        $this->icon = $icon;
        $this->preview = $preview;
    }

    /**
     * Get the array-formatted values for this schema, so that it can be rendered
     *
     * @return array
     */
    public function toArray(): array
    {
        $required = [
            'type' => $this->type,
            'name' => $this->name,
            'title' => $this->title,
            'fields' => array_map(function (Field $field) {
                return $field->toArray();
            }, $this->fields)
        ];
        if($this->preview){
            $required['preview'] = $this->preview;
        }

        $optional = [];
        if ($this->groups) {
            $optional['groups'] = array_map(function (Group $group) {
                return $group->toArray();
            }, $this->groups);
        }
        return array_merge($required, $optional);
    }
}
