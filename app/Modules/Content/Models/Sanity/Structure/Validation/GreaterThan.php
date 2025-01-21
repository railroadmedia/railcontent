<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class GreaterThan extends ValidationRule
{
    /**
     * @param  int|string  $value the int value that this field must be greater than,
     *                      or the string name of the field to reference
     * @param  string|null  $warningMessage
     * @param  string|null  $errorMessage
     */
    public function __construct(int|string $value, ?string $warningMessage = null, ?string $errorMessage = null)
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
        return [FieldType::Number];
    }
}
