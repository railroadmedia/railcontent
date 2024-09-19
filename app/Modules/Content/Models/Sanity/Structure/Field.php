<?php

namespace App\Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Validation\ValidationRule;
use Exception;

/**
 * A field of a Sanity CMS document
 */
class Field
{
    /**
     * @param  FieldType  $type
     * @param  string  $name
     * @param  string|null  $title
     * @param  string|null  $description
     * @param  mixed|null  $initialValue
     * @param  string|null  $to
     * @param  FormItem|array  $of
     * @param  Group|array<Group>|null  $group
     * @param  array|null  $options
     * @param  string|null  $hidden
     * @param  string|null  $readOnly
     * @param  array<ValidationRule>|null  $validation
     * @param  string|null  $inputComponent
     * @param  array|null  $fields
     */
    public function __construct(
        public FieldType $type,
        public string $name,
        public ?string $title = null,
        public ?string $description = null,
        public mixed $initialValue = null,
        //TODO can we do something more for $to? Can at least do some validation that there exists a class with that name, that extends BaseSanityModel
        public ?string $to = null,
        public FormItem|array $of = [],
        public Group|array|null $group = null,
        public ?array $options = null,
        public ?string $hidden = null,
        public ?string $readOnly = null,
        public ?array $validation = [],
        public ?string $inputComponent = null,
        public ?array $fields = null,
        public ?array $insertMenu = null,
    ) {

    }

    /**
     * Get the array-formatted values for this field, so that it can be rendered
     *
     * @return array
     * @throws Exception
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
        if (!is_null($this->description)) {
            $optional['description'] = $this->description;
        }
        if (!is_null($this->to)) {
            $optional['to'] = ['type' => $this->to];
        }
        if (!empty($this->of)) {
            if (!is_array($this->of)) {
                $optional['of'] = [$this->of];
            } else {
                $optional['of'] = $this->of;
            }
        }
        if (!is_null($this->fields)) {
            $optional['fields'] = $this->fields;
        }
        if (!is_null($this->options)) {
            $optional['options'] = $this->options;
        }
        if (!is_null($this->insertMenu)) {
            $optional['insertMenu'] = $this->insertMenu;
        }
        if ($this->group) {
            if (is_array($this->group)) {
                $optional['group'] = array_map(function (Group $group) {
                    return $group->name;
                }, $this->group);
            } else {
                $optional['group'] = $this->group->name;
            }
        }
        if (!is_null($this->hidden)) {
            $optional['hidden'] = Field::formatTypeScriptForView($this->hidden);
        }
        if (!empty($this->validation)) {
            $rules = array_map(function (ValidationRule $rule) {
                if (!in_array($this->type, $rule->getSupportedFieldTypes())) {
                    throw new Exception(sprintf('Invalid Rule: %s does not support field type %s', class_basename($rule), $this->type->name));
                }
                return $rule->toString();
            }, $this->validation);

            $optional['validation'] = Field::formatTypeScriptForView('(rule) => rule.' . implode('.', $rules));
        }
        if (!is_null($this->readOnly)) {
            $optional['readOnly'] = Field::formatTypeScriptForView($this->readOnly);
        }
        // Add initialValue to optional array
        if (!is_null($this->initialValue)) {
            $optional['initialValue'] = $this->initialValue;
        }
        // Add input components to optional array
        if (!is_null($this->inputComponent)) {
            $optional['components'] = ['input' => $this->inputComponent];
        }

        return array_merge($required, $optional);
    }

    private static function formatTypeScriptForView(string $value): string
    {
        $value = preg_replace("/\s\s+/", ' ', $value);
        return getStripFromJsonKey() . $value . getStripFromJsonKey();
    }
}
