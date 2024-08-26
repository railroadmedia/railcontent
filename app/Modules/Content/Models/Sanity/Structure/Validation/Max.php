<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class Max extends ValidationRule
{
    /**
     * @param  int|float|string  $value the int|float value that this field must have at maximum,
     *                      or the string name of the field to reference the value of
     * @param  string|null  $warningMessage
     * @param  string|null  $errorMessage
     */
    public function __construct(int|float|string $value, ?string $warningMessage = null, ?string $errorMessage = null)
    {
        if (is_string($value)) {
            $value = "rule.valueOfField('$value')";
        }
        parent::__construct($value, $warningMessage, $errorMessage);
    }

    /**
     * @inheritDoc
     */
    public function getSupportedFieldTypes(): array
    {
        return [FieldType::Array, FieldType::Number, FieldType::String, FieldType::Text];
    }
}
